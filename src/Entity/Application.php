<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplicationRepository::class)
 */
class Application
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $admin_comment;

    /**
     * @ORM\Column(type="date")
     */
    private $date_created;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_rejected;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $animal_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getAdminComment(): ?string
    {
        return $this->admin_comment;
    }

    public function setAdminComment(?string $admin_comment): self
    {
        $this->admin_comment = $admin_comment;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeInterface $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getDateRejected(): ?\DateTimeInterface
    {
        return $this->date_rejected;
    }

    public function setDateRejected(?\DateTimeInterface $date_rejected): self
    {
        $this->date_rejected = $date_rejected;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getAnimalId(): ?int
    {
        return $this->animal_id;
    }

    public function setAnimalId(int $animal_id): self
    {
        $this->animal_id = $animal_id;

        return $this;
    }
}
