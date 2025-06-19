<?php

namespace App\Models;

class Home
{
    private string $welcomeMessage;

    public function __construct()
    {
        $this->welcomeMessage = "Welcome to the SpamHunter App!";
    }

    public function welcomeUser(): string
    {
        return $this->welcomeMessage;
    }

    public function getCurrentDate(): string
    {
        return date('d/m/Y');
    }
}

