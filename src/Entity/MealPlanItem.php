<?php

namespace App\Entity;

use App\Repository\MealPlanItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MealPlanItemRepository::class)
 */
class MealPlanItem
{

    const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    const MEALS = [ 'Breakfast', 'Lunch', 'Dinner', 'Afternoon snack', 'Supper'];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"meal-plan-item-simple"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="mealPlanItem")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"meal-plan-item-simple"})
     */
    private $course;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"meal-plan-item-simple"})
     */
    private $day;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"meal-plan-item-simple"})
     */
    private $meal;

    /**
     * @ORM\ManyToOne(targetEntity=MealPlan::class, inversedBy="mealPlanItem")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"meal-plan-item-simple"})
     */
    private $mealPlan;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getMeal(): ?string
    {
        return $this->meal;
    }

    public function setMeal(string $meal): self
    {
        $this->meal = $meal;

        return $this;
    }

    public function getMealPlan(): ?MealPlan
    {
        return $this->mealPlan;
    }

    public function setMealPlan(?MealPlan $mealPlan): self
    {
        $this->mealPlan = $mealPlan;

        return $this;
    }
}
