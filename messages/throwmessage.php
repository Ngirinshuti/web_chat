<?php session_start();
require 'connect.php';

$sender = test_input($_POST['sender']);
$reciever = test_input($_POST['reciever']);
$body = str_replace("'", "\'", test_input($_POST['message']));

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (!empty($body)) {
  $sqll = "INSERT INTO `messages` (`id`, `sender`, `reciever`, `body`, `date_`, `status`)
          VALUES (NULL, '$sender', '$reciever', '$body', current_timestamp(), 'unread')";

  if ($conn->query($sqll)) {
    echo 'Hello It\'s Done!';
  }
} else {
  echo "<script>alert('Can\'t throw empty message!');</script>";
}
