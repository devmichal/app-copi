<?php

namespace App\Core\Application\Command\Files\UploadFile;


use Symfony\Component\HttpFoundation\File\UploadedFile;


final class UploadFileCommand
{
    public const NAME = 'upload.file';

    private string $taskId;

    private UploadedFile $uploadedFile;


    public function __construct(
        UploadedFile $uploadedFile,
        string $taskId
    )
    {
        $this->taskId = $taskId;
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @return string
     */
    public function getTaskId(): string
    {
        return $this->taskId;
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedFile(): UploadedFile
    {
        return $this->uploadedFile;
    }
}