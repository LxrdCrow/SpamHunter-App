<?php

namespace App;

class Kernel
{
    private string $env;
    private bool $debug;

    public function __construct(string $env, bool $debug)
    {
        $this->env = $env;
        $this->debug = $debug;

        $this->loadEnv();
        $this->initErrorHandling();
    }

    private function loadEnv(): void
    {
        if (file_exists(__DIR__ . '/../.env')) {
            $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue;
                putenv($line);
                [$key, $value] = explode('=', $line, 2);
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }

    private function initErrorHandling(): void
    {
        if ($this->debug) {
            ini_set('display_errors', '1');
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', '0');
            error_reporting(0);
        }
    }

    public function run(): void
    {
        // Esempio: gestisci routing "a mano"
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if ($uri === '/')
            require __DIR__ . '/Controllers/HomeController.php';
        elseif ($uri === '/play')
            require __DIR__ . '/Controllers/GameController.php';
        else
            http_response_code(404);
    }
}
