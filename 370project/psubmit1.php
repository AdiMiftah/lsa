<?php
require_once('process/dbh.php');

if(isset($_GET['pid']) && isset($_GET['id'])) {
  $pid = $_GET['pid'];
  $id = $_GET['id'];
  
  date_default_timezone_set('Asia/Jakarta');
  $time4 = date('H:i:s');
  
  $sql = "UPDATE project SET waktu4='$time4' WHERE pid='$pid'";
  $result = mysqli_query($conn, $sql);
  
  if($result) {
    header("Location: empproject.php?id=$id");
    exit;
  } else {
    // handle error
    echo "Error updating project.";
  }
} else {
  // handle missing parameters
  echo "Missing parameters.";
}
?>
