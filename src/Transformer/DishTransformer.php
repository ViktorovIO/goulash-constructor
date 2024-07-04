<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Model\Dish;
use App\Model\Product;

class DishTransformer
{
    public function transformToArray(Dish $dish): array
    {
        return [
            "products" => $this->transformProductsToArray($dish->getProducts()),
            "price" => $dish->getPrice(),
        ];
    }

    /**
     * @param Product[] $products
     * @return array
     */
    private function transformProductsToArray(array $products): array
    {
        $result = [];
        foreach ($products as $product) {
            $result[] = [
                "type" => $product->getType(),
                "value" => $product->getValue(),
            ];
        }

        return $result;
    }
}
