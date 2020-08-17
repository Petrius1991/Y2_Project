 <!DOCTYPE html>
 <html>
 <head>
 <title> Amend User </title>
	<link rel="stylesheet" href="./StyleSheet.css">
	<script type='text/javascript'> function DBConnectError(){alert("An error occured while trying to connect to the database");} </script>
	<script type='text/javascript'> function ConnectionFailed(){alert("Conenction to the database failed");} </script>
	<script> function amendfailed(){alert("Failed to Amend Parent Details");}</script>
	<script> function ConfirmAmend(){alert("Details Amended");}</script>
	
	
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
			<h1>Parent Details</h1>
			<h2>Contact Details For Children's Parents or Guardians Can Be Accessed Here</h2>
		</div>
	</div>

<?php	
session_start();


if($_SESSION['Valid'] == "No")
	{
	
	header( 'Location: ./LogIn2.php' );
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

	
?>
<div class="AmendContainer">

<table class="AmendTbl">
<tr>
<th>Child Forename</th><th>Child Surname</th><th>Parent Forename</th><th>Parent Surname</th><th>Contact No.</th>
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
			   
				$sql = "select `userID`, `forename`, `surname`, `parentForename`, `parentSurname`, `parentContact` from `".$table."` where `accessLevel` = 'User';";
				$result = mysqli_query($connect, $sql);
																
				
				while($row = mysqli_fetch_array($result)){
					
					echo"
					<tr><form name='update' action='./ParentDetails.php' method='post'>
					<input type='hidden' name='id' value='".$row[0]."' />
					<td><input type='text' name='ChildForename' size='5' value='".$row[1]."' /></td>
					<td><input type='text' name='ChildSurname' size='5' value='".$row[2]."' /></td>
					<td><input type='text' name='ParentForename' size='5' value='".$row[3]."' /></td>
					<td><input type='text' name='ParentSurname' size='5' value='".$row[4]."' /></td>
					<td><input type='text' name='ContactNo' size='5' value='".$row[5]."' /></td>
					<td><input type='submit' value='Update' /></td>
					</form>
					</tr>
						
					";
					}
								
								
		   }
		 }

				
	if(isset($_POST['id'])){

	$sql = "select * from ".$table." where `userID` = ".$_POST['id'].";";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);

	$updateid = $_POST['id'];
	
	
	$updatesql = "UPDATE tbl_users SET forename='$_POST[ChildForename]', surname='$_POST[ChildSurname]', parentForename='$_POST[ParentForename]', parentSurname='$_POST[ParentSurname]', parentContact='$_POST[ContactNo]' WHERE userID='$_POST[id]'";
	$updateresult = mysqli_query($connect, $updatesql);
	

	if(!$updateresult)
	{
		echo"<script>amendfailed();</script>";
		
	}else{
		  echo"<script>ConfirmAmend();</script>";
		 echo"
			<script>
			function Refresh(){
				window.location.reload(true);
			}
			</script>		
			";
	
	}
	
	
	}
	
	
	
	
	
?>	
</table>

</div>
</body>
</html>
