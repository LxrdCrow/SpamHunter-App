<?php

namespace App\DB;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                $host = $_ENV['DB_HOST'] ?? 'localhost';
                $db   = $_ENV['DB_NAME'] ?? 'my_database';
                $user = $_ENV['DB_USER'] ?? 'root';
                $pass = $_ENV['DB_PASS'] ?? '';
                $charset = 'utf8mb4';

                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

                self::$connection = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
