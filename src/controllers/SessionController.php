<?php

namespace App\Controllers;

use App\Models\SessionModel;

class SessionController
{
    private SessionModel $model;

    public function __construct()
    {
        $this->model = new SessionModel();
    }

    // GET /sessions
    public function index(): void
    {
        $sessions = $this->model->getAllSessions();

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $sessions
        ]);
    }

    // GET /sessions/{id}
    public function show($id): void
    {
        $session = $this->model->getSessionById((int)$id);

        if ($session) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $session
            ]);
        } else {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Session not found'
            ]);
        }
    }

    // POST /sessions
    public function store(): void
    {
        $data = $_POST;

        $result = $this->model->createSession($data);

        if ($result) {
            http_response_code(201);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Session created',
                'data' => $result
            ]);
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create session'
            ]);
        }
    }

    // PUT/PATCH /sessions/{id}
    public function update($id): void
    {
        $data = $_POST; 
        $result = $this->model->updateSession((int)$id, $data);

        if ($result) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Session updated',
                'data' => $result
            ]);
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Failed to update session or session not found'
            ]);
        }
    }

    // DELETE /sessions/{id}
    public function destroy($id): void
    {
        $deleted = $this->model->deleteSession((int)$id);

        if ($deleted) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Session deleted'
            ]);
        } else {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Failed to delete session or session not found'
            ]);
        }
    }
}


