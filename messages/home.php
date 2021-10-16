<?php session_start();
require 'connect.php';

$sql = 'SELECT * FROM users WHERE username = "' . $_SESSION["a_user"] . '"';
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>New Home</title>
    <style media="screen">
        *{box-sizing: border-box;}
    body{ font-family: arial; margin: 0; padding: 0;
      background-color: orange;
    }
  q:lang(no){font-size: 14px; quotes: "~" "~"; font-style: italic; color: blue; font-weight: lighter;}
    img:hover{
      transition: transform 2s;
      box-shadow: 0 0 4px 4px white;
      padding: 0;
      transform: scale(1);
    }
    .header{padding: 30px; text-align: center; font-size: 78px; background-color: coral;}
    .navbar{z-index: 3; position: sticky; top: 0; display: flex; flex-wrap: wrap; background-color: gray; box-shadow: 1px 2px 2px 1px blue;}
    .navbar li a{text-decoration: none; color: black; border-left: 5px solid red; padding: 10px;font-weight: bold;}
    #msgReciever{padding: 5px; color: white; font-family: algerian; display: inline-block;}
    .navbar li {padding: 15px; list-style: none;}
    .navbar li:hover a{background-color: lightgray; font-weight: bold;}
    .navbar li:hover a{color: green;}
    .home{text-align: center;margin-top: 10px; display: flex; flex-direction: row; flex-wrap: wrap; border: 2px double green; border-radius: 4px;}
    .left{flex: 25%; padding: 20px; background-color: lightgray;}
    .center{flex: 50%; padding: 20px; background-color: gray;}
    .right{flex: 25%; padding: 20px; background-color: lightgray;}
    .mySlides{display: none; animation: fade 2s ease-in-out;}
    .navbar .searchbar{position: absolute; right: 20px; top: 10px;}
    .navbar  input{color: green; border: 0; font: normal bold 16px verdana; padding: 5px; border-radius: 5px; text-align: center;background-color: lightgrey;}

    .logOptions{font-family: verdana; padding: 20px; background-color: rgba(255, 255, 255, 0.2);position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); color: ghostwhite; display: block;}
    a{text-decoration: none;}
    p{padding: 5px; text-align: justify; border-radius: 5px;}
    .contacts hr{display: block; background: dodgerblue; width: 100%; position: relative; margin-left: 0;}
    #myForm{position: fixed; bottom: 0;}
    #myForm textarea{width: 310px; resize: none; border: 0; display: inline-block; color: black; position: absolute;  padding: 3px; bottom: 0; background-color: lightgrey; height: 37px; font-family: times new roman;}
    .contactsContiner{width: 50%; margin: auto; overflow-x: hidden;}
    .contacts{font-family: consolas; display: block; text-align: justify; position: relative;}
    .chatContainer{display: none; overflow-y: scroll; scroll-behavior: smooth; overflow-x: hidden; width: 310px; height: 450px; background: rgba(300, 300, 300, 1); position: fixed; bottom: 35.5px; right: 10px; z-index: 10;border: 0; border-radius: 15px 10px 0 0;}
    .chatContainer .tophead .close{color: white; font-size: 32px; position: absolute; top: -5px; right: 0; border-radius: 30px;}
    .chatContainer .tophead .minimize{color: white; font-size: 35px; position: absolute; top: -8px; right: 30px; border-radius: 30px;}
    .chatContainer img{box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 12px 40px 0 rgba(0, 0, 0, 0.19);}
    .chatContainer .tophead .minimize:hover{color: red; font-weight: bold; cursor: pointer;}
    .chatContainer .tophead .close:hover{color: red; cursor: pointer;}
    .chatContainer .tophead{z-index: 10; position: sticky; top: 0; border-radius: 10px 0 0 0px; width: 100%; height: 35px; padding: 2.5px; background: deepskyblue;}
    .badge{background-color:#000;color:#fff;display:inline-block;padding-left:8px;padding-right:8px;text-align:center;border-radius:45%; margin: 5px; }
    .msgContainer{ padding: 10px; margin: 5px;}
    .userlink{color: darkblue; position: relative; display: block; cursor: pointer; list-style: none; font-size: 20px; margin: 4px;}
    .status{cursor: pointer; position: absolute; border-radius: 45%; background: green; right: 5px; color: lightgreen; display: inline; margin-top: 10px;}
    img#menu{display: none; position: absolute; top: 10px; border-radius: 20%; max-width: 60px; max-height: 60px;}
    img#logo{position: absolute; left: 0; top: 5px; padding: 0; display: inline; border-radius: 50%; max-width: 110px; max-height: 110px;}
    @keyframes fade {from {opacity: 0.3;} to {opacity: 1}}
    .footer{position: relative; text-align: center; margin: auto; background-color: lightgreen; padding: 20px; border-radius: 3px; width: 100%; bottom: 0; display: block;}
    @media screen and (max-width: 800px){
         .navbar, .home{flex-direction: column; width: 100%;}
         html, body{margin: 0; padding: 0; width: 100%; height: 100%;}
         .searchbar{display: none;}
         .navbar{display: none;}
         .navbar li a{border: 0;}
         .navbar li{border-bottom: 1px double blue; background: lightgray; margin: auto;  display: block; width: 100%;}
         .navbar {text-align: center; position: static;}
         .status{right: 5px;}
         .contacts hr{width: 100%;}
         .contacts{margin: 0;}
         .header{padding: 5px; font-size: 30px;}
         .contactsContiner{width: 100%; overflow-x: hidden;}
         .chatContainer{display: block; width: 100%; height: auto;}
         .chatContainer textarea{position: relative; width: 100%; margin-left: 5px; margin-right: 0; text-align: center;}
         img#menu{display: inline-block; left: 0;}
         img#logo{width: 25px; height: 25px; top: 5px; display: none;}

    }

    </style>
  </head>

  <body>
    <div class="header"> <img id="logo" src="../images/logo.jpg" alt="LOGO" />
      <img id="menu" src="menu.jpg" alt="LOGO" />
      <h4 style="display: inline; text-align: left;">Back-end Developers</h4>
    </div>
    <div class="navbar">
      <li><a href="#" class="tablinks" onclick="openPage('default', this, '')">Home</a></li>
      <li><a href="#" class="tablinks" onclick="openPage('contacts', this, '');">Contacts</a></li>
      <!--li><a href="#" class="tablinks" onclick="openPage('messages', this, '');" >Messages</a></li-->
      <li><a href="#" class="tablinks" onclick="openPage('notifications', this, '');">Notifications</a></li>
      <li><a href="#" class="tablinks" id="logout">Logout</a></li>
      <li><input class="searchbar" type="search" placeholder="search" name="searchbar" /></li>
    </div>

    <div class="home" name="tabcontent" id="default">
      <div class="left">
        <h3><?php echo $row['username']; ?></h3>
        <img src="<?php echo $row['profile_pic']; ?>" alt="avatar" style="width: 50%; height: 300px; border-radius: 50%; padding: 2px;">
        <p>Location: <?php echo $row['address']; ?></p>
        <p>Proffession: Web Developer</p>
        <h3 style="padding: 5px; color: green; background-color: coral; text-transform: uppercase;">What is going on now!?</h3>
      </div>
      <div class="center">
        <h4 align="left">About Me : </h4>
        <input type="text" style="width: 100%; padding:2%;" value="<?php echo $row['about']; ?>" disabled>

      </div>
      <div class="right">
        <h3>MY ACCOUNT</h3>
        <img src="../images/img(2).jpg" alt="avatar" style="width: 60%; border-radius: 50%;">
        <p>Location: Muganza, Mutovu</p>
        <p>Proffession: Web Developer</p>
        <h3 style="padding: 5px; color: green; background-color: coral; text-transform: uppercase;">What is going on now!?</h3>
      </div>
    </div>

    <div class="contactsContiner" name="tabcontent" id="contacts" style="display: block; position: relative;">

      <div class="contacts">

        <?php

        $sqlv = "SELECT * FROM users WHERE username != '" . $_SESSION['a_user'] . "' ORDER BY status DESC";
        $resultv = $conn->query($sqlv);
        if ($conn->affected_rows > 0) {

          while ($key = $resultv->fetch_assoc()) {

        ?>
            <li class="userlink" id="<?php echo $key['username']; ?>"><a><?php echo ucfirst($key['username']); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge"></span>
              &nbsp;&nbsp;&nbsp;&nbsp;<span class="status" title="online"></span></li>
            <hr />
        <?php
          }
        } else {
          echo "<p>No Available Users!</p>";
        }
        ?>

      </div>



      <div class="chatContainer" id="chat" ondblclick="this.style.height = '350px'; document.getElementById('min').style.display= 'inline'">
      	    <!--audio id="myAudio" src="../images/sound.mp3" controls></audio-->
        <div class="tophead">
          <img id="imgContainer" src="http://localhost/project2/w3images/app.jpg" height="25" width="25" style="border-radius: 50%; z-index: 20;" />
          <span id="msgReciever"></span>
          <span class='minimize' id="min" onclick="document.getElementById('chat').style.height= '20px';this.style.display='none';">-</span>
          <span class='close' onclick="document.getElementById('chat').style.display= 'none'">&times;</span>
        </div>
        <div class="msgContainer">
        </div>
        <form id="myForm">
          <textarea placeholder="message!" id="messageBody" name="message" wrap="hard" required></textarea>
          <input type="hidden" id="sender" name="sender" value="<?php echo $_SESSION['a_user']; ?>" required />
          <button type="submit" id="sub" value="SEND"></button>
        </form>
        <input type="hidden" id="currentUserValue" value="">
      </div>

    </div>
    </div>
    <div class="notifications" name="tabcontent" id="notifications">We notifications</div>

    <div class="footer">
      <h1><q lang="no">&copy;valentin 2020</q></h1>
    </div>
    <div class="logout" style="z-index: 10; display: none; width: 100%; position: fixed; top: 0; height: 100%; background: rgba(0, 0, 0, 0.8); ">
      <div class="logOptions">Are you sure you want to <big style="color: red;">Logout</big>
        <button id="yesLogout" style=" background: red; padding: 10px; border: 0; ">Yes</button>
        <button id="noLogout" style=" background-color: lightgreen; padding: 10px; border: 0;">No</button>
      </div>
    </div>
    <script type="text/javascript">
      var currentUser = document.getElementById('currentUserValue').value;
      var activeUser = document.getElementsByClassName('userlink');
      var imgz = document.getElementsByClassName('youimg');
      (function(){
                  for (var i = 0; i < activeUser.length; i++) {
                    activeUser[i].onclick = function() {
                      var chatBox = document.getElementById('chat');
                      loadBadges();
                      
                      chatBox.style.display = 'block';
                      chatBox.style.height = '350px';
                      currentUser = this.id;
                      var xht = new XMLHttpRequest();
                      xht.open('GET', 'readMessage.php?user=' + this.id, true);
                      xht.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          loadBadges();
                        }
                      }
                      xht.send();
                    }
                  }
              })();



      setInterval(loader, 1000);

      function loader() {
        loadMessages(currentUser);
      }
      document.getElementById('messageBody').onkeyup = function(event) {
        if (event.keyCode === 13) {
          event.preventDefault();
          throwMessage(currentUser);
        }
      }
      document.getElementsByClassName('chatContainer')[0].scrollTop = 100;

      function loadMessages(user) {
        var param = "user_=" + user;
        var xhttp = new XMLHttpRequest();
        document.getElementById('msgReciever').innerHTML = user;
        //document.getElementsByClassName('imgContainer')[0].src ;
        xhttp.open('POST', 'as_message.php', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            let element = document.getElementsByClassName("msgContainer")[0];

            if (this.responseText.indexOf('img') != -1) {
              element.innerHTML = this.responseText;
              element.scrollIntoView(false);
              loadBadges();
            } else {
              element.innerHTML = 'No Conersation Yet';
            }
          }
        }
        xhttp.send(param);
      }
      /*setInterval(alerter, 2000);
      function alerter() {
          var img = document.getElementsByClassName('imgContainer')[0];
          img.src = 'http://localhost/project2/w3images/app.jpg';
      }*/


      function throwMessage(user) {
        var message = document.getElementById('messageBody').value;
        var sender = document.getElementById('sender').value;
        var reciever = user;
        if (message != '') {
          var params = 'sender=' + sender + '&reciever=' + reciever + '&message=' + message;
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'throwmessage.php', true);
          xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //document.getElementsByClassName('output')[0].innerHTML = this.responseText;
              //alert(this.responseText);
              document.getElementById('messageBody').value = '';
            }
          }
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.send(params);
        } else {
          alert('can\'t send empty message!');
        }

      }

      document.getElementById('menu').onclick = function() {
        e = document.getElementsByClassName('navbar')[0];
        if (e.style.display == 'none') {
          e.style.display = 'flex';
        } else {
          e.style.display = 'none';
        }
      }
      document.body.onload = function() {
        openPage('default', this, '');
        document.getElementsByClassName('chatContainer')[0].style.display = 'none';
      }

      function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].style.backgroundColor = "";
        }
        if (pageName == 'default') {
          document.getElementById(pageName).style.display = "flex";
          document.getElementById("default").click();
        } else {
          document.getElementById(pageName).style.display = "block";

          document.getElementById("default").click();
        }
      }
      document.getElementById('logout').onclick = function() {
        document.getElementsByClassName('logout')[0].style.display = 'block';
      }
      document.getElementById('noLogout').onclick = function() {
        document.getElementsByClassName('logout')[0].style.display = 'none';
      }

      document.getElementById('yesLogout').onclick = function() {
        var xhttp = new XMLHttpRequest();
        xhttp.open('GET', 'logout.php', true);
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            location.href = 'index.htm';
          }
        }
        xhttp.send();
      }
      window.onclick = function(e) {
        if (e.target == document.getElementsByClassName('logout')[0]) {
          document.getElementsByClassName('logout')[0].style.display = 'none';
        }
      }

      setInterval(loadBadges, 2300);

      function loadBadges() {
        //alert('hihi');
        var users = document.getElementsByClassName('userlink');
        for (var i = 0; i < users.length; i++) {
          var badge = users[i].getElementsByClassName('badge')[0];
          var st = users[i].getElementsByClassName('status')[0];
          //alert(stata.title);
          var badgeId = badge.parentElement.id;
          updateBadge(badgeId, badge, st);
          //if (badge.innerHTML.length > 1) {badge.innerHTML = badge.innerHTML[0];}
        }
      }

      function updateBadge(user, element, stat) {
        var xhr = new XMLHttpRequest();
        var http = new XMLHttpRequest();
        xhr.open('GET', 'updateBadge2.php?user=' + user, true);
        xhr.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == '0') {
              element.innerHTML = '';
            } else {
              element.innerHTML = this.responseText;
            }
          }
        }
        xhr.send();

        http.open('GET', 'active.php?user=' + user, true);
        http.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != 'online') {
              stat.style.display = 'none';
            } else {
              stat.style.display = 'inline';
            }
          }
        }
        http.send();
      }
    </script>
  </body>

  </html>
<?php
}
?>
