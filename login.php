<?php
    session_start();
    require_once('connect.php');
    if (isset($_POST) && !empty($_POST)){
        
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = md5($_POST['password']);

        $verify = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
        $result = mysqli_query($connection, $verify);
        $field = mysqli_fetch_assoc($result);

        $count = mysqli_num_rows($result);

        if($count == 1) {
          if($field['active'] == 1) {
            $_SESSION['username'] = $username;
          } else {
            $fmsg = "Account not activated, please click the link sent to " . $field['email'];
          }
        } else {
            $fmsg = "Invalid Username or Password";
        }
    }

    if($count && isset($_SESSION['username'])){
        $_SESSION['use'] = $username;
        header("location: homepage.php");
    }
?>

<html>
<head>
    <title>User Login Using PHP & MySQL</title>
    
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<link rel="stylesheet" href="styles.css" >

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

      <!-- <?php if(isset($smsg)){ ?><div class ="alert alert-success" role="alert"> <?php echo $smsg; ?> </div> <?php } ?> -->
      <?php if(isset($fmsg)){ ?><div class ="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div> <?php } ?>

      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Please Log in</h2>
        <div class="input-group">
      <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
        <a class="btn btn-lg btn-primary btn-block" href="register.php">Register</a>
      </form>
</div>

</body>

</html>