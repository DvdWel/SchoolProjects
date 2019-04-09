<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 27-3-2019
 * Time: 15:13
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Lesson;
use AppBundle\Entity\Training;
use AppBundle\Form\LessonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class InstructorController extends Controller {
    /**
     * @Route("/instructor/lessons", name="instructor_lessons")
     */
    public function viewLessonsAction() {
        $lessons = $this->getDoctrine()->getRepository(Lesson::class)->findAll();
        $trainings = $this->getDoctrine()->getRepository(Training::class)->findAll();
        return $this->render('instructor/lessons.html.twig', ['lessons'    => $lessons,
                                                                    'trainings'  => $trainings]);
    }

    /**
     * @Route("/lessons/new", name="new_lesson")
     */
    public function newLessonAction(Request $request){
        $form = $this->createForm(LessonType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $person = $form->getData();
            $person->setInstructorId($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->flush();

            return $this->redirectToRoute('lessons');
        }

        return $this->render('new_instructor.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/lessons/edit/{id}", name="edit_lesson")
     */
    public function editLessonAction($id, Request $request){

        $entityManager = $this->getDoctrine()->getManager();
        $lesson = $entityManager->getRepository(Lesson::class)->find($id);

        $form = $this->createForm(LessonType::class, $lesson);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $person = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->flush();

            return $this->redirectToRoute('lessons');
        }

        return $this->render('new_instructor.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/lessons/delete/{id}", name="delete_lesson")
     */
    public function deleteLessonAction($id){
        $entityManager = $this->getDoctrine()->getManager();
        $lesson = $entityManager->getRepository(Lesson::class)->find($id);
        $entityManager->remove($lesson);
        $entityManager->flush();

        return $this->redirectToRoute('lessons');
    }
}