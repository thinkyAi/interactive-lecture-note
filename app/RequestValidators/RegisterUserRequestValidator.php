<?php

declare(strict_types = 1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Entity\Lecturer;
use App\Entity\User;
use App\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Valitron\Validator;

class RegisterUserRequestValidator implements RequestValidatorInterface
{
    public function __construct(public readonly EntityManager $entityManager)
    {
    }

    public function validate(array $data): array|object
    {
        $v = new Validator($data);
        $v->rule('required', ['full_name', 'email', 'role', 'password', 'confirmPassword']);
        $v->rule('email', 'email');
        $v->rule('equals', 'confirmPassword', 'password')->label('Confirm Password');
        return $v;


//        if (! $v->validate()) {
//            throw new ValidationException($v->errors());
//        }
//
//        return $data;
    }
}
