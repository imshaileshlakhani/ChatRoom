<?php
$room = $_POST['room'];
include 'db_connect.php';
$sql = "SELECT msgs, stime, ip FROM msg WHERE room = '$room'";
$res="";
$result = $db->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$res = $res . '<div class="container">';
			$res = $res . $row['ip'];
			$res = $res . " says <p>".$row['msgs'];
			$res = $res . '</p> <span class="time-right">' . $row["stime"].'</span></div>';
		}
	}
	echo $res;
$db->close();
?>