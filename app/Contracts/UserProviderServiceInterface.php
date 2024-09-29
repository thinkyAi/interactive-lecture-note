<?php

declare(strict_types = 1);

namespace App\Contracts;

use App\DataObjects\LecturerData;
use App\DataObjects\RegisterUserData;
use App\DataObjects\StudentData;

interface UserProviderServiceInterface
{
    public function getById(int $userId): ?UserInterface;

    public function getByCredentials(array $credentials, string $userClass, array $findUserBy ): ?UserInterface;

    public function createUser(LecturerData|StudentData $data, mixed $userClass): UserInterface;

}
