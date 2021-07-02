<?php

namespace App\Entity;

use App\Repository\IngridientRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=IngridientRepository::class)
 * @UniqueEntity("name")
 */
class Ingredient
{

    const UNITS = ['g', 'dkg', 'kg', 'ml', 'l', 'piece'];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ingredient-simple"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"ingredient-simple"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class )
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="json")
     * @Groups({"ingredient-simple"})
     */
    private $availableUnits = [];

    /**
     * @ORM\OneToMany(targetEntity=CourseIngredient::class, mappedBy="ingredient", orphanRemoval=true)
     */
    private $courseIngredient;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAvailableUnits(): ?array
    {
        return $this->availableUnits;
    }

    public function setAvailableUnits(array $availableUnits): self
    {
        $this->availableUnits = $availableUnits;

        return $this;
    }
    public function __toString():string
    {
        return  $this->getName();
    }
    /**
     * @return Collection|CourseIngredient[]
     */
    public function getCourseIngredient(): Collection
    {
        return $this->courseIngredient;
    }
}
