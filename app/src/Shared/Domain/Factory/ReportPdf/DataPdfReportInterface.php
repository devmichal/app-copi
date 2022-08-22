<?php

namespace App\Shared\Domain\Factory\ReportPdf;

use App\Core\Domain\Model\Users\User;
use App\Shared\Infrastructure\ValueObject\FilterCreatedAtTask;

interface DataPdfReportInterface
{
    public function getData(FilterCreatedAtTask $atTask, User $user): array;
}
