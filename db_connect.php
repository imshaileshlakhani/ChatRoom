<?php
 $db = new mysqli('localhost','root','','chatroom');
    if($db->connect_error)
    {
       die("database not connected".$db->connect_error);
    }
?>