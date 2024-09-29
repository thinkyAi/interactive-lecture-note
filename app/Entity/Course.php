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

#[Entity, Table('courses')]
#[HasLifecycleCallbacks]
class Course
{
    use HasTimestamps;

    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private int $id;

    #[Column(name: 'course_code')]
    private string $courseCode;

    #[Column(name: 'course_title')]
    private string $courseTitle;

    #[Column(name: 'description')]
    private string $description;

    #[Column(name: 'objective', type: Types::TEXT)]
    private string $objective;

    #[ManyToOne(inversedBy: 'courses')]
    private Lecturer $lecturer;

    #[ManyToOne(inversedBy: 'courses')]
    private StudyLevel $studyLevel;

    #[ManyToOne(inversedBy: 'courses')]
    private SemesterSession $semesterSession;

//    #[OneToMany(mappedBy: 'course', targetEntity: Lecture::class)]
//    private Collection $lecture;

    #[OneToMany(mappedBy: 'course', targetEntity: CourseOutline::class)]
    private Collection $courseOutline;


//    =================== METHODS =====================
    public function __construct()
    {
        $this->courseOutline = new ArrayCollection();

    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getCourseCode(): string
    {
        return $this->courseCode;
    }

    public function setCourseCode(string $courseCode): Course
    {
        $this->courseCode = $courseCode;
        return $this;
    }

    public function getCourseTitle(): string
    {
        return $this->courseTitle;
    }

    public function setCourseTitle(string $courseTitle): Course
    {
        $this->courseTitle = $courseTitle;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Course
    {
        $this->description = $description;
        return $this;
    }

    public function getObjective(): string
    {
        return $this->objective;
    }

    public function setObjective(string $objective): Course
    {
        $this->objective = $objective;
        return $this;
    }

    public function getLecturer(): Lecturer
    {
        return $this->lecturer;
    }

    public function setLecturer(Lecturer $lecturer): Course
    {
        $lecturer->addCourse($this);
        $this->lecturer = $lecturer;
        return $this;
    }

    public function getCourseOutline(): ArrayCollection|Collection
    {
        return $this->courseOutline;
    }

    public function addCourseOutline(CourseOutline $courseOutline): Course
    {
        $this->courseOutline->add($courseOutline);
        return $this;
    }

    public function getStudyLevel(): StudyLevel
    {
        return $this->studyLevel;
    }

    public function setStudyLevel(StudyLevel $studyLevel): self
    {
        $studyLevel->addCourse($this);
        $this->studyLevel = $studyLevel;
        return $this;
    }

    public function getSemesterSession(): SemesterSession
    {
        return $this->semesterSession;
    }

    public function setSemesterSession(SemesterSession $semesterSession): self
    {
        $semesterSession->addCourse($this);
        $this->semesterSession = $semesterSession;
        return $this;
    }
}