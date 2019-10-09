<?php
require_once('connection.php');
if(isset($_GET['id'])){
	$sql = 'DELETE FROM students where id = '.$_GET['id'];
	if(mysqli_query($connect, $sql)){
		header('location: http://localhost/crud/');
	} else {
		echo mysqli_error();
	}
} else {
	header('location: http://localhost/crud/');
	exit();
}

