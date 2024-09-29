<?php

namespace App\helper;

class Ini
{
    public function set(string $option, mixed $value): self
    {
        ini_set($option, $value);

        return $this;
    }

}