<?php

namespace App\Controllers;

use App\Models\Home;

class HomeController
{
    public function index(): void
    {
        $home = new Home();

        $welcomeMessage = $home->welcomeUser();
        $currentDate = $home->getCurrentDate();

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => $welcomeMessage,
            'data' => [
                'date' => $currentDate
            ]
        ]);
    }
}

