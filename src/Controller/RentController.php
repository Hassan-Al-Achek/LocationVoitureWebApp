<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Contrat;
use App\Entity\PaymentInfo;
use App\Entity\Client;
use App\Entity\Invoice;
use App\Form\ContratFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;

class RentController extends AbstractController
{
    #[Route('/rent/{licensePlate}', name: 'app_rent')]
    public function index(ManagerRegistry $doctrine, Request $request, String $licensePlate): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $entityManager = $doctrine->getManager();
        $contrat = new Contrat();

        $form = $this->createForm(ContratFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $data = $form->getData();

            // Get Current Logged In User
            $user = $this->getUser();

            $car = $entityManager->getRepository(Car::class)->find($licensePlate);

            // Add The Car To The Current Logged In User
            $car->setClientNumber($user);

            $contrat->setDateOfDeparture($data->getdateOfDeparture());
            $contrat->setDateOfReturn($data->getdateOfReturn());
            $contrat->setlicensePlate($car->getlicensePlate());
            $contrat->setType($car->getMark());
            $contrat->setClientNumber($user);

            // Get Payment Info From The DataBase
            $payment = $entityManager->getRepository(PaymentInfo::class)->find($licensePlate);

            // Generate The Invoice For The Current User
            $invoice = $this->generateInvoice($user, $payment, $contrat);

            // dd($contrat);
            // ... perform some action, such as saving the task to the database
            $entityManager->persist($invoice);
            $entityManager->persist($contrat);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('rent/index.html.twig', [
            'rentForm' => $form->createView()
        ]);
    }

    private function generateInvoice(Client $user, PaymentInfo $payment, Contrat $contrat): Invoice
    {
        $invoice = new Invoice();
        $invoice->setClientNumber($user);
        $invoice->setInvoiceDate(new \DateTime('now'));
        $invoice->setKmCounter($payment->getKM());

        $durationInterval = $contrat->getDateOfDeparture()->diff($contrat->getDateOfReturn());
        $durationOfRent = ($durationInterval->y) * 8760 + ($durationInterval->m) * 730 + ($durationInterval->h) + ($durationInterval->i) / 60;

        // Money To Pay Before Reduction(In Case A Reduction Exist)
        $ptAmount = $durationOfRent * $payment->getAmountPerHour();

        // Money To Pay After Reduction
        $amountToPay = $ptAmount - ($ptAmount * ($payment->getReduction())) / 100;

        $invoice->setPtAmount($ptAmount);
        $invoice->setAmmountToPay($amountToPay);

        return $invoice;
    }
}
