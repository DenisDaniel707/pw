<?php
$connection = mysqli_connect('localhost', 'pw', 'pw');
if (!$connection){
    die("Database Connection Failed " . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'user');
if (!$select_db){
    die("Database Selection Failed " . mysqli_error($connection));
}
?>