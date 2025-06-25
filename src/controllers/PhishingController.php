<?php

namespace App\Controllers;

use App\Services\PhishingEmailService;

class PhishingController
{
    private PhishingEmailService $service;

    public function __construct()
    {
        $this->service = new PhishingEmailService();
    }

    // GET /phishing-email
    public function generate(): void
    {
        $email = $this->service->generate();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $email]);
    }

    // POST /phishing-email/send
    public function send(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $result = $this->service->send($data);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    // POST /phishing-email/save
    public function save(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $result = $this->service->save($data);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    // GET /phishing-email/all
    public function getAll(): void
    {
        $emails = $this->service->getAll();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $emails]);
    }

    // DELETE /phishing-email/all
    public function deleteAll(): void
    {
        $result = $this->service->deleteAll();
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }
}

