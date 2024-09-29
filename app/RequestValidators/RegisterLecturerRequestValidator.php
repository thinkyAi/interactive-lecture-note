<?php

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Entity\Lecturer;
use App\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Valitron\Validator;

class RegisterLecturerRequestValidator extends RegisterUserRequestValidator
{

    public function validate(array $data): array
    {
        $v = parent::validate($data);
        $v->rule('required', ['id_number']);
        $v->rule(
            fn($field, $value, $params, $fields) => ! $this->entityManager->getRepository(Lecturer::class)->count(
                ['email' => $value]
            ),
            'email'
        )->message('Lecturer with the given email address already exists');

        if (! $v->validate()) {
            throw new ValidationException($v->errors());
        }

        return $data;
    }

}