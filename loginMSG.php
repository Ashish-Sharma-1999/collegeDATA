<?php
session_start();
session_unset();
session_destroy();
echo "<h4>Not a Valid User";
	header("Refresh:2;url=LoginPage.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page message</title>
</head>
<body>

</body>
</html>
