<?php
$roomname = $_GET['roomname'];
include 'db_connect.php';

$sql = "SELECT * FROM `room` WHERE roomname='$roomname'";
$result = $db->query($sql);
	if($result->num_rows == 0){
		$msg="This Room does not exist. Try creating a new one";
		echo '<script language="javascript">';
		echo 'alert("'.$msg.'");';
		echo 'window.location="http://localhost/chatroom";';
		echo '</script>';
	}
	else{
			
	}
?>
<!DOCTYPE html>
<html>
<head>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>ChatRoom</title>
  </head>
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyclass{
	height:350px;
	overflow-y: scroll;
}
</style>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">ChatRoom.com</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="#">Home</a>
    <a class="p-2 text-dark" href="#">About</a>
    <a class="p-2 text-dark" href="#">Contact</a>
  </nav>
  <a class="btn btn-outline-primary" href="#">Sign up</a>
</div>
<h2>Chat Messages - <?php echo $roomname?></h2>

<div class="container">
	<div class="anyclass">
		
	</div>
</div>

</br>
 <div class="form-group">
    <input type="email" class="form-control" name="usermsg" id="usermsg" aria-describedby="emailHelp" placeholder="Add message">
 </div>
<button class="btn btn-secondary" name="submit" id="submit">Send</button>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
	setInterval(runFunction, 1000);
	function runFunction(){
		$.post("htcont.php", {room:'<?php echo $roomname ?>'},
		function(data, status){
			document.getElementsByClassName('anyclass')[0].innerHTML = data;}
		)
	}
	// Get the input field
	var input = document.getElementById("usermsg");

	// Execute a function when the user releases a key on the keyboard
	input.addEventListener("keyup", function(event) {
		// Number 13 is the "Enter" key on the keyboard
		if (event.keyCode === 13) {
			// Cancel the default action, if needed
			event.preventDefault();
			// Trigger the button element with a click
			document.getElementById("submit").click();
		}
	});

	$("#submit").click(function(){
		var clientmsg = $("#usermsg").val();
		$.post("postmsg.php",{text: clientmsg, room:'<?php echo $roomname ?>', ip:'<?php echo $_SERVER['REMOTE_ADDR']?>'
		}),function(data, status){
			document.getElementsByClassName('anyclass')[0].innerHTML = data;}
		$('#usermsg').val("");
		return false;	
	});
</script>
</body>
</html>
