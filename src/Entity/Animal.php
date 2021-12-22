<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=category::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category_id;

    /**
     * @ORM\OneToMany(targetEntity=Application::class, mappedBy="animal_id")
     */
    private $applications;

    /**
     * @ORM\OneToMany(targetEntity=FileAdoption::class, mappedBy="animal_id")
     */
    private $fileAdoptions;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
        $this->fileAdoptions = new ArrayCollection();
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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCategoryId(): ?category
    {
        return $this->category_id;
    }

    public function setCategoryId(?category $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setAnimalId($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getAnimalId() === $this) {
                $application->setAnimalId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FileAdoption[]
     */
    public function getFileAdoptions(): Collection
    {
        return $this->fileAdoptions;
    }

    public function addFileAdoption(FileAdoption $fileAdoption): self
    {
        if (!$this->fileAdoptions->contains($fileAdoption)) {
            $this->fileAdoptions[] = $fileAdoption;
            $fileAdoption->setAnimalId($this);
        }

        return $this;
    }

    public function removeFileAdoption(FileAdoption $fileAdoption): self
    {
        if ($this->fileAdoptions->removeElement($fileAdoption)) {
            // set the owning side to null (unless already changed)
            if ($fileAdoption->getAnimalId() === $this) {
                $fileAdoption->setAnimalId(null);
            }
        }

        return $this;
    }
}
