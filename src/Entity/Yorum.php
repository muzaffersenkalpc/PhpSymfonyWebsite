<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\YorumRepository")
 */
class Yorum
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $membername;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $yorum;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $productid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getMembername(): ?string
    {
        return $this->membername;
    }

    public function setMembername(?string $membername): self
    {
        $this->membername = $membername;

        return $this;
    }

    public function getYorum(): ?string
    {
        return $this->yorum;
    }

    public function setYorum(?string $yorum): self
    {
        $this->yorum = $yorum;

        return $this;
    }

    public function getproductid(): ?int
    {
        return $this->productid;
    }

    public function setproductid(?int $productid): self
    {
        $this->productid = $productid;

        return $this;
    }
}
