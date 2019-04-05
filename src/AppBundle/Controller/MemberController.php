<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 27-3-2019
 * Time: 14:36
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Lesson;
use AppBundle\Entity\Registration;
use AppBundle\Entity\Training;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class MemberController extends Controller {
    /**
     * @Route("/member/lessons", name="member_lessons")
     */
    public function viewLessonsAction() {
        $lessons = $this->getDoctrine()->getRepository(Lesson::class)->findBy([], ['date' => 'ASC', 'time' => 'ASC']);
        $trainings = $this->getDoctrine()->getRepository(Training::class)->findAll();
        $registrations = $this->getDoctrine()->getRepository(Registration::class)->findByMemberId($this->getUser());
        return $this->render('member/lessons.html.twig', ['lessons'       => $lessons,
                                                                'trainings'     => $trainings,
                                                                'registrations' => $registrations]);
    }

    /**
     * @route("/register/{lessonId}", name="lesson_register")
     */
    public function registerAction($lessonId) {
        $entityMenager = $this->getDoctrine()->getManager();
        $lesson = $this->getDoctrine()->getRepository(Lesson::class)->find($lessonId);

        $checkRegistration = $this->getDoctrine()->getRepository(Registration::class)->findOneBy(['lessonId' => $lesson, 'memberId' => $this->getUser()]);

        if ($checkRegistration == null){
            $registration = new Registration();
            $registration->setPayment('true')
                ->setLessonId($lesson)
                ->setMemberId($this->getUser());

            $entityMenager->persist($registration);
            $entityMenager->flush();

            $this->addFlash('success', 'Je bent ingeschreven!');

            return $this->redirectToRoute('member_lessons');
        } else {
            $this->addFlash('warning', 'Je staat al ingeschreven voor deze les');

            return $this->redirectToRoute('member_lessons');
        }

    }

    /**
     * @Route("/unregister/{registrationId}", name="lesson_unregister")
     */
    public function unregisterAction($registrationId) {
        $entityManager = $this->getDoctrine()->getManager();
        $registration = $this->getDoctrine()->getRepository(Registration::class)->find($registrationId);
        $entityManager->remove($registration);
        $entityManager->flush();

        $this->addFlash('info', 'Je bent uitgeschreven!');

        return $this->redirectToRoute('member_lessons');
    }
}