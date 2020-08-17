 <!DOCTYPE html>
 <html>
 <head>
 <title> Amend User </title>
	<link rel="stylesheet" href="./StyleSheet.css">
	
	
	
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
include './DBConnect.php';

echo $_SESSION['UA'];

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



if(!$mySQLconnection){
							echo"Sorry, an error has occurred while trying to connect to the database<br/>";
							//exit();
						 }else{
						   mysql_select_db($database, $mySQLconnection);
						   
						   if(!mysql_select_db($database, $mySQLconnection))
						   {
							echo"Failed<br/>Sorry the program is unable to continue!<br/>";
							exit();
						   }else{
									echo"
										<div class='AmendContainer'>
												<!-- This form carries out the search to populate the fields in the second form -->
												<form action='' method='post'>
													<div class='AmendSearchLeftCol'>
														<label for='Search'>Search:</label><br /><br />
													</div>
													<div class='AmendSearchRightCol'>
														<input type='text' name='Searchtxt' placeholder='Search by Username'>
														<select name='SearchBy' placeholder='Username'>
															<option value='userName'>Username</option>
															<option value='forename'>Forename</option>
															<option value='midname'>Middle Name</option>
															<option value='surname'>Surname</option>
														</select>
														<input type='Submit' name='Searchbtn' value='Search'>
													</div>
													
												</form>
												
												<!-- Main form for displaying current user details -->
												<form action='' method='post'>													
													<div class='AmendLeftCol'>														
														<label for='Username'>Username:</label><br /><br />
														<label for='Password'>Password:</label><br /><br />
														<label for='Forename'>Forename:</label><br /><br />
														<label for='MiddleName'>Middle Name:</label><br /><br />
														<label for='Surname'>Surname:</label><br /><br /><br />
														<label for='Gender'>Gender:</label><br /><br />
													</div>
													
													<div class='AmendRightCol'>
														<input type='text' id='javaU' name='Username' placeholder='Username..'>
														<input type='text' name='Password' placeholder='Password..'>
														<input type='text' name='Forename' placeholder='Your name..'>
														<input type='text' name='MiddleName' placeholder='Your middle name..'>
														<input type='text' name='Surname' placeholder='Your surname..'>
														<select name='Gender' placeholder='Male'>
															<option value='Male'>Male</option>
															<option value='Female'>Female</option>
															<option value='Other'>Other</option>
														</select>
													</div>
													<div class='AmendRow'>
														<input type='Submit' value='Save'>
													</div>
												</form>
									
						   ";
						   
						   if(isset($_POST['Searchbtn']))
							   {
								   $searchby = $_POST['SearchBy'];
								   $searchvalue = $_POST['Searchtxt'];
								   //$selectsql = "SELECT userID, userName, userPass, forename, surname, midname, gender From `tbl_users` where ".$searchby."='".$searchvalue."'";
								   $selectsql = "SELECT userID, userName, userPass, forename, surname, midname, gender From `tbl_users` where ".$searchby."='".$searchvalue."'";
								   
								   $result = mysql_query($selectsql);
								   $row = mysql_fetch_array($result);					   
								   
								   $JID = $row[0];
								   $JUser = $row[1]; //$row[1];
								   $JPass = $row[2];
								   $JFor = $row[3];
								   $JMid = $row[4];
								   $JSur = $row[5];
								   $JGend = $row[6];
								   
								   echo"'".$row[0]."'";
								   echo"'".$row[1]."'";
								   echo"'".$row[2]."'";
								   echo"'".$row[3]."'";
								   echo"'".$row[4]."'";
								   echo"'".$row[5]."'";
								   echo"'".$row[6]."'";
								   
								   
								   
								   
										
								
						       }
						   }
						   
						 }
					
					
?>
	
	
</body>
</html>
