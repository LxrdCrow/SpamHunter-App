<?php

namespace App\Services;

use App\Helpers\EmailTemplateHelper;
use App\Helpers\StringHelper;

class PhishingEmailService
{
    protected EmailTemplateHelper $emailTemplateHelper;

    public function __construct(?EmailTemplateHelper $emailTemplateHelper = null)
    {
        $this->emailTemplateHelper = $emailTemplateHelper ?? new EmailTemplateHelper();
    }

    public function generate(): array
    {
        $template = $this->emailTemplateHelper->getTemplate('phishing');
        $placeholders = [
            '{{name}}' => StringHelper::randomName(),
            '{{link}}' => StringHelper::randomPhishingUrl(),
            '{{company}}' => StringHelper::randomCompany()
        ];

        $subject = str_replace(array_keys($placeholders), array_values($placeholders), $template['subject']);
        $body = str_replace(array_keys($placeholders), array_values($placeholders), $template['body']);

        $log = "[PHISHING] " . date('Y-m-d H:i:s') . " - Subject: $subject";
        file_put_contents(__DIR__ . '/../../log.txt', $log . PHP_EOL, FILE_APPEND | LOCK_EX);

        return [
            'subject' => $subject,
            'body' => $body
        ];
    }

    public function send(array $emailData): bool
    {
        if (empty($emailData['to']) || empty($emailData['subject']) || empty($emailData['body'])) {
            return false;
        }
        // In assenza di mail server, puoi loggare in un file:
        $log = "[SEND] " . date('Y-m-d H:i:s') . " - To: {$emailData['to']} Subject: {$emailData['subject']}";
        file_put_contents(__DIR__ . '/../../log.txt', $log . PHP_EOL, FILE_APPEND | LOCK_EX);

        // Se mail() configurata, puoi usarla:
        // return mail($emailData['to'], $emailData['subject'], $emailData['body']);
        return true;
    }

    public function save(array $emailData): bool
    {
        if (empty($emailData['to']) || empty($emailData['subject']) || empty($emailData['body'])) {
            return false;
        }
        $filePath = __DIR__ . '/../../data/phishing_emails.json';
        $emails = [];
        if (file_exists($filePath)) {
            $emails = json_decode(file_get_contents($filePath), true) ?: [];
        }
        // Aggiungi un ID univoco
        $emailData['id'] = uniqid();
        $emailData['created_at'] = date('Y-m-d H:i:s');
        $emails[] = $emailData;
        $written = file_put_contents($filePath, json_encode($emails, JSON_PRETTY_PRINT), LOCK_EX);
        return $written !== false;
    }

    public function getAll(): array
    {
        $filePath = __DIR__ . '/../../data/phishing_emails.json';
        if (!file_exists($filePath)) {
            return [];
        }
        $emails = json_decode(file_get_contents($filePath), true);
        return is_array($emails) ? $emails : [];
    }

    public function deleteAll(): bool
    {
        $filePath = __DIR__ . '/../../data/phishing_emails.json';
        if (!file_exists($filePath)) {
            return true;
        }
        return unlink($filePath);
    }
}

