<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $device = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $os = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deviceModel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $geo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ip = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Teaser $teaser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getDevice(): ?string
    {
        return $this->device;
    }

    public function setDevice(?string $device): void
    {
        $this->device = $device;
    }

    public function getOs(): ?string
    {
        return $this->os;
    }

    public function setOs(?string $os): void
    {
        $this->os = $os;
    }

    public function getDeviceModel(): ?string
    {
        return $this->deviceModel;
    }

    public function setDeviceModel(?string $deviceModel): void
    {
        $this->deviceModel = $deviceModel;
    }

    public function getGeo(): ?string
    {
        return $this->geo;
    }

    public function setGeo(?string $geo): void
    {
        $this->geo = $geo;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getTeaser(): ?Teaser
    {
        return $this->teaser;
    }

    public function setTeaser(?Teaser $teaser): self
    {
        $this->teaser = $teaser;

        return $this;
    }
}
