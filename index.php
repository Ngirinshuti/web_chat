<?php session_start();
if (isset($_SESSION["a_user"])) {
  header("location: friends/profile.php");
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/font-awesome-4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="css/login_signup.css">
  <?php require 'theme.php'; ?>
</head>

<body class="w3-theme-l2">
  <div class="container w3-theme-d3">
    <h1 style="text-align: center;">LOGIN</h1>
    <form action="login.php" method="post">
      <label for="username">E-mail or username</label>
      <input id="username" type="text" name="username" placeholder="Enter e-mail or username" required />
      <label for="password">Password</label>
      <div class="pwd">
        <input id="password" type="password" name="password" placeholder="Enter password" required />
        <i id="visible" onclick="showHide(this.id)" class='fa fa-eye'></i>
      </div>
      <div class="btm">
        <input type="submit" class="w3-button w3-theme-d5" name="login" value="Login" />
        <p id="signup"><span>
            <span>Have no account? </span>
            <a href="signup.php" class="w3-hover-text-theme w3-round">Signup</a>
          </span>
        </p>
      </div>
    </form>

    <?php if (isset($_GET["Error"])) { ?>
      <p id="error"><?php echo $_GET["Error"]; ?></p>
    <?php }
    if (isset($_GET["Success"])) { ?>
      <p id="success"><?php echo $_GET["Success"]; ?></p>
    <?php } ?>
  </div>
</body>
<script>
  function showHide(id) {
    var element = document.getElementById(id);
    var passwordElement = document.getElementsByName("password")[0];
    element.classList.toggle("fa-eye-slash");
    if (passwordElement.type == "password") {
      passwordElement.type = "text";
    } else {
      passwordElement.type = "password";
    }
  }
</script>

</html>