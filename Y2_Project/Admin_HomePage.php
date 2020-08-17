 <!DOCTYPE html>
 <html>
 <head>
 <?php session_start();?>
 <title> Admin Menu </title>
	<link rel="stylesheet" href="./StyleSheet.css">
	
	<div class="ERCLOGO">
	<img src="./Images/ERC_Logo.png" alt="ERC Logo" width="473" height="180">
	</div>	
	
	<div class="CCLOGO">
	<img src="./Images/CodeClub_Logo.png" alt="CodeClub Logo" width="180" height="180">
	</div>

	<div id="rectangleContainer">
		<div id="rectangle">
		<br/>
		<h1>Welcome to The Admin Homepage!</h1>
		</div>
	</div>
	
	<script> function logOutConfirm(){
	var logout = confirm("Confirm Log Out");
	if(logout == true){
						window.location.href='./LogOut.php';						
					  }
	}
	
	</script>
	
</head>
<body> 

	<br/><br/><br/>
	<div class="LeftBtnContainer" >
		<div class="BtnLeft" onclick="location.href='./Profile.php';">
			<br/>
			My Profile
		</div>
		<br/><br/><br/><br/><br/><br/>

		<div class="BtnLeft" onclick="location.href='./Admin_Upload.php';">
			<br/>
			Upload Your Work
		</div>
		<br/><br/><br/><br/><br/><br/>

		<div class="BtnLeft" onclick="location.href='./Download.php';">
			<br/>
			Download Files
		</div>
		<br/><br/><br/><br/><br/><br/>

		<div class="BtnLeft" onclick="location.href='./ParentDetails.php';">
			<br/>
			Parent Details
		</div>
	</div>

	<div class="RightBtnContainer" >
	<div class="BtnRight" onclick="location.href='./Admin_AddUser.php';">
	<br/>
	Add New User
	</div>
	<br/><br/><br/><br/><br/><br/>

	<div class="BtnRight"onclick="location.href='./Admin_AmendUser.php';">
	<br/>
	Amend User
	</div>
	<br/><br/><br/><br/><br/><br/>

	<div class="BtnRight" onclick="location.href='./Admin_RemoveFiles.php';">
	<br/>
	Remove Files
	</div>
	<br/><br/><br/><br/><br/><br/>

	<div class="BtnRight" type="button" onclick=logOutConfirm()>
	<br/>
	Log Out
	</div>
	</div>
		
<?php
//echo $_SESSION['Valid'];

if($_SESSION['Valid'] == "No")
	{
	
	header( 'Location: ./LogIn2.php' );
	}



?>
</body>
</html>
