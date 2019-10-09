<?php
require_once('connection.php');
session_start();
if(!isset($_SESSION['name'])){
	header('location: login.php');
	exit();
}
if(isset($_POST['logout'])){
	session_destroy();
	header('location: login.php?msg=logout successfully');
	exit();
}
if(isset($_POST['update'])){
	if(isset($_POST['newpass']) && !empty(trim($_POST['newpass']))){
		if(isset($_POST['confpass']) && !empty(trim($_POST['confpass']))){
			if($_POST['newpass'] != $_POST['confpass']){
				echo "password n conf pass donot match";
				die;
			}
			$newpass = $_POST['newpass'];
			$npass = password_hash($newpass, PASSWORD_DEFAULT);
		} else {
			die('confirm password error');
		}
	} else {
		die('New password error');
	}
	$name = $_SESSION['name'];
	if(isset($_POST['oldpass']) && !empty(trim($_POST['oldpass']))){
		$pass = $_POST['oldpass'];
		$sql = $sql = 'SELECT * from users WHERE username = "'.$name.'"';
	
		 $results = mysqli_query($connect, $sql);
		if($results){
			if(mysqli_num_rows($results)){
				while($row = mysqli_fetch_assoc($results)){
					$hashpass = $row['password'];
					if(password_verify($pass, $hashpass)){
						$sql = "UPDATE users SET password = '$npass' WHERE username = '".$name."'";
						$change = mysqli_query($connect, $sql);
						echo 'password changed successfully';
					} else {
						echo "password doesn't match";
					}
				}
			} else {
				echo "username is incorrect";
			}
		} else {
			echo mysqli_error($connect);
		}
	}
}
echo "welcome ".$_SESSION['name'];
?>

<form method='post' action='#'>
	<input name='logout' type='submit' value='Logout' />
</form>

<form method='post' action='#'>
	<input type='password' name='newpass' />
	<input type='password' name='confpass' />
	<input type='password' name='oldpass' />
	<input name='update' type='submit' />
</form>
	<?php
/*if(isset($_GET['id'])){
	$id = $_GET['id'];
	if(isset($_POST['submit'])){
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$email = $_POST['email'];
		$age = $_POST['age'];
		$sql_update = 'UPDATE students SET firstname="'.$fname.'", lastname="'.$lname.'", email="'.$email.'", age='.$age.' WHERE id = '.$id;
		if(mysqli_query($connect, $sql_update)){
			header('location: http://localhost/crud/');
			exit();
		} else{
			echo mysqli_error($connect);
		}
	}
	$sql = 'SELECT * FROM students where id = '.$id;
	$results = mysqli_query($connect, $sql);
	
	if($results){
		if(mysqli_num_rows($results)){
			while($row = mysqli_fetch_assoc($results)){?>
			<form method='post' action='#'>
			<input type='text' value=<?php echo $row['firstname']; ?> name='firstname' />
			<input type='text' value=<?php echo $row['lastname']; ?> name='lastname' />
			<input type='text' value=<?php echo $row['email']; ?> name='email' />
			<input type='number' value=<?php echo $row['age']; ?> name='age' />
			<input name='submit' type='submit' />
			</form>
		<?php }
		} else {
			die('456');
			header('location: http://localhost/crud/');
			exit();
		}
	} else {
		echo mysqli_error();
	}
} else {
	die('asda');
	header('location: http://localhost/crud/');
	exit();
}*/
