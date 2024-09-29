<?php

namespace App\UserAuth;

use App\Auth;
use App\Contracts\UserInterface;
use App\DataObjects\LecturerData;
use App\Entity\Lecturer;
use App\Entity\User;

class LecturerAuth extends Auth
{
    public function registerLecturer(LecturerData $data): UserInterface
    {
        $lecturer = $this->lecturerProvider->createLecturer($data);
        $this->logIn($lecturer);
        return $lecturer;
    }

    public function attemptLogin(array $credentials): bool
    {
        $lecturer = $this->lecturerProvider->getByCredentials($credentials, Lecturer::class,
            (['email' => $credentials['email']] ??
                ['id_number' => $credentials['id_number']]));

        if (! $lecturer || ! $this->checkCredentials($lecturer, $credentials)) {
            return false;
        }

        $this->logIn($lecturer);

        return true;
    }



}