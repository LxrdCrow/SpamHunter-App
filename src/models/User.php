<?php

namespace App\Models;

use PDO;
use App\DB\Database;

class User
{
    private int $id;
    private string $name;
    private string $email;

    public function __construct(int $id, string $name, string $email)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->email = $email;
    }

    // Getter
    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }

    // Static CRUD methods

    public static function getAll(): array
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM users");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new User($row['id'], $row['name'], $row['email']), $results);
    }

    public static function findById(int $id): ?User
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new User($row['id'], $row['name'], $row['email']) : null;
    }

    public static function create(array $data): ?User
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $success = $stmt->execute([$data['name'], $data['email']]);

        if ($success) {
            $id = $db->lastInsertId();
            return new User($id, $data['name'], $data['email']);
        }

        return null;
    }

    public static function update(int $id, array $data): ?User
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$data['name'], $data['email'], $id]);

        return self::findById($id);
    }

    public static function delete(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}


