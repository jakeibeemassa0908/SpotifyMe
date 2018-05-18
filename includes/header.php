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
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
	<div id="main container">
		<div id="topContainer">
			<?php include ("includes/navBarContainer.php");?>
			<div id="mainViewContainer">
				<div id="mainContent">