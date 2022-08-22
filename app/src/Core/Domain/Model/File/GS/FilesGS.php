<?php

namespace App\Core\Domain\Model\File\GS;

use App\Core\Domain\Model\Task\Task;

trait FilesGS
{
    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNameFiles(): string
    {
        return $this->nameFiles;
    }

    public function getPathFile(): string
    {
        return $this->pathFile;
    }

    public function getTypeExt(): string
    {
        return $this->typeExt;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getTask(): Task
    {
        return $this->task;
    }
}
