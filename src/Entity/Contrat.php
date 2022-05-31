<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $contratNumber;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'contrats')]
    private $clientNumber;

    #[ORM\Column(type: 'string', length: 255)]
    private $licensePlate;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'datetimetz')]
    private $dateOfDeparture;

    #[ORM\Column(type: 'datetimetz')]
    private $dateOfReturn;

    public function getContratNumber(): ?int
    {
        return $this->contratNumber;
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

    public function getLicensePlate(): ?string
    {
        return $this->licensePlate;
    }

    public function setLicensePlate(string $licensePlate): self
    {
        $this->licensePlate = $licensePlate;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateOfDeparture(): ?\DateTimeInterface
    {
        return $this->dateOfDeparture;
    }

    public function setDateOfDeparture(\DateTimeInterface $dateOfDeparture): self
    {
        $this->dateOfDeparture = $dateOfDeparture;

        return $this;
    }

    public function getDateOfReturn(): ?\DateTimeInterface
    {
        return $this->dateOfReturn;
    }

    public function setDateOfReturn(\DateTimeInterface $dateOfReturn): self
    {
        $this->dateOfReturn = $dateOfReturn;

        return $this;
    }
}
