<?php

class Login extends Dbh
{
    protected function getUserByEmail($email)
    {
        $stmt = $this->connect()->prepare(
            'SELECT id, name, email, password, role, is_active
             FROM users
             WHERE email = ?'
        );

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}