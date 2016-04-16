<?php
	session_start();
	if (isset($_SESSION['islogin']) && $_SESSION['islogin'])  
	{
		header("Location: landing.php");
		exit();
	}
	if(isset($_POST["submit"]))
	{	
		if(isset($_SESSION["formid"]) == $_POST["formid"])
		{
			$_SESSION["formid"]='';
			unset($_SESSION["formid"]);
			$id = $_POST["username"];
			$pass = $_POST["password"];

		/*spelling of connection variable is $con NOT $conn !!!!!!*/
			$con = mysqli_connect("localhost","root","","login");

		/*spelling of connection variable is $con NOT $conn !!!!!!*/
			if (!$con)
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		/* escape characters for double quotes because we are sending strings!!*/
			$sql = "SELECT id, pass FROM users WHERE id LIKE \"".$id."\" AND pass LIKE \"".$pass."\"";
		/*spelling of connection variable is $con NOT $conn !!!!!!*/
			$result = mysqli_query($con, $sql);

			if (mysqli_num_rows($result) == 1)
			{
		/*spelling of connection variable is $con NOT $conn !!!!!!*/
			    mysqli_close($con);
				$_SESSION["islogin"]=1;
				$_SESSION["username"]=$id;
			    header("Location: landing.php");
			    exit();
			}
			else 
			{	
		/*spelling of connection variable is $con NOT $conn !!!!!!*/
				mysqli_close($con);
			    $_SESSION["error"]=" Either Username or Password is incorrect!";
			    header("Location: login.php");
			    exit();
			}
		}
	} 
	else 
	{
		$_SESSION["formid"]=md5(rand(0,99999999));

	 ?>
<html>
	<head>
		<title>LOGIN</title>
	</head>
	<body>
	<div id="error">
		<?php 
			if(isset($_SESSION["error"]))
			{	echo $_SESSION["error"];
				unset($_SESSION["error"]);
			}
		?>
	</div>
		<form action="login.php" method="POST">
			<input type="hidden" name="formid" value="<?php echo $_SESSION["formid"]; ?>">
			Username : <input type="text" name="username">
			<br><br>
			Password : <input type="password" name="password">
			<br><br>
			<input type="submit" name="submit" value="submit">
		</form>
	</body>
</html>
<?php } ?>