<?php

use Dotenv\Dotenv;
use App\Kernel;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Application {
    public static function run(): void {
        $env = $_ENV['APP_ENV'] ?? 'dev';
        $debug = (bool) ($_ENV['APP_DEBUG'] ?? true);

        $kernel = new Kernel($env, $debug);
        $kernel->run();
    }
}

Application::run();

