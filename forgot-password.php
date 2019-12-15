<?php 
session_start();
error_reporting(0);
include('confs/config.php');

if(isset($_POST['submit'])):
    $contactno = $_POST['contactno'];
    $email = $_POST['email'];
    $query = mysqli_query($conn, "SELECT id FROM tblusers WHERE email='$email' && mobile_number='$contactno'");
    $ret = mysqli_fetch_array($query);
    if($ret > 0) {
        $_SESSION['contactno'] = $contactno;
        $_SESSION['email'] = $email;
        header('location:reset-password.php');
    }else {
        $msg = "Invalid Details. Please try again.";
    }
endif;    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Expense Tracker || Forgot password</title>
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
                <div class="panel-heading">Log in</div>
                <div class="panel-body">
                <p style="font-size:16px; color:red" align="center"> <?php if($msg)
                    {echo $msg;} ?> </p>

                    <form role="form" method="post">
                        <fieldset>
                            <div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Mobile Number" name="contactno" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-danger">Reset</button>
                                <div class="pull-right">
                                    <span><a href="index.php" class="btn btn-primary">login</a></span>
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