<?php
	session_start();
	if(isset($_GET["logout"]) && $_GET["logout"])       // changed --have to check if $_GET["logout"] is set or not
	{
		$_SESSION['islogin']=0;
		unset($_SESSION['islogin']);
		$_SESSION['error']="You have logged out.";
		header("Location: login.php");
		exit();	

	}
	if (isset($_SESSION['islogin']) and $_SESSION['islogin']==1)  
	{
		echo "Hi! ".$_SESSION['username'];
	?>
	
		<a href="landing.php?logout=1">LOGOUT</a>
	<?php
	}
	else
	{
		$_SESSION['error']="Please login first";
		header("Location: login.php");
		exit();

	}
?>