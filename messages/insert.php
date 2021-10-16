<?php require 'classes/db.php';
$conn = new mysqli('localhost', 'root', '', 'project2');

$fname     =       test_input($_POST["fname"]);
$lname     =       test_input($_POST["lname"]);
$dob       =       test_input($_POST["dob"]);
$sex       =       test_input($_POST["sex"]);
$username  =       test_input($_POST["username"]);
$password  =       test_input($_POST["password"]);
$about1     =      test_input($_POST["about"]);
$address   =       test_input($_POST["address"]);
$about = str_replace("'", "\'",  $about1);
?>

<?php
if ($_FILES["image"]["name"] != '') {
  $profile = explode(".", $_FILES["image"]["name"]);
  $extension = end($profile);
  $name = rand(100, 9999) . "." . $extension;
  $target_file = "images/" . $name;
}

if ($conn->connect_error) {
  die("Connection Failed: " . $conn->connect_error);
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

  $sql = "INSERT INTO users VALUES('" . $fname . "','" . $lname . "','" . $dob . "','" . $sex . "','" . $username . "','" . $password . "','" . $about . "','" . $target_file . "','" . $address . "', 'offline')";

  if ($conn->query($sql)) {
?>
    <script>
      alert('Account was successfully Created');
      location.href = 'index.htm';
    </script>
<?php
  } else {
    echo $conn->error;
  }
}
?>