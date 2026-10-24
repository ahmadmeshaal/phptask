<?php
class RegesterContr extends regester
{
    private $name;
    private $password;
    private $confirmPassword;
    private $email;
    public function __construct($name, $password, $confirmPassword, $email)
    {
        $this->name = $name;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->email = $email;
    }

    private function emptyInput()
    {
        $result = false;
        if (empty($this->name) || empty($this->password) || empty($this->confirmPassword) || empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


    private function invalidEmail()
    {
        $result = false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {

            $result = true;
        }
        return $result;
    }


    private function passwordMatch()
    {
        $result = false;
        if ($this->password !== $this->confirmPassword) {
            $result = false;
        } else {
            $result = true;
        }


        return $result;
    }

    private function emailTakenCheck()
    {
        $result = false;
        if (!$this->checkUser($this->email)) {
            $result = false;
        } else {
            $result = true;
        }


        return $result;
    }

    public function regesterUser()
    {
        if ($this->emptyInput() == false) {
            header("location:../public/register.php?error=emptyinput");
            exit();
        }
        if ($this->invalidEmail() == false) {
            header("location:../public/register.php?error=email");
            exit();
        }
        if ($this->passwordMatch() == false) {
            header("location:../public/register.php?error=pwderror");
            exit();
        }
        if ($this->emailTakenCheck() == true) {
            header("location:../public/register.php?error=emailtaken");
            exit();
        }
        $this->setUser($this->name, $this->password, $this->email);
        header("location:../public/login.php?signup=success");
        exit();
    }
}
