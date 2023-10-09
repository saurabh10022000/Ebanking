<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(isset($_POST['pay']))
{
$payto = $_POST['payto'];
$payamt = $_POST['pay_amt'];
$payacno= $_POST['ac_no'];
$result1 = mysql_query("select * from registered_payee WHERE slno='$payto'");
if(mysql_num_rows($result1) == 1)
{$arrpayment = mysql_fetch_array($result1); $payeetype='ext';}
else
{
    $result1= mysql_query("SELECT * FROM customers WHERE customerid='$_POST[payto]'");
    $arrpayment1 = mysql_fetch_array($result1);
    $payeetype='int';
    $arrpayment['payeename'] = $arrpayment1['firstname']." ".$arrpayment1['lastname'];
    $arrpayment['bankname'] = "Bank of Gotham City";
    $res1=mysql_query("SELECT * FROM accounts WHERE customerid='$_POST[payto]'");
    $arrpayment4 = mysql_fetch_array($res1);
    $arrpayment['accounttype'] = $arrpayment4['accounttype'];
    $arrpayment['accountnumber'] = $arrpayment4['accno'];
    $arrpayment['ifsccode'] = $arrpayment1['ifsccode'];
}
}
$dt = date("Y-m-d h:i:s");
$custid=  mysql_real_escape_string($_SESSION['customerid']);
$resultpass = mysql_query("select * from customers WHERE customerid='$custid'");
$arrpayment1 = mysql_fetch_array($resultpass);

if(isset($_POST["pay2"]))
{
        if (!($_POST['trpass'] == $_POST['conftrpass']))
        {
            $passerr = "Password Mismatch";
            header('Location:Makepayment.php?error=passwordmismatch');
            exit(0);
        }
	else if($_POST['trpass'] == $arrpayment1['transpassword'])
	{
            $rr = mysql_query("SELECT * FROM accounts WHERE customerid ='".$_SESSION['customerid']."'");
            $rrarr=  mysql_fetch_array($rr);
		$amount=$_POST['payamt'];
                if ($amount>$rrarr['accountbalance'])
                {
                    header('Location:Makepayment.php?error=insufficientbalance');
                    exit(0);
                }
                
                if (isset($_POST['payeetype']))
                {
                    
                    if ($_POST['payeetype'] == 'int')
                    {     mysql_query("UPDATE accounts SET accountbalance = accountbalance+$amount WHERE customerid ='".$_POST[payto]."'") or die(mysql_error ());
                    }
                }
                $sql="INSERT INTO transactions (paymentdate,payeeid,receiveid,amount,paymentstat) VALUES ('$dt','$_SESSION[customerid]','$_POST[payto]','$amount','active')";
                
                mysql_query("UPDATE accounts SET accountbalance = accountbalance-$amount WHERE customerid ='".$_SESSION['customerid']."'");
		
				if (!mysql_query($sql))
				  {
				  die('Error: ' . mysql_error());
				  }
				if(mysql_affected_rows() == 1)
				  {
					$successresult = "Transaction successfull";
					header("Location: Makepayment3.php");
				  }
				else
				  {
					  $successresult = "Failed to transfer";
				  }
	}
	else
	{
	$passerr = "Invalic password entered!!!<br/> Transaction Failed </b>";
        header('Location:MakePayment.php?error='.$passerr);
        exit(0);
	}		  
}

$custid=  mysql_real_escape_string($_SESSION['customerid']);
$acc= mysql_query("select * from accounts where customer_id='$custid'");

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
        <li  class="active"><a href="MakePayment.php">> Other Bank Transfer</a></li>
        <li><a href="Transactionmade.php">> View Transfer</a></li>
        <h5 style="padding-left: 10px;"><b>Pay Loans</b></h5>
        <li><a href="viewloanac.php">> View Loan Accounts</a></li>
        <li><a href="makeloanpayment.php">> Pay Loan</a></li>
        <li><a href="loanpayment.php">> View Loan Payments</a></li>
        

    </ul>
</div>

<div class="container">
<div class="row">
    <form method="post" action="MakePayment2.php">
        <h3 align="center">&nbsp;Make payment to <?php if(isset($arrpayment['payeename'])) echo $arrpayment['payeename']; ?></h3><br>
 <table class="col-xs-10 table-bordered table-striped table-condensed cf" align="center">
    <?php
                if(isset($passerr))
                {
                    ?>
                <tr>
                  <td colspan="2">&nbsp;<?php echo $passerr; ?></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                  <td><strong>Pay to</strong></td>
                  <td>
                  <?php
                echo "<b>&nbsp;Payee Name : </b>".$arrpayment['payeename'];
                echo "<br><b>&nbsp;Account No. : </b>".$arrpayment['accountnumber'];
                echo "<br><b>&nbsp;Account type : </b>".$arrpayment['accounttype'];
                echo "<br><b>&nbsp;Bank name : </b>".$arrpayment['bankname'];
                echo "<br><b>&nbsp;IFSC Code : </b>".$arrpayment['ifsccode'];
    
                  ?>
                  </td>
<input type="hidden" class="form-control" name="payto" value="<?php echo $payto; ?>"  />
<input type="hidden" name="payamt" class="form-control" value="<?php echo $payamt; ?>"  />
<input type="hidden" name="payeeid" class="form-control" value="<?php echo $payacno; ?>"  />
<input type="hidden" name="payeetype" class="form-control" value="<?php echo $payeetype; ?>"  />
                  </td>
                </tr>
                <tr>
                  <td><strong>Payment amount</strong></td>
                  <td><?php echo number_format($payamt,2); ?></td>
                </tr>
                
                <tr>
                  <td><strong>Enter Transaction Password</strong></td>
                  <td><input name="trpass" type="password" id="trpass" size="35" class="form-control"/></td>
                </tr>
                <tr>
                  <td><strong>Confirm Password</strong></td>
                  <td><input name="conftrpass" type="password" id="conftrpass" size="35" class="form-control"/></td>
                </tr>
                <tr>
                  <td colspan="2"><div align="right">
                    <input type="submit" name="pay2" id="pay2" value="Pay" class="btn btn-primary"/>
                    <input name="button" type="button" class="btn btn-primary" onclick="<?php echo "window.location.href='accountalerts.php'"; ?>" value="Cancel" alt="Pay Now" />
                  </div></td>
 </tr>
</table></form>
      </div></div></body>



      





















      