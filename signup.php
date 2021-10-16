<?php session_start();
	if (isset($_SESSION["a_user"])) {
		header("location: friends/profile.php");
		exit;
	}
	require 'classes/user.php';
	require 'classes/db.php';
	$db_obj        = new Con('localhost', 'root', 'project2', '');
	$db_connection = $db_obj->create_connection();

	if (isset($_POST['register'])) {
		$fname    = test_input($_POST["fname"]);
		(isset($_POST['register'])) ? $lname = test_input($_POST["lname"]) : $lname = "";
		$day      = test_input($_POST["day"]);
		$month    = test_input($_POST["month"]);
		$year     = test_input($_POST["year"]);
		$dob      = $year."-".$month."-".$day;
		$email    = test_input($_POST["email"]);
		$sex      = test_input($_POST["sex"]);
		$username = test_input($_POST["username"]);
		$password = test_input($_POST["password"]);

		$user_obj = new User($db_connection, $username);

		if (checkdate($month, $day, $year)) {
			
			$register = $user_obj->register_user($fname, $lname, $email, $dob, $sex, $username, $password);
		} else {
			$register = $user_obj->invalid_date($dob);
		}
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/font-awesome-4.5.0/css/font-awesome.min.css">
<?php require 'theme.php';?>
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/login_signup.css">
<title>signup</title>
</head>
<body class="w3-theme-l2">
<div class="container w3-theme-d3">
<?php if(isset($register['Error'])){?>
<p class="w3-card-4" id="error"><?php echo $register['Error'];?></p>
<?php } if(isset($register['Success'])){?>
<p class="w3-card-4" id="success"><?php echo $register['Success'];?></p>
<?php } if(isset($register['Info'])){?>
<p class="w3-card-4" id="info"><?php echo $register['Info'];?></p>
<?php }?>
<h2 style="text-align: center; margin: 0;">SIGNUP</h2>

<form id="signup" method="post" enctype="multipart/form-data">
	<label>Firstname</label>
	<input type="text" name="fname" placeholder="Enter firstname" required/>
	<label>Lastname  . <span class="required">Optional</span></label>
	<input type="text" name="lname" placeholder="Enter lastname"/>
	<label>Username</label>
	<input type="text" name="username" placeholder="Enter username" required/>
	<label>E-mail</label>
	<input type="email" name="email" placeholder="Enter e-mail address" required/>
	<label>Password</label>
	<div class="pwd">
	<input type="password" name="password" placeholder="Enter password" required/>
	<i id="visible" onclick="showHide(this.id)" class='fa fa-eye'></i>
	</div>
	<label for="dob">Date Of Birth</label>
	<div class="date">
		<select name="day" id="dayHolder" required>
			<option value="">Day</option>
		<?php for ($i=1; $i <= 31; $i++) { ?>
			<option value="<?php echo $i;?>"><?php echo $i;?></option>
		<?php } ?>
		</select>
		<select name="month" id="monthHolder" required>
			<option value="">Month</option>
		<?php for ($i=1; $i <= 12; $i++) { ?>
			<option value="<?php echo $i;?>"><?php echo $i;?></option>
		<?php } ?>
		</select>
		<select name="year" id="yearHolder" required>
			<option value="" selected>Year</option>
		<?php for ($i=date("Y"); $i>=1970; $i--) { ?>
			<option value="<?php echo $i;?>"><?php echo $i;?></option>
		<?php } ?>
		</select>
	</div>
	<label>Sex</label>
	<div id="radio">
		<span class="radio">
			<span>Male</span>&nbsp;
			<input type="radio" name="sex" value="Male" required/>
		</span>
		<span class="radio">
			<span>Female</span>&nbsp;
			<input type="radio" name="sex" value="Female" required/>
		</span>
		<span class="radio">
			<span>Other</span>&nbsp;
			<input type="radio" name="sex" value="Other" required/>
		</span>
	</div>
	<div class="btm">
		<input class="w3-theme w3-button" type="submit" name="register" value="Signup"/>
		<span>
			<span>Have account? </span>
			<a href="index.php" class="w3-hover-text-theme">Login</a>
		</span>
	</div>
</form>
<!--h2 align="center" id="footer">&copy;Valentin.Inc</h2-->
</div>

<script>
function showHide(id) {
	var element = document.getElementById(id);
	var passwordElement = document.getElementsByName("password")[0];
	element.classList.toggle("fa-eye-slash");
	if (passwordElement.type == "password") {
		passwordElement.type = "text";
	}else {
		passwordElement.type = "password";
	}
}
</script>
</body>
</html>
