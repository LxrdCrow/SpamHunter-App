<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\SessionController;
use App\Controllers\ScoreController;

require_once __DIR__ . '/../index.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $uri);

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

header('Content-Type: application/json');

// ROUTING
switch ($segments[0]) {

    case '':
        if ($method === 'GET') {
            (new HomeController())->index();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
        break;

    case 'users':
        $controller = new UserController();

        if ($method === 'GET') {
            if (isset($segments[1])) {
                $controller->show((int)$segments[1]);
            } else {
                $controller->index();
            }
        } elseif ($method === 'POST') {
            $controller->store($input);
        } elseif ($method === 'PUT' && isset($segments[1])) {
            $controller->update((int)$segments[1], $input);
        } elseif ($method === 'DELETE' && isset($segments[1])) {
            $controller->destroy((int)$segments[1]);
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
        break;

    case 'sessions':
        $controller = new SessionController();
        if ($method === 'GET') {
            if (isset($segments[1])) {
                $controller->show((int)$segments[1]);
            } else {
                $controller->index();
            }
        } elseif ($method === 'POST') {
            $controller->store($input);
        } elseif ($method === 'PUT' && isset($segments[1])) {
            $controller->update((int)$segments[1], $input);
        } elseif ($method === 'DELETE' && isset($segments[1])) {
            $controller->destroy((int)$segments[1]);
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
        break;

    case 'scores':
        $controller = new ScoreController();
        if ($method === 'GET') {
            $controller->index();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
        break;
}

