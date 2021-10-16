<?php session_start();
require 'connect.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
     #btn{position: absolute; padding: 10px; height: 50px; border: 0; background: green;}
    </style>
  </head>
  <body>

<?php
$_SESSION['reciever'] = $_GET['user'];

$sqlu = "UPDATE messages SET status = 'read' WHERE sender = '".$_SESSION['reciever']."' AND reciever = '".$_SESSION['user']."'";

if($conn->query($sqlu)){
if (isset($_SESSION['reciever'])) {
  $sender = $_SESSION['user'];
  $reciever = $_SESSION['reciever'];
$sql = "SELECT * FROM messages WHERE sender = '".$sender."' AND reciever = '".$reciever."'
 OR sender = '".$reciever."' AND reciever = '".$sender."'";
$result = $conn->query($sql);
?>
    <div class="messages">
<?php
}
}else{
?>
<script>alert('not working');</script>
<?php
}
?>
</div>
  <form id="myForm" method="post">
  <textarea placeholder="message!" id="message" name="message" cols="45" style="display: inline;background: lightgray;" required></textarea>
  <input type="hidden" id="sender" name="sender" value="<?php echo $sender; ?>" required/>
  <input type="hidden" id="reciever" name="reciever" value="<?php echo $reciever; ?>" required/>
  <input type="submit" id="btn" style="" value="SEND"/>
  </form>
  <div class="output"></div>
<script>
  loadMessages();
  var id = setInterval(loadMessages, 3000);

  document.getElementById('message').onkeyup = function(event){
  if (event.keyCode === 13) {
    event.preventDefault();
    throwMessage();
    loadMessages();
  }
 }
  document.getElementById('myForm').onsubmit = function(e) {
    e.preventDefault();
    throwMessage();
  }

  function throwMessage(){
      var message = document.getElementById('message').value;
      var sender = document.getElementById('sender').value;
      var reciever = document.getElementById('reciever').value;
      var params = 'sender='+sender+'&reciever='+reciever+'&message='+message;

      if (message != '') {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'throwmessage.php', true);
        xhr.onreadystatechange = function(){
          if (this.readyState == 4 && this.status == 200) {
            //document.getElementsByClassName('output')[0].innerHTML = this.responseText;
            //alert(this.responseText);
            document.getElementById('message').value = ''; 
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(params);
      }else{
        alert('can\'t send empty message!');
      }

  }


  function loadMessages(){
    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'as_message.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
        document.getElementsByClassName("messages")[0].innerHTML = this.responseText;
      }
    }
    xhttp.send();
  }

</script>
  </body>
</html>
