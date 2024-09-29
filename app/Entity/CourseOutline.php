<?php

namespace App\Entity;

use App\Entity\Traits\HasTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('course_outlines')]
#[HasLifecycleCallbacks]
class CourseOutline
{
    use HasTimestamps;

    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private int $id;

    #[Column(name: 'module_name')]
    private string $moduleName;

    #[Column(type: Types::TEXT)]
    private string $description;

    #[Column(type: Types::TEXT)]
    private string $objective;

    #[ManyToOne(inversedBy: 'courseOutlines')]
    private Course $course;

    #[ManyToOne(inversedBy: 'courseOutlines')]
    private Lecturer $lecturer;

    #[OneToMany(mappedBy: 'courseOutline', targetEntity: TimeLine::class)]
    private Collection $timeLine;

    #[OneToMany(mappedBy: 'courseOutline', targetEntity: Lecture::class)]
    private Collection $lecture;

    // ================ METHODS ================

    public function __construct()
    {
        $this->timeLine = new ArrayCollection();
        $this->lecture = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getModuleName(): string
    {
        return $this->moduleName;
    }

    public function setModuleName(string $moduleName): CourseOutline
    {
        $this->moduleName = $moduleName;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): CourseOutline
    {
        $this->description = $description;
        return $this;
    }

    public function getObjective(): string
    {
        return $this->objective;
    }

    public function setObjective(string $objective): CourseOutline
    {
        $this->objective = $objective;
        return $this;
    }


    public function getLecturer(): Lecturer
    {
        return $this->lecturer;
    }

    public function setLecturer(Lecturer $lecturer): CourseOutline
    {
        $lecturer->addCourseOutline($this);
        $this->lecturer = $lecturer;
        return $this;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): CourseOutline
    {
        $course->addCourseOutline($this);
        $this->course = $course;
        return $this;
    }

    public function getTimeLine(): ArrayCollection|Collection
    {
        return $this->timeLine;
    }

    public function addTimeLine(TimeLine $timeLine): CourseOutline
    {
        $this->timeLine->add($timeLine);
        return $this;
    }

    public function getLecture(): ArrayCollection|Collection
    {
        return $this->lecture;
    }

    public function addLecture(Lecture $lecture): CourseOutline
    {
        $this->lecture->add($lecture);
        return $this;
    }




}