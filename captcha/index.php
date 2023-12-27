<?php
session_start();

$validEmail = "user@example.com";
$validPassword = "password123";

$emailError = ""; 
$passwordError = "";
$captchaError = "";
$enteredEmail = "";
$enteredPassword = "";
$enteredCaptcha = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredEmail = $_POST['email'];
    $enteredPassword = $_POST['password'];
    $enteredCaptcha = $_POST['captcha'];

    if ($enteredEmail !== $validEmail) {
        $emailError = "Invalid email!";
    }

    if ($enteredPassword !== $validPassword) {
        $passwordError = "Invalid password!";
    }

    if ($enteredCaptcha !== $_SESSION['captcha']) {
        $captchaError = "Incorrect CAPTCHA!";
    }

    if (empty($emailError) && empty($passwordError) && empty($captchaError)) {
        $_SESSION['captcha'] = '';
        header("location: dashboard.php");
        exit;
    }
}
var_dump($_SESSION['captcha']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" required>
                                <span class="text-danger"><?php echo isset($emailError) ? $emailError : ""; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" required>
                                <span class="text-danger"><?php echo isset($passwordError) ? $passwordError : ""; ?></span>
                            </div>
                            <div class="form-group">
                                <label>CAPTCHA:</label><br>
                                <img src="./captcha.php" alt="CAPTCHA Image"><br>
                                <input type="text" name="captcha" class="form-control mt-2" required>
                                <span class="text-danger"><?php echo isset($captchaError) ?  $captchaError : ""; ?></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
