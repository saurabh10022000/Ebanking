<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(!($_SESSION["adminid"]))
{
		header("Location: emplogin.php");
}

$m=date("Y-m-d");
if(isset($_POST["add"]))
{
$sql="INSERT INTO loantype (loantype,prefix,maximumamt,minimumamt,interest,status)
VALUES
('$_POST[loantype]','$_POST[prefix]','$_POST[maxamt]','$_POST[minamt]','$_POST[interest]','$_POST[accstatus]')";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
$msg= "1 record added";
}
$sql2 = mysql_query("select * from loantype");
?>

<!DOCTYPE html>



<head>
	<script type="text/javascript">
function valid()
{
	if(document.form1.loantype.value=="")
	{
		alert("INVALID LOAN TYPE");
		return false;
	}
	if(document.form1.prefix.value=="")
	{
		alert("INVALID PREFIX");
		return false;
	}
	if(document.form1.maxamt.value=="")
	{
		alert("INVALID MAXIMUM AMOUNT");
		return false;
	}
	if(document.form1.minamt.value=="")
	{
		alert("INVALID MINIMUM AMOUNT");
		return false;
	}
	if(document.form1.interest.value=="")
	{
		alert("INVALID INTEREST");
		return false;
	}
	if(document.form1.status.value=="")
	{
		alert("INVALID STATUS");
		return false;
	}
	
}
</script>

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
        <li><a href="viewemp.php">> Employee</a></li>
        <li class="active"><a href="viewloantype.php">> Loan Type</a></li><br><br>
         <h5 style="padding-left: 10px;"><b>Customer</b></h5>
        <li><a href="viewcustomer.php">> Add Customer</a></li><br><br>
        
        <h5 style="padding-left: 10px;"><b>All Transactions</b></h5>
        <li><a href="viewtransaction.php">> View All Transactions</a></li>
        
        

    </ul>
</div>



<div class="container">
	<h2><b>&nbsp; &nbsp; ADD NEW LOAN TYPES</b></h2><br><br>
    <form onsubmit="return valid()" id="form1" name="form1" method="post" action="">
	<div class="form-group">
              <label class="col-md-3 control-label">Loan Type</label>
              <div class="col-md-4">
<input type="text" name="loantype" id="loantype" class="form-control" />        	       
              </div>
            </div>


<br><br><div class="form-group">
              <label class="col-md-3 control-label">Prefix</label>
              <div class="col-md-4">
              <input type="text" name="prefix" id="prefix" class="form-control" />
        	       
              </div>
            </div>

<br><br><div class="form-group">
              <label class="col-md-3 control-label">Maximum Amount</label>
              <div class="col-md-4">
<input type="text" name="maxamt" id="maxamt" class="form-control" />              </div>
            </div>

            <br><br><div class="form-group">
              <label class="col-md-3 control-label">Minimum Amount</label>
              <div class="col-md-4">
<input type="text" name="minamt" id="minamt" class="form-control" />            </div>

<br><br><div class="form-group">
              <label class="col-md-3 control-label">Interest</label>
              <div class="col-md-4">
<input type="text" name="interest" id="interest" class="form-control" />        	       
              </div>
            </div>

            <br><br><div class="form-group">
              <label class="col-md-3 control-label">Account Status</label>
              <div class="col-md-4">
<select name="accstatus" id="accstatus" class="form-control">
                    <option value="">Select</option>
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                    </select>              </div>
            </div>

<br><br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
<input type="submit" name="add" id="add" value="ADD" class="btn btn-primary" />        </form><br><br><br>
<div class="row">
         <table class="col-xs-10 table-bordered table-striped table-condensed cf">
              <tr>
        <th  scope="col">LOAN  TYPE</th>
        <th  scope="col">PREFIX</th>
        <th scope="col">MAXIMUM AMOUNT</th>
        <th  scope="col">MINIMUM AMOUNT</th>
        <th  scope="col">INTEREST</th>
        <th scope="col">STATUS</th>
      </tr>
      <?php
       while($arrayvar = mysql_fetch_array($sql2))
	  {
     echo " <tr>
        <td>&nbsp;$arrayvar[loantype]</td>
        <td>&nbsp;$arrayvar[prefix]</td>
        <td>&nbsp;$arrayvar[maximumamt]</td>
        <td>&nbsp;$arrayvar[minimumamt]</td>
        <td>&nbsp;$arrayvar[interest]</td>
        <td>&nbsp;$arrayvar[status]</td>
      </tr>
	  ";
	  }	
      ?>
    </table></div>
</div></body>