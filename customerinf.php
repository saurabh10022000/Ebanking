<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(!($_SESSION["adminid"]))
{
		header("Location:login.php");
}
if(isset($_REQUEST['Del']))
{
    $query = "DELETE FROM customers WHERE customerid = '$_REQUEST[custid]'";
    mysql_query($query);
    $query = "DELETE FROM accounts WHERE customerid = '$_REQUEST[custid]'";
    mysql_query($query);
    header("Location:viewcustomer.php?suc=1");
    exit(0);
}
$results = mysql_query("SELECT * FROM customers where customerid='$_GET[custid]'");
$custid=$_GET['custid'];
while($arrow = mysql_fetch_array($results))
{
	$custname = $arrow[firstname]." ".$arrow['lastname'];
	$ifsccode=$arrow[ifsccode];
	$loginid=$arrow[loginid];
	$accstatus=$arrow[accstatus];
	$city=$arrow[city];
    $state=$arrow[state];
	$country=$arrow[country];
    $accopendate=$arrow[accopendate];
    $lastlogin=$arrow[lastlogin];
}
$resultsd = mysql_query("SELECT * FROM accounts where customerid='$_GET[custid]'");
mysql_num_rows($resultsd);
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
        <li><a href="viewemp.php">> Employee</a></li>
        <li><a href="viewloantype.php">> Loan Type</a></li><br><br>
         <h5 style="padding-left: 10px;"><b>Customer</b></h5>
        <li class="active"><a href="viewcustomer.php">> Add Customer</a></li><br><br>
        
        <h5 style="padding-left: 10px;"><b>All Transactions</b></h5>
        <li><a href="viewtransaction.php">> View All Transactions</a></li>
        
        

    </ul>
</div>
<div class="container">
    <div class="row">

 <form id="form2" name="form2" method="post" action="">
    <blockquote>
         <table class="col-xs-10 table-bordered table-striped table-condensed cf">
        <tr>
          <th  scope="col">
           
             CUSTOMER NAME

          </th>
          <td ><?php echo $custname; ?></td>
        </tr>
        <tr>
          <td><strong>
            <label for="branch">BRANCH</label>
          </strong></td>
          <td><?php echo $ifsccode; ?></td>
        </tr>
        <tr>
          <td><strong>
          <label for="loginid"> LOGIN ID</label>
          </strong></td>
          <td><?php echo $loginid; ?></td>
        </tr>
        <tr>
          <td><strong>
          <label for="accstatus">ACCOUNT STATUS</label>
          </strong></td>
          <td><?php echo $accstatus; ?></td>
        </tr>
        <tr>
          <td><strong>
          <label for="city">CITY</label>
          </strong></td>
          <td><?php echo $city; ?></td>
        </tr>
        <tr>
          <td><strong>
          <label for="state"> STATE</label>
          </strong></td>
          <td><?php echo $state; ?></td>
        </tr>
        <tr>
          <td><strong>
          <label for="country"> COUNTRY</label>
          </strong></td>
          <td><?php echo $country; ?></td>
        </tr>
        <tr>
          <td><strong>
          <label for="accopendate"> ACCOUNT OPEN DATE</label>
          </strong></td>
          <td><?php echo $accopendate; ?></td>
        </tr>
        <tr>
          <td><strong>
          <label for="lastlogin">LAST LOGIN</label>
          </strong></td>
          <td><?php echo $lastlogin; ?></td>
        </tr>
      </table>
  
        
        <br/><br/><br/>

    </blockquote>
         <table class="col-xs-10 table-bordered table-striped table-condensed cf">
      <tr>
        <th colspan="5" scope="col"><strong>CUSTOMER ACCOUNTS</strong></th>
        </tr>
      <tr>
        <th  scope="col"><strong>ACCOUNT NO</strong></th>
        <th scope="col"><strong>STATUS</strong></th>
        <th  scope="col"><strong>OPEN DATE</strong></th>
        <th  scope="col"><strong>ACCOUNT TYPE</strong></th>
        <th  scope="col"><strong>BALANCE</strong></th>
      </tr>
      <?php
     while($arrow=mysql_fetch_array($resultsd))
     {
     ?>
        <tr>
        <td>&nbsp;<?php echo $arrow[accno];?></td>
        <td>&nbsp;<?php echo $arrow[accstatus];?></td>
        <td>&nbsp;<?php echo $arrow[accopendate];?></td>
        <td>&nbsp;<?php echo $arrow[accounttype];?></td>
        <td>&nbsp;<?php echo $arrow[accountbalance];?></td>
      </tr>
     <?php
     }
     ?> <input type="hidden" class="btn btn-primary" value="<?php echo $custid ?>" name="custid" >
      <br><br>
</table>
     <input type="submit" value="Delete Customer" name="Del"  class="btn btn-primary" >
    <p>&nbsp;</p>
  </form>

</div></div>