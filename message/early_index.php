<?php require '../classes/init.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- <link rel="stylesheet" href="../css/login_signup.css"/> -->
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/font-awesome-4.5.0/css/font-awesome.min.css">
<?php require_once '../theme.php'; ?>
<link rel="stylesheet" href="../css/style2.css">
<title></title>
<style>
  .chat-wrapper{
    padding: 5px;
    width: 100%;
    margin: 0;
  }
  .user-wrapper{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .user-wrapper .data img{
    width: 50px;
    height: 50px;
    padding: 5px;
    object-fit: cover;
    border-radius: 50%;
  }
  .user-wrapper .status-wrapper{
    padding: 4px;
    position: relative;
  }
  .container {
    max-width: 700px!important;
  }
</style>
</head>
<body class="w3-theme-l3">
<div class="container">
	<div class="header w3-theme-dark">
		<div class="left w3-bar">
			<img src="../images/<?php echo $me->profile_pic; ?>" alt="profile"/>
			<div class="search">
				<input type="search" placeholder="search "/>
			</div>
		</div>
    <ul>
			<li title="Home"><i class="fa fa-home"></i></li>
			<li title="Profile">
        <a href="../friends/profile.php">
          <i class="fa fa-user"></i>
        </a>
      </li>
			<li title="Friends">
				<a href="../friends/friends.php">
					<i class="fa fa-users"></i>
					<?php echo ($req_num > 0)? '<span class="badge-red">'.$req_num.'' : '</span>'; ?>
				</a>
			</li>
			<li title="Messages" class="active">
				<a href="#">
					<i class="fa fa-wechat"></i>
          <?php echo ($unread > 0)? '<span class="badge-red">'.$unread.'</span>': ''; ?>
				</a>
			</li>
			<li id="notation">
				<i class="fa fa-bars"></i>
				<a id="logout" class="w3-animate-zoom w3-theme-light w3-card-4" href="../friends/logout.php">
					<i class="fa fa-sign-out" style="font-size: 14px;"></i>
					<span>Logout</span>
				</a>
			</li>
		</ul>
	</div>
  <div class="chat-wrapper w3-theme-light">
    <?php if ($active_friends == 0) {
      echo "<h3 style='text-align: center'>You have no active friends</h3>";}
      else { ?>
    <?php foreach ($active_friends as $friend) { ?>
    <div class="user-wrapper w3-theme-d3 w3-margin-top w3-card-4">
      <div class="data">
        <img src="../images/<?php echo $friend->profile_pic;?>" alt="<?php echo $friend->username;?>"/>
        <a class="username" href="messages.php?m_r=<?php echo $friend->username;?>">
          <span><?php echo ucfirst($friend->username);?></span>
        </a>
      </div>
      <div class="status-wrapper">
        <span>online</span>
        <span class="<?php echo ($msg_obj->get_unread($friend->username) > 0)? 'badge-red': ''; ?>">
          <?php echo $msg_obj->get_unread($friend->username);?>
        </span>
      </div>
    </div>
    <?php } }?>
  </div>
</div>
</body>
</html>
