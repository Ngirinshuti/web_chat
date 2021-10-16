<?php require "../classes/init.php";

if (isset($_SESSION['a_user'])) {
$conn = new mysqli("localhost", "root", "", "project2");
$sql = "UPDATE users SET status = 'offline' WHERE username = '".$_SESSION['a_user']."'";
if ($conn->query($sql)) {
	if(session_destroy()){
		header("location: ../index.php");
	}
}
}else {
	header("location: ../index.php");
}
?>   