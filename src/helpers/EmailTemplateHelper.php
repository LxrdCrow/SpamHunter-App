<?php

namespace App\Helpers;

class EmailTemplateHelper
{
    private array $templates = [];

    public function __construct()
    {
        $this->templates = [
            // ID 1
            [
                'id' => 1,
                'name' => 'account_verification',
                'type' => 'phishing',
                'category' => 'security',
                'subject' => 'Urgente: verifica il tuo account {{company}}',
                'body' => "Ciao {{name}}, abbiamo rilevato un accesso sospetto. Clicca qui: {{link}} per verificare il tuo account.",
            ],
            // ID 2
            [
                'id' => 2,
                'name' => 'prize_winner',
                'type' => 'phishing',
                'category' => 'promotion',
                'subject' => 'Hai vinto un premio da {{company}}!',
                'body' => "Congratulazioni {{name}}! Riscatta il premio ora su {{link}}.",
            ],
        ];
    }

    public function getTemplate(string $type): array
    {
        $filtered = array_filter($this->templates, fn($t) => $t['type'] === $type);
        if (empty($filtered)) {
            throw new \RuntimeException("No template found for type '$type'");
        }
        $keys = array_keys($filtered);
        $randKey = $keys[array_rand($keys)];
        return $filtered[$randKey];
    }

    public function getTemplateById(int $id): ?array
    {
        foreach ($this->templates as $template) {
            if (isset($template['id']) && $template['id'] === $id) {
                return $template;
            }
        }
        return null;
    }

    public function getTemplateByName(string $name): ?array
    {
        foreach ($this->templates as $template) {
            if (isset($template['name']) && $template['name'] === $name) {
                return $template;
            }
        }
        return null;
    }

    public function getTemplateByType(string $type): array
    {
        return array_values(array_filter($this->templates, fn($t) => $t['type'] === $type));
    }

    public function getTemplateByCategory(string $category): array
    {
        return array_values(array_filter($this->templates, fn($t) => ($t['category'] ?? '') === $category));
    }

    public function getAllTemplates(): array
    {
        return $this->templates;
    }

    public function saveTemplate(array $data): bool
    {
        if (!isset($data['subject'], $data['body'], $data['type'], $data['name'])) {
            return false;
        }
        // Genera un nuovo ID (incrementale)
        $ids = array_column($this->templates, 'id');
        $newId = empty($ids) ? 1 : max($ids) + 1;
        $newTemplate = [
            'id' => $newId,
            'name' => $data['name'],
            'type' => $data['type'],
            'category' => $data['category'] ?? '',
            'subject' => $data['subject'],
            'body' => $data['body'],
        ];
        $this->templates[] = $newTemplate;
        return true;
    }

    public function updateTemplate(int $id, array $data): bool
    {
        foreach ($this->templates as &$template) {
            if (($template['id'] ?? null) === $id) {
                foreach (['name','type','category','subject','body'] as $field) {
                    if (isset($data[$field])) {
                        $template[$field] = $data[$field];
                    }
                }
                return true;
            }
        }
        return false;
    }

    public function deleteTemplate(int $id): bool
    {
        foreach ($this->templates as $key => $template) {
            if (($template['id'] ?? null) === $id) {
                unset($this->templates[$key]);
                $this->templates = array_values($this->templates);
                return true;
            }
        }
        return false;
    }
}
