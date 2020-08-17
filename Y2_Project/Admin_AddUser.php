 <!DOCTYPE html>
 <html>
 <head>
 <title> Add User </title>
	<link rel="stylesheet" href="./StyleSheet.css">
		<script type='text/javascript'> function confirmFunction(){alert("User added!");} </script>
		<script type='text/javascript'> function errorFunction(){alert("Issue adding this user");} </script>
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

	<div id="rectangleContainer">
		<div id="rectangle">
			<div class="btnHomepage">
				<br/>
				<img src="./Images/btnHome.png" alt="Homepage Logo" width="75" height="75" onclick=Redirect()>
			</div>		
			<h1>Welcome to The Add User Page!</h1>
			<h2>Use this page to add new users!</h2>
		</div>
	</div>
	
<?php	
session_start();


if($_SESSION['Valid'] == "No")
	{
	
	header( 'Location: ./LogIn2.php' );
	}


include './DBConnect.php';



if($_SESSION['UA']=="Admin")
{
echo"
<script>
function Redirect(){
	
	window.location.href='./Admin_HomePage.php';
}
</script>
";
}	

if($_SESSION['UA']=="User")
{
echo"
<script>
function Redirect(){
	
	window.location.href='./HomePage.html';
}
</script>
";
}
if($_SESSION['UA']=="SuperUser")
{
echo"
<script>
function Redirect(){
	
	window.location.href='./Super_HomePage.php';
}
</script>
";
}	

	if(!$mySQLconnection){
							echo"<script>DBConnectError(); </script>";
							//exit();
						 }else{
						   mysql_select_db($database, $mySQLconnection);
						   
						   if(!mysql_select_db($database, $mySQLconnection))
						   {
							echo"<script>ConnectionFailed();</script>";
							exit();
						   }else{
									echo"
									<div class='AddUserContainer'>
										<form name='AddUser' method='post' action=''>			
											<div class='AddUserLeftCol'>
												<label for='Username'>Username:</label><br /><br />
												<label for='Password'>Password:</label><br /><br />
												<label for='Forename'>Forename:</label><br /><br />
												<label for='MiddleName'>Middle Name:</label><br /><br />
												<label for='Surname'>Surname:</label><br /><br /><br />
												<label for='Gender'>Gender:</label><br /><br />
												<label for='UserLevel'>User level:</label><br /><br />
											</div>
				
											<div class='AddUserRightCol'>
												<input type='text' name='Username' placeholder='Your Username..' maxlength='20' required />
												<input type='text' name='Password' placeholder='Your password..' maxlength='20' required />
												<input type='text' name='Forename' placeholder='Your name..' maxlength='20' required />
												<input type='text' name='MiddleName' placeholder='Leave blank if none..' maxlength='20' />
												<input type='text' name='Surname' placeholder='Your surname..' maxlength='20'  required />
												<select name='Gender' placeholder='Male' required>
													<option value='Male'>Male</option>
													<option value='Female'>Female</option>
													<option value='Other'>Other</option>
												</select>
												<select name='UserLevel' placeholder='User' required>
													<option value='User'>User</option>
												</select>
											</div>
											
											<div class='AddUserRow'>
												<input type='Submit' name='AddUserBtn' value='Save' />
											</div>
										</form>		
									</div>
									";
						   
					 
									if(isset($_POST['AddUserBtn']))
									{
										$Username = $_POST['Username'];
										$Password = $_POST['Password'];
										$Forename = $_POST['Forename'];
										$MiddleName = $_POST['MiddleName'];
										$Surname = $_POST['Surname'];
										$Gender = $_POST['Gender'];
										$UserLevel = $_POST['UserLevel'];
																			
										$addsql = "INSERT INTO tbl_users(userName, userPass, forename, midname, surname, gender, accessLevel) VALUES ('$Username','$Password','$Forename','$MiddleName','$Surname','$Gender','$UserLevel')";
										
										$result = mysql_query($addsql);
										
										if(!$result)
										{
											echo"
											<script type='text/javascript'>
												errorFunction();
											</script>
											";											
										}else{
																			
											echo"
											<script type='text/javascript'>
												confirmFunction();
											</script>
											";
										}
									}
								}
							}
							
							
?>	
	
</body>
</html>
