<?php

namespace App\core;

use DateInterval;
use DateTime;
use Exception;

class Session
{
    private Users $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    /**
     * @throws Exception
     */
    public function login(string $email, string $password): void
    {
        try {
            $this->users->setEmail($email);
            $this->users->setPassword($password);
            $response = $this->users->findByEmail();
            if (!$response->success || !count($response->data)) {
                throw new Exception();
            }
            if (!hash_equals($response->data[0]->password, $this->users->getPassword())) {
                throw new Exception();
            }
            $_SESSION['isLogged'] = true;
            $now = new DateTime();
            $expiresIn = $now->add(new DateInterval('PT8H'));
            $_SESSION['expireIn'] = $expiresIn;
            $user = $response->data[0];
            $_SESSION['name'] = $user->name;
            $_SESSION['email'] = $user->email;
            $_SESSION['avatar'] = $user->avatar;
        } catch (Exception) {
            $this->logout();
            throw new Exception('Email or password is invalid');
        }
    }

    public function logout(): void
    {
        if (!empty($_SESSION) && $_SESSION['isLogged']) {
            session_destroy();
        }
    }

    public function sessionValid(): bool
    {
        if (empty($_SESSION['isLogged']) || empty($_SESSION['expireIn'])) {
            return false;
        }
        $now = new DateTime();
        $diff = $now->diff($_SESSION['expireIn']);
        return $diff->h <= 8;
    }

    public function validate(array $values): bool
    {
        if (empty($values)) return false;
        return array_key_exists('email', $values)
            && array_key_exists('password', $values);
    }
}
