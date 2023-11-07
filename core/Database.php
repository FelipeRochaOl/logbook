<?php

namespace App\core;

use PDO;
use PDOException;

class Database
{
    private string $dbName;
    private string $dbHost;
    private string $dbUser;
    private string $dbPass;

    public function __construct()
    {
        $this->dbName = getenv('DB_DATABASE');
        $this->dbHost = getenv('DB_HOST');
        $this->dbUser = getenv('DB_USERNAME');
        $this->dbPass = getenv('DB_PASSWORD');
    }

    public function query(string $query, array $attributes = [], bool $isSelect = false): object
    {
        $pdo = $this->connect();
        try {
            $pdo->beginTransaction();
            $dbConnect = $pdo->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $dbConnect->execute($attributes);
            $success = $pdo->commit();
            if ($isSelect) {
                $data = $dbConnect->fetchAll(PDO::FETCH_CLASS);
                if (!$data) return $this->response();
                return $this->response($success, $data);
            }
            return $this->response($success);
        } catch (PDOException $exception) {
            $pdo->rollBack();
            return $this->response(false, [], $exception->getMessage());
        }
    }

    private function connect(): PDO
    {
        return new PDO($this->getDsn(), $this->dbUser, $this->dbPass);
    }

    private function getDsn(): string
    {
        return "mysql:dbname=$this->dbName;host=$this->dbHost";
    }

    private function response(bool $success = false, array $data = [], string $error = ''): object
    {
        return (object) [
            "success" => $success,
            "data" => $data,
            "error" => $error
        ];
    }
}