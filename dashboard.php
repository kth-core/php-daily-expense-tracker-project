<?php

session_start();
error_reporting(0);
include('confs/config.php');

if(strlen($_SESSION['detsuid'] == 0)):
    header("location: logout.php");
else:

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Expense Tracker - Dashboard</title>
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
            <li class="active">Dashboard</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <?php
                    #Today's Expense
                        $userid = $_SESSION['detsuid'];
                        $tdate = date('Y-m-d');
                        $query = mysqli_query($conn, "SELECT sum(cost) AS todayexpense FROM tblexpenses WHERE expense_date='$tdate' && user_id='$userid'");
                        $result = mysqli_fetch_array($query);
                        $sum_today_expense = $result['todayexpense'];
                    ?>
                    <h4>Today's Expense</h4>
                    <div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $sum_today_expense; ?>">
                        <span class="percent">
                            <?php if($sum_today_expense=="") {
                                echo "0";
                                }else { echo $sum_today_expense; }    
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <?php 
                    #Yesterday's Expense
                        $userid=$_SESSION['detsuid'];
                        $ydate=date('Y-m-d',strtotime("-1 days"));
                        $query1=mysqli_query($conn,"SELECT sum(cost)  AS yesterdayexpense FROM tblexpenses WHERE expense_date='$ydate' && user_id='$userid'");
                        $result1=mysqli_fetch_array($query1);
                        $sum_yesterday_expense=$result1['yesterdayexpense'];
                    ?>       
                    <h4>Yesterday's Expense</h4>
                    <div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_yesterday_expense;?>" >
                        <span class="percent">
                            <?php if($sum_yesterday_expense==""){
                                echo "0";
                                } else {
                                    echo $sum_yesterday_expense;
                                }
                        
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <?php
                        #Weekly Expense
                        $userid=$_SESSION['detsuid'];
                        $pastdate=  date("Y-m-d", strtotime("-1 week")); 
                        $crrntdte=date("Y-m-d");
                        $query2=mysqli_query($conn,"SELECT sum(cost) AS weeklyexpense FROM tblexpenses WHERE (expense_date BETWEEN '$pastdate' AND '$crrntdte') && user_id='$userid'");
                        $result2=mysqli_fetch_array($query2);
                        $sum_weekly_expense=$result2['weeklyexpense'];
                    ?>
                                       
                    <h4>Last 7day's Expense</h4>
                    <div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $sum_weekly_expense;?>">
                        <span class="percent">
                            <?php if($sum_weekly_expense==""){
                                echo "0";
                                } else {
                                    echo $sum_weekly_expense;
                                }
                            ?>
                        </span>
                    </div>                   
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <?php
                    #Monthly Expense
                        $userid=$_SESSION['detsuid'];
                        $monthdate=  date("Y-m-d", strtotime("-1 month")); 
                        $crrntdte=date("Y-m-d");
                        $query3=mysqli_query($conn,"SELECT sum(cost) AS monthlyexpense FROM tblexpenses WHERE (expense_date BETWEEN '$monthdate' AND '$crrntdte') && user_id='$userid'");
                        $result3=mysqli_fetch_array($query3);
                        $sum_monthly_expense=$result3['monthlyexpense'];
                    ?>
                                       
                    <h4>Monthly Expenses</h4>
                    <div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_monthly_expense;?>" >
                        <span class="percent">
                            <?php if($sum_monthly_expense==""){
                                echo "0";
                                } else {
                                    echo $sum_monthly_expense;
                                }
                   
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    <div class="row">

        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                <?php
                #Yearly Expense
                    $userid=$_SESSION['detsuid'];
                    $cyear= date("Y");
                    $query4=mysqli_query($conn,"SELECT sum(cost) AS yearlyexpense FROM tblexpenses WHERE year(expense_date)='$cyear' && user_id='$userid'");
                    $result4=mysqli_fetch_array($query4);
                    $sum_yearly_expense=$result4['yearlyexpense'];
                ?>
                    
                    <h4>Current Year Expenses</h4>
                    <div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_yearly_expense;?>" >
                        <span class="percent">
                            <?php if($sum_yearly_expense==""){
                                echo "0";
                                } else {
                                    echo $sum_yearly_expense;
                                }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <?php
                    #Total Expense
                        $userid=$_SESSION['detsuid'];
                        $query5=mysqli_query($conn,"SELECT sum(cost) AS totalexpense FROM tblexpenses WHERE user_id='$userid'");
                        $result5=mysqli_fetch_array($query5);
                        $sum_total_expense=$result5['totalexpense'];
                    ?>
                    <h4>Total Expenses</h4>
                    <div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_total_expense;?>" >
                        <span class="percent">
                            <?php if($sum_total_expense==""){
                                echo "0";
                                } else {
                                    echo $sum_total_expense;
                                }
                                
                            ?>
                        </span>
                    </div>
                </div>
            </div>             
        </div>

    </div>

</div>    

    <?php include('confs/footer.php'); ?>
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