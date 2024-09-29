<?php

namespace App\Entity;

use App\Entity\Traits\HasTimestamps;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('lectures')]
#[HasLifecycleCallbacks]
class Lecture
{
    use HasTimestamps;

    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private int $id;

    #[Column]
    private string $title;

    #[Column(type: Types::TEXT)]
    private string $content;

//    #[ManyToOne(inversedBy: 'lecture')]
//    private Lecturer $lecturer;

    #[ManyToOne(inversedBy: 'lectures')]
    private CourseOutline $courseOutline;

//    #[OneToOne(mappedBy: 'lecture', targetEntity: LectureTimeline::class, cascade: ['persist', 'remove'])]
//    private LectureTimeline $lectureTimeline;

//    ================= METHODS ==================
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Lecture
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Lecture
    {
        $this->content = $content;
        return $this;
    }

//    public function getLecturer(): Lecturer
//    {
//        return $this->lecturer;
//    }
//
//    public function setLecturer(Lecturer $lecturer): Lecture
//    {
//        $lecturer->addLecture($this);
//        $this->lecturer = $lecturer;
//        return $this;
//    }

    public function getCourseOutline(): CourseOutline
    {
        return $this->courseOutline;
    }

    public function setCourseOutline(CourseOutline $courseOutline): Lecture
    {
        $courseOutline->addLecture($this);
        $this->courseOutline = $courseOutline;
        return $this;
    }

//    public function getLectureTimeline(): LectureTimeline
//    {
//        return $this->lectureTimeline;
//    }
//
//    public function setLectureTimeline(LectureTimeline $lectureTimeline): Lecture
//    {
//        if ($lectureTimeline->getLecture() !== $this) {
//            $lectureTimeline->setLecture($this);
//        }
//        $this->lectureTimeline = $lectureTimeline;
//        return $this;
//    }







}