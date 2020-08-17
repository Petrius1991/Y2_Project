 <!DOCTYPE html>
 <html>
 <head>
 <title> Remove User </title>
	<link rel="stylesheet" href="./StyleSheet.css">
	<script type='text/javascript'> function DBConnectError(){alert("An error occured while trying to connect to the database");} </script>
	<script type='text/javascript'> function ConnectionFailed(){alert("Conenction to the database failed");} </script>
	<script> function RemoveError(){alert("Error Removing User");}</script>
	<script> function ConfirmRemove(){alert("User Removed");}</script>
	<script> function deleteConfirm(no){
	var deleteConf = confirm("Confirm delete?");
	if(deleteConf == false){
		 alert("user not deleted");
		}
		else{
			var name = "update"+no;
			
			document.forms[name].submit();
		    }
	} </script>
	
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
			<h1>Remove Users</h1>
			<h2>Use This Page to Remove Users` Details</h2>
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
							echo"<script>DBConnectError();</script>";
							
						 }else{
						   mysqli_select_db($connect, $database);
						   
						   if(!mysqli_select_db($connect, $database))
						   {
							echo"<script>ConnectionFailed();</script>";
							exit();
						   }else{
									if(isset($_POST['id']))
									{
										$sql = "select * from ".$table." where `userID` = ".$_POST['id'].";";
										$result = mysqli_query($connect, $sql);
										$row = mysqli_fetch_array($result);

										$deleteid = $_POST['id'];
										$deleteusername = $_POST['Username'];
										$deletepassword = $_POST['Password'];
										$deleteforename = $_POST['Forname'];
										$deletemidname = $_POST['Middlename'];
										$deletesurname = $_POST['Surname'];
										$deletegender = $_POST['Gender'];
										
										$deletesql = "delete from `tbl_users` where userID = '".$_POST['id']."';";
										
										
										$deleteresult = mysqli_query($connect, $deletesql);

										if(!$deleteresult)
										{	
											echo"<script>RemoveError();</script>";
										}
										else
										{
											echo"<script>ConfirmRemove();</script>";
										}				
									} 
							   
								$sql = "select * from `".$table."`;";
								$result = mysqli_query($connect, $sql);
								
								
								
								while($row = mysqli_fetch_array($result)){
									
									echo"
									
									<tr><form name='update".$row['userID']."' action='./Admin_RemoveUser.php' method='post'>
									<input type='hidden' name='id' value='".$row['userID']."' />
									<td><input type='text' name='Username' size='5' value='".$row[1]."' readonly /></td>
									<td><input type='text' name='Password' size='5' value='".$row[2]."' readonly /></td>
									<td><input type='text' name='Forname' size='5' value='".$row[3]."' readonly /></td>
									<td><input type='text' name='Middlename' size='5' value='".$row[4]."' readonly /></td>
									<td><input type='text' name='Surname' size='5' value='".$row[5]."' readonly /></td>
									<td><input type='text' name='Gender' size='5' value='".$row[6]."' readonly /></td>
									<td><input type='button' value='Remove' onclick=deleteConfirm(".$row['userID'].") /></td>
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
