<?php

namespace App\helper;

use App\DataObjects\CourseData;

class SetCourseData
{
    public function all(array $data): CourseData
    {
        return new CourseData(
            $data['study_level'],
            $data['semester'],
            $data['course_code'],
            $data['course_title'],
            $data['description'],
            $data['objective']
        );
    }

}