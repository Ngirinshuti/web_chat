<?php session_start();
$conn = new mysqli('localhost', 'root', '', 'project2');

$count = 1;
$username = test_input($_POST['username']);
$password = test_input($_POST['pwd']);

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sql = 'SELECT * FROM users';
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {

     if (strtolower($row['username']) == strtolower($username) and $row['password'] == $password) {
        $sql1 = "UPDATE users SET status = 'online' WHERE username = '".$row['username']."'";
    if ($conn->query($sql1)) {
         $count = 0;
         $_SESSION['a_user'] = $row['username'];
         echo "<script> location.href = 'home.php';</script>";
    }
         
     }
}
if ($count != 0) {
  echo "<script>alert('Username or Password Incorrect!'); location.href = 'index.htm';</script>";
}
?>
