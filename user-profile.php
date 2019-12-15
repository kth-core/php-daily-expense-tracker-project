<?php 
session_start();
error_reporting(0);
include('confs/config.php');

if(strlen($_SESSION['detsuid']==0)):
    header('location:logout.php');
else:
    if(isset($_POST['submit'])) {
        $userid = $_SESSION['detsuid'];
        $name = $_POST['Name'];
        $mbno = $_POST['contactnumber'];
        $query = mysqli_query($conn, "UPDATE tblusers SET name = '$name', mobile_number = '$mbno' WHERE id = '$userid'");
        if($query) {
            $msg = "User Profile has been updated.";
        }else {
            $msg = "Something Went Wrong. Please try again.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Expense Tracker || User Profile</title>
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
                    <li class="active">User Profile</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Profile</div>
                        <div class="panel-body">
                            <p style="font-size:medium;" align="center">
                                <?php if($msg): ?>
                                    <div class="alert alert-info"><?php echo $msg; ?></div>
                                <?php endif; ?>
                            </p>
                            <div class="col-md-12">
                                <?php
                                    $userid = $_SESSION['detsuid'];
                                    $result = mysqli_query($conn, "SELECT * FROM tblusers WHERE id = '$userid'");
                                    while($row = mysqli_fetch_array($result)):
                                ?>
                                        <form role="form" method="post">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="Name" value="<?php echo $row['name']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control" name="contactnumber" value="<?php echo $row['mobile_number'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Registeration Date</label>
                                                    <input type="text" class="form-control" name="regdate" value="<?php echo $row['reg_date']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                                </div>
                                            </fieldset>
                                        </form>
                                    <?php endwhile; ?>    
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
</body>
</html>

<?php endif; ?>