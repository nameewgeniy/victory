<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TeaserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeaserRepository::class)]
class Teaser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $groupId = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;

    #[ORM\ManyToMany(targetEntity: TeaserCategory::class, inversedBy: 'teasers')]
    private Collection $category;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private array $blockIp = [];

    #[ORM\OneToMany(mappedBy: 'teaser', targetEntity: Event::class)]
    private Collection $events;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

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

    public function getGroupId(): ?string
    {
        return $this->groupId;
    }

    public function setGroupId(?string $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return Collection<int, TeaserCategory>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(TeaserCategory $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(TeaserCategory $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getBlockIp(): array
    {
        return $this->blockIp;
    }

    public function setBlockIp(?array $blockIp): self
    {
        $this->blockIp = $blockIp;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setTeaser($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getTeaser() === $this) {
                $event->setTeaser(null);
            }
        }

        return $this;
    }
}
