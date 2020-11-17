<?php
    require('connect.php');
    require('PHPMailer/class.phpmailer.php');
    require('PHPMailer/class.smtp.php');
    require('PHPMailerAutoload.php');
    require('credentials.php');

    if (isset($_POST['username']) && isset($_POST['password'])){
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $verification_key = md5($_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = md5($_POST['password']);
 
        $query = "INSERT INTO `user` (username, password, email, verification_key) VALUES ('$username', '$password', '$email', '$verification_key')";
        $result = mysqli_query($connection, $query);

        //The next 30 lines of code took me 20 hours to make them work :))))
        if($result){

            $mail = new PHPMailer;
            //$mail->SMTPDebug = 4;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL;
            $mail->Password = PASS;
            //$mail->SMTPSecure = 'ssl';
            $mail->Port = 587;
            $mail->From = EMAIL;
            $mail->FromName = "Photo Site";
            $mail->addAddress($_POST['email']);
            $mail->isHTML(true);

            $mail->Subject = "Confirmation email";
            $mail->Body    = "Please verify your email address to activate your account by clicking on this link http://localhost:8888/login/verify.php?key=" . $verification_key;

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Message has been sent';
                $smsg = 'Confirmation email sent to ' . $email;
            }
        } else {
            $fmsg = 'User already exists';
        }
    }
    ?>
<html>
<head>
    <title>User Registration Using PHP & MySQL</title>
    
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
      <form class="form-signin" method="POST">
      
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <h2 class="form-signin-heading">Please Register</h2>
        <div class="input-group">
      <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>
      </form>
</div>

</body>

</html>