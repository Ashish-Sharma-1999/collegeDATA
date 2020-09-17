<?php
session_start();
session_unset();
session_destroy();
echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()' style='background-color:rgb(0,0,255)'>Successful Logout</div></div>";

	header("Refresh:2;url=LoginPage.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Logout Page</title>
        
        <!-- linking Stylesheet-->
        <link rel="stylesheet" href="style/Index.css" type="text/css">


        <meta name="viewport" content="width=device-width , initial-scale=1"> 
        <script type="text/javascript" src="script/navbar.js"></script>
</head>
<body>
<div id="bgimg" style='background-image:url("images/ccet1.png");'></div>
<div id="err"><div id="errbox" onclick="hideErr()"></div></div>
<div class="ftr">   
	Copyright © CCET Degree Wing. All Rights Reserved | Contact Us: +91 90000 00000
</div>
</body>
</html>