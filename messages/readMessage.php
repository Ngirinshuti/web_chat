<?php session_start();
require 'connect.php';

$sqlu = "UPDATE messages SET status = 'read' WHERE sender = '".$_GET['user']."' AND reciever = '".$_SESSION['a_user']."'";

if($conn->query($sqlu)){
	echo $conn->affected_rows;
}
 ?>
