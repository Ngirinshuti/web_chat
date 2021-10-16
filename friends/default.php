<?php require "../classes/init.php";

if (isset($_GET["user"])) {
	$my = $user_obj->get_my_data($_GET["user"]);
}else{$my = $user_obj->get_my_data($i);}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/lib/w3-theme-black.css">
	<style>
		*{box-sizing: border-box;}
		*:hover{}
		#prf{width: 90%; border-radius: 3px; padding: 0; height: auto;}
		table{width: 100%; height: 130px; text-align: center; border-collapse: collapse; padding: 10px;}
		td{width: 70%; margin: 2px;}
		td{width: 90%; color: green; font-size: 1.5vw;}
		td:hover{background-color: lightgrey; cursor: pointer; box-shadow: 0 4px 10px 3px rgba(0, 0, 0, 0.3), 2px 4px 2px 0 rgba(0, 0, 0, 0.5);}
		table, td{border: 0 solid; border-spacing: 5px;}
	</style>
</head>
<body>
<?php require "navbar.php";
      require "error.php";
?>
	<div class="container">
		<?php
		     if ($user_obj->get_all_users($my->username, false) > 0) {
		     	$users = $user_obj->get_all_users($my->username, true);
		     }
		?>
		<div class="info">
		<div id="user_inf">
			<table>
			<tr><td rowspan="3"><img id="prf" src="../images/<?php echo $my->profile_pic; ?>" alt="profile"/></td>
				<td><span><?php echo $my->fname ." ". $my->lname; ?></span></td></tr>
			<tr><span>
			    <td><?php if($friend_obj->get_mutual_friends($i, $my->username, false) > 0 && $my->username != $i){
				echo "<i class='badge'>".$friend_obj->get_mutual_friends($i, $my->username, false)."</i> mutual friends.";
			    }else{echo "no mutual friends.";}?></td></span>
		    </tr>
				<?php $status = $friend_obj->current_status($my->username, $i);
				 if ($status === 1){
					echo '<tr><td><span class="status">Unfriend</span></td></tr>';
				}elseif ($status === 0 && $my->username != $i) {
					echo '<tr><td><span class="status">Add as friend</span></td></tr>';
				}elseif ($status === 3 && $my->username != $i) {
					echo '<tr><td><span class="status">Request sent</span></td></tr>';
				}elseif ($status === 2 && $my->username != $i) {
					echo '<tr><td><span class="status"><a href="friends.php"><button>Confirm</butoon></a></span></td></tr>';
				} ?>
			</table>
			<div class="w3-display-container" style="width: 70%; height: 200px;">
				<img src="../images/avatar2.png" class="w3-display-left" height="100" style="width: 40%; position: relative;">
				<span class="w3-display-top">Myname</span>
				<span>mutuals</span>
			</div>
		</div>
		<div class="friends">
		<h1 align="center" style="background: darkgreen;">Friends <span class="badge"><?php echo $friend_obj->get_all_friends($my->username, false); ?></span></h1>
		<?php foreach ($users as $user) {
			if ($friend_obj->current_status($my->username, $user->username) === 1) {
				?>
				<div class="friend_info">
			        <img class="frnd_profile" src="../images/<?php echo $user->profile_pic;?>" alt="profile"/>
				    <span class="username"><?php echo $user->username; ?></span>
		       </div>
				<?php
			}
		} ?>
		<br>
		</div>
		</div>
		<div class="posts">
			<h1 align="center" style="background: darkgreen; margin-top: -1px;">POSTS<span class="badge">12</span></h1>
			<div class="post">
				<p class="posthead"><img class="frnd_profile" src="../images/avatar1.png" alt=""/><span class="username">Username</span><p>
				<p class="post_caption">We will never stop fighting harder.</p>
				<img src="../images/avatar1.png" class="w3-image" style="width: 100%; height: 340px; margin-top: -15px; padding: 0;" alt=""/>
				<div class="post_credits">
					<span class="like">👍<span class="badge">1</span></span> . <span class="comment">Comment <span class="badge">2</span></span> . <span>Share</span>
				</div>

			</div><br/>

			<div class="post">
				<p class="posthead"><img class="frnd_profile" src="../images/avatar1.png" alt=""/><span class="username">Username</span><p>
				<p class="post_caption">We will never stop fighting harder.</p>
				<img src="../images/avatar1.png" class="w3-image" style="width: 100%; height: 340px; margin-top: -15px; padding: 0;" alt=""/>
				<div class="post_credits">
					<span class="like">👍<span class="badge">1</span></span> . <span class="comment">Comment <span class="badge">2</span></span> . <span>Share</span>
				</div>

			</div><br/>
		</div>

	</div>
</body>
</html>
