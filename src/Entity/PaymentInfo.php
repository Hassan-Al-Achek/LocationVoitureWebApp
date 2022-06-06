<?php

namespace App\Entity;

use App\Repository\PaymentInfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentInfoRepository::class)]
class PaymentInfo
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 255)]
    private $licensePlate;

    #[ORM\Column(type: 'string', length: 255)]
    private $model;

    #[ORM\Column(type: 'float')]
    private $KM;

    #[ORM\Column(type: 'float')]
    private $amountPerHour;

    #[ORM\Column(type: 'integer')]
    private $reduction;

    public function getLicensePlate(): ?string
    {
        return $this->licensePlate;
    }

    public function setLicensePlate(string $licensePlate): self
    {
        $this->licensePlate = $licensePlate;

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

    public function getKM(): ?float
    {
        return $this->KM;
    }

    public function setKM(float $KM): self
    {
        $this->KM = $KM;

        return $this;
    }

    public function getAmountPerHour(): ?float
    {
        return $this->amountPerHour;
    }

    public function setAmountPerHour(float $amountPerHour): self
    {
        $this->amountPerHour = $amountPerHour;

        return $this;
    }

    public function getReduction(): ?int
    {
        return $this->reduction;
    }

    public function setReduction(int $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }
}
