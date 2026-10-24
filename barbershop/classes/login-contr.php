<?php

class LoginContr extends Login
{
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = trim($email);
        $this->password = $password;
    }

    public function authenticate()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $user = $this->getUserByEmail($this->email);

        if (!$user || (int) $user['is_active'] !== 1) {
            return false;
        }

        if (!password_verify($this->password, $user['password'])) {
            return false;
        }

        return $user;
    }
}