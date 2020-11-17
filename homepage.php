<?php
	session_start();
?>

<html>
<head>
	
  <title>Homepage</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body>
  <?php
        if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
         {
             header("Location:Login.php");  
         }
            echo $_SESSION['use'];
            echo "<br/>";
            echo "<br/>";
            echo "<br/>";
            echo "<br/>";

            echo "<a href='logout.php'> Logout</a> "; 
  ?>



</body>
</html>