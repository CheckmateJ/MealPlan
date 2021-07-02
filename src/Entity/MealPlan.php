<?php

namespace App\Entity;
use App\Repository\MealPlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MealPlanRepository::class)
 */
class MealPlan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"meal-plan-simple"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=MealPlanItem::class, mappedBy="mealPlan", orphanRemoval=true, cascade={"PERSIST"} )
     */
    private $mealPlanItem;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"meal-plan-simple"})
     */
    private $name;

    public function __construct()
    {
        $this->mealPlanItem = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|MealPlanItem[]
     */
    public function getMealPlanItem(): Collection
    {
        return $this->mealPlanItem;
    }

    public function addMealPlanItem(MealPlanItem $mealPlanItem): self
    {
        if (!$this->mealPlanItem->contains($mealPlanItem)) {
            $this->mealPlanItem[] = $mealPlanItem;
            $mealPlanItem->setMealPlan($this);
        }

        return $this;
    }

    public function removeMealPlanItem(MealPlanItem $mealPlanItem): self
    {
        if ($this->mealPlanItem->removeElement($mealPlanItem)) {
            // set the owning side to null (unless already changed)
            if ($mealPlanItem->getMealPlan() === $this) {
                $mealPlanItem->setMealPlan(null);
            }
        }

        return $this;
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
}
