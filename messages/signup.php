
<?php require "classes/init.php";

     	if(isset($_POST['register'])){
      		        //echo "<script>alert('Hi!');</script>";
      	      		/*if ($_FILES["image"]["name"] != "") {
      	      		$image_arr  = explode(".", $_FILES["image"]["name"]);
      	      		$extension  = end($image_arr);
      	      		$rand       = rand(1, 999);
      	      		$image_name = $rand . "." . $extension;
      	      		$image_path = "images/" . $image_name;
      	      		move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
      	      	}*/
      	
      	
      	            $fname    = test_input($_POST["fname"]);
      	            $lname    = test_input($_POST["lname"]);
      	            $dob      = test_input($_POST["dob"]);
      	            $sex      = test_input($_POST["sex"]);
      	            $username = test_input($_POST["username"]);
      	            $password = test_input($_POST["password"]);
      	
      	            $register = $user_obj->register_user($fname, $lname, $dob, $sex, $username, $password);
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
	<title>signup</title>
	<link rel="stylesheet" href="">
	<style>
		*{box-sizing: border-box;}
		html, body{font-family: 'Open Sans', sans-serif; color: slategray; padding: 0; margin: 0;}
		.signup-container{box-shadow: 2px 2px 3px white, 4px 4px 4px green; margin-top: 0; background-color: bisque; width: 40%; margin: auto; background-color: skyblue;}
		.signup-container h1{padding: 5px;}
		form#signup{width: 100%; padding: 5px; background-color: azure;}
		form#signup input[type='text'], input[type='email']{border: 0; border-bottom: 1px solid gray; background: ghostwhite; padding: 5px;}
		form#signup input[type ='text'], input[type='email'], input[type='date'], input[type='file']{width: 100%; display: block;}
		input{color: black; border: 0;}
		input:focus{outline: 0; background-color: white; font-weight: bold; font-family: 'verdana', sans-serif; font-size: 15px;}
		input[type='date']:focus{color: midnightblue;}
		input[type='date']{border-bottom: 1px solid gray;}
		form#signup label{display: block; font-weight: bold; padding: 1.3px;}
		form#signup input[type='radio']{margin-right: 25%; position: relative; width: 18px; height: 18px;}
		form#signup input[type='file']{padding: 7px 1px; text-align: center;}
		input[type='submit']{width: auto; padding: 10px; border:0; background-color: darkgreen;  margin-top: 5px; color: BlanchedAlmond; font-size: 20px; cursor: pointer; font-weight: bold;}
		form#signup p#login{float: right; margin-top: 5px; display: inline-block; padding: 3px;}
		p#login a{text-decoration: none; color: slateblue; font-weight: bolder;}
		p#login a:hover{color: darkgreen; text-decoration: underline;}
		p#fr{background-color: aqua; padding: 5px; display: block; position: absolute; bottom: 0; margin-top: -5px;}
		p#error, p#success{font-family: Berlin Sans FB; letter-spacing: 2px;word-spacing: 5px; padding: 5px; margin: auto; width: 75%; margin-top: 5px;}
		p#error{color: red; border: 1px solid darkred; background-color: salmon; text-align: center; font-weight: bolder;text-transform: uppercase;}
		p#success{color: green; border: 1px solid darkgreen; background-color: lightgreen; text-align: center; font-weight: bolder;text-transform: uppercase;}
		hr{background-color: green; width: 100%;}
		input[type='submit']:hover{background-color: forestgreen;}
        h2#footer{color: darkcyan; font-size: 12px; padding: 3px;}
        @media screen and (max-width: 700px){
        	.signup-container{width: 100%;}
        }
	</style>
</head>
<body bgcolor="Gainsboro">
	<div class="signup-container">
		<h1 align="center">SIGNUP</h1>
		<form action="" id="signup" method="post" enctype="multipart/form-data" autocomplete="off">
			<br/>
			<label for="fname">Firstname</label>
			<input type="text" name="fname" placeholder="Enter your firstname" required/><br/>
			<label for="lname">Lastname</label>
			<input type="text" name="lname" placeholder="Enter your lastname" required/><br/>
			<label for="username">E-mail</label>
			<input type="email" name="username" placeholder="Enter your e-mail address" required/><br/>
			<label for="password">Password</label>
			<input style="width: 90%; border: 0; display: inline; padding: 5px;" type="password" name="password" placeholder="Enter your password" required/>
			<img style="display: inline; width: 5%;" id="visibility" height="20" src="images/show.jpg"/><br/><hr/>
			<label for="dob">Date Of Birth</label><br/>
			<input type="date" name="dob" required/><br/>
			<!--label for="sex"></label-->
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			Male<input type="radio" name="sex" value="Male" required/>
			Female<input type="radio" name="sex" value="Female" required/><br/><hr/>
			<input type="submit" name="register" value="Signup"/>
			<p id="login">Have an account?&nbsp;&nbsp;<a href="index.php">Login</a><p>
		</form>
		<!--h2 align="center" id="footer">&copy;Valentin.Inc</h2-->
<?php if(isset($register['Error'])){?>
   <p id="error"><?php echo $register['Error'];?></p>
<?php } if(isset($register['Success'])){?>
   <p id="success"><?php echo $register['Success'];?></p>
<?php }?>
	</div>
<script src="index.js"></script>
</body>
</html>