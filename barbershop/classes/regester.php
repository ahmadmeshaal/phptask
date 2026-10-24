<?php

class regester extends Dbh
{
    protected function setUser($name, $password, $email){
        $stmt = $this->connect()->prepare('INSERT INTO users (name, password,email) VALUES (?, ?, ?);');

        $hash = password_hash($password, PASSWORD_DEFAULT);
      if (!$stmt-> execute(array($name, $hash, $email))) {
            $stmt=null;
            exit();

        }

$stmt=null;
    }

  protected function checkUser($email)
{
    $stmt = $this->connect()->prepare(
        'SELECT id FROM users WHERE email = ?'
    );

    $stmt->execute([$email]);

    return $stmt->rowCount() > 0;
}

  
}
