<?php require "../classes/init.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="http://localhost/project2/css/font-awesome-4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/style.css">

	<style>
 	.user-box{ width: 50%; margin: 10px auto; border-collapse: collapse; font-size: 13px;}
 	.user-box img{width: 100px; height: 100px;}
 	.username{text-shadow: 1px 1px 1px green; font: 20px candara; }
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
<?php require_once "error.php"; ?>
<div id="container">

<div class="user"><h3 style="text-align: center;">users</h3>
<table class="user-box" style="border: 0; vertical-align: top;">

<?php 
if ($user_obj->get_all_users($i, true) > 0) {
	$users = $user_obj->get_all_users($i, true);

foreach ($users as $user) {
	if ($friend_obj->current_status($i, $user->username) == 0) {
		//echo $user->username  . " : Not friends & No request.<br>";
		?>
		<tr>
			<td rowspan="3"><img src="../images/<?php echo $user->profile_pic; ?>" alt=""></td>
			<td class="username" id="<?php echo $user->username;?>"><a href="default.php?user=<?php echo $user->username;?>"><?php echo $user->username; ?></a></td>
		</tr>
		<tr>
			<td><?php if($friend_obj->get_mutual_friends($i, $user->username, false, false) > 0){
				echo "<a>".$friend_obj->get_mutual_friends($i, $user->username, false, false)." mutual friends.</a>";
			}else{echo "no mutual friends.";}?></td>
		</tr>
		<tr>
			<td id="btn"><a href="properties.php?page=<?php echo $_SERVER['PHP_SELF'];?>&friend=<?php echo $user->username;?>&ad=true">Ask friendship.</a></td>
		</tr>
		<?php
	}

	if ($friend_obj->current_status($i, $user->username) == 1) {
		?>
		<tr>
			<td rowspan="3"><img src="../images/<?php echo $user->profile_pic; ?>" alt="profile"></td>
			<td class="username" id="<?php echo $user->username; ?>"><a href="default.php?user=<?php echo $user->username;?>"><?php echo $user->username; ?></a></td>
		</tr>
		<tr>
			<td><?php if($friend_obj->get_mutual_friends($i, $user->username, false) > 0){
				echo $friend_obj->get_mutual_friends($i, $user->username, false)." mutual friends.";
				foreach ($friend_obj->get_mutual_friends($i, $user->username, true) as $key => $value) {
					echo "<li>".$value."</li>";
				}
			}else{echo "no mutual friends.";}?></td>
		</tr>
		<tr>
			<td id="btn"><img src="../images/icons/check-big.png" style="width: 20px; height: 20px;"> Friends.</td>
		</tr>
		<?php
	}
	if ($friend_obj->current_status($i, $user->username) == 2) {
		?>
		<tr>
			<td rowspan="3"><img src="../images/<?php echo $user->profile_pic; ?>" alt="profile"></td>
			<td class="username" id="<?php echo $user->username; ?>"><a href="default.php?user=<?php echo $user->username;?>"><?php echo $user->username; ?></a></td>
		</tr>
		<tr>
			<td><?php if($friend_obj->get_mutual_friends($i, $user->username, false) > 0){
				echo $friend_obj->get_mutual_friends($i, $user->username, false)." mutual friends.";
			}else{echo "no mutual friends.";}?></td>
		</tr>
		<tr>
			<td>request sent already.</td>
		</tr>
		<?php
	}
	if ($friend_obj->current_status($i, $user->username) == 3) {
		?>
		<tr>
			<td rowspan="3"><img src="../images/<?php echo $user->profile_pic; ?>" alt="profile"></td>
			<td class="username" id="<?php echo $user->username; ?>">	<a href="default.php?user=<?php echo $user->username;?>"><?php echo $user->username; ?></a>	</td>
		</tr>
		<tr>
			<td><?php if($friend_obj->get_mutual_friends($i, $user->username, false) > 0){
				echo $friend_obj->get_mutual_friends($i, $user->username, false)." mutual friends.";
			}else{echo "no mutual friends.";}?></td>
		</tr>
		<tr>
			<td>request recieved.</td>
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

?>
</div>
</div>
</body>
</html>