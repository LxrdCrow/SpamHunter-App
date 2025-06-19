<?php

namespace App\Controllers;

use App\Models\GameSessionScoreModel;

class ScoreController {
    private $model;

    public function __construct() {
        $this->model = new GameSessionScoreModel();
    }

    public function index() {
        $scores = $this->model->getAllScores();

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $scores
        ]);
    }

    public function show($id) {
        $score = $this->model->getScoreById($id);

        if ($score) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $score
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Score not found'
            ]);
        }
    }
}



