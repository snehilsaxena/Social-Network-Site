<?php

	include("includes/config.php");

	$token = $_REQUEST['token'];

	$select = mysqli_query($connection, "SELECT * FROM members where token='$token'");


	if( mysqli_num_rows($select)>=1 ){
		$update = mysqli_query($connection, "UPDATE members SET activated='1' where token='$token'");
		echo "You have successfully activated your account and now you can proceed to login.";
	}else{
		echo "Sorry please try again later.";
	}

	

?>