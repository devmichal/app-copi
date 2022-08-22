<?php

namespace App\Tests\Core\Application\Command\Task\TaskDate;

use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Task\TaskDate;
use DateTime;
use PHPUnit\Framework\TestCase;

class TaskDateTest extends TestCase
{
    public const FORMAT_TIME = 'Y-m-d H:i';
    public const DATA_TIME = '05-12-2021';

    final public function testShouldCreateActualDateForCreatedAt(): void
    {
        $actualTime = new DateTime();

        $result = new TaskDate(new CreateTaskDTO());

        $this->assertEquals($actualTime->format(self::FORMAT_TIME), $result->getCreateAt()->format(self::FORMAT_TIME));
    }

    final public function testShouldCreateUserDataTime(): void
    {
        $createTaskDTO = new CreateTaskDTO();
        $createTaskDTO->setCreatedAt(self::DATA_TIME);

        $result = new TaskDate($createTaskDTO);

        $this->assertEquals($this->createActualTime(), $result->getCreateAt()->format(self::FORMAT_TIME));
    }

    private function createActualTime(): string
    {
        $actualHour = new DateTime();
        $actualTime = new DateTime(self::DATA_TIME);

        return $actualTime->format('Y-m-d').' '.$actualHour->format('H:i');
    }
}
