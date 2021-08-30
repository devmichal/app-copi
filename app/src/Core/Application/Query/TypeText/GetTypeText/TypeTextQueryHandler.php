<?php


namespace App\Core\Application\Query\TypeText\GetTypeText;


use App\Core\Application\Query\TypeText\TypeTextDTO;
use App\Core\Infrastructure\Repository\TypeText\MatchTextType;


final class TypeTextQueryHandler
{
    private MatchTextType $matchTextType;


    public function __construct(
        MatchTextType $matchTextType
    )
    {

        $this->matchTextType = $matchTextType;
    }

    public function __invoke(TypeTextQuery $textQuery): array
    {
        $typeTexts = $this->matchTextType->getTypeText($textQuery->getUser());

        $buildTable = [];
        foreach ($typeTexts as $typeText) {

            $buildTable[] = TypeTextDTO::fromEntity($typeText);
        }

        return $buildTable;
    }
}