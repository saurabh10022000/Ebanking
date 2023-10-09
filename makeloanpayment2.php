<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(!(isset($_SESSION['customerid'])))
    header('Location:login.php?error=nologin');

$dt = date("Y-m-d h:i:s");
if(isset($_POST["pay2"]))
{
$custid=  mysql_real_escape_string($_SESSION['customerid']);
$resul = mysql_query("select * from customers WHERE customerid='$custid'");
$arrpayment1 = mysql_fetch_array($resul);
if(!($_POST['trpass'] == $arrpayment1['transpassword']))
{
    $successresult = "Invalid Transaction Password";
}
else{
$rr = mysql_query("SELECT * FROM accounts WHERE customerid ='".$_SESSION['customerid']."'");
$rrarr=  mysql_fetch_array($rr);
$amount=$_POST[amt];
if ($amount>$rrarr['accountbalance'])
{
    $successresult = "Insufficient Fund!! Payment Failed";
}
else{
$sql="INSERT INTO loanpayment (customerid,paymentid,loanid,amount,paymentdate) VALUES ('$_SESSION[customerid]','','$_POST[paytoo]','$_POST[amt]','$dt')";
$sq="UPDATE accounts SET accountbalance = accountbalance -".$_POST[amt]." WHERE customerid='$_SESSION[customerid]'";
if ((!mysql_query($sql)))
  {
  die('Error: ' . mysql_error());
  print_r($sql);
  }
  if(mysql_affected_rows() == 1)
  {
	$successresult = "Transaction successfull";
  }
  else
  {
	  $successresult = "Failed to transfer";
  }
  if (!(mysql_query($sq)))
  {
      die("Error : ".mysql_error());
      print_r($sq);
  }
  if(mysql_affected_rows() == 1)
  {
	$successresult = "Transaction successfull";
  }
  else
  {
	  $successresult = "Failed to transfer";
  }
}
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
</style>






<script>
function validate()
{
var x=document.forms["form1"]["conftrpass"].value;
var y=document.forms["form1"]["trpass"].value;

if (x==null || x=="")
  {
  alert("Confirm Password must be filled out");
  return false;
  }
  if (y==null || y=="")
  {
  alert("Password must be filled out");
  return false;
  }
  if(!(x==y))
      {
          alert("Password Mismatch");
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
        <li class="active"><a href="makeloanpayment.php">> Pay Loan</a></li>
        <li><a href="loanpayment.php">> View Loan Payments</a></li>
        

    </ul>
</div>
<div class="container">
<div class="row">
<?php if(isset($successresult))
            echo "<h1>".$successresult."</h1>"; ?>
       <form id="form1" name="form1" method="post" action="" onsubmit="return validate()">
            <?php
      if(isset($_POST[pay]))
      { ?>
                                
    
        <h3 align="center">&nbsp;Make Loan Payment</h3><br>
 <table class="col-xs-10 table-bordered table-striped table-condensed cf" align="center">
   
                <tr>
                  <td><strong>Loan Account Information</strong></td>
                  <td>
                  <?php 
            $result3 = mysql_query("select * from loan WHERE loanid='$_POST[payto]'");
                                        $arrpayment3 = mysql_fetch_array($result3);
                                        $qq="SELECT * FROM loanpayment WHERE loanid='$_POST[payto]'";
                                        $x = mysql_query($qq) or die(mysql_error());
                                        $aamt=0;
                                        for($i=0;$i<mysql_num_rows($x);$i++)
                                        {
                                        $arrpayment2 = mysql_fetch_array($x);
                                        $aamt = $aamt+$arrpayment2[amount];
                                        }
                                    
                                        $balance = $arrpayment3[loanamt] + ($arrpayment3[interest]*$arrpayment3[loanamt]/100) - $aamt;
                                        echo "<b>&nbsp;Loan No. : </b>".$arrpayment3[loanid];
                                        echo "<br><b>&nbsp;Loan type. : </b>".  $arrpayment3[loantype];
        echo "<br><b>&nbsp;Loan amount : </b>".$arrpayment3[loanamt];
        echo "<br><b>&nbsp;Interest : </b>".$arrpayment3[interest]. "%";
        echo "<br><b>&nbsp;Balance : </b>".$balance;
        echo "<br><b>&nbsp;Created at : </b>".$arrpayment3[startdate];
  
                  ?>
<input type="hidden" name="paytoo" value="<?php echo $_POST[payto]; ?>" class="form-control"  />
                <input type="hidden" name="amt" value="<?php echo $_POST[pay_amt]; ?>" class="form-control" />


                </td>


</tr>




<tr>
                  <td><strong>Loan amount</strong></td>
                  <td>&nbsp;<?php echo number_format($_POST[pay_amt],2); ?></td>
                </tr>
                <tr>
                  <td><strong>Enter Transaction Password</strong></td>
                  <td><input name="trpass" type="password" id="trpass" size="35" class="form-control" /></td>
                </tr>
                <tr>
                  <td><strong>Confirm Password</strong></td>
                  <td><input name="conftrpass" type="password" id="conftrpass" size="35" class="form-control" /></td>
                </tr>
                <tr>
                  <td colspan="2"><div align="right">
                    <input type="submit" name="pay2" id="pay2" value="Pay" class="btn btn-primary" />
                    <input name="button" type="button" onclick="<?php echo "window.location.href='payloans.php'";  ?>" value="Cancel" alt="Pay Now"  class="btn btn-primary"/>
                  </div></td>
                </tr>
              </table>
              
              <?php
      }
      ?>
    </table>
       </form>
      </div></div>

























      