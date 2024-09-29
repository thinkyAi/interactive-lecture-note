<?php

namespace App\DataObjects;

use App\Entity\SemesterSession;
use App\Entity\StudyLevel;

class CourseData
{
    public function __construct(
        public StudyLevel $study_level,
        public SemesterSession $semester,
        public string $course_code,
        public string $course_title,
        public string $description,
        public string $objective,
    )
    {
    }

}