<?php

namespace App\Entity;

use App\Entity\Traits\HasTimestamps;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('all_courses')]
#[HasLifecycleCallbacks]
class AllCourses
{
    use HasTimestamps;

    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private int $id;

    #[Column(name: 'course_code')]
    private string $courseCode;

    #[Column(name: 'course_title')]
    private string $courseTitle;

    #[ManyToOne(inversedBy: 'allcourses')]
    private StudyLevel $studyLevel;

    #[ManyToOne(inversedBy: 'allcourses')]
    private SemesterSession $semesterSession;



    public function getId(): int
    {
        return $this->id;
    }


    public function getCourseCode(): string
    {
        return $this->courseCode;
    }

    public function setCourseCode(string $courseCode): AllCourses
    {
        $this->courseCode = $courseCode;
        return $this;
    }

    public function getCourseTitle(): string
    {
        return $this->courseTitle;
    }

    public function setCourseTitle(string $courseTitle): AllCourses
    {
        $this->courseTitle = $courseTitle;
        return $this;
    }

    public function getStudyLevel(): StudyLevel
    {
        return $this->studyLevel;
    }

    public function setStudyLevel(StudyLevel $studyLevel): AllCourses
    {
        $studyLevel->addAllCourses($this);
        $this->studyLevel = $studyLevel;
        return $this;
    }

    public function getSemesterSession(): SemesterSession
    {
        return $this->semesterSession;
    }

    public function setSemesterSession(SemesterSession $semesterSession): AllCourses
    {
        $semesterSession->addAllCourses($this);
        $this->semesterSession = $semesterSession;
        return $this;
    }








}