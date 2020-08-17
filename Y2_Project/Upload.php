 <!DOCTYPE html>
 <html>
 <head>
 <title> Upload </title>
	<link rel="stylesheet" href="./StyleSheet.css">
<script> function confirmFunction(){alert("The file has been uploaded!");} </script>
<script type='text/javascript'> function DBConnectError(){alert("An error occured while trying to connect to the database");} </script>
<script type='text/javascript'> function ConnectionFailed(){alert("Conenction to the database failed");} </script>	
<script> function FilenameExists(){alert("A file with this name already exists");}</script>
<script> function TooLarge(){alert("File size too large");}</script>
<script> function ErrorUploading(){alert("File was not uploaded");}</script>
	
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
			<h1>Welcome to The Upload Page!</h1>
			<h2>Use this page to upload files!</h2>
		</div>
	</div>
	
<div class='UploadContainer'>
<div class='UploadInput'>
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



$host= "79.170.40.235";

$pass = "G/Jcz3b!s";
$database ="cl22-codeclub";
$table = "tbl_users";
$connect = mysqli_connect('79.170.40.235','cl22-codeclub','G/Jcz3b!s');


if(!$connect){
							echo"<script>DBConnectError(); </script>";
							
						 }else{
						   mysqli_select_db($connect,$database);
						   
						   if(!mysqli_select_db($connect, $database))
						   {
							echo"<script>ConnectionFailed();</script>";
							exit();
						   }else{
								$sql = "select `userID`, `forename`, `surname` from `".$table."` where `userID` = ".$_SESSION['UID'].";";
							    $result = mysqli_query($connect, $sql);
								$row = mysqli_fetch_array($result);
								$FileUID = $row[0];
								$FileFore = $row[1];
								$FileSur = $row[2];
								
								echo"
								<form name='fileupload' action='./Upload.php' method='post' enctype='multipart/form-data'>
								<div class='AdUplLeft'>
								<label for='filename'> File Name:</label>
								<br /><br />
								<label for='doclink'> Document:</label>
								</div>
								<div class='AdUplRight'>
								<input type='text' name='filename' required>
								<br /><br />
								<input type='file' id='doclink' name='doclink' required />
								</div>
								<br />
								<div class='UplBtn'>
								<input type='submit' name='Savebtn' value='Save' />
								</div>
								</form>
								
								";
						   } 
						 }
						   
						  
						   
					// start document upload
					if(isset($_POST['Savebtn'])){
					
					$target_dir ="./Saves/".$_SESSION['UID']."_".$FileFore."_".$FileSur."/";
						
					//checking if directory already exists	
					if (!is_dir($target_dir))
					{
						mkdir($target_dir);
					}
											
					$target_file = $target_dir.basename($_FILES["doclink"]["name"]);
					$extension = pathinfo($target_file, PATHINFO_EXTENSION);
					$Filename = $_POST['filename'].".".$extension;
					//echo $Filename;
					
					
					$target_file = $target_dir.$Filename;
					$UploadOk = 1;
					//$fileType = pathinfo($target_file, PATHINFO_EXTENSION);
					
					//check if file exists
					if(file_exists($target_file)){
						echo"<script>FilenameExists();</script>";
						$UploadOk = 0;
					}
					//check file size
					if ($_FILES["doclink"]["size"] > 51200000) {
						echo "<script>TooLarge();</script>";
						$UploadOk = 0;
					}
					// checking if $UpLoadOk is set to 0 due to an error
					if ($UploadOk == 0) {
						echo "<script>ErrorUploading();</script>";
					}else{
						
						try{
							move_uploaded_file($_FILES["doclink"]["tmp_name"], $target_file);
							echo "<script> confirmFunction();</script>";
							}
						catch(Exception $e)
						{
							echo "<script>function Exception(){alert(".$e.");}</script>";
							echo "<script> Exception();</script>";
						}
												
					}
				}


?>	
	</div>
</div>

	

</body>
</html>
