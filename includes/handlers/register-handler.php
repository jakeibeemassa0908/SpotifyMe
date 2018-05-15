<?php 

function sanitizeFormPassword($inputText){
	$inputText = strip_tags($inputText);
}

function sanitizeFormUsername($inputText){
	$inputText = strip_tags($inputText); //get rid of HTML to avoid site manipulation
	$inputText = str_replace(" ", "", $inputText);  // replace all space and strip it down
	return $inputText;

}

function sanitizeFormString($inputText){
	$inputText = strip_tags($inputText); //get rid of HTML to avoid site manipulation
	$inputText = str_replace(" ", "", $inputText);  // replace all space and strip it down
	$inputText = ucfirst(strtolower($inputText)); //convert the string to lower then Uppercase the first
	return $inputText;
}

if (isset($_POST['loginButton'])) {
	//login button was pressed
}

if (isset($_POST['registerButton'])) {
	//echo "register button was pressed";
	$username = sanitizeFormUsername($_POST['username']);
	$firstname = sanitizeFormString($_POST['firstname']);
	$lastname = sanitizeFormString($_POST['lastname']);
	$em = sanitizeFormString($_POST['email']);
	$em2 = sanitizeFormString($_POST['email2']);
	$pw = sanitizeFormPassword($_POST['password']);
	$pw2 = sanitizeFormPassword($_POST['password2']);

	$account->register($username,$firstname,$lastname,$em2,$em, $pw,$pw2);
}

?>