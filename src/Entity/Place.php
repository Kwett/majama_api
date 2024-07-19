<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Post(security: "is_granted('ROLE_USER')"),
        new Put(security: "is_granted('ROLE_USER')"),
        new Patch(security: "is_granted('ROLE_USER')"),
        new Delete(security: "is_granted('ROLE_USER')")
    ],
    normalizationContext: ['groups' => ['read:collections']],
)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:collections'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['read:collections'])]
    private ?int $addressNumber = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:collections'])]
    private ?string $road = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:collections'])]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:collections'])]
    private ?string $background = null;

    /**
     * @var Collection<int, Jam>
     */
    #[ORM\OneToMany(targetEntity: Jam::class, mappedBy: 'place')]
    private Collection $place;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:collections'])]
    private ?string $fbTag = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:collections'])]
    private ?string $instaTag = null;

    public function __construct()
    {
        $this->place = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddressNumber(): ?int
    {
        return $this->addressNumber;
    }

    public function setAddressNumber(int $addressNumber): static
    {
        $this->addressNumber = $addressNumber;

        return $this;
    }

    public function getRoad(): ?string
    {
        return $this->road;
    }

    public function setRoad(string $road): static
    {
        $this->road = $road;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): static
    {
        $this->background = $background;

        return $this;
    }

    /**
     * @return Collection<int, Jam>
     */
    public function getPlace(): Collection
    {
        return $this->place;
    }

    public function addPlace(Jam $place): static
    {
        if (!$this->place->contains($place)) {
            $this->place->add($place);
            $place->setPlace($this);
        }

        return $this;
    }

    public function removePlace(Jam $place): static
    {
        if ($this->place->removeElement($place)) {
            // set the owning side to null (unless already changed)
            if ($place->getPlace() === $this) {
                $place->setPlace(null);
            }
        }

        return $this;
    }

    public function getFbTag(): ?string
    {
        return $this->fbTag;
    }

    public function setFbTag(?string $fbTag): static
    {
        $this->fbTag = $fbTag;

        return $this;
    }

    public function getInstaTag(): ?string
    {
        return $this->instaTag;
    }

    public function setInstaTag(?string $instaTag): static
    {
        $this->instaTag = $instaTag;

        return $this;
    }
}
