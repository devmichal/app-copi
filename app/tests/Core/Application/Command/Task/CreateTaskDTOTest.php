<?php


namespace App\Tests\Core\Application\Command\Task;


use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\TypeText\TypeText;

class CreateTaskDTOTest
{
    public static function createClient(): CreateTaskDTO
    {
        $createTaskDTO = new CreateTaskDTO();

        $createTaskDTO->setNumberCountCharacter(123);
        $createTaskDTO->setTitleTask('some title task');
        $createTaskDTO->setClient(new Client());
        $createTaskDTO->setDeadLineAt('1-1-2022');
        $createTaskDTO->setTypeText(new TypeText());

        return $createTaskDTO;
    }
}