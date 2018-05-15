<?php 
	if(isset($_POST['loginButton'])){
		//Login button was pressed
		$username = $_POST['loginUserName'];
		$password = $_POST['loginPassword'];

		$result = $account-> login($username, $password);

		if($result){
			$_SESSION['userLoggedIn'] = $username; // create session variable
			header("Location:index.php");

		}

	}
 ?>