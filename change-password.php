<?php 
session_start();
error_reporting(0);
include('confs/config.php');
if(strlen($_SESSION['detsuid']==0)):
    header('location: logout.php');
else:
    if(isset($_POST['submit'])):
        $userid = $_SESSION['detsuid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $query = mysqli_query($conn,"SELECT id FROM tblusers WHERE id='$userid' and  password='$cpassword'");
        $row = mysqli_fetch_array($query);
        if($row > 0){
            mysqli_query($conn,"UPDATE tblusers SET password='$newpassword' WHERE id='$userid'");
            $msg= "Your password successully changed."; 
        }else {
            $msg="Your current password is wrong.";
        }
    endif;
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Daily Expense Tracker || Change Password</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    </head>
    <body>
        <?php include('confs/header.php') ?>
        <?php include('confs/sidebar.php') ?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#"><em class="fa fa-home"></em></a></li>
                    <li class="active">Change Password</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Change Password</div>
                        <div class="panel-body">
                            <p style="font-size:medium;" align="center">
                                <?php if($msg): ?>
                                    <div class="alert alert-info"><?php echo $msg; ?></div>
                                <?php endif; ?>
                            </p>
                            <div class="col-md-12">
                                <form role="form" method="post" name="changepassword" onsubmit="return checkpass();">
                                    <fieldset>
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input type="password" class="form-control" name="currentpassword" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" name="newpassword" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="confirmpassword" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="submit">Change</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>       
                        </div>
                    </div>
                </div>
                <?php include('confs/footer.php'); ?>
            </div>
        </div>

        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/chart.min.js"></script>
        <script src="js/chart-data.js"></script>
        <script src="js/easypiechart.js"></script>
        <script src="js/easypiechart-data.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/custom.js"></script>
        <script>
            function checkpass() {
                if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value) {
                    alert('Confirm Password field does not match to New Password!');
                    document.changepassword.confirmpassword.focus();
                    return false;
                }else {
                    return true;
                }
            }
        </script>
    </body>
    </html>

<?php endif; ?>