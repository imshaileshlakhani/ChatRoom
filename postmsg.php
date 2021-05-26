<?php
include 'db_connect.php';
$msg = $_POST['text'];
$room = $_POST['room'];
$ip = $_POST['ip'];

$sql = "INSERT INTO `msg` (`sno`, `msgs`, `room`, `ip`, `stime`) VALUES (NULL, '$msg', '$room', '$ip', current_timestamp());";
$db->query($sql);
$db->close();
?>