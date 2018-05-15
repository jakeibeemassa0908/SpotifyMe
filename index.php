<?php 
include ("includes/config.php");

//session_destroy(); manual logout

	if (isset($_SESSION['userLoggedIn'])){
		$userLoggedIn = $_SESSION['userLoggedIn'];
	} else{
		header("Location:register.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to SpotifyMe</title>
</head>

<body>

Hello from Earth!
</body>
</html>