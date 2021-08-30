<?php


namespace App\Core\Domain\Model\File;


use App\Core\Domain\Model\File\GS\FilesGS;
use App\Core\Domain\Model\Task\Task;
use App\Core\Domain\Model\Users\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Files
{
    use FilesGS;

    /** @var string */
    private $id;

    /** @var string */
    private $nameFiles;

    /** @var string */
    private $pathFile;

    /** @var string */
    private $typeExt;

    /** @var \DateTime */
    private $createdAt;

    /** @var Task */
    private $task;

    public function __construct(UploadedFile $uploadedFile, Task $task, string $pathFile)
    {
        $this->id        = uuid_create();
        $this->createdAt = new \DateTime();
        $this->nameFiles = $uploadedFile->getClientOriginalName();
        $this->pathFile  = $pathFile;
        $this->task      = $task;
        $this->typeExt   = $uploadedFile->getExtension();
    }


}
