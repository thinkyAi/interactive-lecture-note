<?php

declare(strict_types = 1);

namespace App\DataObjects;

class RegisterUserData
{
    public function __construct(
        public readonly string $full_name,
        public readonly string $email,
        public readonly string $role,
        public readonly string $password,
    ) {
    }
}
