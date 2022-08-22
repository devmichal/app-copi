<?php

namespace App\Core\Domain\Model\TypeText\GS;

use Doctrine\Common\Collections\ArrayCollection;

trait TypeTextGS
{
    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getTask(): ArrayCollection
    {
        return $this->task;
    }
}
