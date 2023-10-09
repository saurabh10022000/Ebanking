<?php
session_start();
include("dbconnection.php");

if(!(isset($_SESSION['customerid'])))
    header('Location:login.php?error=nologin');
?>


<!DOCTYPE html>



<head>





<link rel="stylesheet" href="style-screen.css" type="text/css" media="screen">
<link rel="stylesheet" href="style-print.css" type="text/css" media="print">










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








@media print
{
.noprint {display:none;}
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
<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
<div class="noprint">
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
        <li  class="active"><a href="Transactionmade.php">> View Transfer</a></li>
        <h5 style="padding-left: 10px;"><b>Pay Loans</b></h5>
        <li><a href="viewloanac.php">> View Loan Accounts</a></li>
        <li><a href="makeloanpayment.php">> Pay Loan</a></li>
        <li><a href="loanpayment.php">> View Loan Payments</a></li>
        

    </ul></div>
</div>






<h2> Transactions made</h2>
        	   <table class="col-xs-10 table-bordered table-striped table-condensed cf">

        	    <tr>
        	      <td><strong>Transaction No.</strong></td>
                  <td><strong>Transaction date</strong></td>
                  <td><strong>Payee ID</strong></td>
                  <td><strong>Receiver ID</strong></td>
        	      <td><strong>Amount</strong></td>
            	  <td><strong>Status</strong></td>
      	      </tr>
<?php
$query="SELECT * FROM transactions where (payeeid=".$_SESSION['customerid'].") or (receiveid=".$_SESSION['customerid'].") ORDER BY  paymentdate DESC";
$rectrans=mysql_query($query);
while($recs = mysql_fetch_array($rectrans))
{	
$transid=$recs['transactionid'];
$transdate=$recs['paymentdate'];
$payeeid=$recs['payeeid'];
$receiveid=$recs['receiveid'];
    $amount=$recs['amount'];
    $status=$recs['paymentstat'];	
		echo "<tr>
        	      <td>$transid</td>
        	      <td>$transdate</td>
        	      <td>$payeeid</td>
        	      <td>$receiveid</td>
                      <td>$amount</td>
        	      <td>$status</td></tr>";
}
?>

<tr><td colspan="6" align="left">      <div class="noprint">  	  <input type="button" class="btn btn-primary" value="Print Transaction detail" onClick="window.print()">   </div></td></tr>

      	    </table><br><br>
