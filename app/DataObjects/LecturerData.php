<?php

namespace App\DataObjects;

class LecturerData extends RegisterUserData
{
   public function __construct(
       string $full_name,
       string $email,
       string $role,
       public readonly string $id_number,
       string $password)
   {
       parent::__construct($full_name, $email, $role, $password);
   }

    public function set (array $data): self
    {
        $reflectionClass = new \ReflectionClass(self::class);
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property ) {
            $propertyName = $property->getName();
            if (is_string($this->$propertyName)) {
                $this->$propertyName = $data[$propertyName];
            } else {
                $this->$propertyName = $data[$propertyName];
            }
        }
        return $this;

    }


}