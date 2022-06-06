<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Contrat;
use App\Form\ContratFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    #[Route('/rent/{licensePlate}', name: 'app_rent')]
    public function index(ManagerRegistry $doctrine, Request $request, String $licensePlate): Response
    {
        $entityManager = $doctrine->getManager();
        $contrat = new Contrat();

        $form = $this->createForm(ContratFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $data = $form->getData();

            $contrat->setDateOfDeparture($data->getdateOfDeparture());
            $contrat->setDateOfReturn($data->getdateOfReturn());

            $car = $entityManager->getRepository(Car::class)->find($licensePlate);
            $contrat->setlicensePlate($car->getlicensePlate());
            $contrat->setType($car->getMark());

            $user = $this->getUser();
            $contrat->setClientNumber($user);
            // dd($contrat);
            // ... perform some action, such as saving the task to the database

            $entityManager->persist($contrat);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('rent/index.html.twig', [
            'rentForm' => $form->createView()
        ]);
    }

    private function generateInvoice()
    {
    }
}
