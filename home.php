<html>
<head>
	<title>COMMENTS PAGE</title>
	<link rel="stylesheet" type="text/css" href="style_home.css">
	<script src="jquery-1.11.2.js"></script>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
</head>
<body>	
	<div class="heading">
		<form action="home.php" method="POST">
				<input type=s"text"  name="search_people" placeholder="Search By Person's Name" class="search">
				
				<input type="submit" value="SUBMIT" name="submitname">
				
				
		</form>
		<form  method="POST">
			<input type="submit" value="LOGOUT" name="logout">
		</form>
	</div>
	
	
	
	<?php session_start();
		//	echo $_SESSION['signedin'];

		if(isset($_SESSION['signedin']))
		{
			
			//$passwordme=$_POST['password'];
			include 'config.php';
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			//	if(isset($_POST['submit']))
			//{
				if (!$conn) {
    					die("Connection failed: " . mysqli_connect_error());
			
					}
				$usernameme = mysqli_real_escape_string($conn,$_SESSION['username']);
				$nameme= mysqli_real_escape_string($conn,$_SESSION['name']);
				//echo "<h1>Welcome ".$nameme." </h1>";
				?>
				<h1 align="center">WELCOME <?php echo htmlspecialchars($nameme, ENT_QUOTES, 'UTF-8'); ?></h1>

				<?php
				if(isset($_POST['logout']))
				{
					mysqli_close();
					session_unset(); 

					header("Location:login.php");
					
				}
				if(isset($_POST['search_people']))
				{
					$searchpeople = mysqli_real_escape_string($conn,$_POST['search_people']);
	
					$sql="SELECT * FROM notification where name='".$searchpeople."' order by time desc";
					$result=mysqli_query($conn,$sql);

					if(mysqli_num_rows($result)>0)
					{
						//echo "NO DATA";
				
			
						while($row=mysqli_fetch_assoc($result))
						{
							?><div >
							<?php
							echo "<hr>";
							echo htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8');
							echo "        :        ";
							echo htmlspecialchars($row["time"], ENT_QUOTES, 'UTF-8');
							echo "<br><br>";
							echo htmlspecialchars($row["mesage"], ENT_QUOTES, 'UTF-8');
							


							//echo "<hr>".$row["name"]."        :        ".$row["time"]."<br><br>";
							//echo $row["mesage"];
							?>
							</div>
							<?php
						}
							
					}
					else
						echo "NO DATA";
				}
			/*	else{
					if(isset($_POST['message']))
					{
						if (!$conn) {
	    					die("Connection failed: " . mysqli_connect_error());
			
							}
								$msg=$_POST['message'];

						$sql = "INSERT INTO notification (name, username, mesage) VALUES ('$nameme','$usernameme','$msg')";
						if (mysqli_query($conn, $sql)) {
		   				 	echo "New record created successfully";
    						//	$_SESSION['username']=$usernameme;
    						//	$_SESSION['name']=$nameme;
    				
	  	  					header("Location:home.php");
    				
							} else {
    							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}

					
					}		
			*/

					
				else{
					$sql="SELECT * FROM notification order by time asc";
					$result=mysqli_query($conn,$sql);

					if(mysqli_num_rows($result)>0)
					{
					//echo "NO DATA";
				
			
						while($row=mysqli_fetch_assoc($result))
						{
							?><div >
							<?php
							$string=$row["mesage"];
							
							echo "<hr>";
							echo htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8');
							echo "        :        ";
							echo htmlspecialchars($row["time"], ENT_QUOTES, 'UTF-8');
							echo "<br><br>";
							echo htmlspecialchars($row["mesage"], ENT_QUOTES, 'UTF-8');

							//echo $row["mesage"];
							?>
							</div>
							<?php
						}
						?><div id="comments">
						<!--	<?php

							?>-->
							</div>
							<?php
					}
					else
						echo "NODATA";
				}
		}
		else
			echo "<br>Please sign in FIRST .";
			//else
				//header("Location:login.php");
			//	{
					//echo $_POST['submit'];
			//	}			
			?>

	
	<!--<div class="third">
	hii
	</div>	-->	
		<!--	<form name="ajaxform" id="ajaxform">	-->
						<br>
						<input type="text"  name="message" placeholder="MESSAGE" class="message" align="center" id="message">
						<button value="submit" id="buttonajax">submit</button>
					<!--	<input type="submit"  name="SUBMIT"  align="center" id="buttonajax">-->

						
						<br>
		<!--	</form>	-->
		<script >
		
			function postLink()
			{
				var postData=$("#message").val();
				console.log("hii");
				$.ajax(
    			{
        			'url' : 'ajax.php',
        			'type': 'POST',
        			'dataType': "json",
        			'data' :{msg: postData},
        			success:function(data)
        			{
        				console.log(data.status);
            			//data: return data from server
            			//data=JSON.parse(data);
            			if(data.status==1)
      					{

      					//	<?php 

      					//		$dt = time();

            					//echo "<hr>";
            					//echo $nameme."        :        ".$dt->format('Y-m-d H:i:s');
								//echo postData; 
      							//document.getElementById('demo').innerHTML = 'hii';
								//echo "<hr>".$nameme."        :        ".$retime=date('Y-m-d H:i:s',$dt)."Check";
								//echo data.msg;

								
						//	?>	
							var str='<hr>'+data.name+'        :        '+data.time+'<br><br>'+data.msg;
							
							$("#comments").before(str);
									console.log(data.status);
      					}
      					else
      					{
      						//	var str='<hr>'+data.name+'        :        '+data.time+'<br><br>'+data.msg;
							//	$("#comments").after(str);
      						//	console.log("false hai dude");
      					//		console.log($usernameme.$nameme);
      					}
        			},
        			error: function(data)
        			{
            			//if fails     
            			console.log(data.status);
        			}
    			});
    		}

    		$('#buttonajax').click(function() {
    			//throw new Error("Not working");
    			console.log("asd");
       	 	postLink();
        	//event.preventDefault();
        	});

		
		

</script>
		
	</body>
</html>