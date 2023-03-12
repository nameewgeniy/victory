<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 2000)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: PostCategory::class, mappedBy: 'posts')]
    private Collection $postCategories;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;

    #[ORM\ManyToMany(targetEntity: TeaserCategory::class)]
    private Collection $teaserCategories;

    public function __construct()
    {
        $this->postCategories = new ArrayCollection();
        $this->teaserCategories = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PostCategory>
     */
    public function getPostCategories(): Collection
    {
        return $this->postCategories;
    }

    public function addPostCategory(PostCategory $postCategory): self
    {
        if (!$this->postCategories->contains($postCategory)) {
            $this->postCategories->add($postCategory);
            $postCategory->addPost($this);
        }

        return $this;
    }

    public function removePostCategory(PostCategory $postCategory): self
    {
        if ($this->postCategories->removeElement($postCategory)) {
            $postCategory->removePost($this);
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string|null $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return Collection<int, TeaserCategory>
     */
    public function getTeaserCategories(): Collection
    {
        return $this->teaserCategories;
    }

    public function addTeaserCategory(TeaserCategory $teaserCategory): self
    {
        if (!$this->teaserCategories->contains($teaserCategory)) {
            $this->teaserCategories->add($teaserCategory);
        }

        return $this;
    }

    public function removeTeaserCategory(TeaserCategory $teaserCategory): self
    {
        $this->teaserCategories->removeElement($teaserCategory);

        return $this;
    }
}
