<?php require 'oop.php';

$user = strtolower($_GET["user"]);
$users =  new method();
$arr = $users->fetch("SELECT username FROM users");
$length = count($arr);

foreach ($arr as $username) {
   if (strtolower($username['username']) == $user) {
      echo "<big style='font-family: arial;'>Sorry, username: <b style='color: blue;'>" . $username['username'] . "</b> was taken by someone else</big>";
   }
}
