<?php

declare(strict_types = 1);

namespace App;

use App\Contracts\AuthInterface;
use App\Contracts\SessionInterface;
use App\Contracts\UserInterface;
use App\Contracts\UserProviderServiceInterface;
use App\DataObjects\LecturerData;
use App\DataObjects\RegisterUserData;
use App\Entity\Lecturer;
use App\Entity\User;
use App\Services\LecturerProviderService;

class Auth implements AuthInterface
{
    private ?UserInterface $user = null;

    public function __construct(
        private readonly UserProviderServiceInterface $userProvider,
        protected readonly LecturerProviderService $lecturerProvider,
        private readonly SessionInterface $session
    ) {
    }

    public function user(): ?UserInterface
    {
        if ($this->user !== null) {
            return $this->user;
        }

        $userId = $this->session->get('user');

        if (! $userId) {
            return null;
        }

        $user = $this->userProvider->getById($userId);

        if (! $user) {
            return null;
        }

        $this->user = $user;

        return $this->user;
    }

    public function checkCredentials(UserInterface $user, array $credentials): bool
    {
        return password_verify($credentials['password'], $user->getPassword());
    }

    public function logOut(): void
    {
        $this->session->forget('user');
        $this->session->regenerate();

        $this->user = null;
    }

    public function register(RegisterUserData|LecturerData $data): UserInterface
    {
        $user = $this->userProvider->createUser($data, User::class);

        $this->logIn($user);

        return $user;
    }


    public function logIn(UserInterface $user): void
    {
        $this->session->regenerate();
        $this->session->put('user', $user->getId());

        $this->user = $user;
    }
}
