<?php 
session_start();
error_reporting(0);
include('confs/config.php');

if(isset($_POST['submit'])):
    $contactno = $_SESSION['contactno'];
    $email = $_SESSION['email'];
    $password = md5($_POST['newpassword']);

    $query = mysqli_query($conn,"UPDATE tblusers SET password='$password' WHERE email='$email' && mobile_number='$contactno'");
    if($query) {
        session_destroy();
        header('location:index.php');
    }
endif;    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Expense Tracker || Reset Password</title>
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
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    <form role="form" method="post" name="changepassword" onsubmit="return checkpass();">
                        <fieldset>
                            <div class="form-group">
                                <input type="password" class="form-control" name="newpassword" placeholder="Type your new password" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirmpassword" placeholder="Repeat your new password" required>
                            </div>
                            <div class="checkbox">
                                <button type="submit" class="btn btn-primary" name="submit">Confirm</button>
                                <div class="pull-right">
                                    <span><a href="index.php" class="btn btn-primary">Cancel</a></span>
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
            if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value) {
                alert('Confirm password field does not match to new password.');
                document.changepassword.confirmpassword.focus();
                return false;
            }else {
                return true;
            }
        }
    </script>
</body>
</html>