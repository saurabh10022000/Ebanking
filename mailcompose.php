<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if((!(isset($_SESSION['customerid'])))&&(!(isset($_SESSION['adminid']))))
    header('Location:login.php?error=nologin');

$datetime=date("Y-m-d h:i:s");
if(isset($_POST["sendmsg"]))
{
    if(isset($_SESSION['customerid']))
    {
        $sql="INSERT INTO  mail(subject,message,mdatetime,senderid,reciverid) VALUES('$_POST[subject]','$_POST[message]','$datetime','$_SESSION[customerid]','$_POST[sendto]')";
    }
    
    if(isset($_SESSION['adminid']))
    {
        $sql="INSERT INTO  mail(subject,message,mdatetime,senderid,reciverid) VALUES('$_POST[subject]','$_POST[message]','$datetime','$_SESSION[adminid]','$_POST[sendto]')";
    }

if (!mysql_query($sql))
  {
  die('Error: ' . mysql_error());
  }
$msgsuccess = mysql_affected_rows();
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

<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
    <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">
          <form class="form-horizontal" action="" method="post">
          <fieldset>
            <legend class="text-center">Compose Mail</legend>
    
            <!-- Name input-->
             <div class="form-group">
              <label class="col-md-3 control-label" for="name">Send To</label>
              <div class="col-md-9">

         <?php if($msgsuccess == 1) echo "<h5> Message sent successfully...</h5>";
                   else
                   ?>    
                       <select name="sendto" id="sendto"  class="form-control" type="text">
                <?php
                     
                            $result = mysql_query("SELECT * FROM customers");
                            if(isset($_SESSION['customerid']))
                            {while($rows = mysql_fetch_array($result))
                            {   if(!($rows['customerid']==$_SESSION['customerid']))
                                        echo "<option value='$rows[customerid]'>$rows[firstname] $rows[lastname]</option>";
                            }
                echo "<option value='admin'>Administrator</option>";
                            }
                            else if(isset($_SESSION['adminid']))
                            {
                                while($rows = mysql_fetch_array($result))
                                {
                                    echo "<option value='$rows[customerid]'>$rows[firstname] $rows[lastname]</option>";
                                }
                            }
                        ?>
                           
                        </select>
              </div>
            </div>
<br>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Subject</label>
              <div class="col-md-9">
                <input id="email" name="subject" type="text" placeholder="Subject" class="form-control">
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Your message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="10"></textarea>
              </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
               <!--  <button type="submit" class="btn btn-primary btn-lg">Send</button> -->
               <input type="submit" name="sendmsg" id="sendmsg" value="SEND MESSAGE" class="btn btn-primary btn-lg" />
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
    </div>
</div>
</div>
</body>
</html>