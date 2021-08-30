<?php

namespace App\Shared\Domain\Factory\ReportPdf;


use App\Core\Domain\Model\Users\User;

interface DataPdfReportInterface
{
    public function getData(string $client, User $user): array;
}