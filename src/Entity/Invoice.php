<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $invoiceNumber;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'invoices')]
    private $clientNumber;

    #[ORM\Column(type: 'datetimetz')]
    private $invoiceDate;

    #[ORM\Column(type: 'integer')]
    private $kmCounter;

    #[ORM\Column(type: 'float')]
    private $ptAmount;

    #[ORM\Column(type: 'float')]
    private $ammountToPay;

    public function getInvoiceNumber(): ?int
    {
        return $this->invoiceNumber;
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

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(\DateTimeInterface $invoiceDate): self
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    public function getKmCounter(): ?int
    {
        return $this->kmCounter;
    }

    public function setKmCounter(int $kmCounter): self
    {
        $this->kmCounter = $kmCounter;

        return $this;
    }

    public function getPtAmount(): ?float
    {
        return $this->ptAmount;
    }

    public function setPtAmount(float $ptAmount): self
    {
        $this->ptAmount = $ptAmount;

        return $this;
    }

    public function getAmmountToPay(): ?float
    {
        return $this->ammountToPay;
    }

    public function setAmmountToPay(float $ammountToPay): self
    {
        $this->ammountToPay = $ammountToPay;

        return $this;
    }
}
