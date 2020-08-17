<!doctype html>
<html>
<head>
<title> ERC CC Profile </title>

<link rel="stylesheet" href="./StyleSheet.css">

<script type='text/javascript'> function ConfirmFunction(){alert("Profile Updated");} </script>
<script>function Refresh(){ alert("User Amended"); window.location.href='./Profile.php';}</script>
<script type='text/javascript'> function DBConnectError(){alert("An error occured while trying to connect to the database");} </script>
		<script type='text/javascript'> function ConnectionFailed(){alert("Conenction to the database failed");} </script>
		<script> function sqlerror(){alert("SQL Error");}</script>
<script>
		function ErrorScript(){
			alert("Gender must be set to Male, Female or Other (case sensitive)");
			
		}
	</script>
	
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
			<div class="btnHomepage">
			<br/>
				<img src="./Images/btnHome.png" alt="Homepage Logo" width="75" height="75" onclick=Redirect()>
				
			</div>
		<h1>Your Profile</h1>
		
		<h2>Use This Page to Check or Change Your Details</h2>
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

<div class="ProfileContainer">
<table class="ProfileTbl">
<tr>
<th>Forename</th><th>MiddleName</th><th>Surname</th><th>Gender</th>
</tr>

<?php
$host= "79.170.40.235";

$pass = "G/Jcz3b!s";
$database ="cl22-codeclub";
$table = "tbl_users";
$connect = mysqli_connect('79.170.40.235','cl22-codeclub','G/Jcz3b!s');


if(!$connect){
							echo"<script>DBConnectError(); </script>";
							
						 }else{
						   mysqli_select_db($connect, $database);
						   
						   if(!mysqli_select_db($connect, $database))
						   {
							echo"<script>ConnectionFailed();</script>";
							exit();
						   }else{
							   $sql = "select `forename`, `midname`, `surname`, `gender`  from ".$table." where `userID` = ".$_SESSION['UID'].";";
							   $result = mysqli_query($connect, $sql);
							   $row = mysqli_fetch_array($result);
							   
							   
							if(isset($_POST['id'])){
							
							
							if($_POST['Gender']== "Male")
									{
										$valid = true;
									}else{
										if($_POST['Gender']== "Female")
										{
											$valid= true;
										}else{
											if($_POST['Gender']== "Other"){
												$valid = true;
											}else{
												
												$valid = false;
											echo"
											<script>
											 ErrorScript();
											</script>
											";
											}
										}
									}
							
							while ($valid== true)
									{
							
							$sql = "select `forename`, `midname`, `surname`, `gender`  from ".$table." where `userID` = ".$_POST['id'].";";
							$result = mysqli_query($connect, $sql);
							$row = mysqli_fetch_array($result);
							
							
							    
								

							$updatesql = "UPDATE tbl_users SET forename='$_POST[Forename]', midname='$_POST[Midname]', surname='$_POST[Surname]', gender='$_POST[Gender]' WHERE userID='$_POST[id]'";
							$updateresult = mysqli_query($connect, $updatesql);
							
							    
							if(!$updateresult)
							{
								echo"<script>sqlerror();</script>";
								
							}else{
								 echo"
								 <script type='text/javascript'>
								 ConfirmFunction();
								 </script>";
								 echo"
								<script>
									function Refresh();
								</script>		
									";
							
								}
	
								$valid = false;
								}
								
							}
							//end of updates
							   
								$sql= "select `userID`, `forename`, `midname`, `surname`, `gender` from `".$table."` where `userID` = ".$_SESSION['UID'].";";
								$result = mysqli_query($connect, $sql);
																				
								
								while($row = mysqli_fetch_array($result)){
									
									echo"
									<tr><form name='update' action='./Profile.php' method='post'>
									<input type='hidden' name='id' value='".$row['userID']."' />
									<td><input type='text' name='Forename' size='4' value='".$row[1]."' required /></td>
									<td><input type='text' name='Midname' size='4' value='".$row[2]."' /></td>
									<td><input type='text' name='Surname' size='4' value='".$row[3]."' required /></td>
									<td><input type='text' name='Gender' size='4' value='".$row[4]."' required /></td>
									<td><input type='submit' value='Update' name='profUpdate'/></td>
									</form>
									</tr>
										
									";
									}
							}
						 }

?>
</table>
</div>
	
	

	

	

<body>
</html>