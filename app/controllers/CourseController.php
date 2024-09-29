<?php

namespace App\controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\Entity\Course;
use App\Entity\SemesterSession;
use App\helper\SetCourseData;
use App\RequestValidators\CourseRequestValidator;
use App\RequestValidators\TransactionRequestValidator;
use App\ResponseFormatter;
use App\Services\CourseService;
use App\Services\RequestService;
use App\Services\SemesterSessionService;
use App\Services\StudyLevelService;
use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CourseController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly StudyLevelService $studyLevelService,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly SemesterSessionService $semesterSessionService,
        private readonly CourseService $courseService,
        private readonly ResponseFormatter $responseFormatter,
        private readonly SetCourseData $setCourseData,
        private readonly RequestService $requestService
    ) {
    }

    public function index(Request $request, Response $response): Response
    {
        return $this->twig->render($response,'course/index.twig');
    }

     public function createView(Request $request, Response $response): Response
     {
         return $this->twig->render($response,
         'course/create_course.twig',
         [
             'levels' => $this->studyLevelService->getStudyLevelName(),
             'semesters' => $this->semesterSessionService->getSemesterName(),

         ]);

     }

     public function register(Request $request, Response $response): Response
     {
         $data = $this->requestValidatorFactory->make(CourseRequestValidator::class)->validate(
             $request->getParsedBody()
         );

         $this->courseService->registerCourse(
             $this->setCourseData->all($data), $request->getAttribute('user')
         );

         return $this->responseFormatter->asJson($response, $data);
     }

     public function get(Request $request, Response $response, array $args): Response
     {
         $course = $this->courseService->getCourseById((int)$args['id']);

         if(!$course) {
             return $response->withStatus(404);
         }
         $data = [
             'id' => $course->getId(),
             'code' => $course->getCourseCode(),
             'title' => $course->getCourseTitle()
         ];
         return $this->responseFormatter->asJson($response, $data);
     }

     public function getByLevelAndSemester(Request $request, Response $response): Response
     {
         $lookup = $request->getQueryParams();
         $course = $this->courseService->getCoursesByLevelAndSemester((int) $lookup['levelId'], (int) $lookup['semesterId'] );
         if (! $course) {
             return $response->withStatus(404);
         }

         return $this->responseFormatter->asJson($response, $course);

     }

     public function load (Request $request, Response $response): Response
     {
         $params = $this->requestService->getDataTableQueryParameters($request);
         $course = $this->courseService->getPaginatedCourse($params);

         $start = $params->start;

         $transformer = function (Course $course) use (&$start) {
             $start++;
             return [
                 'sn' => $start,
                 'id' => $course->getId(),
                 'courseCode' => $course->getCourseCode(),
                 'courseTitle' => $course->getCourseTitle(),
             ];
         };
         

         $totalCourse = count($course);

         return $this->responseFormatter->asDataTable(
             $response,
             array_map($transformer, (array)$course->getIterator()),
             $params->draw,
             $totalCourse
         );


     }







}