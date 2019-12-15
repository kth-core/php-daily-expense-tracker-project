<?php 
session_start();
error_reporting(0);
include('confs/config.php');
if(strlen($_SESSION['detsuid']==0)):
    header("location: logout.php");
else:
    if(isset($_POST['submit'])) {
        $userid = $_SESSION['detsuid'];
        $exdate = $_POST['expense_date'];
        $item = $_POST['expense_item'];
        $itemcost = $_POST['cost'];
        $query = mysqli_query($conn, "INSERT INTO tblexpenses(user_id, expense_date, expense_item, cost) VALUES ('$userid', '$exdate', '$item', '$itemcost')");
        if($query) {
            echo "<script>alert('Expense has been added');</script>";
            header("location: manage-expense.php");
        }else { echo "<script>alert('Something went wrong. Please try again!');</script>"; }
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Expense Tracker || Add Expense</title>
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
                <li class="active">Expense</li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Expense Adding</div>
                    <div class="panel-body">
                        
                        <div class="col-md-12">
                            <form role="form" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Date of Expense</label>
                                        <input type="date" class="form-control" name="expense_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Item</label>
                                        <input type="text" class="form-control" name="expense_item" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Cost of Item</label>
                                        <input type="text" class="form-control" name="cost" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="submit">Add</button>
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