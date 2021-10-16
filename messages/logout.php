<?php session_start();
require 'connect.php';

if (isset($_SESSION['a_user'])) {
$sql = "UPDATE users SET status = 'offline' WHERE username = '".$_SESSION['a_user']."'";
if ($conn->query($sql)) {
	if(session_destroy()){
		echo "Ok";
	}
}
}else {
	echo "error";
}
?>   