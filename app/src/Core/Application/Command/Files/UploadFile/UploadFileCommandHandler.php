<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Files\UploadFile;


use App\Core\Domain\Model\File\Files;
use App\Core\Infrastructure\Repository\Task\MatchTask;
use App\Core\Infrastructure\Service\SaveFiles\SaveUploadFileInterface;
use App\Core\Infrastructure\Service\Validator\ValidFileExtInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class UploadFileCommandHandler implements EventSubscriberInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidFileExtInterface $validFileExt,
        private SaveUploadFileInterface $saveUploadFile,
        private MatchTask $matchTask
    )
    {}


    public static function getSubscribedEvents(): array
    {
        return[
            UploadFileCommand::NAME => 'uploadFile'
        ];
    }

    public function uploadFile(UploadFileCommand $command): void
    {
        $this->validFileExt->valid($command->getUploadedFile());

        $taskFile       = $this->matchTask->foundTask($command->getTaskId());
        $pathToSaveFile = $this->saveUploadFile->saveFile($command->getUploadedFile());

        $file = new Files($command->getUploadedFile(), $taskFile, $pathToSaveFile);

        $this->entityManager->persist($file);
        $this->entityManager->flush();
    }
}