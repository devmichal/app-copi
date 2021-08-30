<?php

namespace App\Core\Infrastructure\Service\SaveFiles;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\String\Slugger\SluggerInterface;


final class SaveUploadFile implements SaveUploadFileInterface
{
    private SluggerInterface $slugger;

    private KernelInterface $kernel;


    public function __construct(
        SluggerInterface $slugger,
        KernelInterface $kernel
    )
    {
        $this->slugger = $slugger;
        $this->kernel = $kernel;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public function saveFile(UploadedFile $uploadedFile): string
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFolder = uuid_create(UUID_TYPE_RANDOM);

        $pathToSave = $this->kernel->getProjectDir().'/public/files/'.$newFolder;

        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $newFolder.'/'.$safeFilename.'-'.uuid_create(UUID_TYPE_RANDOM).'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $pathToSave,
            $newFilename
        );

        return $newFilename;
    }
}