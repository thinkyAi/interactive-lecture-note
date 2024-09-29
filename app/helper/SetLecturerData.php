<?php

namespace App\helper;

use App\DataObjects\LecturerData;


class SetLecturerData
{
    public function all(array $data): LecturerData
    {
        return new LecturerData(
            $data['full_name'],
            $data['email'],
            $data['role'],
            $data['id_number'],
            $data['password'],

        );
    }
}