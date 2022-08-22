<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Files;

use Symfony\Component\HttpFoundation\FileBag;

final class UploadFilesDTO
{
    public function __construct(
        private FileBag $fileBag
    ) {
    }

    public function getFile(): FileBag
    {
        return $this->file;
    }
}
