<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Registration
 *
 * @ORM\Table(name="registration")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistrationRepository")
 */
class Registration
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="payment", type="boolean", nullable=true)
     */
    private $payment;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="registrations")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private  $memberId;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="registrations")
     * @ORM\JoinColumn(name="lesson_id", referencedColumnName="id")
     */
    private $lessonId;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set payment
     *
     * @param boolean $payment
     *
     * @return Registration
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return bool
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set memberId
     *
     * @param int $memberId
     *
     * @return Registration
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;

        return $this;
    }

    /**
     * Get memberId
     *
     * @return int
     */
    public function getMemberId()
    {
        return $this->memberId;
    }
    /**
     * Set lessonId
     *
     * @param int $lessonId
     *
     * @return Registration
     */

    public function setLessonId($lessonId)
    {
        $this->lessonId = $lessonId;

        return $this;
    }

    /**
     * Get lessonId
     *
     * @return int
     */
    public function getLessonId()
    {
        return $this->lessonId;
    }
}

