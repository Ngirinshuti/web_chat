<?php session_start();
require 'connect.php';

  $sql = "SELECT * FROM messages WHERE status = 'unread' AND sender = '".$_GET['user']."' AND reciever = '".$_SESSION['a_user']."' ORDER BY sender DESC";

  $result = $conn->query($sql);
  if ($conn->affected_rows > 0) {
    echo $conn->affected_rows;
  }else {
    echo $conn->affected_rows;
  }
