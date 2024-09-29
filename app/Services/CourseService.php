<?php

namespace App\Services;

use App\Auth;
use App\DataObjects\CourseData;
use App\DataObjects\DataTableQueryParams;
use App\Entity\AllCourses;
use App\Entity\Course;
use App\Entity\Lecturer;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CourseService
{
    public function __construct(
        private readonly EntityManager $entityManager,
        private readonly Auth          $auth,
    )
    {
    }

    public function registerCourse(CourseData $courseData, Lecturer $lecturer): Course
    {
        $course = new Course();
        $course->setLecturer($lecturer);

        return $this->update($course, $courseData);
    }

    public function update(Course $course, CourseData $courseData): Course
    {
        $course->setStudyLevel($courseData->study_level);
        $course->setSemesterSession($courseData->semester);
        $course->setCourseCode($courseData->course_code);
        $course->setCourseTitle($courseData->course_title);
        $course->setDescription($courseData->description);
        $course->setObjective($courseData->objective);

        $this->entityManager->persist($course);
        $this->entityManager->flush();

        return $course;
    }

    public function getCourseById(int $id): ?Course
    {
        return $this->entityManager->find(Course::class, $id);

    }

    public function getCoursesByLevelAndSemester(int $levelId, int $semesterId): array
    {
        return $this->entityManager
            ->getRepository(AllCourses::class)
            ->createQueryBuilder('c')
            ->select('c.id', 'c.courseCode', 'c.courseTitle')
            ->where('c.studyLevel = :studyLevel')->setParameter('studyLevel', $levelId)
            ->andWhere('c.semesterSession = :semesterSession')->setParameter('semesterSession', $semesterId)
            ->getQuery()
            ->getArrayResult();
    }

    public function getPaginatedCourse(DataTableQueryParams $params): Paginator
    {
        $query = $this->entityManager->getRepository(Course::class)
            ->createQueryBuilder('c')
            ->setFirstResult($params->start)
            ->setMaxResults($params->length)
            ->where('c.lecturer = :lecturer')
            ->setParameter('lecturer', $this->auth->user()?->getId());

        $orderBy = in_array($params->orderBy, ['course_code', 'course_title']) ? $params->orderBy : 'course_code';
        $orderDir = strtolower($params->orderDir) === 'asc' ? 'asc' : 'desc';

        // search for course code
        if (!empty($params->searchTerm)) {
            $query->andWhere('c.courseCode LIKE :courseCode')
                ->setParameter('courseCode', '%' . addcslashes($params->searchTerm, '%_') . '%');

        }
        return new Paginator($query);


    }

}