 <!DOCTYPE html>
 <html>
 <head>
 <title> Log In </title>
	<link rel="stylesheet" href="./StyleSheet.css">

	<script type='text/javascript'> function alertFunction(){alert("Incorrect credentials");} </script>
	<script type='text/javascript'> function DBConnectError(){alert("An error occured while trying to connect to the database");} </script>
	<script type='text/javascript'> function ConnectionFailed(){alert("Conenction to the database failed");} </script>
 </head>
 
 <body>
 
	<div class="ERCLOGO">
	<img src="./Images/ERC_Logo.png" alt="ERC Logo" width="473" height="180">
	</div>	
	
	<div class="CCLOGO">
	<img src="./Images/CodeClub_Logo.png" alt="CodeClub Logo" width="180" height="180">
	</div>
	
	<div class="clear"></div>
	
	<div id="rectangleContainer">
		<div id="rectangle">
		<h1>Welcome to East Riding College Code Club<br/>
		Please Log In to Continue!</h1>
		</div>
	</div>
	

 

<?php
session_start();
include './DBConnect.php';


if(!$mySQLconnection){
					  echo"<script>DBConnectError(); </script>";
					
					 }else{
						   mysql_select_db($database, $mySQLconnection);
						   
						   if(!mysql_select_db($database, $mySQLconnection))
						   {
							echo"<script>ConnectionFailed();</script>";
							exit();
						   }else{
								echo"<div class='container'>
	<form name='Login' method='post' action=''> 
		<label for 'Username'>Username</label>
		</br>
		<input type='text' name='Username' required/>
		</br>
		</br>
		<label for 'Password'>Password</label>
		</br>
		<input type='password' name='Password' required />
		</br>
		</br>
		</div>
		<input type='Submit' name='LoginBtn' value='Log In' />
	</form>
	";
	
	if(isset($_POST['LoginBtn']))
	{
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	
	
	$loginsql = "SELECT userID, userName, userPass, accessLevel From `tbl_users` where userName = '".$Username."' and userPass = '".$Password."'";
	$result = mysql_query($loginsql);
		
	$row = mysql_fetch_array($result);
		
	
	 
	 $UserAccess = $row[3];
	 $UserID = $row[0];
	
	if($Username==$row['1'] && $Password==$row['2'] && $row['3']=="Admin")
	{
		$_SESSION['Valid'] = "Yes";
		$_SESSION['UID'] = $UserID;
		$_SESSION['UA'] = "Admin";
		header( 'Location: ./Admin_HomePage.php' );
	}else{
			if($Username==$row['1'] && $Password==$row['2'] && $row['3']=="SuperUser"){
				$_SESSION['Valid'] = "Yes";
				$_SESSION['UID'] = $UserID;
				$_SESSION['UA'] = "SuperUser";
		header( 'Location: ./Super_HomePage.php' );
			}else{
				if($Username==$row['1'] && $Password==$row['2'] && $row['3']=="User")
				{
					$_SESSION['Valid'] = "Yes";
					$_SESSION['UID'] = $UserID;
					$_SESSION['UA'] = "User";
					header( 'Location: ./HomePage.php' );
				}else{
		 echo"
		 <script type='text/javascript'>
		 alertFunction();
		 </script>
		 ";
				}
			}
		 }
		
	
	}

	
		
	}
						  
	}

?>	

 </body>
 </html>