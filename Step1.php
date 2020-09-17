<?php
session_start();
$var1 = 'p';
$var2 = 'p';
$conn = mysqli_connect("localhost","root","","collegeDATA");
if(mysqli_connect_errno()){
	echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>connection falled</div></div>";
}


else
{
	$var1 = $_SESSION['varname1'];
	$var2 = $_SESSION['varname2'];
if($var1=='p' || $var2=='p')
{
	echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>please login, You will be directed to Login page</div></div>";
	header("Refresh:1;url=LoginPage.php");
}
else{

	if(isset($_POST['submit']))
	{
		if(empty($_POST['RollNo'] || $_POST['Semester'] || $_POST['Branch']))
		{
			echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>one or more fields are empty</div></div>";
		}
		else
		{
			$varcheck = $_POST['RollNo'];
			//echo $var1;
			//echo "     ";
			//echo $varcheck;
			if($varcheck==$var1)
			{
				$rowResult=0;
				$rowResult=mysqli_query($conn,"SELECT * from `SemBranchR` where RollNo = '$var1'");
				if(mysqli_num_rows($rowResult)>0)//if there is already a result for same student then database needs to be updated
				{
					$temp1=$_POST['Branch'];
					$temp2=$_POST['Semester'];

					if(mysqli_query($conn,"UPDATE `SemBranchR` SET `Branch`='$temp1',`Semester`='$temp2' where RollNo='$varcheck'"))
						{
							$_SESSION['varname3'] = $temp2;//storing the branch name
							$_SESSION['varname4'] = $temp1;//store the semester
						echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()' style='background-color:rgb(0,0,255);'>Successfully Done</div></div>";
							header("Refresh:1;url=Step2.php");}
					else
						echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Please do Again</div></div>";
				}
				else//else a new entry is required
				{
					$temp1=$_POST['Branch'];
					$temp2=$_POST['Semester'];
					$stmttable = $conn->prepare("INSERT into `SemBranchR` (`RollNo`, `Branch`, `Semester`) values (?,?,?)");
					$stmttable->bind_param("sss",$_POST['RollNo'],$_POST['Branch'],$_POST['Semester']);
					if($stmttable->execute()){
						echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()' style='background-color:rgb(0,0,255);'>Successfully Done</div></div>";
						header("Refresh:1;url=Step2.php");
					}
					}
				}



				else{
					echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Please login with your roll number to continue or </br> you might be trying to fill someone else form(not allowed)</div></div>";
				}
			}
		}
	}
}
mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration form, page 1</title>

       <link rel="stylesheet" href="bootstrap/bootstrap_/css/bootstrap.min.css" type="text/css">
 
       
        <!-- linking Stylesheet-->
   
     <link rel="stylesheet" href="style/Index.css" type="text/css">

   
     
        <!--jquery Library -->
     
   <script type="text/javascript" src="bootstrap/bootstrap_/js/jquery-3.3.1.min.js">
    
    </script>
        
    
    <!-- latest compiled and minified JavaScript -->
     
   <script type="text/javascript" src="bootstrap/bootstrap_/js/bootstrap.min.js">
      
  </script>
        
        
	<meta name="viewport" content="width=device-width , initial-scale=1">

    <script type="text/javascript" src="script/navbar.js"></script>

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
                <li class="NvBrRt">
                    <a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a>
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
		<fieldset>
		<form action="Step1.php" method="POST">         
        		<center><h1><b>FILL YOUR DETAILS</b></h1></center>
        	<center>
            <div class="form-group">
              	<input type="text" class="form-control" name="RollNo" placeholder="Enter Your Roll No" value="<?php echo $_SESSION['varname1']; ?>">
            </div>
            <div class="form-group">
                <select name="Semester" class="form-control">
				<option></option>
				<option value="1" selected>First Sem</option>
				<option value="2">Second Sem</option>
				<option value="3">Third Sem</option>
				<option value="4">Fourth Sem</option>
				<option value="5">Fifth Sem</option>
				<option value="6">Sixth Sem</option>
				<option value="7">Seventh Sem</option>
				<option value="8">Eight Sem</option>	
				</select>
	     	</div>
	     	<div class="form-group">
	     		<select name="Branch"  class="form-control">
				<option value="CSE" selected>CSE</option>
				<option value="ECE">ECE</option>
				<option value="Mech">Mech</option>
				<option value="Civil">Civil</option>
				</select>
	     	</div>
			</center>	
			
			<center><input type="submit" name="submit" value="Upload" class="btn btn-primary submit">
			</center>
		</form>	
		</fieldset>
	</div>
	</div>
	
	<div id="err"><div id="errbox" onclick="hideErr()"></div></div>
    <div class="ftr">   
       		Copyright © CCET Degree Wing. All Rights Reserved | Contact Us: +91 90000 00000
    </div>
</body>
</html>
