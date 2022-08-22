<?php

namespace App\Core\Domain\Model\Task\GS;

trait TaskDateGS
{
    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    public function getTaskDateAt(): \DateTime
    {
        return $this->taskDateAt;
    }

    public function getDeadLineAt(): \DateTime
    {
        return $this->deadLineAt;
    }

    /**
     * @return string
     */
    public function getFinishTaskAt()
    {
        return $this->finishTaskAt;
    }
}
