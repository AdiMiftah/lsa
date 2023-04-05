<?php
require_once ('dbh.php');

$pname = $_POST['pname'];
$eid = $_POST['eid'];
$subdate = $_POST['duedate'];
$time = $_POST['waktu1'];
$time1 = $_POST['waktu2'];

$sql = "INSERT INTO `project`(`eid`, `pname`, `duedate`, `status`, `waktu1`,`waktu2`) VALUES ('$eid', '$pname', '$subdate', 'Due', '$time' ,'$time1')";

$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: ../assignproject.php");
} else {
    echo "<script>alert('Failed to Assign');</script>";
    header("Location: javascript:history.go(-1)");
    exit();
}
?>
