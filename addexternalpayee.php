<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(!(isset($_SESSION['customerid'])))
    header('Location:login.php?error=nologin');

if(isset($_POST["adda3"]))
{
	$sql="INSERT INTO registered_payee
	(slno, payeename,accountnumber,accounttype,bankname,ifsccode)
	VALUES
	('','$_POST[p_name3]','$_POST[ac_no3]','$_POST[ac_type3]','$_POST[bank_name3]','$_POST[code3]')";
	
	if (!mysql_query($sql))
	  {
	  die('Error: ' . mysql_error());
	  }
	$successresult = "1 Record added";
}

if(isset($_POST["update3"]))
{ 					
	mysql_query("UPDATE registered_payee SET payeename='$_POST[p_name3]',accountnumber='$_POST[ac_no3]',accounttype='$_POST[ac_type3]',bankname='$_POST[bank_name3]',ifsccode='$_POST[code3]' WHERE slno='$_POST[pid3]'");
	$updt= mysql_affected_rows();
	if($updt==1)
	{
	$successresult="Record updated successfully";
	}	

}

if(isset($_POST["delete3"]))
{
	mysql_query("DELETE FROM registered_payee WHERE sl_no='$_POST[pid3]'");
	$updt= mysql_affected_rows();
	if($updt==1)
	{
	$successresult="Record deleted successfully";
	}	
}

if(isset($_POST["btncancel"]))
{
	unset($_GET["payeeid"]);
}

$result = mysql_query("select * from registered_payee WHERE customerid='$_SESSION[customerid]'");

