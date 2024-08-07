<?php

declare(strict_types=1);

namespace App\Model;

class Product
{
    public function __construct(
        private readonly string $type,
        private readonly string $value,
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
