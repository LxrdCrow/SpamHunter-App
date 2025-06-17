<?php

require __DIR__ . '/vendor/autoload.php';

use App\Kernel;

class Application {
    public static function run(): void {
        $env = $_ENV['APP_ENV'] ?? 'dev';
        $debug = (bool) ($_ENV['APP_DEBUG'] ?? true);

        $kernel = new Kernel($env, $debug);
        $kernel->run();
    }
}

Application::run();

