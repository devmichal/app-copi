<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Files\UploadFile;


use Symfony\Component\HttpFoundation\File\UploadedFile;


final class UploadFileCommand
{
    public const NAME = 'upload.file';


    public function __construct(
        private UploadedFile $uploadedFile,
        private string $taskId
    )
    {}

    public function getTaskId(): string
    {
        return $this->taskId;
    }

    public function getUploadedFile(): UploadedFile
    {
        return $this->uploadedFile;
    }
}