<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\CourseIngredient;
use App\Entity\MealPlan;
use App\Entity\MealPlanItem;
use App\Form\MealPlanType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MealPlanController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/app/meal/plan", name="meal_plan_list")
     */
    public function index(): Response
    {
        $user = $this->getUser()->getId();
        $mealsPlan = $this->entityManager->getRepository(MealPlan::class)->findBy(['user' => $user]);
        return $this->render('meal_plan/index.html.twig', [
            'mealsPlan' => $mealsPlan
        ]);
    }

    /**
     * @Route("/app/meal/plan/edit/{id}", name="meal_plan_edit")
     * @Route("/app/meal/plan/edit", name="meal_plan_new")
     */
    public function editMealPLan(Request $request, $id = null)
    {
        if ($id != null) {
            $mealPlan = $this->entityManager->getRepository(MealPlan::class)->find($id);
        } else {
            $mealPlan = new MealPlan();
        }

        $user = $this->getUser();
        $days = MealPlanItem::DAYS;
        $meals = MealPlanItem::MEALS;
        $course = $this->entityManager->getRepository(Course::class)->findAll();

        $form = $this->createForm(MealPlanType::class, $mealPlan);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mealPlan->setUser($user);
            if ($id == null) {
                $this->entityManager->persist($mealPlan);
            }
            $this->entityManager->flush();

            if (isset($request->get('meal_plan')['report'])) {
                return $this->redirectToRoute('meal_plan_report', ['id' => $mealPlan->getId()]);
            }
            return $this->redirectToRoute('meal_plan_list');
        }

        return $this->render('meal_plan/edit.html.twig', [
            'form' => $form->createView(),
            'days' => $days,
            'meals' => $meals,
            'course' => $course,
            'mealPlan' => $mealPlan
        ]);

    }

    /**
     * @Route("/app/meal/plan/delete/{id}", name="meal_plan_delete")
     */
    public function deleteMealPlan($id): Response
    {

        $mealPlan = $this->entityManager->getRepository(MealPlan::class)->find($id);
        $this->entityManager->remove($mealPlan);
        $this->entityManager->flush();

        return $this->redirectToRoute('meal_plan_list');
    }

    /**
     * @Route("/app/meal/plan/report/{id}", name="meal_plan_report")
     */
    public function report($id): Response
    {
        $mealPlan = $this->entityManager->getRepository(MealPlan::class)->find($id);
        $mealPlanItems = $mealPlan->getMealPlanItem()->toArray();

        $report = [];
        foreach ($mealPlanItems as $mealPlanItem) {
            if ($mealPlanItem->getCourse() === null) {
                continue;
            }

            /** @var CourseIngredient $courseIngredient */
            foreach ($mealPlanItem->getCourse()->getCourseIngredient() as $courseIngredient) {
                $index = $courseIngredient->getIngredient()->getId() . $courseIngredient->getUnit();
                if (array_key_exists($index, $report)) {
                    $report[$index][1] += $courseIngredient->getAmount();
                } else {
                    $report[$index] = [$courseIngredient->getIngredient()->getName(), $courseIngredient->getAmount(), $courseIngredient->getUnit()];
                }
            }
        }

        return $this->render('meal_plan/report.html.twig', [
            'report' => $report
        ]);
    }

}
