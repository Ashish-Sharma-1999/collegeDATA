<?php
session_start();
$_SESSION['varname1']='';
$_SESSION['varname2']='';
$conn = mysqli_connect("localhost","root","","collegeDATA");
if(mysqli_connect_errno())
{
	echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>connection failed due to some error </br> Please try after some time</div></div>";
}
else
{
	if(isset($_POST['submit']))
	{
		if(empty($_POST['RollNo'] || $_POST['Password']))
		{
			echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>one or more fields are empty</div></div>";
//header("Refresh:0;url=FieldsError.php");
		}
		else
		{
			$rolno=$_POST['RollNo'];
			$pas=$_POST['Password'];
			$as = substr($pas,0,30);
			//$count=strlen($pas);
			//echo "</br>";

			/*echo $rolno."</br>";
			
			echo $pas."</br>";
			echo $count."</br>";
			echo $as;*/

			$rowResult = mysqli_query($conn,"SELECT * from `LoginIn` where RollNo ='$rolno' && Password ='$as'");
			if (mysqli_num_rows($rowResult)>0) {
				$_SESSION['varname1'] = $rolno;
				$_SESSION['varname2'] = $as;
				$updateQuery = "UPDATE `LoginIn` SET Active=1 where RollNo='$rolno'";
				if(mysqli_query($conn,"UPDATE `LoginIn` SET Active='1' where RollNo='$rolno'")){
				echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()' style='background-color:rgb(0,0,255);'>Login Successfully</div></div>";
				header("Refresh:1; url=Step1.php");
			}
				else{
					echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>There is some problem while updating the data</div></div>";
				}

			}
			else
			{
				echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Not a Valid User</div></div>";
			}
		}

	}
}
mysqli_close($conn);
?>







<!DOCTYPE html>

<html>

<head>

	<title>Login</title>

	
        
	<!-- latest compiled and minified css -->
 
       <link rel="stylesheet" href="bootstrap/bootstrap_/css/bootstrap.min.css" type="text/css">
 
       
 
       <!-- linking Stylesheet-->
   
     <link rel="stylesheet" href="style/Index.css" type="text/css"/>

   

     
        <!--jquery Library -->
     
   <script type="text/javascript"  src="bootstrap/bootstrap_/js/jquery-3.3.1.min.js">
    
    </script>
        
    

    <!-- latest compiled and minified JavaScript -->
     
   <script type="text/javascript" src="bootstrap/bootstrap_/js/bootstrap.min.js">
  </script>
        
	<meta name="viewport" content="width=device-width , initial-scale=1">
  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js">
	</script>

	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>	

	<script type="text/javascript" src="script/navbar.js"></script>

	<script>
	 function encrypt()
	{
        var pass=document.getElementById('password').value;
		var hide=document.getElementById('hide').value;

		if(pass=="")
		{
		   ShowError('Error:Password is missing');
		   return false;
		}
		else
		{
		   	document.getElementById("hide").value=document.getElementById("password").value;
		   	var hash=CryptoJS.MD5(pass);
		   	document.getElementById("password").value=hash;
		  	return true;
		}

	}
	        
	</script>

</head>

<body  onresize="ReSzNav(),checkLogo()" onload="resolvePanel(),checkLogo()">
<div id="HdNav" onclick="comNav()"></div>
        <div class="NvBrCnt" id="NvBrCnt">
            <ul class="NvBr">
                <li class="NvBrLt" id="HmBtn">
                    <a href="home.php" id="active">Home</a>
                </li>
                <li class="NvBrRt" id="NvHd">
                    <span class="glyphicon glyphicon-align-justify" onclick="expNav()"></span>
                </li>
                <li class="NvBrRt">
                    <a href="AboutUs.html"><span class="glyphicon glyphicon-align-justify"></span> About Us</a>
                </li>
                <li class="NvBrRt">
                    <a href="ContactUs.html"><span class="glyphicon glyphicon-earphone"></span> Contact Us</a>
                </li>
            </ul>
        </div>

    <div id="bgimg" style='background-image:url("images/ccet1.png");'></div>

<center><h1 id="pageName">THE GENERIES</h1></center>


<div id="mainTab">
<div id="leftImage"><center>
	<img src="images/ccet logo.png" id="clglogo"></center>
</div>
<div class="rightOptions" id="rightOptions">
<div class="loginlog">
	<fieldset>
	<form action="LoginPage.php" method="POST">          
        	<center><h1><b>LOGIN</b></h1></center>
        	<center>
            <div class="form-group">
              	<input type="text" class="form-control" name="RollNo" placeholder="Enter Your Roll No" id="formselect">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="Password" placeholder="Enter Your Password" id="password" value="" id="formselect">
	     	</div>

			<input type="hidden" name="hide" id="hide" /> <br>
			<center><input type="submit" name="submit" value="Login" onclick="return encrypt()" class="btn btn-primary submit">
        	</center>
        </center>
    	
	</form>
	</fieldset>
</div>
</div>	
</div>
<div id="err"><div id="errbox" onclick="hideErr()"></div></div>
        <div class="ftr">   
       		Copyright © CCET Degree Wing. All Rights Reserved | Contact Us: +91 90000 00000
        </div>
	</body>
</html>
