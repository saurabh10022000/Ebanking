<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if((!(isset($_SESSION['customerid'])))&&(!(isset($_SESSION['adminid']))))
    header('Location:login.php?error=nologin');

if(isset($_GET["mailid"]))
{
	$mailres=mysql_query("SELECT * FROM mail where mailid='$_REQUEST[mailid]'");
        $mailarr=  mysql_fetch_array($mailres);
        if (!($mailarr['senderid']=='admin'))
        {
            $mailresult=  mysql_query("SELECT * FROM customers WHERE customerid='".$mailarr['senderid']."'");
            $mailresarr = mysql_fetch_array($mailresult);
            $sendername = $mailresarr['firstname']." ".$mailresarr['lastname'];
        }
        else
            $sendername='admin';
        if (!($mailarr['reciverid']=='admin'))
        {
            $mailresult=  mysql_query("SELECT * FROM customers WHERE customerid='".$mailarr['reciverid']."'");
            $mailresarr = mysql_fetch_array($mailresult);
            $receivername = $mailresarr['firstname']." ".$mailresarr['lastname'];
        }
        else
            $receivername='admin';
        if(mysql_num_rows($mailres)==0)
        {
            $mailerr="Mail Do No Exist/Mail Expired/Viewing Authorization Failed";
        }
        if (isset($_SESSION['customerid']))
        {
            if (!(($mailarr['senderid']==$_SESSION['customerid'])||($mailarr['reciverid']==$_SESSION['customerid'])))
                $mailerr="Mail Do No Exist/Mail Expired/Viewing Authorization Failed";
        }
        else
        { 
            if (!(($mailarr['senderid']=='admin')||($mailarr['reciverid']=='admin')))
                $mailerr="Mail Do No Exist/Mail Expired/Viewing Authorization Failed";
        }
}
?>

<!DOCTYPE html>

<html>

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
        <h5 style="padding-left: 10px;"><b>MAIL</b></h5>
        <li><a href="mailinbox.php">> Inbox</a></li>
        <li><a href="mailcompose.php">> Compose Mail</a></li>
        <li><a href="mailsent.php">> Sent Mail</a></li>
        

    </ul>
</div>

<div class="container-fluid">
    <h2 align="center">Read Mail</h2>
            <?php if(isset($mailerr))
                        echo"<h1>$mailerr</h1>";
                  else {?>
    <strong>From:</strong>&nbsp; <?php echo $sendername ?> <br>
        <strong>To:</strong>&nbsp; <?php echo $receivername ?><br>
    <strong>Subject:</strong>&nbsp; <?php echo $mailarr['subject'] ?><br>
    <strong>Time:</strong>&nbsp; <?php echo $mailarr['mdatetime'] ?><br>
    <strong>Message:</strong>&nbsp; <?php echo $mailarr['message'] ?><br>
    <?php 
}?>
</div>
</body>
</html>
