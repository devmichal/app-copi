<?php

namespace App\Core\Ports\Rest\pdf;

use App\Shared\Domain\Factory\ReportPdf\ConfigPdfReport;
use App\Shared\Domain\Factory\ReportPdf\DataPdfReportInterface;
use App\Shared\Infrastructure\ValueObject\FilterCreatedAtTask;
use Mpdf\MpdfException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class GenerateReportPDF extends AbstractController
{
    /**
     * @Route("/pdf/report/{client}/{createdAt}/{deadlineAt}", methods={"GET"})
     *
     * @throws MpdfException
     */
    final public function indexAction(
        string $client,
        DataPdfReportInterface $dataPdfReport,
        ?string $createdAt = null,
        ?string $deadlineAt = null
    ): JsonResponse {
        $mpdf = ConfigPdfReport::config();
        $filterData = new FilterCreatedAtTask($client, $createdAt, $deadlineAt);

        $html = $this->render(
            'pdf/report.html.twig',
            $dataPdfReport->getData($filterData, $this->getUser()));

        $mpdf->WriteHTML($html);
        $mpdf->Output('report.pdf', 'D');

        return $this->json(null);
    }
}
