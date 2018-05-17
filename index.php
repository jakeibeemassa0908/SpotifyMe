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

	<div id="nowPlayingBarContainer">
		<div id="nowPlayingBar">
			<div id="nowPlayingLeft">
				
			</div>
			<div id="nowPlayingCenter">
				<div class="content playerControls">
					<div class="buttons">
						<button class ="controlButton shuffle" title="Shuffle Button">
							<img src="assets/images/icons/shuffle.png" alt="Shuffle">
						</button>
						<button class ="controlButton previous" title="Previous Button">
							<img src="assets/images/icons/previous.png" alt="Previous">
						</button>
						<button class ="controlButton play" title="Play Button">
							<img src="assets/images/icons/play.png" alt="Play">
						</button>
						<button class ="controlButton pause" title="Pause Button" style ="display:none">
							<img src="assets/images/icons/pause.png" alt="Pause">
						</button>
						<button class ="controlButton next" title="Next Button">
							<img src="assets/images/icons/next.png" alt="Next">
						</button>
						<button class ="controlButton repeat" title="Repeat Button">
							<img src="assets/images/icons/repeat.png" alt="Repeat">
						</button>
					</div> 
				</div>
				<div class ="playbackBar">
					<span class="progressTime current">0.00</span>
					<div class="progressBar">
					</div>
					<span class="progressTime remaining">0.00</span>
				</div>
			</div>
			<div id="nowPlayingRight">

			</div>
		</div>
	</div>
</body>
</html>