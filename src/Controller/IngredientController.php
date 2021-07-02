<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/app/ingredient/list", name="ingredient_list")
     */
    public function index(): Response
    {
        $user = $this->getUser()->getId();
        $ingredients = $this->entityManager->getRepository(Ingredient::class)->findBy(['user' => $user]);
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients
        ]);
    }

    /**
     * @Route("/app/ingredient/edit/{id}", name="ingredient_edit")
     * @Route("/app/ingredient/edit", name="ingredient_new")
     * @throws \Doctrine\ORM\ORMException
     */
    public function editIngredient(Request $request, $id = null): Response
    {
        if ($id != null) {
            $ingredient = $this->entityManager->getRepository(Ingredient::class)->find($id);
        } else {
            $ingredient = new Ingredient();
        }

        $user = $this->getUser();
        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $ingredient->setUser($user);

            if ($id == null) {
                $this->entityManager->persist($ingredient);
            }

            $this->entityManager->flush();
            return $this->redirectToRoute('ingredient_list');
        }
        return $this->render('ingredient/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/app/ingredient/delete/{id}", name="ingredient_delete")
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteIngridient($id): Response
    {
        $ingredients = $this->entityManager->getRepository(Ingredient::class)->find($id);
        $this->entityManager->remove($ingredients);
        $this->entityManager->flush();
        return $this->redirectToRoute('ingredient_list');
    }
}
