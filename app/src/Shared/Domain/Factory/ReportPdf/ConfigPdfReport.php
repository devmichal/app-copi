<?php

namespace App\Shared\Domain\Factory\ReportPdf;

use Mpdf\Mpdf;

final class ConfigPdfReport
{
    public static function config(): Mpdf
    {
        return new Mpdf([
            'orientation' => 'P',
            'format' => 'A4',
            'margin_top' => '10',
            'margin_left' => '10',
            'margin_right' => '10',
        ]);
    }
}
