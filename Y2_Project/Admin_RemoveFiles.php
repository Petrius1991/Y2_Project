 <!DOCTYPE html>
 <html>
 <head>
 <title> Remove Files </title>
	<link rel="stylesheet" href="./StyleSheet.css">
	
	
	
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
			<h1>Welcome to The File Removal Page!</h1>
			<h2>Remove Saved Files</h2>
		</div>
	</div>
<div class='RemoveContainer'>
<div class='RemoveInput'>
<?php
session_start();
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

if($_SESSION['Valid'] == "No")
	{
	
	header( 'Location: ./LogIn2.php' );
	}
$directory = "Saves/";
$dirArray = glob($directory . "*");
echo "<form name='directlocate' action='./Admin_RemoveFiles.php' method='post'>
<label for='folderselect'>Choose a Directory:</label>
<select name='folderselect' required >";
foreach ($dirArray as $item)
{
	$location = substr($item, 6);
	echo "<option value='".$item."'>".$location."</option>";
}
echo "</select><br/><br />
<input type='submit' name='SelectBtn' value='Select' />
</form>";

if (isset($_POST['SelectBtn']))
{
	$ChosenFolder = "./".$_POST['folderselect']."/";
}
$files = array_diff(scandir($ChosenFolder), array('.', '..'));
echo "<div class='fileselectdiv'>";
foreach ($files as $newitem)
{
	echo "	
			<div class='formpadding'>
			<form name='removeform' action='' method='post'>
			<label for='filename'>".$newitem."</label>
			<input type='hidden' name='filename' value='".$newitem."' />
			<input type='hidden' name='folderselect' value='".$ChosenFolder."' />
			<input type='submit' name='removebtn' value='Remove' />
			</form>
			</div>
			";	
}
echo "</div>";
if(isset($_POST['removebtn']))
{
	$ChosenFolder = $_POST['folderselect'];
	
	if(isset($ChosenFolder))
	{
		//echo $ChosenFolder;
		$filename = $ChosenFolder.$_POST['filename'];
				
		try{
			unlink($filename);
			$delCheck = array_diff(scandir($ChosenFolder), array('.','..'));
			if (empty($delCheck))
			{
				rmdir($ChosenFolder);
			}
		}
		catch(exception $e)
		{
			echo "<script>function Exception(){alert(".$e.");}</script>";
			echo "<script>Exception();</script>";
		}
		
	}

}
//echo $ChosenFolder;


?>
</div></div>
</body>
</html>
