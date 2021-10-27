<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=10, minMessage="Le nom du produit doit avoir au moins {{ limit }} caractères.", maxMessage="Le nom du produit ne doit pas excéder {{ limit }} caractères.")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=20, max=200, minMessage="La description du produit doit avoir au moins {{ limit }} caractères.", maxMessage="La description du produit ne doit pas excéder {{ limit }} caractères.")
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="float")
     * @Assert\Positive(message="La valeur saisie n'est pas supérieur à 0 !")
     */
    private $price;

     /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=20, max=300, minMessage="La description du produit doit avoir au moins {{ limit }} caractères.", maxMessage="La description du produit ne doit pas excéder {{ limit }} caractères.")
     */
    private $longDescription;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive(message="Merci de renseigner une valeur supérieur à 0 !")
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(message="Merci de saisir une URL valide.")
     */
    private $mainPicture;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

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

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(string $longDescription): self
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getMainPicture(): ?string
    {
        return $this->mainPicture;
    }

    public function setMainPicture(string $mainPicture): self
    {
        $this->mainPicture = $mainPicture;

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

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
