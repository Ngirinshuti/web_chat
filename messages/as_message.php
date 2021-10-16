<?php session_start();
require 'connect.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
     .you, .me{width: 100%;}
     .you p,  .me p{hyphens: auto; font-size: 12px; font-family: comic sans ms; font-weight: lighter;text-align: left; padding: 5px; margin: 3px; border-radius: 10px; max-width: 80%}
     .you p{background: lightgrey; font-weight: bold;}
     .me p{background: dodgerblue; font-weight: bold; color: ghostwhite;}
     .you img, .me img{border-radius: 50%;}
     .you{display: flex; justify-content: flex-start; margin: 6px;}
     .me{display: flex; justify-content: flex-end; margin: 6px;}
     .mydate, .yourdate{color: grey; font: 10px verdana; }
     .yourdate{display: flex; justify-content: flex-start;}
     .mydate{display: flex; justify-content: flex-end;}
    </style>
  </head>
  <body>

<?php
$_SESSION['reciever'] = $_POST['user_'];
if (isset($_SESSION['a_user']) and isset($_SESSION['reciever'])) {
  $sender = $_SESSION['a_user'];
  $reciever = $_SESSION['reciever'];

$sql = "SELECT * FROM messages WHERE sender = '".$sender."' AND reciever = '".$reciever."'
 OR sender = '".$reciever."' AND reciever = '".$sender."' ORDER BY date_ ASC";
$result = $conn->query($sql);
?>
<!--div class="messages" id="msgContainer"-->
<?php
while ($row = $result->fetch_assoc()) {
$sql1 = "SELECT * FROM users WHERE username = '".$row['sender']."'";
$result1 = $conn->query($sql1);
while ($row1 = $result1->fetch_assoc()) {
  if ($row['sender'] == $sender){
?>
<div class="me">
   <p><?php echo $row['body']; ?></p><img class="meimg" src="../images/<?php echo  $row1['profile_pic']; ?>" height="25" width="25" alt=""/>
</div>
<div class="mydate">
   <span class="date"><?php echo date("M j, G:i", strtotime($row['date_'])); ?></span>
</div>

<?php }else{ ?>
  <div class="you">
       <img class="youimg" src="../images/<?php echo  $row1['profile_pic']; ?>" height="25" width="25" alt=""><p><?php echo $row['body']; ?></p>

  </div>
  <div class="yourdate">
    <span><?php echo date("M j,  G:i", strtotime($row['date_'])); ?></span>
  </div>
<?php }
}
?>
<?php
}
}
?>
<!--/div-->
<!-- <script>

  document.getElementById('content').onclick = function() {
    var dates = document.getElementsByClassName('date');
    for (var i = 0; i < dates.length; i++) {
      if (date[i].style.display == 'none') {date[i].style.display = 'block';}
      else{date[i].style.display = 'none';}
    }
  }
</script> -->
</body>
</html>
