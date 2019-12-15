<?php 
session_start();
error_reporting(0);
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
    <title>Daily Expense Tracker || Monthwise Expense Report Details</title>
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
                <li class="active">Monthwise Expense Report</li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Monthwise Expense Report Details</div>
                    <div class="panel-body">
                        
                        <div class="col-md-12">
                            <?php 
                                $fdate = $_POST['fromdate']; 
                                $tdate = $_POST['todate'];
                            ?>
                            <h5 align="center" style="color:slateblue">Monthwise Expense Report From <?php echo $fdate; ?> to <?php echo $tdate; ?></h5>
                            <hr>
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Month-Year</th>
                                        <th>Expense Amount</th>
                                    </tr>
                                </thead>
                                <?php 
                                    $userid = $_SESSION['detsuid'];
                                    $result = mysqli_query($conn, "SELECT month(expense_date) AS rptmonth, year(expense_date) AS rptyear, sum(cost) AS totalmonth 
                                    FROM `tblexpenses` WHERE (expense_date BETWEEN '$fdate' AND '$tdate') && (user_id = '$userid') 
                                    GROUP BY month(expense_date), year(expense_date)");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($result)):
                                ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['rptmonth']."-".$row['rptyear'] ?></td>
                                    <td><?php echo $total_expense_list = $row['totalmonth'] ?></td>
                                </tr>
                                <?php 
                                    $totalsexpense += $total_expense_list;
                                    $cnt = $cnt + 1;
                                    endwhile;
                                ?>
                                <tr>
                                    <th colspan="2" style="text-align:center;">Grand Total</th>
                                    <td><?php echo $totalsexpense; ?></td>
                                </tr>
                            </table>
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
?>