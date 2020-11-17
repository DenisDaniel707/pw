<?php

	require_once('connect.php');
	$key = $_GET['key']; //interogare, ce e dupa '?' in link
	$sql = "SELECT * FROM `user` WHERE `verification_key` = '$key'"; //verifica daca codul se gaseste in tabela si se selecteaza user-ul in caz afirmativ

	$res = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($res);
	$r = mysqli_fetch_assoc($res);
	$id = $r['id'];

	if($count == 1) {
		$usql = "UPDATE `user` SET `active` = 1 WHERE `id` = '$id'";
		$ures = mysqli_query($connection, $usql);
		if($ures){
			header('location: activated.html');
		} else {
			echo "Failed to activate account";
		}
	} else {
		echo "Key not found in database";
	}

?>