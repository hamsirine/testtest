<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CreationDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationDate(): ?string
    {
        return $this->CreationDate;
    }

    public function setCreationDate(string $CreationDate): self
    {
        $this->CreationDate = $CreationDate;

        return $this;
    }
}
