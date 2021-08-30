<?php

namespace App\Core\Application\Command\Files;

use Symfony\Component\HttpFoundation\FileBag;

final class UploadFilesDTO
{
    private FileBag $file;


    public function __construct(
        FileBag $fileBag
    )
    {
        $this->file = $fileBag;
    }

    /**
     * @return FileBag
     */
    public function getFile(): FileBag
    {
        return $this->file;
    }
}