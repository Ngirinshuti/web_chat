<?php session_start();
require 'connect.php';

$sql = 'SELECT * FROM users where username = "'.$_GET['user'].'"';
$result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo $row['status'];
    }
 ?>
