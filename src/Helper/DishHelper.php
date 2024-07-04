<?php

declare(strict_types=1);

namespace App\Helper;

use App\Entity\Ingredient;
use App\Model\Dish;
use App\Model\Product;

class DishHelper
{
    /**
     * Генерация всех возможных блюд с уникальными ингредиентами
     *
     * @param list<string, Ingredient[]> $ingredientList
     * @param string $recipeCode
     * @return Dish[]
     */
    public static function makeUniqueDishes(array $ingredientList, string $recipeCode): array
    {
        $result = [];
        $recipeCodeLen = strlen($recipeCode);

        $indexList = array_fill(0, $recipeCodeLen, 0);
        $currentRecipe = array_fill(0, $recipeCodeLen, null);

        while (true) {
            for ($i = 0; $i < $recipeCodeLen; $i++) {
                $typeCode = $recipeCode[$i];
                $currentRecipe[$i] = $ingredientList[$typeCode][$indexList[$i]];
            }

            $isUnique = true;
            $values = [];
            foreach ($currentRecipe as $ingredient) {
                if (in_array($ingredient->getId(), $values)) {
                    $isUnique = false;
                    break;
                }

                $values[] = $ingredient->getId();
            }

            if ($isUnique) {
                $result[] = self::makeDish($currentRecipe);
            }

            // Увеличение индексов для генерации следующей комбинации
            for ($i = $recipeCodeLen - 1; $i >= 0; $i--) {
                $typeCode = $recipeCode[$i];
                if (++$indexList[$i] < count($ingredientList[$typeCode])) {
                    break;
                } else {
                    // Все возможные варианты пройдены
                    $indexList[$i] = 0;
                    if ($i == 0) {
                        break 2;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @param Ingredient[] $recipe
     * @return Dish
     */
    private static function makeDish(array $recipe): Dish
    {
        $price = 0.0;
        $productList = [];
        foreach ($recipe as $ingredient) {
            $productList[] = new Product($ingredient->getType()->getTitle(), $ingredient->getTitle());
            $price += $ingredient->getPrice();
        }

        return new Dish($productList, $price);
    }
}
