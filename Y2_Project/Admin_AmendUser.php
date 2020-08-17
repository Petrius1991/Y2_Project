 <!DOCTYPE html>
 <html>
 <head>
 <title> Amend User </title>
	<link rel="stylesheet" href="./StyleSheet.css">
	
	<script>function Refresh(){ alert("User Amended"); window.location.href='./Admin_AmendUser.php';}</script>
	<script type='text/javascript'> function DBConnectError(){alert("An error occured while trying to connect to the database");} </script>
		<script type='text/javascript'> function ConnectionFailed(){alert("Conenction to the database failed");} </script>
		<script> function FailedAmend(){alert("Failed to amend user");}</script>
		<script> function ConfirmAmend(){alert("User Amended");}</script>
	
</head>
<body onload=AddInfoFunction()>
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
			<h1>Amend Users</h1>
			<h2>Use This Page to Update User Details</h2>
		</div>
	</div>

<?php	
session_start();


if($_SESSION['Valid'] == "No")
	{
	
	header( 'Location: ./LogIn2.php' );
	}




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
	
	window.location.href='./HomePage.php';
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

	
?>
<div class="AmendContainer">

<table class="AmendTbl">
<tr>
<th>Username</th><th>Password</th><th>Forename</th><th>Middle Name</th><th>Surname</th><th>Gender</th>
</tr>


<?php
$host= "79.170.40.235";

$pass = "G/Jcz3b!s";
$database ="cl22-codeclub";
$table = "tbl_users";
$connect = mysqli_connect('79.170.40.235','cl22-codeclub','G/Jcz3b!s');


if(!$connect){
							echo"<script>DBConnectError(); </script>";
							//exit();
						 }else{
						   mysqli_select_db($connect, $database);
						   
						   if(!mysqli_select_db($connect, $database))
						   {
							echo"<script>ConnectionFailed();</script>";
							exit();
						   }else{
							   
							   //run updates
							   if(isset($_POST['id'])){

									$sql = "select * from ".$table." where `userID` = ".$_POST['id'].";";
									$result = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($result);

									$updateid = $_POST['id'];
									$updateusername = $_POST['Username'];
									$updatepassword = $_POST['Password'];
									$updateforename = $_POST['Forname'];
									$updatemidname = $_POST['Middlename'];
									$updatesurname = $_POST['Surname'];
									$updategender = $_POST['Gender'];
									
									$updatesql = "UPDATE tbl_users SET userName='$_POST[Username]', userPass='$_POST[Password]', forename='$_POST[Forname]', midname='$_POST[Middlename]', surname='$_POST[Surname]', gender='$_POST[Gender]' WHERE userID='$_POST[id]'";
									$updateresult = mysqli_query($connect, $updatesql);
									

									if(!$updateresult)
									{
										echo"<script>FailedAmend();</script>";
										
									}else{
										  echo"<script>ConfirmAmend();</script>";
										 echo"
											<script>
											function Refresh();
											</script>		
											";
									
									}
							   }
							   //end of updates
							   
								$sql = "select * from `".$table."`;";
								$result = mysqli_query($connect, $sql);
																				
								
								while($row = mysqli_fetch_array($result)){
									
									echo"
									<tr><form name='update' action='./Admin_AmendUser.php' method='post'>
									<input type='hidden' name='id' value='".$row[0]."' />
									<td><input type='text' name='Username' size='5' value='".$row[1]."' /></td>
									<td><input type='text' name='Password' size='5' value='".$row[2]."' /></td>
									<td><input type='text' name='Forname' size='5' value='".$row[3]."' /></td>
									<td><input type='text' name='Middlename' size='5' value='".$row[4]."' /></td>
									<td><input type='text' name='Surname' size='5' value='".$row[5]."' /></td>
									<td><input type='text' name='Gender' size='5' value='".$row[6]."' /></td>
									<td><input type='submit' value='Update' size='3' /></td>
									</form>
									</tr>
										
									";
									}
												
												
						   }
						 }
				
				
	
	
	
	
	
	
	
	
	
?>	
</table>

</div>
</body>
</html>
