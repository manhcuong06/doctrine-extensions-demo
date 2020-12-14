<?php

namespace App\Entity;

use App\Repository\RProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RProductRepository::class)
 * @ORM\Table(name="r_products")
 */
class RProduct
{
    const DIRECTORY = 'products/';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=RCategory::class, inversedBy="products", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?RCategory
    {
        return $this->category;
    }

    public function setCategory(?RCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image ?? '';
    }

    public function setImage(?string $image): self
    {
        $this->image = self::DIRECTORY . $image;

        return $this;
    }

    public static function getDirectory()
    {
        return self::DIRECTORY;
    }
}
