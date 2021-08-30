<?php

namespace App\Core\Infrastructure\Service\SaveFiles;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface SaveUploadFileInterface
{
    public function saveFile(UploadedFile $uploadedFile): string;
}