<?php

namespace App\core;

use Exception;

class Users
{
    private Database $DB;
    private array $users;
    private string $id;
    private string $name;
    private string $email;
    private string $password;
    private string $avatar;

    public function __construct()
    {
        $this->DB = new Database();
        $this->setCategories();
        $this->setAvatar('avatar.png');
    }

    private function setCategories(): void
    {
        $response = $this->DB->query('SELECT * FROM users ORDER BY name ASC', [], true);
        if (!$response->success) {
            $this->users = [];
            return;
        }
        $this->users = $response->data;
    }

    /**
     * @throws Exception
     */
    public function setID(string $id): void
    {
        if (!is_numeric($id)) {
            throw new Exception('ID is not a number');
        }
        $this->id = (int) $id;
    }

    public function setName(string $name): void
    {
        $this->name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email is invalid');
        }
        $this->email = $email;
    }

    public function setPassword(string $pass): void
    {
        $secretKey = '8uRhAeH89naXfFXKGOEj';
        $password = hash_hmac('sha256', $pass, $secretKey);
        $this->password = $password;
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = htmlspecialchars($avatar, ENT_QUOTES, 'UTF-8');;
    }

    public function getAll(): array
    {
        return $this->users;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getOneById(string $id): object
    {
        foreach ($this->users as $user) {
            if ($id == $user->id ) {
                return $user;
            }
        }
        return (object)[];
    }

    /**
     * @throws Exception
     */
    public function create(): object
    {
        $exists = $this->findByEmail();
        if ($exists->success) {
            throw new Exception('Email is exists in database');
        }
        return $this->DB->query(
            'INSERT INTO blog.users (name, email, password, avatar) VALUES(:name, :email, :password, :avatar)',
            ['name' => $this->name, 'email' => $this->email, 'password' => $this->password, 'avatar' => $this->avatar]
        );
    }

    /**
     * @throws Exception
     */
    public function findByEmail(): object
    {
        if (empty($this->email)) {
            throw new Exception('Email is not defined');
        }
        return $this->DB->query(
            'SELECT * FROM blog.users WHERE email = :email', ['email' => $this->email], true
        );
    }

    /**
     * @throws Exception
     */
    public function findById(): object
    {
        if (empty($this->id)) {
            throw new Exception('ID is not defined');
        }
        return $this->DB->query(
            'SELECT * FROM blog.users WHERE id = :id', ['id' => $this->id], true
        );
    }

    /**
     * @throws Exception
     */
    public function edit(): object
    {
        $exists = $this->findById();
        if (!$exists->success) {
            throw new Exception('ID is not defined');
        }
        return $this->DB->query(
            'UPDATE blog.users SET name = :name, email = :email, password = :password, avatar = :avatar WHERE id = :id',
            ['name' => $this->name, 'id' => $this->id, 'email' => $this->email, 'password' => $this->password, 'avatar' => $this->avatar]
        );
    }

    /**
     * @throws Exception
     */
    public function delete(): object
    {
        $exists = $this->findById();
        if (!$exists->success) {
            throw new Exception('ID is not defined');
        }
        return $this->DB->query(
            'DELETE FROM blog.users WHERE id = :id',
            ['id' => $this->id]
        );
    }

    public function validate(array $values): bool
    {
        if (empty($values)) return false;
        return array_key_exists('name', $values)
            && array_key_exists('email', $values)
            && array_key_exists('password', $values)
            && array_key_exists('avatar', $values);
    }
}