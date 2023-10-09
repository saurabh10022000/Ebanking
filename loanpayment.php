<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(!(isset($_SESSION['customerid'])))
    header('Location:login.php?error=nologin');

if(isset($_POST["adda"]))
{
$sql="INSERT INTO loanpayment (payment_id,	customer_id,	loan_amt,	interest,	total_amt,	paid,	balance,	paid_date)
VALUES
('$_POST[payment_id]','$_POST[customer_id]','$_POST[loan_amt]','$_POST[interest]','$_POST[total_amt]','$_POST[paid]','$_POST[balance]','$_POST[paydate]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";
}

if(isset($_POST["update"]))
{
	mysql_query("UPDATE loanpayment SET payment_id='$_POST[payment_id]',	customer_id='$_POST[customer_id]',	loan_amt='$_POST[loan_amt]',	interest='$_POST[interest]',	total_amt='$_POST[total_amt]',	paid='$_POST[paid]',	balance='$_POST[balance]',	paid_date='$_POST[paydate]' WHERE payment_id='$_POST[payment_id]'");
	

$updt= mysql_affected_rows();
if($updt==1)
{
$successresult="Record updated successfully";
}
}
?>


<!DOCTYPE html>



<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">

<style type="text/css">
    .navbar-inverse
{
    background:#49c7ed;
    border-bottom-color: #142340;
}
.navbar-inverse .navbar-nav>li>a,.navbar-inverse .navbar-brand,.navbar-inverse .navbar-nav>.dropdown>a .caret
{
    color: #fff;
}
.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover, .navbar-inverse .navbar-nav>.open>a:focus,
.navbar-nav>li>.dropdown-menu
{
    background:#337ab7;
}
.nav-pills>li>a,
{
    color: #303F9F;
}

.nav>li>a:hover, .nav>li>a:focus
{
    background-color: #EEEEEE;
}




























@media only screen and (max-width: 800px) {
    
    /* Force table to not be like tables anymore */
    #no-more-tables table, 
    #no-more-tables thead, 
    #no-more-tables tbody, 
    #no-more-tables th, 
    #no-more-tables td, 
    #no-more-tables tr { 
        display: block; 
    }
 
    /* Hide table headers (but not display: none;, for accessibility) */
    #no-more-tables thead tr { 
        position: absolute;
        top: -9999px;
        left: -9999px;
    }
 
    #no-more-tables tr { border: 1px solid #ccc; }
 
    #no-more-tables td { 
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee; 
        position: relative;
        padding-left: 50%; 
        white-space: normal;
        text-align:left;
    }
 
    #no-more-tables td:before { 
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%; 
        padding-right: 10px; 
        white-space: nowrap;
        text-align:left;
        font-weight: bold;
    }
 
    /*
    Label the data
    */
    #no-more-tables td:before { content: attr(data-title); }
}
</style>

</head>
<body>
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="accountsalert.php">Dashboard</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="fa fa-user-circle"></i> Admin <span class="caret"></span></a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                        <li><a href="custprofile.php"><i class="fa fa-user-secret"></i> My Profile</a></li>
                        <li><a href="changelogpass.php"><i class="fa fa-key"></i> Change Login Password</a></li>
                        <li><a href="changetranspass.php"><i class="fa fa-key"></i> Change Transaction Password</a></li>
                    </ul>
                </li>
                <li><a href="mailinbox.php"><i class="fa fa-envelope"></i> Mail</a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>

<!-- /Header -->

<!-- Main -->

<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">

    <ul class="nav nav-pills nav-stacked" style="border-right:1px solid black">
        <!--<li class="nav-header"></li>-->
        <h5 style="padding-left: 10px;"><b>Current/Savings</b></h5>
        <li><a href="accountsummary.php">> View Account Summary</a></li>
        <li><a href="ministatements.php">> View Mini Statement</a></li>
        <li><a href="accdetails.php">> View Account Balance</a></li>
        <li><a href="stateacc.php">> View A/c Statement</a></li><br>
          <h5 style="padding-left: 10px;"><b>Beneficiary Library</b></h5>
        <li><a href="addexternalpayee.php">> Add Benefeciary</a></li>
        <li><a href="viewexternalpayee.php">> View Benefeciary</a></li>
        <h5 style="padding-left: 10px;"><b>Fund Transfer</b></h5>
        <li><a href="MakePayment.php">> Other Bank Transfer</a></li>
        <li><a href="Transactionmade.php">> View Transfer</a></li>
        <h5 style="padding-left: 10px;"><b>Pay Loans</b></h5>
        <li><a href="viewloanac.php">> View Loan Accounts</a></li>
        <li><a href="makeloanpayment.php">> Pay Loan</a></li>
        <li class="active"><a href="loanpayment.php">> View Loan Payments</a></li>
        

    </ul>
</div><!-- /span-3 -->











<div class="container">
	<div class="row">
<h2><b>&nbsp; &nbsp; View Loan Payment</b></h2><br><br>

        	<form id="form1" name="form1" method="post" action="">
 <table class="col-xs-10 table-bordered table-striped table-condensed cf" align="center">
        	    <tr>
        	      <td ><strong>Payment ID</strong></td>        	   
        	      <td ><strong>Loan ID</strong></td>
        	      <td ><strong>Amount</strong></td>
        	      <td ><strong>Paid date</strong></td>

      	      </tr>
              <?php     $result = mysql_query("select * from loanpayment where customerid='$_SESSION[customerid]'");
			  while($arrvar = mysql_fetch_array($result))
			  {
                            echo " <tr>
        	      <td>$arrvar[paymentid]</td>
				  <td>$arrvar[loanid]</td>
				   <td>$arrvar[amount]</td>
				    <td>$arrvar[paymentdate]</td>
                                    </tr>";
			  }
			  ?>
      	    </table>
        	
       	  </form></div></div>