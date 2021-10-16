<?php require "../classes/init.php";

function get_first_letter($str)
{
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
		} elseif ($friend_obj->current_status($user->username) == 0) {
			array_push($people, $user);
		} elseif ($friend_obj->current_status($user->username) == 3) {
			array_push($recieved_req, $user);
		} else {
			array_push($sent_req, $user);
		}
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
	<!-- <link rel="stylesheet" href="http://localhost/project2/css/font-awesome-4.5.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" href="../css/font-awesome-4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/style2.css">
	<?php require_once '../theme.php'; ?>
	<script src="../js/lib/jquery-3.4.1.min.js"></script>
	<style media="screen">
		@media only screen and (max-width: 230px) {
			.friend-info * {
				padding: 0 !important;
				margin: 0 !important;
				font-size: 12px !important;
			}

			.fa-check:hover {
				color: forestgreen !important;
			}

			.footer {
				padding: 0 !important;
				margin: 0 !important;
				font-size: 6px !important;
			}
		}

		h2 {
			padding-left: 10px;
		}

		html {
			overflow-y: scroll;
		}

		.w3-button {
			border-radius: 0 !important;
		}

		.sent,
		.people,
		.friends {
			display: none;
			flex-direction: column;
		}
	</style>
</head>

<body class="w3-theme-l3">
	<div class="container w3-card-4 w3-theme-l4">
		<div class="header w3-theme-dark">
			<div class="left w3-bar">
				<img src="../images/<?php echo $me->profile_pic; ?>" alt="profile" />
				<div class="search">
					<input type="search" placeholder="search" />
				</div>
			</div>
			<ul>
				<li title="Home"><i class="fa fa-home"></i></li>
				<li title="Profile"><a href="profile.php"><i class="fa fa-user"></i></a></li>
				<li title="Friends" class="active">
					<a href="friends.php">
						<i class="fa fa-users"></i>
						<?php echo ($req_num > 0) ? '<span class="badge-red">' . $req_num . '</span>' : ''; ?>
					</a>
				</li>
				<li title="Messages">
					<a href="../message/">
						<i class="fa fa-wechat"></i>
						<?php echo ($unread > 0) ? '<span class="badge-red">' . $unread . '</span>' : ''; ?>
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
			<button id="request-close" class="headers w3-margin-top w3-button w3-card-4 w3-theme-d2">
				<span>Requests recieved</span>
				<span class="badge"><?php echo $req_num; ?></span>
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="recieved" id="recieved-wrapper">
				<?php echo ($req_num == 0) ? "<h2 align='center'>You have no friend requests.</h2>" : ""; ?>
				<?php if ($users_num != 0) {
					foreach ($users as $user) {
						if ($friend_obj->current_status($user->username) == 3) { ?>
							<div class="friend-box w3-card-2 w3-theme-l2 w3-theme-hover w3-round">
								<div class="friend-img">
									<a href="user.php?us=<?php echo $user->username; ?>">
										<img id="<?php echo $user->username; ?>" src="../images/<?php echo $user->profile_pic; ?>" alt="profile" />
									</a>
								</div>
								<div class="friend-info">
									<span>
										<a href="user.php?us=<?php echo $user->username; ?>" id="<?php echo $user->username; ?>">
											<?php echo ucfirst($user->fname . " " . $user->lname); ?>
										</a>
									</span>
									<span class="mutual">
										<?php if ($friend_obj->get_mutual_friends($user->username, false) > 0) {
											echo $friend_obj->get_mutual_friends($user->username, false) . " mutual friends.";
											echo "<div class='mutual-friends w3-theme-light w3-animate-zoom'>";
											foreach ($friend_obj->get_mutual_friends($user->username, true) as $key => $value) {
												$user_ = $user_obj->get_user_data($value); ?>
												<span><a href='#'><?php echo ucfirst($user_->username); ?></a></span>
										<?php }
											echo "</div>";
										} else {
											echo "<span>no mutual friends</span>";
										} ?>
									</span>
									<div>
										<span class="accept w3-theme-action w3-round w3-button">
											<a href="properties.php?page=<?php echo $_SERVER['PHP_SELF']; ?>&request=<?php echo $user->username; ?>&accept=true">
												<i style="color: green;" class="fa fa-check-circle"></i> <span>Accept</span>
											</a>
										</span>
										<span>
											<a class="w3-button remove w3-theme-action w3-round" href="properties.php?page=<?php echo $_SERVER['PHP_SELF']; ?>&request=<?php echo $user->username; ?>&ignore=true" title="remove this request">
												<i style="color: red;" class="fa fa-times"></i>
												Ignore
											</a>
										</span>
									</div>
								</div>
							</div>
				<?php }
					}
				} ?>
			</div>
			<button id="sent-close" class="headers w3-margin-top w3-button w3-card-4 w3-theme-d2">
				<span>Sent requests</span>
				<?php echo (count($sent_req) > 0) ? '<span class="badge">' . count($sent_req) . '</span>' : ""; ?>
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="sent" id="sent-wrapper">
				<?php if ($users_num != 0) {
					if (count($sent_req) == 0) {
						echo "<h2 style='text-align: center;'>There is no sent requests</h2>";
					}
					foreach ($users as $user) {
						if ($friend_obj->current_status($user->username) == 2) { ?>
							<div class="friend-box w3-card-2 w3-theme-l2 w3-round">
								<div class="friend-img">
									<a id="=<?php echo $user->username; ?>" href="user.php?us=<?php echo $user->username; ?>">
										<img id="<?php echo $user->username; ?>" src="../images/<?php echo $user->profile_pic; ?>" alt="profile" />
									</a>
								</div>
								<div class="friend-info">
									<span>
										<a href="user.php?us=<?php echo $user->username; ?>" id="<?php echo $user->username; ?>">
											<?php echo ucfirst($user->fname . " " . $user->lname); ?>
										</a>
									</span>
									<span class="mutual">
										<?php if ($friend_obj->get_mutual_friends($user->username, false) > 0) {
											echo $friend_obj->get_mutual_friends($user->username, false) . " mutual friends";
											echo "<div class='mutual-friends w3-theme-light w3-animate-zoom'>";
											foreach ($friend_obj->get_mutual_friends($user->username, true) as $key => $value) {
												$user_ = $user_obj->get_user_data($value);
										?>
												<span>
													<a href='#'><?php echo ucfirst($user_->username); ?></a>
												</span>
										<?php
											}
											echo "</div>";
										} else {
											echo "<span>no mutual friends</span>";
										}
										?>
									</span>
									<span>
										<i style="color: green;" class="fa fa-check-circle"></i>
										<span>Request sent</span>
									</span>
									<span class="accept w3-button w3-theme-action w3-round">
										<a href="properties.php?page=<?php echo $_SERVER['PHP_SELF']; ?>&request=<?php echo $user->username; ?>&ignore=true">
											<i style="color: red;" class="fa fa-times"></i>
											<span>Cancel</span>
										</a>
									</span>
								</div>
							</div>
				<?php
						}
					}
				}
				?>
			</div>
			<button id="friends-close" class="headers w3-margin-top w3-button w3-card-4 w3-theme-d2">
				<span>Friends</span>
				<span class="badge"><?php echo $friend_obj->get_all_friends($me->username, false); ?></span>
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="friends" id="friends-wrapper">
				<?php if ($friend_obj->get_all_friends($me->username, false) == 0) { ?>
					<h3 style="text-align: center;">You have no friends</h3>
					<?php } else {
					foreach ($users as $user) {
						if ($friend_obj->current_status($user->username) == 1) { ?>
							<div class="friend-box w3-card-2 w3-theme-l2 w3-round">
								<div class="friend-img">
									<a href="user.php?us=<?php echo $user->username; ?>">
										<img id="<?php echo $user->username; ?>" src="../images/<?php echo $user->profile_pic; ?>" alt="profile" />
									</a>
								</div>
								<div class="friend-info">
									<span>
										<a href="user.php?us=<?php echo $user->username; ?>" id="<?php echo $user->username; ?>"> <?php echo ucfirst($user->fname . " " . $user->lname); ?></a>
									</span>
									<span class="mutual">
										<?php if ($friend_obj->get_mutual_friends($user->username, false) > 0) {
											echo $friend_obj->get_mutual_friends($user->username, false) . " mutual friends";
											echo "<div class='mutual-friends w3-theme-light w3-animate-zoom'>";
											foreach ($friend_obj->get_mutual_friends($user->username, true) as $key => $value) {
												$user_ = $user_obj->get_user_data($value);
										?>
												<span>
													<a href='#'><?php echo ucfirst($user_->username); ?></a>
												</span>
										<?php
											}
											echo "</div>";
										} else {
											echo "<span>no mutual friends</span>";
										}
										?>
									</span>
									<span>
										<i style="color: green;" class="fa fa-check-circle"></i>
										<span>Friends</span>
									</span>
									<span style="display: inline;" class="remove w3-button w3-theme-action w3-round">
										<a href="properties.php?page=<?php echo $_SERVER['PHP_SELF']; ?>&friend=<?php echo $user->username; ?>&un=true">
											<i style="color: red;" class="fa fa-times"></i>
											<span>Unfriend</span>
										</a>
									</span>
								</div>
							</div>
				<?php }
					}
				}
				?>
			</div>
			<button id="people-close" class="headers w3-margin-top w3-button w3-card-4 w3-theme-d2">
				<span>Disocver people</span>
				<?php echo (count($people) > 0) ? '<span class="badge">' . count($people) . '</span>' : ""; ?>
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="people" id="people-wrapper">
				<?php
				if ($users_num != 0) {
					if (count($people) == 0) {
						echo "<h2 style='text-align: center;'>No available discovery</h2>";
					}

					foreach ($users as $user) {
						if ($friend_obj->current_status($user->username) == 0) {
				?>

							<div class="friend-box w3-card-2 w3-theme-l2 w3-round">
								<div class="friend-img">
									<a href="user.php?us=<?php echo $user->username; ?>">
										<img id="<?php echo $user->username; ?>" src="../images/<?php echo $user->profile_pic; ?>" alt="profile" />
									</a>
								</div>
								<div class="friend-info">
									<span>
										<a href="user.php?us=<?php echo $user->username; ?>" id="<?php echo $user->username; ?>">
											<?php echo ucfirst($user->fname . " " . $user->lname); ?>
										</a>
									</span>
									<span class="mutual">
										<?php if ($friend_obj->get_mutual_friends($user->username, false) > 0) {
											echo $friend_obj->get_mutual_friends($user->username, false) . " mutual friends";
											echo "<div class='mutual-friends w3-theme-light w3-animate-zoom'>";
											foreach ($friend_obj->get_mutual_friends($user->username, true) as $key => $value) {
												$user_ = $user_obj->get_user_data($value);
										?>
												<span>
													<a href='#'><?php echo ucfirst($user_->username); ?></a>
												</span>
										<?php
											}
											echo "</div>";
										} else {
											echo "<span>no mutual friends</span>";
										}
										?>
									</span>
									<span class="w3-button accept w3-theme-action w3-round">
										<a href="properties.php?page=<?php echo $_SERVER['PHP_SELF']; ?>&friend=<?php echo $user->username; ?>&ad=true">Send request</a>
										<i style="color: green;" class="fa fa-send"></i>
									</span>
								</div>
							</div>
				<?php
						}
					}
				}
				?>
			</div>
		</div>
		<div class="footer w3-theme-d3 w3-round">
			<h3>&copy;Valentin.inc - 2020</h3>
		</div>
		<script>
			$(document).ready(function() {
				$("#friends-close").click(function() {
					$("#friends-wrapper").slideToggle('slow');
				});
				$("#people-close").click(function() {
					$("#people-wrapper").slideToggle('slow');
				});
				$("#sent-close").click(function() {
					$("#sent-wrapper").slideToggle('slow');
				});
				$("#request-close").click(function() {
					$("#recieved-wrapper").slideToggle('slow');
				});
			});
		</script>
</body>

</html>