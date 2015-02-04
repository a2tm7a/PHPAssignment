<html>
	<head>
	<title>SIGN UP</title>
	</head>
	<body>
		<?php
			session_start();
			include 'config.php';
			


			
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn) {
    			die("Connection failed: " . mysqli_connect_error());
			}
			$nameme= mysqli_real_escape_string($conn,$_POST['name']);
			$usernameme= mysqli_real_escape_string($conn,$_POST['username']);
			$passwordme= mysqli_real_escape_string($conn,$_POST['password']);
			$emailme= mysqli_real_escape_string($conn,$_POST['email']);

			$passwordhash=md5($passwordme);

			$sql="SELECT usernname FROM signup WHERE usernname='".$usernameme."'";

			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0)
			{
				echo("Username already taken");
			}
			else{




			
// Create connection
			//$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
			





			$sql = "INSERT INTO signup (name, usernname, email,password) VALUES ('$nameme','$usernameme','$emailme','$passwordhash')";

			if (mysqli_query($conn, $sql)) {
   			 	console.log("New record created successfully") ;
    			$_SESSION['username']=$usernameme;
    			$_SESSION['name']=$nameme;
    			$_SESSION['signedin']=$_POST['submit'];
    			
    			header("Location:home.php");
    			
				} else {
    				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}

				mysqli_close($conn);

			}
		?>
			
			
		
	</body>
</html>