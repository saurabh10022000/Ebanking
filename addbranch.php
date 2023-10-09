<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(!($_SESSION["adminid"]))
{
		header("Location: emplogin.php");
}
$m=date("Y-m-d");
if(isset($_POST["addbranch"]))
{
$sql="INSERT INTO branch (ifsccode, branchname,city,branchaddress,state,country) VALUES ('$_POST[ifsccode]','$_POST[branchname]','$_POST[city]','$_POST[branchaddress]','$_POST[country]','$_POST[state]')";

if (!mysql_query($sql))
  {
  die('Error: ' . mysql_error());
  }
else $mess = "1 record added";
}
?>





<!DOCTYPE html>



<head>









	<script type="text/javascript">
function valid()
{
	if(document.form1.ifsccode.value=="")
	{
		alert("Invalid ifsccode");
		return false;
	}
	if(document.form1.branchname.value=="")
	{
		alert("Invalid branchname");
		return false;
	}
	
     if(document.form1.city.value=="")
	  {
		alert("Invalid city");
		return false;
	  }
	 
}

  function isNumberKey(evt)
      {

         var charCode = (evt.which) ? evt.which : event.keyCode
		//alert(charCode);
         if (charCode > 65 && charCode < 91 )
      	 {              
		 return true;
	 }
	 else if (charCode > 96 && charCode < 122 )
      	 {
		 return true;
	 }
	 else
	 {
                             alert("should be alphabet");
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
        <li class="active"><a href="viewbranch.php">> Branch</a></li>
        <li><a href="addaccountmaster.php">> Account Types</a></li>
        <li><a href="viewemp.php">> Employee</a></li>
        <li><a href="viewloantype.php">> Loan Type</a></li><br><br>
         <h5 style="padding-left: 10px;"><b>Customer</b></h5>
        <li><a href="viewcustomer.php">> Add Customer</a></li>
        <br><br>
        <h5 style="padding-left: 10px;"><b>All Transactions</b></h5>
        <li><a href="viewtransaction.php">> View All Transactions</a></li>
        
        

    </ul>
</div>





<div class="container">
         <form onsubmit="return valid()" id="form1" name="form1" method="post" action="">


<?php if(isset($mess)) echo "<h1>$mess</h1>"; ?>


<h4><b>&nbsp; &nbsp; Add Branch</b></h4><br>
<div class="form-group">
              <label class="col-md-3 control-label">IFSC Code</label>
              <div class="col-md-4">
              <input type="text" name="ifsccode" id="ifsccode" class="form-control" />
        	       
              </div>
            </div>

<br><br>

<div class="form-group">
              <label class="col-md-3 control-label">Branch Name</label>
              <div class="col-md-4">
              <input type="text" name="branchname" id="branchname"   onKeyPress="return isNumberKey(event)" class="form-control" />
        	       
              </div>
            </div>

<br><br>
            <div class="form-group">
              <label class="col-md-3 control-label">City</label>
              <div class="col-md-4">
             <input type="text" name="city" id="city"   onKeyPress="return isNumberKey(event)" class="form-control" />
        	       
              </div>
            </div>


<br><br>
<div class="form-group">
              <label class="col-md-3 control-label">Branch Address</label>
              <div class="col-md-4">
              <textarea name="branchaddress" id="branchaddress" cols="45" rows="2" class="form-control"></textarea>
        	       
              </div>
            </div>

<br><br><br>
        <div class="form-group">
              <label class="col-md-3 control-label">Country</label>
              <div class="col-md-4">
              <select name="country" id="country" class="form-control">
            <option value="USA">USA</option>
            <option value="ENGLAND">ENGLAND</option>
            <option value="INDIA">INDIA</option>
          </select>
              </div>
            </div>
<br><br>


 <div class="form-group">
              <label class="col-md-3 control-label">State</label>
              <div class="col-md-4">
              <select name="state" id="state" class="form-control">
            <option value="MAHARASTRA">MAHARASTRA</option>
            <option value="WEST BENGAL">WEST BENGAL</option>
            <option value="KARNATAKA">KARNATAKA</option>
            <option value="MICHIGAN">HARYANA</option>
            <option value="EDGBASTON">HIMACHAL PRADESH</option>
          </select>
              </div>
            </div>

<br><br>
&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <input type="submit" name="addbranch" id="addbranch" value="ADD BRANCH" class="btn btn-primary" />

</form>