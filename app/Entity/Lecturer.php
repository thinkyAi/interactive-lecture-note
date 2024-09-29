<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('lecturers')]
class Lecturer extends User
{
    #[Column(name: 'id_number')]
    private string $idNumber;

    #[OneToMany(mappedBy: 'lecturer', targetEntity: CourseOutline::class)]
    private Collection $courseOutline;

    #[OneToMany(mappedBy: 'lecturer', targetEntity: Course::class)]
    private Collection $course;

    public function __construct()
    {
        $this->courseOutline = new ArrayCollection();
        $this->course = new ArrayCollection();
    }

    //    ============= METHODS =============
    public function getIdNumber(): string
    {
        return $this->idNumber;
    }

    public function setIdNumber(string $idNumber): Lecturer
    {
        $this->idNumber = $idNumber;
        return $this;
    }

    public function getCourseOutline(): ArrayCollection|Collection
    {
        return $this->courseOutline;
    }

    public function addCourseOutline(CourseOutline $courseOutline): Lecturer
    {
        $this->courseOutline->add($courseOutline);
        return $this;
    }

    public function getCourse(): ArrayCollection|Collection
    {
        return $this->course;
    }

    public function addCourse(Course $course): Lecturer
    {
        $this->course->add($course);
        return $this;
    }





}