<html>
	<head>
	<title>SIGN IN</title>
	</head>
	<body>
		<?php
			session_start();
			include 'config.php';

			
			

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn) {
    			die("Connection failed: " . mysqli_connect_error());
			}

			$usernameme= mysqli_real_escape_string($conn,$_POST['username']);
			$passwordme= mysqli_real_escape_string($conn,$_POST['password']);
			

			$sql="SELECT name FROM signup WHERE usernname='".$usernameme."' AND password='".md5($passwordme)."'" ;
			
			$result=mysqli_query($conn,$sql);
			
			if(mysqli_num_rows($result)>0)
			{
				if($row=mysqli_fetch_assoc($result))
				$nameme=$row["name"];
				$_SESSION['signedin']=$_POST['submit'];
				$_SESSION['username']=$usernameme;
    			$_SESSION['name']=$nameme;
    			//echo $_POST['submit'];
    			header("Location:home.php");
			}
			else
				echo "Wrong username or password";
			?>
		</body>
</html>