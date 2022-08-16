<?php

namespace App\Entity;

use App\Repository\JourRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JourRepository::class)
 */
class Jour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Num;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomClient;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Total;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $TotalTraite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Reste;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getNum(): ?string
    {
        return $this->Num;
    }

    public function setNum(?string $Num): self
    {
        $this->Num = $Num;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->NomClient;
    }

    public function setNomClient(string $NomClient): self
    {
        $this->NomClient = $NomClient;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->Total;
    }

    public function setTotal(?int $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getTotalTraite(): ?int
    {
        return $this->TotalTraite;
    }

    public function setTotalTraite(?int $TotalTraite): self
    {
        $this->TotalTraite = $TotalTraite;

        return $this;
    }

    public function getReste(): ?int
    {
        return $this->Reste;
    }

    public function setReste(?int $Reste): self
    {
        $this->Reste = $Reste;

        return $this;
    }
}
