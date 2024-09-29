<?php

namespace App\Entity;

use App\Entity\Traits\HasTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('semester_sessions')]
#[HasLifecycleCallbacks]
class SemesterSession
{
    use HasTimestamps;

    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private int $id;

    #[Column(name: 'semester_name')]
    private string $semesterName;

    #[OneToMany(mappedBy: 'semesterSession', targetEntity: AllCourses::class)]
    private Collection $allCourses;

    #[OneToMany(mappedBy: 'semesterSession', targetEntity: Course::class)]
    private Collection $course;

    public function __construct()
    {
        $this->allCourses = new ArrayCollection();
        $this->course = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSemesterName(): string
    {
        return $this->semesterName;
    }

    public function setSemesterName(string $semesterName): SemesterSession
    {
        $this->semesterName = $semesterName;
        return $this;
    }

    public function getAllCourses(): ArrayCollection|Collection
    {
        return $this->allCourses;
    }

    public function addAllCourses(AllCourses $allCourses): SemesterSession
    {
        $this->allCourses->add($allCourses);
        return $this;
    }

    public function getCourse(): ArrayCollection|Collection
    {
        return $this->course;
    }

    public function addCourse(Course $course): SemesterSession
    {
        $this->course->add($course);
        return $this;
    }







}