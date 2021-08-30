<?php

namespace App\Tests\Core\Infrastructure\Service\Validator;


use App\Core\Infrastructure\Service\Validator\ValidFileExt;
use App\Shared\Domain\Exception\InvalidUploadFile;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ValidFileExtTest extends TestCase
{
    const TO_BIG_SIZE_FILE  = 2097192;
    const CORRECT_FILE_SIZE = 2097142;

    /** @var ValidFileExt  */
    private ValidFileExt $validFileExt;

    /** @var mixed|\PHPUnit\Framework\MockObject\MockObject|UploadedFile */
    private $uploadFiles;

    protected function setUp(): void
    {
        $this->uploadFiles  = $this->createMock(UploadedFile::class);
        $this->validFileExt = new ValidFileExt();
    }

    public function testShouldReturnExceptionIncorrectExtension()
    {
        $this->expectException(InvalidUploadFile::class);
        $this->expectExceptionMessage('Incorrect extension of file');

        $this->uploadFiles
            ->method('getMimeType')
            ->willReturn('application/php');

        $this->validFileExt->valid($this->uploadFiles);
    }

    public function testShouldReturnExceptionToMuchSize()
    {
        $this->expectException(InvalidUploadFile::class);
        $this->expectExceptionMessage('To big size of uploaded file');

        $this->uploadFiles
            ->method('getSize')
            ->willReturn(self::TO_BIG_SIZE_FILE);

        $this->uploadFiles
            ->method('getMimeType')
            ->willReturn('text/plain');

        $this->validFileExt->valid($this->uploadFiles);
    }

    public function testShouldNotReturnThatValidIsCorrect()
    {
        $this->uploadFiles
            ->method('getSize')
            ->willReturn(self::CORRECT_FILE_SIZE);

        $this->uploadFiles
            ->method('getMimeType')
            ->willReturn('text/plain');

        $result = $this->validFileExt->valid($this->uploadFiles);

        $this->assertNull($result);
    }
}