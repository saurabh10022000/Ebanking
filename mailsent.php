<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if((!(isset($_SESSION['customerid'])))&&(!(isset($_SESSION['adminid']))))
    header('Location:login.php?error=nologin');

if(isset($_GET["mailid"]))
{
  mysql_query("DELETE FROM mail where mailid='$_GET[mailid]'");
  $recres = "Mail deleted Successfully...";
}
if(isset($_SESSION['adminid']))
$result = mysql_query("SELECT * FROM mail where senderid='$_SESSION[adminid]'");
else if(isset($_SESSION['customerid']))
    $result= mysql_query("SELECT * FROM mail where senderid='$_SESSION[customerid]'");
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
        <h5 style="padding-left: 10px;"><b>MAIL</b></h5>
        <li><a href="mailinbox.php">> Inbox</a></li>
        <li><a href="mailcompose.php">> Compose Mail</a></li>
        <li><a href="mailsent.php">> Sent Mail</a></li>
        

    </ul>
</div><!-- /span-3 -->
<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
    <!-- Right -->

   <form>
            <?php echo $recres; ?>

            <div class="container">
    <div class="row">
 <table class="col-xs-10 table-bordered table-striped table-condensed cf">
              
            
             
             <?php
     echo " <tr>";
                echo " <th scope='col' width='45' >Delete</th>";
                echo " <th scope='col'>Read</th>";
                echo " <th scope='col'>RECEIVER</th>";
                echo " <th scope='col'>SUBJECT</th>";
                echo " <th scope='col'>TIME</th>";
                echo " </tr>";
            while($row = mysql_fetch_array($result))
          {
                                  $rid=$row['reciverid'];
                                  if (!($rid=='admin'))
                                  {
                                      $rres=  mysql_query("SELECT * FROM customers WHERE customerid='".$rid."'");
                                      $rresarr = mysql_fetch_array($rres);
                                      $recid = $rresarr['firstname']." ".$rresarr['lastname'];
                                  }
                                  else
                                      $recid=$rid;
          echo " <tr>";
                echo " <th scope='col'><a href='mailinbox.php?mailid=$row[mailid]'><i class='fa fa-trash'></i></a></th>";
                echo " <th scope='col'><a href='mailread.php?mailid=$row[mailid]'><i class='fa fa-book'></a></th>";
                echo " <th scope='col'>$recid</th>";
                echo " <th scope='col'>$row[subject]</th>";
                echo " <th scope='col'>$row[mdatetime]</th>";
                echo " </tr>";
          }
?>                 </table>
</div></div>
  </form>


</body>
</html>