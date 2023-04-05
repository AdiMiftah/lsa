<?php 
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	require_once ('process/dbh.php');
	$sql = "SELECT * FROM `project` where eid = '$id'";
	$result = mysqli_query($conn, $sql);
	
?>



<html>
<head>
	<title>Employee Panel | MBUT oration</title>
	<link rel="stylesheet" type="text/css" href="styleview.css">
	<style>
	.collapse-row {
	background-color: #f0f0f0;
}

.collapse-content {
	animation-duration: 0.3s;
	animation-name: slideDown;
}

@keyframes slideDown {
	from {
		opacity: 0;
		max-height: 0;
	}
	to {
		opacity: 1;
		max-height: 1000px;
	}
}</style>
</head>
<body>
	
	<header>
		<nav>
			<h1>MBUT .</h1>
			<ul id="navli">
				<li><a class="homeblack" href="eloginwel.php?id=<?php echo $id?>"">HOME</a></li>
				<li><a class="homeblack" href="myprofile.php?id=<?php echo $id?>"">My Profile</a></li>
				<li><a class="homered" href="empproject.php?id=<?php echo $id?>"">My Projects</a></li>
				<li><a class="homeblack" href="applyleave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="elogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">


	<table>
  <tr>
    <th align="center">NRP</th>
    <th align="center">TUGAS</th>
    <th align="center">Waktu awal</th>
    <th align="center">Waktu akhir</th>
    <th align="center">Tanggal Mulai</th>
    <th align="center">Tanggal akhir</th>
    <th align="center">Waktu dimulai</th>
    <th align="center">Waktu berakhir</th>
	<th align="center">Durasi</th>
    <th align="center">Status</th>
  </tr>

  <?php
while ($employee = mysqli_fetch_assoc($result)) {
	echo "<tr>";
	echo "<td>".$employee['pid']."</td>";
	echo "<td>".$employee['pname']."</td>";
	echo "<td id='waktu1_".$employee['pid']."'>".$employee['waktu1']."</td>";
	echo "<td id='waktu2_".$employee['pid']."'>".$employee['waktu2']."</td>";
	echo "<td>".$employee['duedate']."</td>";
	echo "<td>".$employee['subdate']."</td>";
	echo "<td>".$employee['waktu4']."</td>";
	echo "<td>".$employee['waktu']."</td>";
	echo "<td>".$employee['waktu5']."</td>";
	echo "<td>".$employee['status']."</td>";
	echo "<td><a href='psubmit1.php?pid=".$employee['pid']."&id=".$employee['eid']."' onclick='startTimer(".$employee['pid'].")'>Mulai</a></td>"; 
	echo "<td><a href='psubmit.php?pid=".$employee['pid']."&id=".$employee['eid']."' onclick='stopTimer(".$employee['pid'].")'>Akhiri</a></td>";
	echo "<td><button class='btn btn-primary' onclick='toggleCollapse(".$employee['pid'].")'>Upload</button></td>";
	echo "</tr>";
	
	echo "<tr id='collapseExample_".$employee['pid']."' class='collapse-row' style='display:none'>";
	echo "<td colspan='12'>";
	echo "<div class='collapse-content'>";
	echo '<img src="assets/' . $employee['gambar'] . '" alt="" width="500" height="300">';
	echo "<form method='post' enctype='multipart/form-data'>";
	echo "<input type='hidden' name='pid' value='".$employee['pid']."'>";
	echo "<div class='mb-3'>";
	echo "<label for='formFile' class='form-label'>Upload Foto:</label>";
	echo "<input class='form-control' type='file' name='gambar' id='formFile'>";
	echo "</div>";
	echo "<button type='submit' name='submit_photo' class='btn btn-primary'>Upload</button>";
	echo "</form>";
	echo "</div>";
	echo "</td>";
	echo "</tr>";

	if(isset($_POST['submit_photo']) && $_POST['pid'] == $employee['pid']) {
	    $pid = $_POST['pid'];
	    $gambar = $_FILES['gambar']['name'];
	    $target_dir = "assets/";
	    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
	    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
	    
	    // insert query to save photo to database here
	    $sql = "UPDATE project SET gambar='$gambar' WHERE pid=$pid";
	    if(mysqli_query($conn, $sql)) {
	        echo "Foto berhasil diupload.";
	    } else {
	        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	}
}
?> 

<!-- jQuery and Bootstrap JavaScript -->
<script>
function toggleCollapse(pid) {
	var row = document.getElementById("collapseExample_" + pid);
	var content = row.querySelector(".collapse-content");
	if (row.style.display === "none") {
		row.style.display = "table-row";
		content.classList.add("open");
	} else {
		content.classList.remove("open");
		setTimeout(function() {
			row.style.display = "none";
		}, 300);
	}
}
</script>
</body>

</html>