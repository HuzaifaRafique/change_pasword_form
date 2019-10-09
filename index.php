<?php
require_once('connection.php');

if(isset($_POST['submit'])){
	if(isset($_POST['username']) && !empty(trim($_POST['username']))){
		$username = $_POST['username'];
	} else {
		echo "please set username";
		die;
	}
	if(isset($_POST['password']) && !empty(trim($_POST['password']))){
		if(isset($_POST['conf_password']) && !empty(trim($_POST['conf_password']))){
			if($_POST['conf_password'] != $_POST['password']){
				echo "password n conf pass donot match";
				die;
			}
			$pass = $_POST['password'];
		} else {
			die('456');
		}
	} else {
		die('123');
	}
	$pass = password_hash($pass, PASSWORD_DEFAULT);
	$results = mysqli_query($connect, 'INSERT INTO users (username, password) VALUES ("'.$username.'", "'.$pass.'")');
	if($results){
		header('location: http://localhost/login/login.php');
	} else{
		echo mysqli_error($connect);
	}
	
}
?>

<html><head></head>
<body>
<form method='post'>
	<input type='text' name='username' value='' />
	<input type='password' name='password' value='' />
	<input type='password' name='conf_password' value='' />
	<input type='submit' name='submit' value='submit' />
</form>
<?php
/*$results = mysqli_query($connect, 'SELECT COUNT(*) as count FROM students');
if(!$results){?>
	<tr>Query Error</tr>
<?php
} else {
	$offset = 0;
	if(mysqli_num_rows($results)){
	while($row = mysqli_fetch_assoc($results)){
			$totalrec = $row['count'];
		}
	}
	
	$orderby = 'id';
	$order = 'asc';
	if(isset($_GET['orderby'])){
		$orderby = $_GET['orderby'];
	}
	if(isset($_GET['order'])){
		$order = $_GET['order'];
	}
	
	$perpage = 2;
	if(isset($_GET['page'])){
		$offset = ($_GET['page'] - 1) * $perpage;
	} else {
		$_GET['page'] = 1;
	}
	$where = "";
	if(isset($_POST['submit'])){
		if(isset($_POST['searchid'])){
			$where = " where id = ".$_POST['searchid'];
		} elseif(isset($_POST['searchfn'])){
			$where = " where firstname LIKE '%".$_POST['searchfn']."%'";
		}elseif(isset($_POST['searchln'])){
			$where = " where lastname LIKE '%".$_POST['searchln']."%'";
		}elseif(isset($_POST['searchem'])){
			$where = " where email LIKE '%".$_POST['searchem']."%'";
		}elseif(isset($_POST['searchage'])){
			$where = " where age = ".$_POST['searchage'];
		}
	}
	$results = mysqli_query($connect, 'SELECT * FROM students '.$where.' order by '.$orderby.' '.$order.' LIMIT '.$offset.', '.$perpage);
	if(mysqli_num_rows($results)){
		while($row = mysqli_fetch_assoc($results)){?>
			<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['firstname']; ?></td>
			<td><?php echo $row['lastname']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['age']; ?></td>
			<td><a href='edit.php?id=<?php echo $row['id']; ?>'>Edit</a></td>
			<td><a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a></td>
			</tr>
		<?php }
	} else {?>
		<tr>Empty Results</tr>
	<?php
	}
}
?>
<tr><a href='create.php'>Add NEw Student</a></tr>
<tr>
<?php
$totalpage = ceil($totalrec / $perpage);
if(isset($_GET['page']) && $_GET['page'] > 1){
	$abc = $_GET['page'] - 1;
	?>
<a href='http://localhost/crud?<?php echo 'orderby='.$orderby.'&order='.$order.'&page='.$abc;?>'>&laquo;</a>
<?php 
}
for($i=1; $i <= $totalpage; $i++){
	if($_GET['page'] == $i){
		echo $i;
	} else {
		?>
		<a href='http://localhost/crud?<?php echo 'orderby='.$orderby.'&order='.$order.'&page='.$i;?>'><?php echo $i; ?></a>
		<?php
	}
}
if(isset($_GET['page']) && $_GET['page'] < $totalpage){
	$abc = $_GET['page'] + 1;
	?>
<a href='http://localhost/crud?<?php echo 'orderby='.$orderby.'&order='.$order.'&page='.$abc;?>'>&raquo;</a>
<?php
}?>
</tr>
</tbody>
</table>*/
?>
</body>
</html>