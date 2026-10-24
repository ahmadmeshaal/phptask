<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    section class="index-login">
    <div class="wrapper">
        <div class="index-login-signup">
            <h4>SIGN UP</h4>
            <p>Don't have an account yet? Sign up here !< /p>
                    <form action="includes/signup.inc.php" method="post">
                        <input type="text" name="name" placeholder="Username">
                        <input type="password" name="password" placeholder="Password">
                        <input type="password" name="confirm_password" placeholder="Repeat Password">
                        <input type="text" name="email" placeholder="E-mail">
                        <br>
                        <button type="submit" name="submit">SIGN UP</button>
                    </form>
        </div>
</body>

</html>