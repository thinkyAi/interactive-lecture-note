<?php

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Entity\StudyLevel;
use App\Exception\ValidationException;
use App\Services\SemesterSessionService;
use App\Services\StudyLevelService;
use Valitron\Validator;

class CourseRequestValidator implements RequestValidatorInterface
{
    public function __construct(
        private readonly StudyLevelService $studyLevelService,
        private readonly SemesterSessionService $semesterSessionService
    )
    {
    }

    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('required', ['study_level', 'semester', 'course_code', 'course_title', 'description', 'objective']);
        $v->rule('integer', ['study_level', 'semester']);
        $v->rule(function ($field, $value, $params, $fields) use (&$data) {
            $getId = function ($value) {
                $id = (int) $value;
                if (!$id) {
                    return false;
                }
                return $id;
            };
            $id = $getId($value);
            $studyLevel = $this->studyLevelService->getById($id);
            if ($studyLevel) {
                $data['study_level'] = $studyLevel;
                return true;
            }
            return false;
        }, 'study_level')->message('StudyLevel not found!');

        $v->rule(function ($field, $value, $params, $fields) use(&$data) {
            $id = (int) $value;
            if (!$id) {
                return false;
            }
            $semester = $this->semesterSessionService->getById($id);
            if ($semester) {
                $data['semester'] = $semester;
                return true;
            }
            return false;
        }, 'semester')->message('SemesterSession not found!');


        if (!$v->validate()) {
            throw new ValidationException($v->errors());
        }
        return $data;
    }
}