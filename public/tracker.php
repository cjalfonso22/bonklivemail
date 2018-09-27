<?php

//THIS RETURNS THE IMAGE
header('Content-Type: image/gif');
readfile('images/tracking.gif');

$user = $_GET['user'];
$campaign_id = $_GET['id'];
//THIS IS THE SCRIPT FOR THE ACTUAL TRACKING
$date = date('Y-m-d', $_SERVER['REQUEST_TIME']);
$txt = $date . ", " . $_SERVER['REMOTE_ADDR'] . ", " . $user . ", " . $campaign_id;


$myfile = file_put_contents('log.txt', $txt.PHP_EOL , FILE_APPEND);


$hostname = "mysql.boinklivemail.com"; // the hostname you created when creating the database
$username = "bonkemailadmin";      // the username specified when setting up the database
$password = "bonkadmin123";      // the password specified when setting up the database
$database = "bonkemail";      // the database name chosen when setting up the database

$con = mysqli_connect($hostname, $username, $password, $database) or die(mysql_error());

mysqli_query($con, "UPDATE contacts SET opened=1, campaign_id=$campaign_id WHERE email='$user'");

exit;
?>