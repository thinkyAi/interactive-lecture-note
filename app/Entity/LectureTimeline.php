<?php

namespace App\Entity;

use App\Entity\Traits\HasTimestamps;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

//#[Entity, Table('lecture_timeline')]
//#[HasLifecycleCallbacks]
class LectureTimeline
{
//    use HasTimestamps;
//
//    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
//    private int $id;
//
//    #[Column(name: 'week_number')]
//    private string $weekNumber;
//
//    #[Column(name: 'start_date')]
//    private \DateTime $startDate;
//
//    #[Column(name: 'end_date')]
//    private \DateTime $endDate;
//
//    #[OneToOne(inversedBy: 'lecturetimeline', targetEntity: Lecture::class)]
//    private Lecture $lecture;
//
//
////    ================= METHODS ==================
//
//    public function getId(): int
//    {
//        return $this->id;
//    }
//
//
//    public function getWeekNumber(): string
//    {
//        return $this->weekNumber;
//    }
//
//    public function setWeekNumber(string $weekNumber): LectureTimeline
//    {
//        $this->weekNumber = $weekNumber;
//        return $this;
//    }
//
//    public function getStartDate(): \DateTime
//    {
//        return $this->startDate;
//    }
//
//    public function setStartDate(\DateTime $startDate): LectureTimeline
//    {
//        $this->startDate = $startDate;
//        return $this;
//    }
//
//    public function getEndDate(): \DateTime
//    {
//        return $this->endDate;
//    }
//
//    public function setEndDate(\DateTime $endDate): LectureTimeline
//    {
//        $this->endDate = $endDate;
//        return $this;
//    }
//
//    public function getLecture(): Lecture
//    {
//        return $this->lecture;
//    }
//
//    public function setLecture(Lecture $lecture): LectureTimeline
//    {
//        $this->lecture = $lecture;
//        return $this;
//}

}