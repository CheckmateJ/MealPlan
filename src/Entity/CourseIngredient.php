<?php

namespace App\Entity;

use App\Repository\CourseIngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CourseIngredientRepository::class)
 */
class CourseIngredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class,  )
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"course-ingredient-simple"})
     */
    private $ingredient;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"course-ingredient-simple"})
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"course-ingredient-simple"})
     */
    private $unit;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="courseIngredient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $course;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }
}
