<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(!($_SESSION["adminid"]))
{
		header("Location:login.php");
}
$emparray = mysql_query("select * from employees");
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
            <a class="navbar-brand" href="admindashboard.php">Dashboard</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="fa fa-user-circle"></i> Admin <span class="caret"></span></a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                       
                        <li><a href="changepass.php"><i class="fa fa-key"></i> Change Login Password</a></li>
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
        <!--<li class="nav-header"></li>--><br><br>
        <h5 style="padding-left: 10px;"><b>Settings</b></h5>
        <li><a href="viewbranch.php">> Branch</a></li>
        <li><a href="addaccountmaster.php">> Account Types</a></li>
        <li class="active"><a href="viewemp.php">> Employee</a></li>
        <li><a href="viewloantype.php">> Loan Type</a></li><br><br>
         <h5 style="padding-left: 10px;"><b>Customer</b></h5>
        <li><a href="viewcustomer.php">> Add Customer</a></li><br><br>
        
        <h5 style="padding-left: 10px;"><b>All Transactions</b></h5>
        <li><a href="viewtransaction.php">> View All Transactions</a></li>
        
        

    </ul>
</div>

<h2><b>&nbsp; &nbsp; EMPLOYEES DETAILS</b></h2><br><br>
 <table class="col-xs-10 table-bordered table-striped table-condensed cf">
    	
      <tr>
        <th scope="col">EMPLOYEE ID</th>
        <th scope="col">EMP NAME</th>
        <th scope="col">EMAIL ID</th>
        <th scope="col">CONTACT NO</th>
        <th scope="col">JOIN DATE</th>
      </tr>
      <?php	
 while($employee = mysql_fetch_array($emparray))
	  {
echo "
      <tr>
        <td>&nbsp;$employee[empid]</td>
        <td>&nbsp;$employee[employee_name]</td>
        <td>&nbsp;$employee[emailid]</td>
        <td>&nbsp;$employee[contactno]</td>
        <td>&nbsp;$employee[createdat]</td>
      </tr>";
	  }
	  ?>


	  <tr>
      <th colspan="6" scope="col" align="center"><a href="addemployee.php">   <input type="submit" id="submit" value="Add Employee" class="btn btn-primary" />
</a></th>
    </tr>
    </table>