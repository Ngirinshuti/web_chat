<?php require "../classes/init.php";

function get_first_letter($str){
	$str = trim($str);
	$str_arr = str_split($str);
	return $str_arr[0];
}
	$people = [];
	$sent_req = [];
	$all_friends = [];
	$recieved_req = [];

if ($users_num > 0) {
	foreach ($users as $user) {
		if ($friend_obj->current_status($user->username) == 1) {
			array_push($all_friends, $user);
		}elseif ($friend_obj->current_status($user->username) == 0) {
			array_push($people, $user);
		}elseif ($friend_obj->current_status($user->username) == 3) {
			array_push($recieved_req, $user);
		}else {
			array_push($sent_req, $user);
		}
	}
} 

function get_mutuals($obj)
{
	foreach ($obj as $key => $v) {
		echo "<li>".ucfirst($v)."</li>";
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Friends</title>
<link rel="icon" href="/project2/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="http://localhost/project2/css/font-awesome-4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/style2.css">
<?php require_once '../theme.php'; ?>
<script src="../js/lib/jquery-3.4.1.min.js"></script>
<style media="screen">
@media only screen and (max-width: 230px) {
	.friend-info *{
		padding: 0!important;
		margin: 0!important;
		font-size: 12px!important;
	}
	.fa-check:hover{
		color: forestgreen!important;
	}
	.footer{
		padding: 0!important;
		margin: 0!important;
		font-size: 6px!important;
	}
}
h2{
	padding-left: 10px;
}
html{
	overflow-y: scroll;
}
.w3-button{
	border-radius: 0!important;
}
h3{text-align: center;}
.sent,
.people,
.friends{
	display: none;
	flex-direction: column;
}

/*New style*/
/* 1. Global style */

.mybtn{
	border: 2px solid transparent;
	padding: 4px 10px;
	border-radius: 4px;
	background: ghostwhite;
	cursor: pointer;
}
.success{
	border-color: rgba(20, 200, 30, 9);
	color: rgba(10, 170, 10, 9);
}
.success:hover{
	border-color: rgba(20,200, 30,  9);
	color: white;
	background: rgba(20, 200, 30, 9);
}
.danger{
	border-color: rgba(200, 20, 30, 9);
	color: rgba(200, 20, 30, 9);
}
.danger:hover{
	border-color: rgba(200, 20, 30, 9);
	color: white;
	background: rgba(200, 20, 30, 9);
}

/* 2. Friend page styles */
.friend-wrapper{
	min-width: 80%;
	margin: 10px auto;
	padding: 4px 10px;
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.friend-wrapper .friend-data-wrapper img{
	width: 50px;
	height: 50px;
	border: 0;
	background-image: linear-gradient(red, yellow, green);
	border-radius: 50%;
	padding: 1.2px;
	object-fit: cover;
	object-position: center;
}
.friend-wrapper .mutuals-wrapper{
	position: relative;
}
.mutuals-wrapper .mutual-picker{
	color: rgba(40, 46, 49, 1);
	padding-top: 4px;
	cursor: pointer;
}
.mutuals-wrapper .mutual-name-wrapper{
	display: none;
	z-index: 10;
}
.mutuals-wrapper:hover .mutual-name-wrapper {
	top: 100%;
	position: absolute;
	display: block;
}
</style>
</head>
<body class="w3-theme-l3">
<div class="container w3-card-4 w3-theme-light">
	<div class="header w3-theme-dark">
		<div class="left w3-bar">
			<img src="../images/<?php echo $me->profile_pic; ?>" alt="<?php echo $me->username; ?>"/>
			<div class="search">
				<input type="search" placeholder="search"/>
			</div>
		</div>
		<ul>
			<li title="Home"><i class="fa fa-home"></i></li>
			<li title="Profile"><a href="profile.php"><i class="fa fa-user"></i></a></li>
			<li title="Friends" class="active">
				<a href="friends.php">
					<i class="fa fa-users"></i>
					<?php echo ($req_num > 0)? '<span class="badge-red">'.$req_num.'</span>' : ''; ?>
				</a>
			</li>
			<li title="Messages">
				<a href="../message/">
					<i class="fa fa-wechat"></i>
					<?php echo ($unread > 0)? '<span class="badge-red">'.$unread.'</span>': ''; ?>
				</a>
			</li>
			<li id="notation">
				<i class="fa fa-bars"></i>
				<a id="logout" class="w3-card-4 w3-animate-bottom w3-theme-light" href="logout.php">
					<i class="fa fa-sign-out" style="font-size: 12px;"></i>
					<span>Logout</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="west"> <?php require_once 'error.php'; ?>

		<!-- Friend request recieved -->

		<button id="recieved-close" class="headers w3-margin-top w3-button w3-card-4 w3-theme-d2">
			<span>Requests recieved</span>
			<?php if (count($recieved_req) > 0){?>
			<span class="badge"><?php echo count($recieved_req);?></span>
			<?php } ?>
			<i class="fa fa-caret-down"></i>
		</button>

		<div class="recieved" id="recieved-wrapper">
			<?php if (count($recieved_req) == 0){?>
			<h3>No recieved requests</h3>
			<?php } else { ?>
			<?php foreach ($recieved_req as $fd) { ?>
			<div class="friend-wrapper w3-theme-l2 w3-card-4">
				<div class="friend-data-wrapper">
					<img src="../images/<?php echo $fd->profile_pic;?>" alt="<?php echo $fd->username;?>">
					<span class="fd-name"><?php echo ucfirst($fd->username); ?></span>
				</div>
				<div class="options-wrapper">
					<a href="properties.php?page=<?php echo $_SERVER['PHP_SELF'];?>&request=<?php echo $fd->username;?>&accept=true" class="mybtn success">accept</a>
					<div class="mutuals-wrapper">
					<a href="properties.php?page=<?php echo $_SERVER['PHP_SELF']; ?>&request=<?php echo $fd->username;?>&ignore=true" title="remove this request" class="mybtn danger">ignore</a>
						<span class="mutual-picker">
							<?php echo $friend_obj->get_mutual_friends($fd->username, false); ?>
							<span> mutual friends</span>
						</span>
						<div class="mutual-name-wrapper w3-animate-zoom w3-theme-light w3-round w3-padding">
							<a href="#"><?php get_mutuals($friend_obj->get_mutual_friends($fd->username, true)) ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php } } ?>
		</div>

		<!-- Sent friend requests -->

		<button id="sent-close" class="headers w3-margin-top w3-button w3-card-4 w3-theme-d2">
			<span>Sent requests</span>
			<?php if (count($sent_req) > 0){?>
			<span class="badge"><?php echo count($sent_req);?></span>
			<?php } ?>
			<i class="fa fa-caret-down"></i>
		</button>

		<div class="sent" id="sent-wrapper">
			<?php if (count($sent_req) == 0){?>
			<h3>No sent requests</h3>
			<?php } else { ?>
			<?php foreach ($sent_req as $fd) { ?>
			<div class="friend-wrapper w3-theme-l2 w3-card-4">
				<div class="friend-data-wrapper">
					<img src="../images/<?php echo $fd->profile_pic;?>" alt="<?php echo $fd->username;?>">
					<span class="fd-name"><?php echo ucfirst($fd->username); ?></span>
				</div>
				<div class="options-wrapper">
					<a href="properties.php?page=<?php echo $_SERVER['PHP_SELF']; ?>&request=<?php echo $fd->username;?>&ignore=true" title="remove this request" class="mybtn danger">cancel</a>
					<div class="mutuals-wrapper">
						<span class="mutual-picker">
							<?php echo $friend_obj->get_mutual_friends($fd->username, false); ?>
							<span> mutual friends</span>
						</span>
						<div class="mutual-name-wrapper w3-animate-zoom w3-theme-light w3-round w3-padding">
							<a href="#"><?php get_mutuals($friend_obj->get_mutual_friends($fd->username, true)) ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php } } ?>
		</div>

		<!-- All friends -->

		<button id="friends-close" class="headers w3-margin-top w3-button w3-card-4 w3-theme-d2">
			<span>Friends</span>
			<?php if (count($all_friends) > 0){?>
			<span class="badge"><?php echo count($all_friends);?></span>
			<?php } ?>
			<i class="fa fa-caret-down"></i>
		</button>

		<div class="friends" id="friends-wrapper">
			<?php if (count($all_friends) == 0){?>
			<h3>No available friends</h3>
			<?php } else { ?>
			<?php foreach ($all_friends as $fd) { ?>
			<div class="friend-wrapper w3-theme-l2 w3-card-4">
				<div class="friend-data-wrapper">
					<img src="../images/<?php echo $fd->profile_pic;?>" alt="<?php echo $fd->username;?>">
					<span class="fd-name"><?php echo ucfirst($fd->username); ?></span>
				</div>
				<div class="options-wrapper">
					<a href="properties.php?page=<?php echo $_SERVER['PHP_SELF'];?>&friend=<?php echo $fd->username;?>&un=true" class="mybtn danger">unfriend</a>
					<div class="mutuals-wrapper">
						<span class="mutual-picker">
							<?php echo $friend_obj->get_mutual_friends($fd->username, false); ?>
							<span> mutual friends</span>
						</span>
						<div class="mutual-name-wrapper w3-animate-zoom w3-theme-light w3-round w3-padding">
							<a href="#"><?php get_mutuals($friend_obj->get_mutual_friends($fd->username, true)) ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php } } ?>
		</div>

		<!-- Other people -->

		<button id="people-close" class="headers w3-margin-top w3-button w3-card-4 w3-theme-d2">
			<span>Disocver people</span>
			<?php echo (count($people) > 0)? '<span class="badge">'.count($people).'</span>': ""; ?>
			<i class="fa fa-caret-down"></i>
		</button>

		<div class="people" id="people-wrapper">
			<?php if (count($people) == 0){?>
			<h3>No available discovery</h3>
			<?php } else { ?>
			<?php foreach ($people as $fd) { ?>
			<div class="friend-wrapper w3-theme-l2 w3-card-4">
				<div class="friend-data-wrapper">
					<img src="../images/<?php echo $fd->profile_pic;?>" alt="<?php echo $fd->username;?>">
					<span class="fd-name"><?php echo ucfirst($fd->username); ?></span>
				</div>
				<div class="options-wrapper">
					<a href="properties.php?page=<?php echo $_SERVER['PHP_SELF'];?>&friend=<?php echo $fd->username;?>&ad=true" class="mybtn success">Request</a>
					<div class="mutuals-wrapper">
						<span class="mutual-picker">
							<?php echo $friend_obj->get_mutual_friends($fd->username, false); ?>
							<span> mutual friends</span>
						</span>
						<div class="mutual-name-wrapper w3-animate-zoom w3-theme-light w3-round w3-padding">
							<a href="#"><?php get_mutuals($friend_obj->get_mutual_friends($fd->username, true)) ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php } } ?>
		</div>
	</div>
	
		<!-- Footer -->

	<div class="footer w3-theme-d3 w3-round">
		<h3>&copy;Valentin.inc - 2020</h3>
	</div>
</div>

<!-- Javascript -->

<script>
$(document).ready(function(){
	$("#friends-close").click(function(){
		$("#friends-wrapper").slideToggle('slow');
	});
	$("#people-close").click(function(){
		$("#people-wrapper").slideToggle('slow');
	});
	$("#sent-close").click(function(){
		$("#sent-wrapper").slideToggle('slow');
	});
	$("#recieved-close").click(function(){
		$("#recieved-wrapper").slideToggle('slow');
	});
});
</script>
</body>
</html>
