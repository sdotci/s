<?php

declare(strict_types=1);

namespace S\Foundation\Concretes;

use Psr\Container\ContainerInterface;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use S\Exceptions\BadValue;
use S\Exceptions\NotFound;
use S\Support\Callback;
use S\Support\Reflector;

class Container implements ContainerInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $shared = [];

    /**
     * @var array<string, mixed[]|string|object|callable(mixed ...$args): mixed>
     */
    protected array $dependencies = [];

    /**
     * @var array<string, class-string|trait-string|string>
     */
    protected array $aliases = [];

    /**
     * @param  array<string, mixed[]|string|object|callable(mixed ...$args): mixed>  $dependencies
     */
    public function __construct(array $dependencies = [])
    {
        $this->setDependencies($dependencies);
    }

    /**
     * @param  array<string, mixed[]|string|object|callable(mixed ...$args): mixed>  $dependencies
     */
    public function setDependencies(array $dependencies): static
    {
        foreach ($dependencies as $id => $dependency) {
            $this->set($id, $dependency);
        }

        return $this;
    }

    /**
     * @param  mixed[]|string|object|callable(mixed ...$args): mixed  $dependency
     */
    public function set(string $id, array|string|object|callable $dependency): static
    {
        if (is_string($dependency) && ! is_callable($dependency)) {
            $this->aliases[$id] = $dependency;
        } else {
            $this->dependencies[$id] = $dependency;
        }

        return $this;
    }

    public function get(string $id, mixed $default = null): mixed
    {
        if (isset($this->aliases[$id])) {
            return $this->get($this->aliases[$id], $default);
        }

        return $this->dependencies[$id] ?? $default ?? $id;
    }

    public function has(string $id): bool
    {
        return isset($this->aliases[$id]) || isset($this->dependencies[$id]);
    }

    public function shared(string $id): mixed
    {
        return $this->shared[$id] ??= $this->build($id);
    }

    public function build(string $id): mixed
    {
        $dependency = $this->get($id);

        if (! class_exists($dependency)) {
            throw NotFound::new('Could not build %s.', [$id]);
        }

        if (is_array($dependency)) {
            if (class_exists($id)) {
                return $this->instanciateArgs($id, $dependency);
            }

            if (is_callable($id)) {
                return $this->invokeArgs($id, $dependency);
            }

            throw BadValue::new('Invalid dependency given');
        }

        if (is_callable($dependency)) {
            return $this->invoke($dependency);
        }
        if (is_object($dependency)) {
            return $this->instanciate($dependency);
        }
        if (class_exists($dependency)) {
            return $this->instanciate($dependency);
        }

        return $this->get($dependency);
    }

    /**
     * @return list<class-string>
     */
    public function getClasses(): array
    {
        $classes = [];

        foreach ($this->aliases as $id) {
            if ($class = $this->getClass($id)) {
                $classes[] = $class;
            }
        }

        foreach (array_keys($this->dependencies) as $id) {
            if ($class = $this->getClass($id)) {
                $classes[] = $class;
            }
        }

        return $classes;
    }

    /**
     * @return null|class-string
     */
    public function getClass(string $id): ?string
    {
        if (isset($this->dependencies[$id])) {
            $dependency = $this->dependencies[$id];

            if (is_object($dependency)) {
                return $dependency::class;
            }

            if (is_string($dependency)) {
                return class_exists($dependency) || interface_exists($dependency) ? $dependency : $this->getClass($dependency);
            }

            if (class_exists($id)) {
                return $id;
            }
        }

        return null;
    }

    /**
     * Tries to build the given instance.
     *
     * @template TObject of object
     *
     * @param  TObject|class-string<TObject>  $object_or_class
     * @return TObject|null
     */
    public function instanciate(object|string $object_or_class, mixed ...$args): ?object
    {
        return $this->instanciateArgs($object_or_class, $args);
    }

    /**
     * Tries to build the given instance.
     *
     * @template TObject of object
     *
     * @param  TObject|class-string<TObject>  $object_or_class
     * @param  mixed[]  $args
     * @return TObject|null
     */
    public function instanciateArgs(object|string $object_or_class, array $args = []): ?object
    {
        $reflectionClass = Reflector::reflectClass($object_or_class);

        if ($reflectionClass->isInstantiable()) {
            $constructor = $reflectionClass->getConstructor();

            if ($constructor instanceof \ReflectionMethod) {
                $args = $this->buildFunctionArgs($constructor, $args);

                return $args === [] ? $reflectionClass->newInstance() : $reflectionClass->newInstanceArgs($args);
            }

            return $reflectionClass->newInstance();
        }

        throw BadValue::new('The class %s cannot be instantiated.', [$object_or_class::class]);
    }

    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $callback
     */
    public function invoke(array|string|object|callable $callback, mixed ...$arguments): mixed
    {
        return $this->invokeArgs($callback, $arguments);
    }

    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $callback
     * @param  mixed[]  $args
     */
    public function invokeArgs(array|string|object|callable $callback, array $args = []): mixed
    {
        $callback = Callback::from($callback);

        if ($method = $callback->getMethod()) {
            $method = ($object = $callback->getObject())
            ? Reflector::reflectMethod($object, $method)
            : Reflector::reflectMethod($method);

            return $this->invokeFunctionArgs($method, $args, $object);
        }

        $func = Reflector::reflectCallback($callback);

        return $this->invokeFunctionArgs($func, $args);
    }

    /**
     * @param  mixed[]  $args
     */
    public function invokeFunctionArgs(ReflectionFunction|ReflectionMethod $func, array $args = [], ?object $object = null): mixed
    {
        $args = $this->buildFunctionArgs($func, $args);

        if ($args === []) {
            /** @var mixed $result */
            $result = $func instanceof ReflectionMethod
            ? $func->invoke($object)
            : $func->invoke();
        } else {
            /** @var mixed $result */
            $result = $func instanceof ReflectionMethod
            ? $func->invokeArgs($object, $args)
            : $func->invokeArgs($args);
        }

        if (! Reflector::checkType($type = $func->getReturnType(), $result)) {
            throw BadValue::new('%s expected but %s provided.', [(string) $type ?: 'mixed', get_debug_type($result)]);
        }

        return $result;
    }

    /**
     * @param  mixed[]  $args
     * @return list<mixed>
     */
    public function buildFunctionArgs(ReflectionFunctionAbstract $func, array $args = []): array
    {
        $args = Reflector::buildFunctionArgs($func, $args);
        $classes = $this->getClasses();
        foreach ($func->getParameters() as $param) {
            $pos = $param->getPosition();
            if (! isset($args[$pos]) && ! $param->allowsNull()) {
                /** @psalm-suppress MixedAssignment */
                $args[$pos] = Reflector::getParameterClassName($param, $classes);
            }
        }

        return $args;
    }
}
