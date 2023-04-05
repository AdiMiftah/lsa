<?php
require_once ('process/dbh.php');
$pid = $_GET['pid'];
$id = $_GET['id'];
$date = date('Y-m-d');
date_default_timezone_set('Asia/Jakarta'); // set timezone to WIB
$time = date('H:i:s');

// retrieve the data from the database
$sql = "SELECT * FROM project WHERE pid='$pid'";
$result = mysqli_query($conn, $sql);
$employee = mysqli_fetch_assoc($result);

// calculate the elapsed time
$datetime1 = new DateTime($employee['waktu']);
$datetime2 = new DateTime($employee['waktu4 ']);
$interval = $datetime1->diff($datetime2);
$elapsed_time = $interval->format('%H:%I:%S');

// update the database with the elapsed time
$sql = "UPDATE project SET subdate='$date', waktu='$time', waktu5='$elapsed_time', status='Submitted' WHERE pid='$pid'";
$result = mysqli_query($conn, $sql);

header("Location: empproject.php?id=$id");
exit;
?>
