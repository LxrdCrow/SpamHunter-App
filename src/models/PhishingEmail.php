<?php

namespace App\Models;

class PhishingEmail
{
    public $id;
    public $email;
    public $subject;
    public $body;
    public $created_at;
    public $updated_at;

    public function __construct($id, $email, $subject, $body, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->subject = $subject;
        $this->body = $body;
        $this->created_at = $created_at ?? date('Y-m-d H:i:s');
        $this->updated_at = $updated_at ?? date('Y-m-d H:i:s');
    }
}

class PhishingEmailManager
{
    private $emails = [];

    public function addEmail(PhishingEmail $email)
    {
        $this->emails[] = $email;
    }

    public function getEmails()
    {
        return $this->emails;
    }

    public function findEmailById($id)
    {
        foreach ($this->emails as $email) {
            if ($email->id === $id) {
                return $email;
            }
        }
        return null;
    }

    public function updateEmail($id, $newData)
    {
        foreach ($this->emails as $key => $email) {
            if ($email->id === $id) {
                foreach ($newData as $field => $value) {
                    if (property_exists($email, $field)) {
                        $email->$field = $value;
                    }
                }
                $email->updated_at = date('Y-m-d H:i:s');
                return $email;
            }
        }
        return null;
    }

    public function deleteEmail($id)
    {
        foreach ($this->emails as $key => $email) {
            if ($email->id === $id) {
                unset($this->emails[$key]);
                $this->emails = array_values($this->emails); 
                return true;
            }
        }
        return false;
    }

    public function toArray(): array
    {
        return array_map(function ($email) {
            return [
                'id' => $email->id,
                'email' => $email->email,
                'subject' => $email->subject,
                'body' => $email->body,
                'created_at' => $email->created_at,
                'updated_at' => $email->updated_at,
            ];
        }, $this->emails);
    }
}
