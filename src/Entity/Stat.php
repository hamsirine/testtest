<?php

namespace App\Entity;

use App\Repository\StatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatRepository::class)
 */
class Stat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Total;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $enveloppes;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TotalTraite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?string
    {
        return $this->Total;
    }

    public function setTotal(string $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getPages(): ?string
    {
        return $this->pages;
    }

    public function setPages(string $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    public function getEnveloppes(): ?string
    {
        return $this->enveloppes;
    }

    public function setEnveloppes(string $enveloppes): self
    {
        $this->enveloppes = $enveloppes;

        return $this;
    }

    public function getTotalTraite(): ?string
    {
        return $this->TotalTraite;
    }

    public function setTotalTraite(string $TotalTraite): self
    {
        $this->TotalTraite = $TotalTraite;

        return $this;
    }
}
