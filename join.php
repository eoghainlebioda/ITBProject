<?php
if(count($_POST)>0) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
	if(empty($_POST[$key])) {
	$message = ucwords($key) . " field is required";
	break;
	}
	}


	/* Email Validation */
	if(!isset($message)) {
	if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
	$message = "Invalid UserEmail";
	}
	}


	if(!isset($message)) {
		require_once("dbcontroller.php");
		$db_handle = new DBController();
		$query = "INSERT INTO registered_users (user_name, first_name, last_name, password, email, gender) VALUES
		('" . $_POST["userName"] . "', '" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . md5($_POST["password"]) . "', '" . $_POST["userEmail"] . "', ')";
		$result = $db_handle->insertQuery($query);
		if(!empty($result)) {
			$message = "You have registered successfully!";	
			unset($_POST);
		} else {
			$message = "Problem in registration. Try Again!";	
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>join</title>
	<meta charset="utf-8">
	<style>
		@import "css/styleSheet.css";
	</style>
</head>
<body>
			<nav>
				<ul>
					<li><a href="index.php">Home</a>		</li>
					<li><a href="shop.php">Shop</a>				</li>
					<li><a href="contactUs.php">Contact us</a>	</li>
					<li><a href="join.php">Join</a>				</li>
					<li><a href="login.php">Login</a>			</li>
				</ul>
			</nav>
	<form name="frmRegistration" method="post" action="">
		<table>
			<tr>
				<td>First Name</td>
				<td><input class="inputbox"type="text" name="firstName" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName'];?>">></input></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input class="inputbox" type="text" name="lastName" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName'];?>">></input></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input class="inputbox" type="text" name="username" value="<?php if(isset($_POST['userName'])) echo $_POST['userName'];?>"></input></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input class="inputbox" type="password" name="password"></input></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input class="inputbox" type="text" name="email"></input></td>
			</tr>
			
			<tr>
				<td>
				<input type="submit" name="submit" value="Register" class="btnRegister"></input>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>