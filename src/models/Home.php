<?php

namespace App\Controllers;

use App\Models\Home;

class HomeController
{
    public function index()
    {
        $home = new Home();
        echo $home->welcomeUser();
    }
}
