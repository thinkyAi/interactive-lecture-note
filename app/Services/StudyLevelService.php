<?php

namespace App\Services;

use App\Entity\StudyLevel;
use Doctrine\ORM\EntityManager;


class StudyLevelService
{
    public function __construct(
        private readonly EntityManager $entityManager,
    )
    {
    }

    public function getById (int $id): ?StudyLevel
    {
        return $this->entityManager->find(StudyLevel::class, $id);
    }

    public function getStudyLevelName(): array
    {
        return $this->entityManager->getRepository(StudyLevel::class)
            ->createQueryBuilder('sl')
            ->select('sl.id', 'sl.levelName')
            ->getQuery()
            ->getArrayResult();
    }

}