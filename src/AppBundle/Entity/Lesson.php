<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lesson
 *
 * @ORM\Table(name="lesson")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonRepository")
 */
class Lesson
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
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time")
     */
    private $time;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=150)
     */
    private $location;

    /**
     * @var int
     *
     * @ORM\Column(name="max_members", type="integer")
     */
    private $maxMembers;

    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="lessons")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     */
    private $trainingId;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="lessons")
     * @ORM\JoinColumn(name="instructor_id", referencedColumnName="id")
     */
    private $instructorId;

    /**
     * @ORM\OneToMany(targetEntity="Registration", mappedBy="lessonId")
     */
    private $registrations;

    public function __construct(){
        $this->registrations = new ArrayCollection();
    }

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
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Lesson
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Lesson
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Lesson
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set maxMembers
     *
     * @param integer $maxMembers
     *
     * @return Lesson
     */
    public function setMaxMembers($maxMembers)
    {
        $this->maxMembers = $maxMembers;

        return $this;
    }

    /**
     * Get maxMembers
     *
     * @return int
     */
    public function getMaxMembers()
    {
        return $this->maxMembers;
    }

    /**
     * Set trainingId
     *
     * @param integer $trainingId
     *
     * @return Lesson
     */
    public function setTrainingId($trainingId)
    {
        $this->trainingId = $trainingId;

        return $this;
    }

    /**
     * Get trainingId
     *
     * @return int
     */
    public function getTrainingId()
    {
        return $this->trainingId;
    }

    /**
     * Set instructorId
     *
     * @param integer $instructorId
     *
     * @return Lesson
     */
    public function setInstructorId($instructorId)
    {
        $this->instructorId = $instructorId;

        return $this;
    }

    /**
     * Get instructorId
     *
     * @return int
     */
    public function getInstructorId()
    {
        return $this->instructorId;
    }

    /**
     * @return mixed
     */
    public function getRegistrations()
    {
        return $this->registrations;
    }

    /**
     * @param mixed $registrations
     */
    public function setRegistrations($registrations)
    {
        $this->registrations = $registrations;
    }
}

