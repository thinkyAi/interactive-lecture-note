<?php

namespace App\Services;

use App\Contracts\UserInterface;
use App\Contracts\UserProviderServiceInterface;
use App\DataObjects\LecturerData;
use App\DataObjects\RegisterUserData;
use App\DataObjects\StudentData;
use App\Entity\Lecturer;
use Doctrine\ORM\EntityManager;

class LecturerProviderService extends UserProviderService
{
    public function createLecturer(LecturerData $data): UserInterface
    {
        $lecturer  = $this->createUser($data, Lecturer::class);
        if ($lecturer instanceof Lecturer) {
            $lecturer->setIdNumber($data->id_number);

            $this->entityManager->persist($lecturer);
            $this->entityManager->flush();
            return $lecturer;
        }

        return $lecturer;
    }

}