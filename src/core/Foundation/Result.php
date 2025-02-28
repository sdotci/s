<?php

declare(strict_types=1);

namespace S\Foundation;

class Result
{
    public function __construct(protected mixed $data) {}

    public function isSuccess(): bool
    {
        return $this->data !== null;
    }

    public function send(): never
    {
        if (is_scalar($this->data)) {
            echo $this->data;
        } else {
            echo json_encode($this->data);
        }

        exit;
    }
}
