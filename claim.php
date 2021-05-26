<?php
	$room = $_POST['room'];

	if(strlen($room)>20 or strlen($room)<2){
		$msg = "Please choose a name between 2 to 20 characters";
		echo '<script language="javascript">';
		echo 'alert("'.$msg.'");';
		echo 'window.location="http://localhost/chatroom";';
		echo '</script>';
	}
	else if(!ctype_alnum($room)){
		$msg = "Please choose an alphanumeric room name";
		echo '<script language="javascript">';
		echo 'alert("'.$msg.'");';
		echo 'window.location="http://localhost/chatroom";';
		echo '</script>';
	}
	else{
		include 'db_connect.php';
	}

	$sql = "SELECT * FROM `room` WHERE roomname='$room'";
	$result = $db->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			if($row['roomname']==$room){
				$msg="This Room Name is not available please try another";
				echo '<script language="javascript">';
				echo 'alert("'.$msg.'");';
				echo 'window.location="http://localhost/chatroom";';
				echo '</script>';
			}
		}
		else{
			$sql1="INSERT INTO `room` (`sno`, `roomname`, `stime`) VALUES (NULL, '$room', current_timestamp());";
			if($db->query($sql1) == TRUE)
			{
				$msg = "Your room is ready and you can chat now!";
				echo '<script language="javascript">';
				echo 'alert("'.$msg.'");';
				echo 'window.location="http://localhost/chatroom/rooms.php?roomname='.$room.'";';
				echo '</script>';
			}
			else
			{
				echo "Error".$sql1."<br>".$db->error;
			}
		}
	$db->close();
?>