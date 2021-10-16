<?php
$conn = new mysqli('localhost', 'root', '', 'project2');

if(!isset($_SESSION['a_user'])){
?>
  <script>location.href = 'index.htm';</script>
<?php
}
?>
