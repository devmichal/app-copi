<?php


namespace App\Core\Domain\Model\File\GS;


use App\Core\Domain\Model\Task\Task;
use App\Core\Domain\Model\Users\User;

trait FilesGS
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
    public function getNameFiles(): string
    {
        return $this->nameFiles;
    }

    /**
     * @return string
     */
    public function getPathFile(): string
    {
        return $this->pathFile;
    }

    /**
     * @return string
     */
    public function getTypeExt(): string
    {
        return $this->typeExt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return User
     */
    public function getUsers(): User
    {
        return $this->users;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }
}
