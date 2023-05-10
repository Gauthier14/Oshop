<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="fk_product_category1_idx", columns={"category_id"}), @ORM\Index(name="fk_product_type1_idx", columns={"type_id"}), @ORM\Index(name="fk_product_brand_idx", columns={"brand_id"})})
 * @ORM\Entity
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function __construct()
    {


        $this->createdAt = new \DateTime;
        
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false, options={"comment"="Le nom du produit"})
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true, options={"comment"="La description du produit"})
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="picture", type="string", length=128, nullable=true, options={"comment"="L'URL de l'image du produit"})
     * @Assert\NotBlank
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false, options={"comment"="Le prix du produit"})
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private $price ;

    /**
     * @var bool
     *
     * @ORM\Column(name="rate", type="decimal", nullable=false, options={"comment"="L'avis sur le produit, de 1 à 5"})
     */
    private $rate = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="integer", nullable=false, options={"comment"="Le statut du produit (1=dispo, 2=pas dispo)"})
     */
    private $status = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP","comment"="La date de création du produit"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"comment"="La date de la dernière mise à jour du produit"})
     */
    private $updatedAt;



    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @Assert\NotBlank
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="products")
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products")
     * @Assert\NotBlank
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(bool $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }



    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }


}
