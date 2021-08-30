<?php

namespace App\Core\Infrastructure\Service\Validator;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ValidFileExtInterface
{
    public function valid(UploadedFile $uploadedFile): void;
}