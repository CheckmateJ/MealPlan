<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\CourseIngredient;
use App\Entity\Ingredient;
use App\Form\CourseType;
use ContainerNXOMcKK\get_Console_Command_About_LazyService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CourseController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/app/course/list", name="course_list")
     */
    public function index(): Response
    {
        $user = $this->getUser()->getId();
        $courses = $this->entityManager->getRepository(Course::class)->findBy(['user' => $user]);
        return $this->render('course/index.html.twig', [
            'courses' => $courses
        ]);
    }

    /**
     * @Route("/app/course/edit/{id}", name="course_edit")
     * @Route("/app/course/edit", name="course_new")
     */
    public function editCourse(Request $request, $id = null): Response
    {
        if ($id != null) {
            $course = $this->entityManager->getRepository(Course::class)->find($id);
            $courseName = $course->getName();
        } else {
            $courseName = null;
            $course = new Course();
        }

        $ingredients = $this->entityManager->getRepository(Ingredient::class)->findAll();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $course->setUser($user);
            if ($id == null) {
                $this->entityManager->persist($course);
            }
            $this->entityManager->flush();
            return $this->redirectToRoute('course_list');
        }
        return $this->render('course/edit.html.twig', [
            'form' => $form->createView(),
            'course' => $course,
            'ingredients' => $ingredients,
            'courseName' => $courseName,
        ]);
    }

    /**
     * @Route("/app/course/delete/{id}", name="course_delete")
     */
    public
    function deleteCourse($id): Response
    {
        $course = $this->entityManager->getRepository(Course::class)->find($id);
        $this->entityManager->remove($course);
        $this->entityManager->flush();
        return $this->redirectToRoute('course_list');
    }
}
