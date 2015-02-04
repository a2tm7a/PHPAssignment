<?php session_start();
			
			//$passwordme=$_POST['password']
			//var_dump($_SESSION['username']);
			include 'config.php';
			
			


			$dt = time();
			$retime=date('Y-m-d H:i:s',$dt);


			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
	    					die("Connection failed: " . mysqli_connect_error());
			}

			$usernameme = mysqli_real_escape_string($conn,$_SESSION['username']);
			$nameme= mysqli_real_escape_string($conn,$_SESSION['name']);
			$msg= mysqli_real_escape_string($conn,$_POST['msg']);

			$sql = "INSERT INTO notification (name, username, mesage) VALUES ('$nameme','$usernameme','$msg')";
			
			mysqli_query($conn, $sql);
			
			$msg=htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
			$nameme=htmlspecialchars($nameme, ENT_QUOTES, 'UTF-8');
			$usernameme=htmlspecialchars($usernameme, ENT_QUOTES, 'UTF-8');
		
			$result=array("status"=>1,"msg"=>$msg,"name"=>$nameme,"time"=>$retime);
			//echo $result['status'];
		//	console.log($result['status']);
		  	echo json_encode($result);
				
				
	?>

  		 	