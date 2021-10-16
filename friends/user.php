<?php require "../classes/init.php";
     if (isset($_GET["us"])) {
     	if ($user_obj->user_exist($_GET["us"])) {
     		$username = $_GET["us"];
     		$user = $user_obj->get_my_data($username);
        $you = $user->username;
        $me   = $user_obj->get_my_data($i);
     	}else{
     		header("location: profile.php");
     		exit;
     	}
     }else{
     	header("location: profile.php");
     	exit;
     }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="vieport" content="width=device-width, initial-scale=1.0">
	<title>interface</title>
	<link rel="stylesheet" href="../css/w3.css">
	<style>

  *{
    box-sizing: border-box;
  }
  html, body{
    font-family: "Open sans",
    sans-serif;
    margin: 0;
    padding: 0;
  }
  a{
    text-decoration: none;
  }
  .header{
    background-color: beige;
    box-shadow: 0 2px 1.3px 0 rgba(0, 0, 0, 0.4), 0 2px 2px 0 rgba(0, 0, 0, 0.2);
    width: 100%;
    position: sticky;
    z-index: 9;
    top: 0;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
  }
  .header .left{
    width: 90%;
    padding: 4px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .header .left input{
    border: 1px solid green;
    border-radius: 5px;
    padding: 0 5px;
    width: 85%;
    height: 30px;
  }
  .header .left img{
    border-radius: 50%;
    width: 12%;
    height: auto;
          transition: width 1.5s;
    margin-left: 4px;
  }
  .header ul{
    display: flex;
    float: right;
    padding: 0;
    justify-content: space-around;
  }
  .header ul li{
    list-style: none;
    cursor: pointer;
    margin: auto;
    padding: 5px;
  }
  .container{
    max-width: 760px;
    display: flex;
    margin: auto;
    flex-direction: column;
  }
  .east{
    background-color: ghostwhite;
    padding: 10px;
  }
  .west{
    display: flex;
    flex-direction: column;
    background-color: ghostwhite;
    padding: 4px;
  }
  .footer {
          background-color: beige;
          color: #000000;
          text-align: center;
          font-size: 12px;
          padding: 15px;
          margin-top: 14px;
      }
      #notation{
        position: relative;
      }
      #notation:hover #logout{
        display: inline-block;
      }
      #logout{
        display: none;
        width: 5pc;
        background-color: rgba(0, 0, 0, 0.6);
        color: rgba(255, 200, 120, 1);
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        font-weight: bolder;
        position: absolute;
        z-index: 1;
        top: 100%;
        left: 53%;
        margin-left: -60px;
      }
      @keyframes fade{
          from{
            opacity: 0;
          }to{
            opacity: 1;
          }
      }
      #logout::after{
        content: "";
          position: absolute;
          bottom: 100%;
          left: 75%;
          margin-left: -5px;
          border-width: 5px;
          border-style: solid;
          border-color: transparent transparent rgba(0, 0, 0, 0.6) transparent;
      }

  .header ul{
    justify-content: flex-end;
    flex: 70%;
    height: 100%;
  }

      .user-box{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .user-image{
        width: 75%;
      }
      .user-image img{
        width: 90%;
      }
      .friend-info{
        flex: 60%;
        position: relative;
        width: 100%;
      }
      .friend-info, .user-info{
        list-style: none;
        padding: 5px;
      }
      .user-info li{
        font-family: verdana, sans-serif;
        font-size: 18px;
        font-weight: lighter;
        text-align: left;
      }
      .friend-info li a.un{
        color: red;
        border: 2px solid #f44336;
        padding: 2px;
        border-radius: 5px;
      }
      .friend-info li a.un:hover, .user-info li:hover{
        background: #f44336;
        color: white;
        cursor: pointer;
      }
      .badge-red{
        background: darkred;
        border-radius: 50%;
        padding: 0 6px;
        margin: 1.5px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        position: relative;
      }
      .badge{
        background: black;
        border-radius: 50%;
        padding: 0 6px;
        margin: 1.5px;
        font-size: 16px;
        font-weight: bold;
        color: beige;
        position: relative;
      }
      .accept{
        color: green;
        border: 2px solid #4CAF50;
      }
      .accept:hover{
        background-color: #4CAF50;
        color: white;
      }
      .remove{
        color: red;
        border: 2px solid #f44336;
      }
      .remove:hover{
        background: #f44336;
        color: white;
      }
      .accept, .remove{
        border-radius: 3px;
        cursor: pointer;
        padding: 4px;
      }
      #cancel{
        border-radius: 4px;
        padding: 5px 35px;
        color: red;
        border: 2px solid #f44336;
      }
      #cancel:hover{
        background: #f44336;
        color: white;
        font-weight: bold;
        cursor: pointer;
      }
      span{
        display: inline;
      }
      .mutual{
        display: block;
        cursor: pointer;
        margin-bottom: 4px;
        position: relative;
        color: grey;
      }
      .req-user{
        margin: 0;
        padding: 0;
      }
      .mutual:hover {
        color: black;
      }
      .mutual:hover .mutual-friends{
          display: block;
      }
      .mutual-friends{
        display: none;
        padding: 3px;
        color: grey;
        position: absolute;
        z-index: 3;
        margin-left: 40%;
        flex-direction: column;
        text-align: left;
        border-radius: 10px;
        background-color: lightgreen;
      }
      .mutual-friends p{
        padding: 3px;
        margin: 2px;
      }
      .friend-box{
        width: 60%;
        margin: 5px;
        padding: 5px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
      }
      .friend-img{
        flex: 40%;
        position: relative;
        display: flex;
      }
      .friend-img img{
        width: 50%;
      }
      h4{
        background-color: dodgerblue;
        color: white;
      }
      @media only screen and (max-width: 660px) {
        .friend-box{
          width: 100%;
        }
      }

	</style>
</head>
<body>
<div class="container">
	<div class="header">
		<div class="left">
			<img class="w3-card-4" src="../images/<?php echo $me->profile_pic;?>" alt="profile"/>
			<input type="search" placeholder="search">
		</div>
		<ul>
			<li><img width="20" src="../images/icons/icon_home.png" alt="home"></li>
			<li><a href="profile.php"><img width="20" src="../images/icons/people2.png" alt=""></a></li>
			<li><a href="friends.php"><img width="20" src="../images/icons/people-icon.png" alt=""></a></li>
			<li><img src="../images/icons/mes-ico.png" alt=""></li>
			<li id="notation"><img src="../images/icons/notation.png" width="10" alt=""><a id="logout" class="w3-animate-zoom" href="logout.php">Logout</a></li>
		</ul>
	</div>
  <div class="user-box w3-card-4">
    <div class="user-image">
      <img class="" id="profile" src="../images/<?php echo $user->profile_pic; ?>" alt="profile"/>
    </div>
    <div class="user-info">
      <li><?php echo ucfirst($user->fname." ".$user->lname);?></li>
      
    </div>
  </div>
	<div class="footer w3-card-4">
		<h3>&copy;Valentin.inc - 2020</h3>
	</div>
  </div>
</body>
</html>
