  var currentUser = document.getElementById('currentUserValue').value;
  var activeUser = document.getElementsByClassName('userlink');

  for (var i = 0; i < activeUser.length; i++) {
    activeUser[i].onmouseover = function() {
      //alert(this.id);
    }
    activeUser[i].onclick = function() {
    document.getElementById('chat').style.display='block'; 
    document.getElementById('chat').style.height='350px'; 
    currentUser = this.id;
    //alert(currentUser);
    document.getElementById('msgReciever').innerHTML = this.id;

    var xhttps = new XMLHttpRequest();
    xhttps.open('GET', 'readMessage.php?user='+this.id, true);
    xhttps.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
        //alert(this.responseText);
      }
    }
    xhttps.send();
      }
  }



 setInterval(loader, 100);
 function loader() {
 loadMessages(currentUser);
  }
document.getElementById('messageBody').onkeyup = function(event){
  if (event.keyCode === 13) {
    event.preventDefault();
    throwMessage(currentUser);
  }
 }

function loadMessages(user){
    var param = "user_="+user;
    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'as_message.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
        let element = document.getElementsByClassName("msgContainer")[0];
          element.innerHTML = this.responseText;
          element.scrollTop = 1000;
      }
    }
    xhttp.send(param);
  }

  function throwMessage(user){
     var message = document.getElementById('messageBody').value;
     var sender = document.getElementById('sender').value;
     var reciever = user;
      if (message != '') {
        var params = 'sender='+sender+'&reciever='+reciever+'&message='+message;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'throwmessage.php', true);
        xhr.onreadystatechange = function(){
          if (this.readyState == 4 && this.status == 200) {
            //document.getElementsByClassName('output')[0].innerHTML = this.responseText;
            //alert(this.responseText);
            document.getElementById('messageBody').value = ''; 
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(params);
      }else{
        alert('can\'t send empty message!');
      }

  }