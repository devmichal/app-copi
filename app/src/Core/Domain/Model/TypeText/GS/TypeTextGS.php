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

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return ArrayCollection
     */
    public function getTask(): ArrayCollection
    {
        return $this->task;
    }
}
