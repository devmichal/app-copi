<?php

namespace App\Core\Infrastructure\Service\Validator;


use App\Shared\Domain\Enum\ConditionsUploadFile;
use App\Shared\Domain\Exception\InvalidUploadFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;


final class ValidFileExt implements ValidFileExtInterface
{

    /**
     * @throws InvalidUploadFile
     */
    public function valid(UploadedFile $uploadedFile): void
    {
        if (!in_array($uploadedFile->getMimeType(), ConditionsUploadFile::CORRECT_EXT, true)) {

            throw new InvalidUploadFile('Incorrect extension of file');
        }

        if ($uploadedFile->getSize() > ConditionsUploadFile::MAX_SIZE_UPLOAD) {

            throw new InvalidUploadFile('To big size of uploaded file');
        }
    }
}