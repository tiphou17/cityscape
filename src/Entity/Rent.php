<?php

namespace App\Entity;

use App\Repository\RentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentRepository::class)]
class Rent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $rent_start = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $rent_end = null;

    #[ORM\Column]
    private ?float $rent_price = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $rent_user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?property $rent_property = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRentStart(): ?\DateTimeInterface
    {
        return $this->rent_start;
    }

    public function setRentStart(\DateTimeInterface $rent_start): static
    {
        $this->rent_start = $rent_start;

        return $this;
    }

    public function getRentEnd(): ?\DateTimeInterface
    {
        return $this->rent_end;
    }

    public function setRentEnd(\DateTimeInterface $rent_end): static
    {
        $this->rent_end = $rent_end;

        return $this;
    }

    public function getRentPrice(): ?float
    {
        return $this->rent_price;
    }

    public function setRentPrice(float $rent_price): static
    {
        $this->rent_price = $rent_price;

        return $this;
    }

    public function getRentUser(): ?user
    {
        return $this->rent_user;
    }

    public function setRentUser(?user $rent_user): static
    {
        $this->rent_user = $rent_user;

        return $this;
    }

    public function getRentProperty(): ?property
    {
        return $this->rent_property;
    }

    public function setRentProperty(?property $rent_property): static
    {
        $this->rent_property = $rent_property;

        return $this;
    }
}
