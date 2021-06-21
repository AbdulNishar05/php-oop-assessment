<?php

session_start();

include_once('User.php');

$user = new User();

if(isset($_POST['login'])){
	$username = $user->escape_string($_POST['uname']);
	$password = $user->escape_string($_POST['upass']);

	$auth = $user->check_login($username, $password);

	if(!$auth){
		$_SESSION['message'] = 'Invalid username or password';
    	header('location:../index.php');
	}
	else{
		$_SESSION['user'] = $auth;
		header('location:adminpage.php');
	}
}
else{
	$_SESSION['message'] = 'You need to login first';
	header('location:../index.php');
}
?>