<!DOCTYPE html>
<html>
<head>
<title> ERC CC Home Page </title>

<link rel="stylesheet" href="./StyleSheet.css">
<script>
function noAccess(){	
	alert('You are not allowed to view this page, please log in to continue');
	window.location.href='./LogIn2.php';	
}
</script>

<script> function logOutConfirm(){
	var logout = confirm("Confirm Log Out");
	if(logout == true){
						window.location.href='./LogOut.php';						
					  }
	}
	
	</script>

	<div class="ERCLOGO">
	<img src="./Images/ERC_Logo.png" alt="ERC Logo" width="473" height="180">
	</div>	
	
	<div class="CCLOGO">
	<img src="./Images/CodeClub_Logo.png" alt="CodeClub Logo" width="180" height="180">
	</div>
	
	<div class="clear"></div>
	
	<div id="rectangleContainer">
		<div id="rectangle">
		<h1>Welcome to Your Homepage</h1>
		</div>
	</div>
	
	
	
</head>
<body>
<br />
<div class="btn" onclick="location.href='./Profile.php';">
</br>
My Profile
</div>


</br></br>


<div class="btn" onclick="location.href='./Upload.php';">
</br>Upload Your Work
</div>


</br></br>


<div class="btn" onclick="location.href='./Download.php';">
</br>Download Files
</div>


</br></br>


<div class="btn" type="button" onclick=logOutConfirm()>
</br>Log Out
</div>



<?php
session_start();

if($_SESSION['Valid'] == "No")
	{
	
	header( 'Location: ./LogIn2.php' );
	}








?>
</br></br></br></br>






</body>
</html>