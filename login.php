<?php session_start();
  require "classes/user.php";
  require "classes/db.php"; 

  $db = new Con();
  $conn = $db->create_connection();

  if (isset($_POST['login'])) {
	  $username = filter_data($_POST["username"]);
	  $password = filter_data($_POST["password"]);

    $user_obj = new User($conn, $username);
	  $log_user = $user_obj->login_user($username, $password);

    if (isset($log_user["Error"])) {
      header("location: index.php?Error=".$log_user["Error"]);
    }
    if (isset($log_user["Success"])) {
      if ($log_user["Success"]) {
        header("location: friends/profile.php");
      }
    }
  }
  
  function filter_data($data){
  	htmlspecialchars($data);
  	trim($data);
  	stripcslashes($data);
  	return $data;
  }
?>
