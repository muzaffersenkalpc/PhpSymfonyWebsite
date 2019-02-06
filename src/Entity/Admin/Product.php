<?php

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Admin\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $seller_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Model;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pprice;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sprice;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $yorum;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $yorumismi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gallery;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $firma_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $category_id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Detail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSellerId(): ?int
    {
        return $this->seller_id;
    }

    public function setSellerId(?int $seller_id): self
    {
        $this->seller_id = $seller_id;

        return $this;
    }

    public function getModel(): ?int
    {
        return $this->Model;
    }

    public function setModel(?int $Model): self
    {
        $this->Model = $Model;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPprice(): ?float
    {
        return $this->pprice;
    }

    public function setPprice(?float $pprice): self
    {
        $this->pprice = $pprice;

        return $this;
    }

    public function getSprice(): ?float
    {
        return $this->sprice;
    }

    public function setSprice(?float $sprice): self
    {
        $this->sprice = $sprice;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
    public function getYorum(): ?string
    {
        return $this->yorum;
    }

    public function setYorum(?string $yorum): self
    {
        $this->image = $yorum;

        return $this;
    }
    public function getYorumismi(): ?string
    {
        return $this->yorumismi;
    }

    public function setYorumismi(?string $yorumismi): self
    {
        $this->image = $yorumismi;

        return $this;
    }

    public function getGallery(): ?string
    {
        return $this->gallery;
    }

    public function setGallery(?string $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }

    public function getFirmaId(): ?int
    {
        return $this->firma_id;
    }

    public function setFirmaId(?int $firma_id): self
    {
        $this->firma_id = $firma_id;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->Detail;
    }

    public function setDetail(?string $Detail): self
    {
        $this->Detail = $Detail;

        return $this;
    }


}
