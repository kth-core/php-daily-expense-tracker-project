<?php
session_start();
error_reporting(0);
include('confs/config.php');

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = mysqli_query($conn, "SELECT id FROM tblusers WHERE email = '$email' && password = '$password'");
    $result = mysqli_fetch_array($sql);
    if($result > 0) {
        $_SESSION['detsuid'] = $result['id'];
        header("location: dashboard.php");
    } else {
        $msg = "Invalid Details";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Expense Tracker - Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="row">
        <h2 align="center">Daily Expense Tracker</h2>
        <hr>
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form role="form" method="post" name="login">
                        <p style="font-size: 16px; color: red;" align="center">
                            <?php if($msg) echo $msg; ?>
                        </p>
                        <fieldset>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="E-mail" autofocus required>
                            </div>
                            <a href="forgot-password.php">Forgot Password?</a>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <!-- <input type="submit" class="btn btn-primary" name="login" value="Login"> -->
                                <button type="submit" class="btn btn-primary" name="login">Login</button>
                                <div class="pull-right">
                                    <span><a href="register.php" class="btn btn-primary">Register</a></span>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>