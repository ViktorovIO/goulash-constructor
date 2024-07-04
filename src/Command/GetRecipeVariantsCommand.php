<?php

namespace App\Command;

use App\Exception\InvalidRecipeException;
use App\Model\Dish;
use App\Service\DishService;
use App\Transformer\DishTransformer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'get:recipe:variants',
    description: 'Gives a recipe code and return all dish variants',
)]
class GetRecipeVariantsCommand extends Command
{
    public function __construct(
        private readonly DishService $dishService,
        private readonly DishTransformer $transformer,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('recipe', InputArgument::REQUIRED, 'Recipe code')
        ;
    }

    /**
     * @throws InvalidRecipeException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $recipeCode = $input->getArgument('recipe');

        if ($recipeCode) {
            $io->note(sprintf('Ищем возможные варианты блюд по рецепту: %s', $recipeCode));
        }

        $dishList = $this->dishService->getAllVariantsByCode($recipeCode);
        $result = $this->makeResponse($dishList);

        $io->success($result);

        return Command::SUCCESS;
    }

    /**
     * @param Dish[] $dishList
     * @return string
     */
    private function makeResponse(array $dishList): string
    {
        $response = [];
        foreach ($dishList as $dish) {
            $response[] = $this->transformer->transformToArray($dish);
        }

        return json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
