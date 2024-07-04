<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Ingredient;
use App\Entity\IngredientType;
use App\Exception\InvalidRecipeException;
use Doctrine\ORM\EntityManagerInterface;

class IngredientService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @param string $typeCode
     * @param int $codeCount
     * @return Ingredient[]
     * @throws InvalidRecipeException
     */
    public function getByCodeAndCount(string $typeCode, int $codeCount): array
    {
        $ingredientTypeRepository = $this->entityManager->getRepository(IngredientType::class);

        /** @var IngredientType $ingredientType */
        $ingredientType = $ingredientTypeRepository->findOneBy(['code' => $typeCode]);
        $ingredientList = $ingredientType->getIngredients()->toArray();
        if (count($ingredientList) < $codeCount) {
            throw new InvalidRecipeException(sprintf('Не хватает ингридиентов типа %s', $typeCode));
        }

        return $ingredientList;
    }
}
