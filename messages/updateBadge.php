<?php session_start();
require 'connect.php';
?>

<p class="contacts">
  
   <?php

  $sqlv = "SELECT * FROM users WHERE username != '".$_SESSION['a_user']."'";
  $resultv = $conn->query($sqlv);
  while ($key = $resultv->fetch_assoc()) {
?>
<li class="userlink" id="<?php echo $key['username']; ?>" style="cursor: pointer; list-style: square;"><a><?php echo ucfirst($key['username']); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge" id=""></span></li><br>
<?php
}
?>

</p>

<script>
	setInterval(loadBadges, 1000);
	loadBadges();
	function loadBadges(){
		var users = document.getElementsByClassName('userlink');
		for (var i = 0; i < users.length; i++) {
			var badge = users[i].getElementsByClassName('badge')[0];
			badgeId = badge.parentElement.id;
			updateBadge(badgeId, badge);
			users[i].onclick = function(){
				
			}
		}}

  function updateBadge(user, element){
      var xhr = new XMLHttpRequest();
      xhr.open('GET','updateBadge2.php?user='+user, true);
      xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
             if (this.responseText.indexOf(user) != -1) {
             	element.innerHTML = this.responseText[0];
             }    
        }
      }
      xhr.send();        
    }

</script>