<?php

class Response
{
    public int $session_id;
    public string $response_data;
    public string $created_at;
    public string $updated_at;

    public function __construct(array $data = [])
    {
        $this->session_id = isset($data['session_id']) ? (int)$data['session_id'] : 0;
        $this->response_data = $data['response_data'] ?? '';
        $this->created_at = $data['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $data['updated_at'] ?? date('Y-m-d H:i:s');
    }
    
    public function getCreatedAtFormatted(): string
    {
        $dt = new DateTime($this->created_at);
        return $dt->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtFormatted(): string
    {
        $dt = new DateTime($this->updated_at);
        return $dt->format('Y-m-d H:i:s');
    }

    public function setCreatedAt(string $date): void
    {
        $this->created_at = date('Y-m-d H:i:s', strtotime($date));
    }
    public function setUpdatedAt(string $date): void
    {
        $this->updated_at = date('Y-m-d H:i:s', strtotime($date));
    }
    public function toArray(): array
    {
        return [
            'session_id' => $this->session_id,
            'response_data' => $this->response_data,
            'created_at' => $this->getCreatedAtFormatted(),
            'updated_at' => $this->getUpdatedAtFormatted(),
        ];
    }
}


