<?php

declare(strict_types=1);

namespace App\Model;

class Dish
{
    /**
     * @param Product[] $products
     * @param float $price
     */
    public function __construct(
        private readonly array $products,
        private readonly float $price,
    ) {
    }

    /** @return Product[] */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
