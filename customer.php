<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(!($_SESSION["adminid"]))
{
		header("Location: emplogin.php");
}

$m=date("Y-m-d");
if(isset($_POST["button"]))
{
    $sql="SELECT * FROM customers WHERE loginid='".$_POST['loginid']."'";
    if(mysql_num_rows(mysql_query($sql)) > 0)
    {
        $logmsg="LOGIN ID ALREADY EXIST";
    }
    else
    {
    $sql="INSERT INTO customers (ifsccode,firstname, lastname,loginid,accpassword,transpassword,accstatus,country,state,city,accopendate) VALUES ('$_POST[brname]','$_POST[firstname]','$_POST[lastname]','$_POST[loginid]','$_POST[accountpassword]','$_POST[transactionpassword]','$_POST[accstatus]','$_POST[country]','$_POST[state]','$_POST[city]','$m')";
    mysql_query($sql);
    $ree=mysql_query("SELECT * FROM customers WHERE loginid='$_POST[loginid]'");
    $arra=  mysql_fetch_array($ree);
    $cusid=$arra['customerid'];
    $sql="INSERT INTO accounts(accno,customerid,accstatus,accopendate,accounttype,accountbalance) VALUES ('$_POST[acc]','$cusid','$_POST[accstatus]','$m','$_POST[acctype]','$_POST[balance]')";
    if (!mysql_query($sql))
    {
    die('Error: ' . mysql_error());
    }
    $logmsg ="1 CUSTOMER RECORD ADDED SUCCESSFULLY.....";
    }
}
$resq = mysql_query("select * from branch");
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



<script language="javascript">

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

<script type="text/javascript">
function valid()
{
    if(document.form1.brname.value=="")
    {
        alert("INVALID BRANCH NAME");
        return false;
    }
    if(document.form1.firstname.value=="")
    {
        alert("INVALID FIRST NAME");
        return false;
    }
    if(document.form1.lastname.value=="")
    {
        alert("INVALID LAST NAME");
        return false;
    }
    if(document.form1.loginid.value=="")
    {
        alert("INVALID LOGIN ID");
        return false;
    }
    if(document.form1.accountpassword.value=="")
    {
        alert("INVALID ACCOUNT PASSWORD");
        return false;
    }
    if(document.form1.confirmpassword.value=="")
    {
        alert("INVALID CONFIRM PASSWORD");
        return false;
    }
        
        if(!(document.form1.confirmpassword.value == document.form1.accountpassword.value))
    {
        alert("ACCOUNT PASSWORD MISMATCH");
        return false;
    }
        
    if(document.form1.transactionpassword.value=="")
    {
        alert("INVALID TRANSACTION PASSWORD");
        return false;
    }
        if(!(document.form1.transactionpassword.value == document.form1.confirmtransactionpassword.value))
    {
        alert("TRANSACTION PASSWORD MISMATCH");
        return false;
    }
    if(document.form1.accstatus.value=="")
    {
        alert("INVALID ACCOUNT STATUS");
        return false;
    }
    if(document.form1.country.value=="")
    {
        alert("INVALID COUNTRY");
        return false;
    }
    if(document.form1.state.value=="")
    {
        alert("INVALID STATE");
        return false;
    }
    if(document.form1.city.value=="")
    {
        alert("INVALID CITY");
        return false;
    }
}
</script>







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
<br><br><br><br>
This dashboard only available to admin and employees not to the customers


        
        

    </ul>
</div>





<div class="container">
        <form onsubmit="return valid()" id="form1" name="form1" method="post" action="">


    <p>&nbsp;<?php echo $logmsg; ?></p>


<h4><b>&nbsp; &nbsp; Add Customers</b></h4><br>
<div class="form-group">
              <label class="col-md-3 control-label">Branch Name</label>
              <div class="col-md-4">
<select name="brname" id="brname" class="form-control">
                <?php
                    while($rta = mysql_fetch_array($resq) )
                        {
                            echo "<option value='$rta[ifsccode]'>$rta[branchname]</value>";
                        }
                ?> </select>                   
              </div>
            </div>

