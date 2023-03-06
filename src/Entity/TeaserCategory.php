<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TeaserCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeaserCategoryRepository::class)]
class TeaserCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Teaser::class, mappedBy: 'category')]
    private Collection $teasers;

    public function __construct()
    {
        $this->teasers = new ArrayCollection();
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

    /**
     * @return Collection<int, Teaser>
     */
    public function getTeasers(): Collection
    {
        return $this->teasers;
    }

    public function addTeaser(Teaser $teaser): self
    {
        if (!$this->teasers->contains($teaser)) {
            $this->teasers->add($teaser);
            $teaser->addCategory($this);
        }

        return $this;
    }

    public function removeTeaser(Teaser $teaser): self
    {
        if ($this->teasers->removeElement($teaser)) {
            $teaser->removeCategory($this);
        }

        return $this;
    }
}
