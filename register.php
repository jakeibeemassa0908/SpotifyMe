<?php 
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name){
		if(isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to SpotifyMe</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php 
		if(isset($_POST['registerButton'])){
			echo '
				<script>
				$(document).ready(function(){
		
					$("#loginForm").hide();
		
					$("#registerForm").show();	
				});
			</script>
			';
		} else{
			echo '
				<script>
					$(document).ready(function(){
			
						$("#loginForm").show();
			
						$("#registerForm").hide();	
					});
				</script>
		';
		}
	?>
	<div id="background">
		<div id="loginContainer">
				<div id="inputContainer">
					<form id="loginForm" action = "register.php" method="POST">
						<h2>Login to your account</h2>

						<p>
							<?php echo $account->getError(Constants::$loginFailed) ?>
							<label for="loginUserName">Username</label>
							<input id="loginUserName" type="text" name="loginUserName" placeholder="eg. bartsimpson" required> 
						</p>
						<p>
							<label for="loginPassword">Password</label>
							<input id="loginPassword" type="password" name="loginPassword" required>
						</p>

						<button type="submit" name="loginButton">LOG IN</button>

						<div class="hasAccountText">
							<a href="#">
								<span id="hideLogin">Don't have an account yet? Signup here.</span>
							</a>
						</div>
					</form>

					<form id="registerForm" action = "register.php" method="POST">
						<h2>Create a Free Account</h2>

						<p>
							<?php echo $account->getError(Constants::$usernameCharacters); ?>
							<?php echo $account->getError(Constants::$usernameTaken); ?>
							<label for="username">Username</label>
							<input id="username" type="text" name="username" placeholder="eg. bartsimpson" value="<?php getInputValue('username') ?>" required>
						</p>

						<p>
							<?php echo $account->getError(Constants::$fistNameCharacters); ?>
							<label for="firstname"> First Name</label>
							<input id="firstname" type="text" name="firstname" placeholder="eg. bart" value="<?php getInputValue('firstname') ?>" required>
						</p>

						<p>
							<?php echo $account->getError(Constants::$lastNameCharacters); ?>
							<label for="lastname">Last Name</label>
							<input id="lastname" type="text" name="lastname" placeholder="eg. Simpson" value="<?php getInputValue('lastname') ?>"required>
						</p>

						<p>
							<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
							<?php echo $account->getError(Constants::$emailInvalid); ?>
							<?php echo $account->getError(Constants::$emailTaken); ?>
							<label for="email">Email</label>
							<input id="email" type="email" name="email" placeholder="eg. bartsimpson@gmail.com" value="<?php getInputValue('email') ?>"required>
						</p>

						<p>
							<label for="email2">Confirm email</label>
							<input id="email2" type="text" name="email2" placeholder="eg. bartsimpson@gmail.com" value="<?php getInputValue('email2') ?>"required>
						</p>

						<p>
							<?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
							<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
							<?php echo $account->getError(Constants::$passwordCharacters); ?>
							<label for="password">Password</label>
							<input id="password" type="password" name="password" placeholder="Your password" required>
						</p>

						<p>
							<label for="password2">Confirm Password</label>
							<input id="password2" type="password" placeholder="Confirm your password"  name="password2" required>
						</p>

						<button type="submit" name="registerButton">Signup</button>

						<div class="hasAccountText">
							<a href="#">
								<span id="hideRegister">Already have an account? Login here.</span>
							</a>
						</div>
					</form>
				</div>
			</div>
	</div>
</body>
</html>