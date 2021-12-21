<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
 */
class File
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $admin_comment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cni;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adoption_form;

    /**
     * @ORM\Column(type="date")
     */
    private $date_created;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_decision;

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

    public function getCni(): ?string
    {
        return $this->cni;
    }

    public function setCni(?string $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    public function getAdoptionForm(): ?string
    {
        return $this->adoption_form;
    }

    public function setAdoptionForm(?string $adoption_form): self
    {
        $this->adoption_form = $adoption_form;

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

    public function getDateDecision(): ?\DateTimeInterface
    {
        return $this->date_decision;
    }

    public function setDateDecision(?\DateTimeInterface $date_decision): self
    {
        $this->date_decision = $date_decision;

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
