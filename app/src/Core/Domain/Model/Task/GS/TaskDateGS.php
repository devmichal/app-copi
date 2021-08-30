<?php


namespace App\Core\Domain\Model\Task\GS;


trait TaskDateGS
{
    /**
     * @return \DateTime
     */
    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    /**
     * @return \DateTime
     */
    public function getTaskDateAt(): \DateTime
    {
        return $this->taskDateAt;
    }

    /**
     * @return \DateTime
     */
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
