<?php require "../classes/init.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/style.css">

	<style>
 	.user-box{ width: 50%; margin: 10px auto; border-collapse: collapse; font-size: 13px;}
 	.user-box img{width: 100px; height: 100px;}
 	.stand:hover{background-color: gray;}
 	#container{width: 60%; margin: auto; background-color: rgba(0, 0, 0, 0.8);}
	p#error, p#success, p#info{font-family: "Open SANS", sans-serif;  width: 50%; margin: 5px auto; padding: 8px; text-align: center; font-weight: bolder;}
	p#error{color: red; border: 1px solid darkred; background-color: salmon;}
	p#success{color: green; border: 1px solid darkgreen; background-color: lightgreen;}
	p#info{color: white; border: 1px solid darkblue; background-color: #0080FF;}
	td#btn{background-color: lightslategrey; font-weight: bolder; color: darkgreen; cursor: pointer;}
	td#btn:hover{background-color: grey;}

	@media screen and (max-width: 700px) {
	.user-box{flex-direction: column; width: 100%;}	
	#container{width: 100%;}	
	}
	</style>
</head>
<body text="white">
<?php require "navbar.php";?>
<div id="container">
<div class="user"><h3 align="center">users</h3>
<table class="user-box" border="0" style="vertical-align: top;">

<?php 
if ($user_obj->get_all_users($i, true) > 0) {
	$users = $user_obj->get_all_users($i, true);

foreach ($users as $user) {
	if ($friend_obj->current_status($i, $user->username) == 0) {
		//echo $user->username  . " : Not friends & No request.<br>";
		?>
		<tr>
			<td rowspan="3"><img src="../<?php echo $user->profile_pic; ?>" alt=""></td>
			<td id="<?php echo $user->username;?>"><a href="#"><?php echo $user->username; ?></a></td>
		</tr>
		<tr>
			<td><?php if($friend_obj->get_mutual_friends($i, $user->username) > 0){
				echo get_mutual_friends($i, $username)." mutual friends.";
			}else{echo "no mutual friends.";}?></td>
		</tr>
		<tr>
			<td id="btn">Ask friendship.</td>
		</tr>
		<?php
	}

	if ($friend_obj->current_status($i, $user->username) == 1) {
		?>
		<tr>
			<td rowspan="2"><img src="../<?php echo $user->profile_pic; ?>" alt="profile"></td>
			<td id="<?php echo $user->username; ?>"><a href="#"><?php echo $user->username; ?></a></td>
		</tr>
		<tr>
			<td id="btn"><img src="../images/icons/check-big.png" width="18" height="18"/> Friends.</td>
		</tr>
		<?php
	}
}
?>
</table><br/>
<?php 
}else{
	echo "<h3 align='center' style='color: red;'>".$user_obj->get_all_users($i, true)["Info"]."</h3>";
}
if (isset($_GET['Success'])) {
	echo '<p id="success">'.$_GET["Success"].'</p>';
}
if (isset($_GET['Info'])) {
	echo '<p id="info">'.$_GET["Info"].'</p>';
}
if (isset($_GET['Error'])) {
	echo '<p id="error">'.$_GET["Error"].'</p>';
}
?>
</div>
</div>
</body>
</html>