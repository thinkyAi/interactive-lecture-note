<?php

declare(strict_types = 1);

namespace App\Services;

use App\Contracts\UserInterface;
use App\Contracts\UserProviderServiceInterface;
use App\DataObjects\LecturerData;
use App\DataObjects\RegisterUserData;
use App\DataObjects\StudentData;
use App\Entity\Lecturer;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class UserProviderService implements UserProviderServiceInterface
{
    public function __construct(protected readonly EntityManager $entityManager)
    {
    }

    public function getById(int $userId): ?UserInterface
    {
        return $this->entityManager->find(User::class, $userId);
    }

    public function getByCredentials(array $credentials, string $userClass, array $findUserBy): ?UserInterface
    {
        return $this->entityManager->getRepository($userClass)->findOneBy($findUserBy);
    }

    public function createUser(LecturerData|StudentData $data, mixed $userClass): UserInterface
    {
        $user = new $userClass();
        $user->setFullName($data->full_name);
        $user->setEmail($data->email);
        $user->setRole($data->role);
        $user->setPassword(password_hash($data->password, PASSWORD_BCRYPT, ['cost' => 12]));

        return $user;
    }

}
