<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 255)]
    private $licensePlate;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'cars')]
    private $clientNumber;

    #[ORM\ManyToOne(targetEntity: Parking::class, inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private $parkingNumber;

    #[ORM\Column(type: 'string', length: 255)]
    private $mark;

    #[ORM\Column(type: 'string', length: 255)]
    private $model;

    #[ORM\Column(type: 'smallint')]
    private $numberOfSeats;

    #[ORM\Column(type: 'string', length: 255)]
    private $fuel;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagePath;

    public function getLicensePlate(): ?string
    {
        return $this->licensePlate;
    }

    public function setLicensePlate(string $licensePlate): ?string
    {
        return $this->licensePlate = $licensePlate;
    }

    public function getClientNumber(): ?Client
    {
        return $this->clientNumber;
    }

    public function setClientNumber(?Client $clientNumber): self
    {
        $this->clientNumber = $clientNumber;

        return $this;
    }

    public function getParkingNumber(): ?Parking
    {
        return $this->parkingNumber;
    }

    public function setParkingNumber(?Parking $parkingNumber): self
    {
        $this->parkingNumber = $parkingNumber;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getNumberOfSeats(): ?int
    {
        return $this->numberOfSeats;
    }

    public function setNumberOfSeats(int $numberOfSeats): self
    {
        $this->numberOfSeats = $numberOfSeats;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}
