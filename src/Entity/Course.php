<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
class Course
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"course-simple"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"course-simple"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=CourseIngredient::class, mappedBy="course", orphanRemoval=true, cascade={"PERSIST"} )
     */
    private $courseIngredient;

    /**
     * @ORM\OneToMany(targetEntity=MealPlanItem::class, mappedBy="course", orphanRemoval=true)
     */
    private $mealPlanItems;

    public function __construct()
    {
        $this->courseIngredient = new ArrayCollection();
        $this->mealPlanItems = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|CourseIngredient[]
     */
    public function getCourseIngredient(): Collection
    {
        return $this->courseIngredient;
    }

    public function addCourseIngredient(CourseIngredient $courseIngredient): self
    {
        if (!$this->courseIngredient->contains($courseIngredient)) {
            $this->courseIngredient[] = $courseIngredient;
            $courseIngredient->setCourse($this);
        }

        return $this;
    }

    public function removeCourseIngredient(CourseIngredient $courseIngredient): self
    {
        if ($this->courseIngredient->removeElement($courseIngredient)) {
            // set the owning side to null (unless already changed)
            if ($courseIngredient->getCourse() === $this) {
                $courseIngredient->setCourse(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->getName();
    }

    /**
     * @return Collection|MealPlanItem[]
     */
    public function getMealPlanItems(): Collection
    {
        return $this->mealPlanItems;
    }

    public function addMealPlanItem(MealPlanItem $mealPlanItem): self
    {
        if (!$this->mealPlanItems->contains($mealPlanItem)) {
            $this->mealPlanItems[] = $mealPlanItem;
            $mealPlanItem->setCourse($this);
        }

        return $this;
    }

    public function removeMealPlanItem(MealPlanItem $mealPlanItem): self
    {
        if ($this->mealPlanItems->removeElement($mealPlanItem)) {
            // set the owning side to null (unless already changed)
            if ($mealPlanItem->getCourse() === $this) {
                $mealPlanItem->setCourse(null);
            }
        }

        return $this;
    }
}
