<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 */
class Products
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
    private $brochureFilesname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrochureFilesname(): ?string
    {
        return $this->brochureFilesname;
    }

    public function setBrochureFilesname(string $brochureFilesname): self
    {
        $this->brochureFilesname = $brochureFilesname;

        return $this;
    }
}
