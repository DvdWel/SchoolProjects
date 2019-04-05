<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/training", name="training")
     */
    public function getTrainingsAction(){
        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery('SELECT t.id, t.name, t.description, t.duration, t.cost
                                              FROM AppBundle:Training t');

        $trainings = $query->getResult();

        return $this->render('trainings.html.twig', ['trainings' => $trainings,]);
    }

}
