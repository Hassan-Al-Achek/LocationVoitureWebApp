<?php

namespace App\Entity;

use App\Repository\PaymentInfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentInfoRepository::class)]
class PaymentInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'paymentInfo', targetEntity: Car::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $model;

    #[ORM\Column(type: 'float')]
    private $KM;

    #[ORM\Column(type: 'float')]
    private $amountPerHour;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $reduction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?Car
    {
        return $this->model;
    }

    public function setModel(Car $model): self
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

    public function setReduction(?int $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }
}
