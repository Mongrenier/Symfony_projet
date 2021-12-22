<?php

namespace App\Entity;

use App\Repository\FileAdoptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FileAdoptionRepository::class)
 */
class FileAdoption
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
     * @ORM\Column(type="string", length=255)
     */
    private $nic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $form_adoption;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_decision;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="fileAdoptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=animal::class, inversedBy="fileAdoptions")
     * @ORM\JoinColumn(nullable=false)
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

    public function getNic(): ?string
    {
        return $this->nic;
    }

    public function setNic(string $nic): self
    {
        $this->nic = $nic;

        return $this;
    }

    public function getFormAdoption(): ?string
    {
        return $this->form_adoption;
    }

    public function setFormAdoption(string $form_adoption): self
    {
        $this->form_adoption = $form_adoption;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

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

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getAnimalId(): ?animal
    {
        return $this->animal_id;
    }

    public function setAnimalId(?animal $animal_id): self
    {
        $this->animal_id = $animal_id;

        return $this;
    }
}
