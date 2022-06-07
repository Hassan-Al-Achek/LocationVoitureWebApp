<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Entity\Invoice;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProfileController extends AbstractController
{
    #[Route('/profile', methods: ['GET', 'HEAD'], name: 'app_profile')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Invoice::class);
        $user = $this->getUser();

        dd($user);
        $invoices = $repository->findAll($user->getId());

        $repository = $entityManager->getRepository(Contrat::class);
        $contrats = $repository->findAll($user->getId());

        return $this->render('profile/index.html.twig', [
            'invoices' => $invoices,
            'contrats' => $contrats
        ]);
    }

    #[Route('/pdf/invoice/{invoiceNumber}', methods: ['GET', 'HEAD'], name: 'app_ipdf')]
    public function invoicePDFDownload(ManagerRegistry $doctrine, String $invoiceNumber)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Invoice::class);

        $invoice = $repository->find($invoiceNumber);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('PDFsTemplates/invoice.html.twig', [
            'invoice' => $invoice
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($invoice->getinvoiceNumber() . ".pdf", [
            "Attachment" => true
        ]);

        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    #[Route('/pdf/contrat/{contratNumber}', methods: ['GET', 'HEAD'], name: 'app_cpdf')]
    public function contratPDFDownload(ManagerRegistry $doctrine, String $contratNumber)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Contrat::class);

        $contrat = $repository->find($contratNumber);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('PDFsTemplates/contrat.html.twig', [
            'contrat' => $contrat
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($contrat->getcontratNumber() . ".pdf", [
            "Attachment" => true
        ]);

        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
