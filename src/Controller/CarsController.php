<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Parking;
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
        return $this->render('cars/car.html.twig', [
            'car' => $car,
            'parking' => $parking
        ]);
    }
}
