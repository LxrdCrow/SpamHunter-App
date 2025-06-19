<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    // GET /users
    public function index(): void
    {
        $users = User::getAll(); 

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $users
        ]);
    }

    // GET /users/{id}
    public function show($id): void
    {
        $user = User::findById((int)$id);

        header('Content-Type: application/json');
        if ($user) {
            echo json_encode([
                'success' => true,
                'data' => $user
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
    }

    // POST /users
    public function store(): void
    {
        $data = [
            'name'  => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? ''
        ];

        $created = User::create($data);

        header('Content-Type: application/json');
        if ($created) {
            http_response_code(201);
            echo json_encode([
                'success' => true,
                'message' => 'User created',
                'data' => $created
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create user'
            ]);
        }
    }

    // PUT/PATCH /users/{id}
    public function update($id): void
    {
        $data = [
            'name'  => $_POST['name'] ?? null,
            'email' => $_POST['email'] ?? null
        ];
        
        $filtered = array_filter($data, fn($v) => $v !== null);

        $updated = User::update((int)$id, $filtered);

        header('Content-Type: application/json');
        if ($updated) {
            echo json_encode([
                'success' => true,
                'message' => 'User updated',
                'data' => $updated
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to update user or user not found'
            ]);
        }
    }

    // DELETE /users/{id}
    public function destroy($id): void
    {
        $deleted = User::delete((int)$id);

        header('Content-Type: application/json');
        if ($deleted) {
            echo json_encode([
                'success' => true,
                'message' => 'User deleted'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
    }
}

