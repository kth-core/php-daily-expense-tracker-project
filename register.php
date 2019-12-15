<?php 

session_start();
error_reporting(0);
include('confs/config.php');

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mbno = $_POST['phone'];
    $password = md5($_POST['password']);

    $ret = mysqli_query($conn, "SELECT email from tblusers WHERE email = '$email'");
    $result = mysqli_fetch_array($ret);
    if($result > 0) {
        $msg = "This e-mail is associated with another account";
    }else {
        $sql = mysqli_query($conn, "INSERT INTO tblusers (name, email, mobile_number, password) VALUES ('$name', '$email', '$mbno', '$password')");
        if($sql) {
            $msg = "You have successfully registered";
        }else {
            $msg = "Something went wrong. Please try again!";
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Expense Tracker - Registeration</title>
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
                <div class="panel-heading">Sign Up</div>
                <div class="panel-body">
                    <form role="form" method="post" name="register" onsubmit="return checkpass();">
                        <p style="font-size: 16px; color: red;" align="center">
                            <?php if($msg) echo $msg; ?>
                        </p>

                        <fieldset>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" autofocus required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Your E-mail" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Your Moblie Number" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Type Password" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="repeatpassword" placeholder="Repeat Password" required>
                            </div>
                            <div class="checkbox">
                                <!-- <input type="submit" class="btn btn-primary" name="submit" value="Register">     -->
                                <button type="submit" class="btn btn-primary" name="submit">Register</button>
                                <div class="pull-right">
                                    <span><a href="index.php" class="btn btn-primary">Login</a></span>
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
    <script>
        function checkpass() {
            if(document.register.password.value!=document.register.repeatpassword.value) {
                alert('Repeat password field does not match to password!');
                document.register.repeatpassword.focus();
                return false;
            }else return true;
        } 
    </script>
</body>
</html>