<br>

<div class="form-group">
              <label class="col-md-3 control-label">First Name</label>
              <div class="col-md-4">
<input type="text" name="firstname"  id="firstname" class="form-control" />                   
              </div>
            </div>

<br>
            <div class="form-group">
              <label class="col-md-3 control-label">Last Name</label>
              <div class="col-md-4">
<input type="text" name="lastname" id="lastname" class="form-control" />                   
              </div>
            </div>


<br>
<div class="form-group">
              <label class="col-md-3 control-label">Login ID</label>
              <div class="col-md-4">
<input type="text" name="loginid" id="loginid" class="form-control" />                   
              </div>
            </div>

<br>
        <div class="form-group">
              <label class="col-md-3 control-label">Account Password</label>
              <div class="col-md-4">
             <input type="password" name="accountpassword" id="accountpassword" class="form-control" />
              </div>
            </div>
<br>


 <div class="form-group">
              <label class="col-md-3 control-label">Transaction Password</label>
              <div class="col-md-4">
              <input type="password" name="transactionpassword" id="transactionpassword" class="form-control" />
              </div>
            </div>

<br>
<div class="form-group">
              <label class="col-md-3 control-label">Confirm Transaction Password</label>
              <div class="col-md-4">
<input type="password" name="confirmtransactionpassword" id="confirmtransactionpassword" class="form-control" />                  
              </div>
            </div>

<br>
<div class="form-group">
              <label class="col-md-3 control-label">Account Status</label>
              <div class="col-md-4">
<select name="accstatus" id="accstatus" class="form-control">
                    <option value="">Select</option>
                    <option value="active">Active</option>
                    <option value="inactive">In-active</option>
                </select>                  
              </div>
            </div>

<br>
<div class="form-group">
              <label class="col-md-3 control-label">Country</label>
              <div class="col-md-4">
<select name="country" id="country" class="form-control">
                    <option value="">Select</option>
                    <option value="INDIA">INDIA</option>
                    <option value="USA">USA</option>
                    <option value="ENGLAND">ENGLAND</option>
                </select>              
              </div>
            </div>

<br><div class="form-group">
              <label class="col-md-3 control-label">State</label>
              <div class="col-md-4">
<select name="state" id="state" class="form-control">
                    <option value="KARNATAKA">KARNATAKA</option>
                    <option value="KERALA">KERALA</option>
                    <option value="WEST BENGAL">WEST BENGAL</option>
                    <option value="HARYANA">HARYANA</option>
                    <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                </select>                 
              </div>
            </div>

<br><div class="form-group">
              <label class="col-md-3 control-label">City</label>
              <div class="col-md-4">
<select name="accstatus" id="accstatus" class="form-control">
                    <option value="">Select</option>
                    <option value="active">Active</option>
                    <option value="inactive">In-active</option>
                </select>                  
              </div>
            </div>

<br>

<div class="form-group">
              <label class="col-md-3 control-label">Account Number</label>
              <div class="col-md-4">
<input type="number" name="acc" class="form-control" />                 
              </div>
            </div>

<br>

<div class="form-group">
              <label class="col-md-3 control-label">Account Type</label>
              <div class="col-md-4">
<select name="acctype" class="form-control">
                    <?php $re = mysql_query("SELECT * FROM accountmaster");
                           while ($a=  mysql_fetch_array($re))
                           {
                                echo "<option value='$a[accounttype]'>$a[accounttype]</option>";
                           }?>
                    
                </select> 
            </div>

<br><br>
<div class="form-group">
              <label class="col-md-3 control-label">Opening Balance</label>
              <div class="col-md-4">
               <input type="number" name="balance" id="balance" class="form-control" />
              </div>
            </div>

<br>
<br>

&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="submit" name="button" id="button" value="Add Customers" class="btn btn-primary" />
</form>