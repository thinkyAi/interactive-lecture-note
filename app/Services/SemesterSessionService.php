<?php

namespace App\Services;

use App\Entity\SemesterSession;
use Doctrine\ORM\EntityManager;

class SemesterSessionService
{

    public function __construct(
        private readonly EntityManager $entityManager
    )
    {
    }

    public function getById (int $id): ?SemesterSession
    {
        return $this->entityManager->find(SemesterSession::class, $id);
    }


    public function getSemesterName(): array
    {
       return $this->entityManager->getRepository(SemesterSession::class)
            ->createQueryBuilder('ss')
            ->select('ss.id', 'ss.semesterName')
            ->getQuery()
            ->getArrayResult();
    }





}