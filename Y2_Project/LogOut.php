<!doctype>
<html>

<head>
 <?php session_start();?>
	<title>Log Out</title>
</head>

<body>
<?php 
$_SESSION['Valid'] = "No";

if ($_SESSION['Valid'] == "No")
						{
							
							header( 'Location: ./LogIn2.php' );
						}
						else
						{
							echo "fucked it";
						}


?>
</body>

</html>