<?php

namespace App\Services;

class CustomGreetingService
{
    public function greet($name)
    {
        return "Hello, $name!";
    }
}
