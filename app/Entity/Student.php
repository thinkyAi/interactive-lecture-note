<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('students')]
class Student extends User
{
    #[Column(name: 'matric_number')]
    private string $matricNumber;

//    ================= METHODS ====================
    public function getMatricNumber(): string
    {
        return $this->matricNumber;
    }

    public function setMatricNumber(string $matricNumber): Student
    {
        $this->matricNumber = $matricNumber;
        return $this;
    }

}