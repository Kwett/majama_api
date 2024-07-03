<?php

namespace App\Entity;

use App\Repository\JamRepository;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: JamRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:collections']],
    order: ['timeStart' => 'ASC'],
)]
class Jam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'place')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:collections'])]
    private ?Place $place = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['read:collections'])]
    private ?\DateTimeInterface $timeStart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['read:collections'])]
    private ?\DateTimeInterface $timeEnd = null;

    #[ORM\Column(length: 255, nullable: true)] 
    #[Groups(['read:collections'])]
    private ?string $fbLink = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:collections'])]
    private ?string $instaLink = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visual = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getTimeStart(): ?\DateTimeInterface
    {
        return $this->timeStart;
    }

    public function setTimeStart(\DateTimeInterface $timeStart): static
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    public function getTimeEnd(): ?\DateTimeInterface
    {
        return $this->timeEnd;
    }

    public function setTimeEnd(\DateTimeInterface $timeEnd): static
    {
        $this->timeEnd = $timeEnd;

        return $this;
    }

    public function getFbLink(): ?string
    {
        return $this->fbLink;
    }

    public function setFbLink(?string $fbLink): static
    {
        $this->fbLink = $fbLink;

        return $this;
    }

    public function getInstaLink(): ?string
    {
        return $this->instaLink;
    }

    public function setInstaLink(?string $instaLink): static
    {
        $this->instaLink = $instaLink;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getVisual(): ?string
    {
        return $this->visual;
    }

    public function setVisual(?string $visual): static
    {
        $this->visual = $visual;

        return $this;
    }
}
