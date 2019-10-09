<?php
require_once('connection.php');
session_start();
if(isset($_GET['msg'])){
	echo $_GET['msg'];
}
if(isset($_POST['submit'])){
	$uname = $_POST['username'];
	$pass = $_POST['password'];
	
	$sql = 'Select * from users where username = "'.$uname.'"';
	
	$results = mysqli_query($connect, $sql);
	if($results){
		if(mysqli_num_rows($results)){
			while($row = mysqli_fetch_assoc($results)){
				$hashpass = $row['password'];
				if(password_verify($pass, $hashpass)){
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['name'] = $row['username'];
					header('location: welcome.php');
				} else {
					echo "password doesn't match";
				}
			}
		} else {
			echo "username is incorrect";
		}
	} else {
		echo mysqli_error();
	}
}
?>



<form method='post' action='#'>
<input id='firstname' name='username' type='text' />
<label for=''></label><input name='password' type='password' />
<input name='submit' type='submit' />

</form>
