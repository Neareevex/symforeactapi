<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PublicationRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 */
class Publication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read", "write"})
     */
    private $Content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "write"})
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="publications")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $writtenBy;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="publications")
     * @Groups({"read", "write"})
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read", "write"})
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(?string $Content): self
    {
        $this->Content = $Content;

        return $this;
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

    public function getWrittenBy(): ?User
    {
        return $this->writtenBy;
    }

    public function setWrittenBy(?User $writtenBy): self
    {
        $this->writtenBy = $writtenBy;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
