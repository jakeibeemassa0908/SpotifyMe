<?php 
	include("includes/classes/Account.php");

	$account = new Account();

	include("includes/handlers/register-handler.php");
	//include("includes/handlers/login-handler.php");

	?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to SpotifyMe</title>
</head>
<body>
	<div id="inputContainer">
		<form id="LoginForm" action = "register.php" method="POST">
			<h2>Login to your account</h2>

			<p>
				<label for="loginUserName">Username</label>
				<input id="loginUserName" type="text" name="loginUserName" placeholder="eg. bartsimpson" required>
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" type="password" name="loginPassword" required>
			</p>

			<button type="submit" name="loginButton">Login</button>
		</form>

		<form id="registerForm" action = "register.php" method="POST">
			<h2>Create a Free Account</h2>

			<p>
				<?php echo $account->getError("Your username must be between 5 and 25 character"); ?>
				<label for="username">Username</label>
				<input id="username" type="text" name="username" placeholder="eg. bartsimpson" required>
			</p>

			<p>
				<label for="firstname"> First Name</label>
				<input id="firstname" type="text" name="firstname" placeholder="eg. bart" required>
			</p>

			<p>
				<label for="lastname">Last Name</label>
				<input id="lastname" type="text" name="lastname" placeholder="eg. Simpson" required>
			</p>

			<p>
				<label for="email">Email</label>
				<input id="email" type="email" name="email" placeholder="eg. bartsimpson@gmail.com" required>
			</p>

			<p>
				<label for="email2">Email</label>
				<input id="email2" type="text" name="email2" placeholder="eg. bartsimpson@gmail.com" required>
			</p>

			<p>
				<label for="password">Password</label>
				<input id="password" type="password" name="password" placeholder="Your password" required>
			</p>

			<p>
				<label for="password2">Confirm Password</label>
				<input id="password2" type="password" placeholder="Confirm your password"  name="password2" required>
			</p>

			<button type="submit" name="registerButton">Login</button>
		</form>
		
	</div>
</body>
</html>