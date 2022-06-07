<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Contrat;
use App\Entity\Parking;
use App\Entity\PaymentInfo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'app_cars')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Car::class);
        $cars = $repository->findAll();

        return $this->render('cars/index.html.twig', [
            'cars' => $cars
        ]);
    }

    #[Route('/cars/{licensePlate}', name: 'app_show_car')]
    public function showCar(ManagerRegistry $doctrine, String $licensePlate): Response
    {
        $repository = $doctrine->getRepository(Car::class);
        $car = $repository->find($licensePlate);
        // dd($car);
        $repository = $doctrine->getRepository(Parking::class);
        $parking = $repository->find($car->getParkingNumber());

        $repository = $doctrine->getRepository(PaymentInfo::class);
        $paymentInfo = $repository->find($car->getLicensePlate());

        return $this->render('cars/car.html.twig', [
            'car' => $car,
            'parking' => $parking,
            'paymentInfo' => $paymentInfo
        ]);
    }


    // Function To End The Rent Of The Car 
    private function realeseRent(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $repository = $doctrine->getRepository(Car::class);
        $cars = $repository->findAll();

        // dd($cars);
        foreach ($cars as $car) {
            if ($car->getClientNumber() !== null) {
                $clientID = $car->getClientNumber()->getId();
                $repository = $doctrine->getRepository(Client::class);


                $repository = $doctrine->getRepository(Contrat::class);
                $contrats = $repository->findAll($clientID);

                foreach ($contrats as $contrat) {
                    $currentTime = (new \DateTime('now'));

                    if ($contrat->getLicensePlate() === $car->getLicensePlate()) {
                        // $duration = date_diff(($contrat->getDateOfReturn()), $currentTime);
                        // dd($currentTime > $contrat->getDateOfReturn());
                        $dateOfReturn = $contrat->getDateOfReturn()->modify('-5 min');
                        dd($dateOfReturn);
                        if ($currentTime == $dateOfReturn) {
                            $car->setClientNumber(null);
                            $entityManager->flush();
                        }
                    }
                }
            }
        }
    }
}
