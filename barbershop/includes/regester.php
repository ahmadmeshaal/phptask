<?php

if (isset($_POST["submit"])) {


    //GRAPPING THE DATA FROM FORM
    $name = $_POST["name"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $email = $_POST["email"];


    //Instantiate signupContr class
    include "../classes/Database.php";
    include "../classes/regester.php";
    include "../classes/regester-contr.php";

    $regester = new RegesterContr($name, $password, $confirmPassword,$email);

    $regester->regesterUser();

}