if(isset($_GET[payeeid]))        	
{
$result1 = mysql_query("select * from registered_payee WHERE sl_no='$_GET[payeeid]'");
$arrvar1 = mysql_fetch_array($result1);
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




<script type="text/javascript">
function validateForm()
{
        
	var x	=	document.forms["form1"]["p_name3"].value;
	var y	=	document.forms["form1"]["ac_no3"].value;
	var z	=	document.forms["form1"]["code3"].value;
  if (x==null || x=="")
  {
  alert("Payee name must be filled out");
  return false;
  }
  if (y==null || y=="")
  {
  alert("Account number must be filled out");
  return false;
  }
  if (z==null || z=="")
  {
  alert("Ifsc code must be filled out");
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
        <li class="active"><a href="addexternalpayee.php">> Add Benefeciary</a></li>
        <li><a href="viewexternalpayee.php">> View Benefeciary</a></li>
        <h5 style="padding-left: 10px;"><b>Fund Transfer</b></h5>
        <li><a href="MakePayment.php">> Other Bank Transfer</a></li>
        <li><a href="Transactionmade.php">> View Transfer</a></li>
        <h5 style="padding-left: 10px;"><b>Pay Loans</b></h5>
        <li><a href="viewloanac.php">> View Loan Accounts</a></li>
        <li><a href="makeloanpayment.php">> Pay Loan</a></li>
        <li><a href="loanpayment.php">> View Loan Payments</a></li>
        

    </ul>
</div>
<div class="container">
<form method="POST" action="" onsubmit="return validateForm()" >

	<?php
if(isset($_POST['adda3']) || isset($_POST['update3']))
{
	?>

	<h4><b><u>&nbsp; &nbsp; Beneficiary Successfully added..</u></b></h4><br>
<p align="center"><div class="form-group">
              <label class="col-md-3 control-label">Beneficiary Name</label>
              <div class="col-md-4">
              <strong> <?php echo $_POST[p_name3]; ?> </strong>
        	       
              </div>
            </div>

<br><br>

<div class="form-group">
              <label class="col-md-3 control-label">Bank Name</label>
              <div class="col-md-4">
              <strong> <?php
				 echo  $_POST[bank_name3];
					?>      
</strong>
        	       
              </div>
            </div>

<br><br>
            <div class="form-group">
              <label class="col-md-3 control-label">Account Number</label>
              <div class="col-md-4">
              <strong>  <?php echo $_POST[ac_no3]; ?></strong>
        	       
              </div>
            </div>


<br><br>
<div class="form-group">
              <label class="col-md-3 control-label">Account Type</label>
              <div class="col-md-4">
              <strong>  <?php echo $_POST[ac_type3]; ?></strong>
        	       
              </div>
            </div>

<br><br>
        <div class="form-group">
              <label class="col-md-3 control-label">IFSC Code</label>
              <div class="col-md-4">
              <strong>  <?php echo $_POST[code3]; ?></strong>
        	       
              </div>
            </div>
<br>


</p>
<?php
}
else if(isset($_POST['delete3']))
{
?>

<strong><?php echo $successresult; ?></strong>

<?php
}
else
{
?>








<h4><b>&nbsp; &nbsp; ADD BENEFECIARY</b></h4><br>
<p align="center">
<div class="form-group">
              <label class="col-md-3 control-label" for="email">Beneficiary Name</label>
              <div class="col-md-4">
                <input class="form-control" name="pid3" type="hidden" id="pid3" value="<?php echo $arrvar1[sl_no]; ?>" />
        	        <input name="p_name3" class="form-control" type="text" id="p_name3" size="35" value="<?php echo $arrvar1['payee_name']; ?>" />
              </div>
            </div>
         <br><br><br>
 <div class="form-group">
              <label class="col-md-3 control-label">Bank Name</label>
              <div class="col-md-4">
                <select name="bank_name3" id="bank_name3" class="form-control">
        	          <option value="">Select Bank name</option>
					  <?php
					  $arr = array("Canara Bank","HDFC Bank","Axis Bank","Federal Bank");
					foreach($arr as $value)
					{
						if($arrvar1[bank_name] == $value)
						{	
						echo "<option value='$value' selected>$value</option>";	
						}
						else
						{
						echo "<option value='$value'>$value</option>";	
						}
					}
					?>
      	          </select>
              </div>
            </div>

<br><br>
 <div class="form-group">
              <label class="col-md-3 control-label" for="email">Account Number</label>
              <div class="col-md-4">
                <input name="ac_no3" class="form-control" type="text" id="ac_no3" size="35"  value="<?php echo $arrvar1['account_no']; ?>" />
              </div>
            </div>
            <br><br>

 <div class="form-group">
              <label class="col-md-3 control-label" for="email">Account Type</label>
              <div class="col-md-4">
                 



                 <?php            
					$arr = array("SAVINGS ACCOUNT","CURRENT ACCOUNT");
					echo "<select name='ac_type3' id='ac_type3' class='form-control'>";
						foreach($arr as $value) 
						{
							if($arrvar1[acc_type] == $value)
							{	
							echo "<option value='$value' selected>$value</option>";
							}
							else
							{
							echo "<option value='$value'>$value</option>";	
							}
						}
					?>
                         </select>

              </div>
            </div>
<br><br>

    <div class="form-group">
              <label class="col-md-3 control-label">IFSC Code</label>
              <div class="col-md-4">
<input name="code3" class="form-control"	 type="text" id="code3" size="35"  value="<?php echo $arrvar1['ifsc_code']; ?>"  />              </div>
            </div>


<br><br>
             <?php
if(isset($_GET['payeeid']))        	
{
?>
        	        <input type="submit" name="update3" id="update3" value="update" class="btn btn-primary" />
        	        <input type="submit" name="btncancel3" id="btncancel3" value="Cancel" class="btn btn-primary" />
        	        <input type="submit" name="delete3" id="delete3" value="Delete" class="btn btn-primary" />
        	        <?php
}
else
{
	?>
        	        <input type="submit" name="adda3" id="adda3" value="Add Bank Account" class="btn btn-primary" />
        	        <?php
}
?>

<?php
}
?>

       	  </form>