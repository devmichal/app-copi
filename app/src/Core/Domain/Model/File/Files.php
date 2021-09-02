<?php


namespace App\Core\Domain\Model\File;


use App\Core\Domain\Model\File\GS\FilesGS;
use App\Core\Domain\Model\Task\Task;
use DateTime;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class Files
{
    use FilesGS;

    private string $id;

    private string $nameFiles;

    private string $pathFile;

    private string $typeExt;

    private DateTime $createdAt;

    private Task $task;


    public function __construct(UploadedFile $uploadedFile, Task $task, string $pathFile)
    {
        $this->id        = uuid_create();
        $this->createdAt = new DateTime();
        $this->nameFiles = $uploadedFile->getClientOriginalName();
        $this->pathFile  = $pathFile;
        $this->task      = $task;
        $this->typeExt   = $uploadedFile->getExtension();
    }

}
