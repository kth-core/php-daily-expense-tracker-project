<?php 
session_start();
error_reporting(0);
include('confs/config.php');
if(strlen($_SESSION['detsuid']==0)):
    header('location:logout.php');
else:
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Expense Tracker || Yearwise Expense Report</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    
    <?php include('confs/header.php'); ?>
    <?php include('confs/sidebar.php'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><em class="fa fa-home">&nbsp;</em></a></li>
                <li class="active">Yearwise Expense Report</li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Yearwise Expense Reports</div>
                    <div class="panel-body">
                        
                        <div class="col-md-12">
                            <form role="form" method="post" action="expense-yearwise-report-detail.php">
                                <fieldset>
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" class="form-control" name="fromdate" required>
                                    </div>
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" class="form-control" name="todate" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
</body>
</html>

<?php endif; ?>