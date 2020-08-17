 <!DOCTYPE html>
 <html>
 
 <head>
 
	<title> Download </title>
	
	<link rel="stylesheet" href="./StyleSheet.css">
	<script type='text/javascript'> function DBConnectError(){alert("An error occured while trying to connect to the database");} </script>
	<script type='text/javascript'> function ConnectionFailed(){alert("Conenction to the database failed");} </script>	
	<script> function sqlerror(){alert("SQL Error");}</script>
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
		<h1>Welcome to The Download Page!</h1>
		<h2>Use this page to Download files!</h2>
		</div>
	</div>
<div class='DownloadContainer'>
<div class='DonwloadInput'> 
<?php	
session_start();
$database = "cl22-codeclub";
$table = "tbl_users";
$connect = mysqli_connect('79.170.40.235','cl22-codeclub','G/Jcz3b!s');


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

if(!$connect)
	{
		echo"<script>DBConnectError();</script>";
	}else
		{
			mysqli_select_db($connect, $database);
			if(!mysqli_select_db($connect, $database))
			{
			echo"<script>ConnectionFailed(); </script>";
			exit();
			}
			else
				{
				echo "Choose Files to Access: <br />
					<form name='dirchoice' method='post' action='./Admin_Download.php'>
					<input type='radio' name='dirchoice' id='dirmine' value='Mine' required />
					<label for='dirmine'>My Files</label>
					<input type='radio' name='dirchoice' id='dirall' value='All' required />
					<label for='dirall'>Challenges</label>
					<input type='radio' name='dirchoice' id='dirmembers' value='Members' required />						<label for='dirmembers'>Club Members</label>
					<br/ >
					<input type='submit' name='dirselect' value='Select' />
					</form>";

if (isset($_POST['dirselect']))
{
	$directory = $_POST['dirchoice'];
	if ($directory == "Mine")
	{
		$sql = "select * from ".$table." where `userID` = ".$_SESSION['UID'].";";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
		if (!$result)
		{
			echo "<script>sqlerror();</script>";
					
		}
		else
		{
		$forename = $row[3];
		$surname = $row[5];
		$dir = "./Saves/".$_SESSION['UID']."_".$forename."_".$surname."/"; //finish off this string with database user id pull
		}
		$files = array_diff(scandir($dir), array('.', '..')); // adding files in the chosen directory to an aray, removes first two results
	echo "<table>";
	$i = 1;
	
	foreach ($files as $item)
	{
		if ($i == 1)
		{
			echo "<tr>";
		}
		echo "<td>";
		echo "<a href='".$dir.$item."' download><button>".$item."</button></a>";
		echo "</td>";
		$i++;
		if ($i >=6)
		{
			echo "</tr>";
			$i = 1;
		}
	}
	echo "</table>";
		
	}
	
	
	if ($directory == "All")
	{
		$dir = "./Saves/All/" ;
		$files = array_diff(scandir($dir), array('.', '..')); // adding files in the chosen directory to an aray, removes first two results
	echo "<table>";
	$i = 1;
	
	foreach ($files as $item)
	{
		if ($i == 1)
		{
			echo "<tr>";
		}
		echo "<td>";
		echo "<a href='".$dir.$item."' download><button>".$item."</button></a>";
		echo "</td>";
		$i++;
		if ($i >=6)
		{
			echo "</tr>";
			$i = 1;
		}
	}
	echo "</table>";
		
	}
	
	
	
	if($directory == "Members")
	{
		
		
		$dir ="./Saves/";
		$dirarray = glob($dir. "*");
		echo "	<form name = 'directlocate' action='./Admin_Download.php' method='post'>
				<label for='folderselect'>Select Folder</label>
				<input type='hidden' name='dirchoice' value='Members' />
				<select name='folderselect' required />";
				foreach ($dirarray as $item)
				{
					$location = substr($item, 8);
					echo "<option value='".$item."/'>".$location."</option>";
				}
				
				echo "</select><br/><br />
					  <input type='submit' name='SelectBtn' value='Select' />
					  </form>";
		if(isset($_POST['SelectBtn']))
		{
			$ChosenFolder = $_POST['folderselect'];
			$directory = $_POST['dirchoice'];
			if(isset($ChosenFolder))
			{
				$files = array_diff(scandir($ChosenFolder), array('.', '..'));
				echo "<div class='fileselectdiv'>";
				echo "<table>";
				$i = 1;
				foreach ($files as $item)
						{
							if ($i == 1)
								{
									echo "<tr>";
								}
								echo "<td>";
								echo "<a href='".$ChosenFolder.$item."' download><button>".$item."</button></a>";
								echo "</td>";
								$i++;
								if ($i >=6)
								{
									echo "</tr>";
									$i = 1;
								}								
						}
				echo "</table>";
			}else{
				echo"pleb";
			}
		
		}
	}
	
	 
}
}
}

?>
</div></div>
	
</body>

</html>
