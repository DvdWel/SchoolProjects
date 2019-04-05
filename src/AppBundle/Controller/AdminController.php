<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 20-3-2019
 * Time: 14:51
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Person;
use AppBundle\Entity\Training;
use AppBundle\Form\LoginType;
use AppBundle\Form\PersonType;
use AppBundle\Form\TrainingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends Controller{
    /**
     * @Route("/person/new", name="person_new")
     */
    public function newPersonAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        $form = $this->createForm(PersonType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $person = $form->getData();

            $password = $passwordEncoder->encodePassword($person, $person->getPassword());
            $person->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/training/new", name="new_training")
     */
    public function newTrainingAction(Request $request) {

        $form = $this->createForm(TrainingType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             $training = $form->getData();

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($training);
             $entityManager->flush();

             return $this->redirectToRoute('training');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/training/edit/{id}", name="edit_training")
     */
    public function editTrainingAction(Request $request, $id) {

        $entityManager = $this->getDoctrine()->getManager();
        $training = $entityManager->getRepository(Training::class)->find($id);

        $form = $this->createForm(TrainingType::class, $training);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             $entityManager->persist($training);
             $entityManager->flush();

             return $this->redirectToRoute('training');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/training/delete/{id}", name="delete_training")
     */
    public function deleteTrainingAction($id) {

        $entityManager = $this->getDoctrine()->getManager();
        $training = $entityManager->getRepository(Training::class)->find($id);
        $entityManager->remove($training);
        $entityManager->flush();

        return $this->redirectToRoute('training');
    }
}