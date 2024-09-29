<?php

namespace App\Entity;

use App\Entity\Traits\HasTimestamps;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('timelines')]
#[HasLifecycleCallbacks]
class TimeLine
{
    use HasTimestamps;

    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private int $id;

    #[Column(name: 'week_number')]
    private string $weekNumber;

    #[Column(name: 'start_date')]
    private \DateTime $startDate;

    #[Column(name: 'end_date')]
    private \DateTime $endDate;

    #[ManyToOne(inversedBy: 'timelines')]
    private CourseOutline $courseOutline;


    // ================== METHODS ============

    public function getId(): int
    {
        return $this->id;
    }


    public function getWeekNumber(): string
    {
        return $this->weekNumber;
    }

    public function setWeekNumber(string $weekNumber): TimeLine
    {
        $this->weekNumber = $weekNumber;
        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): TimeLine
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): ?TimeLine
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getCourseOutline(): CourseOutline
    {
        return $this->courseOutline;
    }

    public function setCourseOutline(CourseOutline $courseOutline): TimeLine
    {
        $courseOutline->addTimeLine($this);
        $this->courseOutline = $courseOutline;
        return $this;
    }



}