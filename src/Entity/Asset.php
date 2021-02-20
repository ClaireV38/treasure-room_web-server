<?php

namespace App\Entity;

use App\Repository\AssetRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

/**
 * @ORM\Entity(repositoryClass=AssetRepository::class)
 */
class Asset
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("asset:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez saisir un titre.")
     * @Assert\Length(max="50", maxMessage="Le titre ne doit pas exceder 50 caractères.")
     * @Groups("asset:read")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Assert\Length(max="200", maxMessage="Le massage ne doit pas exceder 200 caractères.")
     * @Groups("asset:read")
     */
    private $placeOfDiscovery;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("asset:read")
     */
    private $depositDate;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Positive(message="La valeur doit être prositive")
     * @Groups("asset:read")
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Groups("asset:read")
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="assets")
     * @Groups("asset:read")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="assets")
     * @Groups("asset:read")
     */
    private $category;

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

    public function getPlaceOfDiscovery(): ?string
    {
        return $this->placeOfDiscovery;
    }

    public function setPlaceOfDiscovery(?string $placeOfDiscovery): self
    {
        $this->placeOfDiscovery = $placeOfDiscovery;

        return $this;
    }

    public function getDepositDate(): ?\DateTimeInterface
    {
        return $this->depositDate;
    }

    public function setDepositDate(?\DateTimeInterface $depositDate): self
    {
        $this->depositDate = $depositDate;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

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
}
