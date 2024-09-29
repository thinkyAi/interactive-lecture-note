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

#[Entity, Table('study_levels')]
#[HasLifecycleCallbacks]
class StudyLevel
{
    use HasTimestamps;

    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private int $id;

    #[Column(name: 'level_name')]
    private string $levelName;

    #[OneToMany(mappedBy: 'studyLevel', targetEntity: AllCourses::class)]
    private Collection $allCourses;

    #[OneToMany(mappedBy: 'studyLevel', targetEntity: Course::class)]
    private Collection $course;


//    ================= METHODS ===================
    public function __construct()
    {
        $this->allCourses = new ArrayCollection();
        $this->course = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getLevelName(): string
    {
        return $this->levelName;
    }

    public function setLevelName(string $levelName): StudyLevel
    {
        $this->levelName = $levelName;
        return $this;
    }

    public function getAllCourses(): ArrayCollection|Collection
    {
        return $this->allCourses;
    }

    public function addAllCourses(AllCourses $allCourses): StudyLevel
    {
        $this->allCourses->add($allCourses);
        return $this;
    }

    public function getCourse(): ArrayCollection|Collection
    {
        return $this->course;
    }

    public function addCourse(Course $course): StudyLevel
    {
        $this->course->add($course);
        return $this;
    }





}