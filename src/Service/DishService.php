<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\InvalidRecipeException;
use App\Helper\DishHelper;

class DishService
{
    public function __construct(
        private readonly IngredientService $ingredientService,
    ) {
    }

    /**
     * @throws InvalidRecipeException
     */
    public function getAllVariantsByCode(string $code): array
    {
        $ingredientList = [];

        $typeCodes = [];
        foreach (str_split($code) as $typeCode) {
            if (!isset($typeCodes[$typeCode])) {
                $typeCodes[$typeCode] = 0;
            }

            $typeCodes[$typeCode] += 1;
        }

        foreach ($typeCodes as $typeCode => $codeCount) {
            $ingredientList[$typeCode] = $this->ingredientService->getByCodeAndCount($typeCode, $codeCount);
        }

        return DishHelper::makeUniqueDishes($ingredientList, $code);
    }
}
