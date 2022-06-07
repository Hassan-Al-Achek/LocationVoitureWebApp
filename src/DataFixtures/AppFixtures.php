<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Parking;
use App\Entity\PaymentInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Parking #1
        $parking = new Parking();
        $parking->setCapacity(10);
        $parking->setStreet("20 bd alexandre de fraissinette");
        $parking->setCity("Saint etienne");
        $manager->persist($parking);

        // Parking #2
        $parking1 = new Parking();
        $parking1->setCapacity(12);
        $parking1->setStreet("20 bd alexandre de fraissinette");
        $parking1->setCity("Saint etienne");
        $manager->persist($parking1);

        //  Car #1
        $car = new Car();
        $car->setLicensePlate("456789");
        $car->setParkingNumber($parking);
        $car->setMark("Mercedes");
        $car->setModel("2012");
        $car->setFuel("95 octane");
        $car->setNumberOfSeats(4);
        $car->setImagePath("images/mercedes.jpg");
        $manager->persist($car);

        //  Car #2
        $car1 = new Car();
        $car1->setLicensePlate("678912");
        $car1->setParkingNumber($parking);
        $car1->setMark("Ferrari");
        $car1->setModel("2016");
        $car1->setFuel("98 octane");
        $car1->setNumberOfSeats(2);
        $car1->setImagePath("images/ferrari.jpg");
        $manager->persist($car1);

        //  Car #3
        $car2 = new Car();
        $car2->setLicensePlate("12345678");
        $car2->setParkingNumber($parking);
        $car2->setMark("BMW");
        $car2->setModel("2018-M5");
        $car2->setFuel("95 octane");
        $car2->setNumberOfSeats(4);
        $car2->setImagePath("images/BMW.jpg");
        $manager->persist($car2);

        //  Car #4
        $car3 = new Car();
        $car3->setLicensePlate("56789");
        $car3->setParkingNumber($parking1);
        $car3->setMark("Mercedes");
        $car3->setModel("2020");
        $car3->setFuel("95 octane");
        $car3->setNumberOfSeats(4);
        $car3->setImagePath("images/mercedes-1.jpg");
        $manager->persist($car3);

        //  Car #5
        $car4 = new Car();
        $car4->setLicensePlate("0123456");
        $car4->setParkingNumber($parking);
        $car4->setMark("lamborghini");
        $car4->setModel("2021");
        $car4->setFuel("98 octane");
        $car4->setNumberOfSeats(2);
        $car4->setImagePath("images/lamborghini.jpg");
        $manager->persist($car4);

        # Payment Info #1
        $payment = new PaymentInfo();
        $payment->setLicensePlate("0123456");
        $payment->setModel("2021");
        $payment->setKM(20);
        $payment->setAmountPerHour(200);
        $payment->setReduction(0);
        $manager->persist($payment);

        # Payment Info #2
        $payment1 = new PaymentInfo();
        $payment1->setLicensePlate("12345678");
        $payment1->setModel("2018 - M5");
        $payment1->setKM(60);
        $payment1->setAmountPerHour(70);
        $payment1->setReduction(0);
        $manager->persist($payment1);

        # Payment Info #3
        $payment2 = new PaymentInfo();
        $payment2->setLicensePlate("456789");
        $payment2->setModel("2012");
        $payment2->setKM(12);
        $payment2->setAmountPerHour(12);
        $payment2->setReduction(1);
        $manager->persist($payment2);


        # Payment Info #4
        $payment3 = new PaymentInfo();
        $payment3->setLicensePlate("56789");
        $payment3->setModel("2020");
        $payment3->setKM(20);
        $payment3->setAmountPerHour(90);
        $payment3->setReduction(10);
        $manager->persist($payment3);

        # Payment Info #5
        $payment4 = new PaymentInfo();
        $payment4->setLicensePlate("678912");
        $payment4->setModel("2016");
        $payment4->setKM(50);
        $payment4->setAmountPerHour(100);
        $payment4->setReduction(0);
        $manager->persist($payment4);


        $manager->flush();
    }
}
