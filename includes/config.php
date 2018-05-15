<?php 
	ob_start(); //output buffering

	$timezone = date_default_timezone_set("America/Monterrey");
	$con = mysqli_connect("localhost", "root","","SpotifyMe");
	if(mysqli_connect_errno()){
		echo "Failed to connect: " .mysqli_connect_errno();
	}

 ?>