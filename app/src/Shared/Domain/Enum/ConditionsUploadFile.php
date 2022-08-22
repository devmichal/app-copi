<?php

namespace App\Shared\Domain\Enum;

final class ConditionsUploadFile
{
    public const MAX_SIZE_UPLOAD = 2097152; // this is a 2MB = 2097152
    public const CORRECT_EXT = [
        'application/pdf',
        'text/plain',
        'image/png',
        'image/jpeg',
        'application/msword',
    ];
}
