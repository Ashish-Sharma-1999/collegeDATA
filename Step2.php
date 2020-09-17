<?php 
	session_start();
	$conn = mysqli_connect("localhost","root","","collegeDATA") or die("<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Error connecting to MySQL server.</div></div>");
	$SEM=NULL;
	$bran=NULL;
	$roll=$_SESSION['varname1'];
	$SEM=$_SESSION['varname3'];
	$bran=$_SESSION['varname4'];
	if(isset($_POST['submit']))
	{
		$num;
		$required=array('SGPA1','SGPA2','SGPA3','SGPA4','SGPA5','SGPA6','SGPA7','CGPA');
		foreach ($required as $fields) {
			if(empty($_POST[$fields])){
				$num++;
			}
			# code...
		}

		if($num==7)
		{
			echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>All fields are Empty</div></div>";
		}
		else
		{
			$query3="SELECT `RollNo`FROM `Result` WHERE RollNo = '$roll'";
			$rows=mysqli_query($conn,$query3);;
			if(mysqli_num_rows($rows)>0)
			{
				$s1=$_POST['SGPA1'];
				$s2=$_POST['SGPA2'];
				$s3=$_POST['SGPA3'];
				$s4=$_POST['SGPA4'];
				$s5=$_POST['SGPA5'];
				$s6=$_POST['SGPA6'];
				$s7=$_POST['SGPA7'];
				//$s8=$_POST['SGPA8'];
				$c1=$_POST['CGPA'];
				$query4="UPDATE `Result` SET `currentSem`='$SEM',`Branch`='$bran',`RollNo`='$roll',`SGPA1`='$s1',`SGPA2`='$s2',`SGAP3`='$s3',`SGAP4`='$s4',`SGAP5`='$s5',`SGAP6`='$s6',`SGAP7`='$s7',`CGPA`='$c1' WHERE RollNo = '$roll'";
				/////add these lines in ashish code
				if(mysqli_query($conn,$query4)){
					//echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Successfully Done</div></div>";
					
					echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()' style='background-color:rgb(0,0,255)'>Successfully done</div></div>";
				header("Refresh:1;url=Step3.php");}
				///////////////////////////////////
			}
			else
			{
				$statmt = $conn->prepare("INSERT into `Result`(`currentSem`, `Branch`, `RollNo`, `SGPA1`, `SGPA2`, `SGAP3`, `SGAP4`, `SGAP5`, `SGAP6`, `SGAP7`, `CGPA`) values (?,?,?,?,?,?,?,?,?,?,?)");
				$statmt->bind_param("issdddddddd",$SEM,$bran,$roll,$_POST['SGPA1'],$_POST['SGPA2'],$_POST['SGPA3'],$_POST['SGPA4'],$_POST['SGPA5'],$_POST['SGPA6'],$_POST['SGPA7'],$_POST['CGPA']);
				if($statmt->execute()){
					//echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Successfully Done</div></div>";
					echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()' style='background-color:rgb(0,0,255);'>Successfully done</div></div>";
					header("Refresh:1;url=Step3.php");/////////also add this
				}
			}
		}
	}

	mysqli_close($conn);
	?>

<!DOCTYPE html>
<html>
<head>
	
	<title>Registration form, page 2</title>

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

    <script type="text/javascript">
    	function getSem(){
    		presentSem=<?php $SEM = $_SESSION['varname3']; echo $SEM; //varname3=semester number?>;
    		
    		if(presentSem==1){
    			document.getElementById("cgpa").style="display:none";

    			document.getElementById("cgpat").style="display:none";

    			document.getElementById("submit").value="Next";
    		}
    		for(i=presentSem;i<8;i++){
    			document.getElementById("sem"+i).style="display:none";

    			document.getElementById("semt"+i).style="display:none;";
        	}
        }
    </script>
</head>


<body onresize="ReSzNav(),resolvePanel()" onload="getSem(),resolvePanel()">
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
<div id="leftImage" style="padding: 3%">
	<fieldset>
	<form action="Step2.php" method="POST">
	<input id="btnbtn" type="button" name="Semester" value="<?php $SEM = $_SESSION['varname3']; if($SEM==NULL){ echo "xoxoxoxox";}
	else echo 'Semester: ',$SEM; //varname3=semester number?>">
	<br></form></fieldset>
	<?php
//Step2
	$bran=$_SESSION['varname4'];
	$query = "SELECT `SubCode`FROM `subranchsem` WHERE Semester = $SEM AND Branch = '$bran'";
	$query2 = "SELECT `SubName`FROM `subranchsem` WHERE Semester = $SEM AND Branch = '$bran'";
	$connnn = mysqli_connect("localhost","root","","collegeDATA") or die('Error connecting to MySQL server.');
	$connn = mysqli_connect("localhost","root","","collegeDATA") or die('Error connecting to MySQL server.');
	//$var1 = array_fill(0,12, 0);//setting the default values
	$var2;
	$var1;
	$obj = mysqli_query($connn, $query) or die('Error querying database.');
	$var1 = mysqli_fetch_all($obj,MYSQLI_NUM);///******stores the subject code*******///
	$obj2 = mysqli_query($connnn, $query2) or die('Error querying database.');
	$var2 = mysqli_fetch_all($obj2,MYSQLI_NUM);///******stores the subject name******///
	$num = mysqli_num_rows($obj);

echo "<table class='UsTable'>";
echo "<caption><h3>Acedemic Details</h3></caption><tbody>
  <tr>
    <th>Subject code</th>
    <th>Subject Name</th>";
	for ($row=0; $row<$num; $row++) {
		echo "<tr> \n";
		for ($col=0; $col <=0; $col++) {
		   echo "<td>".$var1[$row][$col]."</td>";
		   echo "<td>".$var2[$row][$col]."</td>";
		   	}
	  	    echo "</tr>";
		}
		echo "</tbody></table>";
	?>
</div>
	<!--
	<table style="width:100% ">
  <caption>Acedemic Details </caption>
  <tr>
    <th>Subject code</th>
    <th>Subject Name</th>

    <tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[0][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[0][0]; ?>">
    </td>
  </tr>
  <tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[1][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[1][0]; ?>">
    </td>
  </tr>
  <tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[2][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[2][0]; ?>">
    </td>
  </tr><tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[3][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[3][0]; ?>">
    </td>
  </tr><tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[4][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[4][0]; ?>">
    </td>
  </tr><tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[5][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[5][0]; ?>">
    </td>
  </tr><tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[6][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[6][0]; ?>">
    </td>
  </tr><tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[7][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[7][0]; ?>">
    </td>
  </tr><tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[8][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[8][0]; ?>">
    </td>
  </tr><tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //cho $var1[9][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[9][0]; ?>">
    </td>
  </tr><tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[10][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[10][0]; ?>">
    </td>
  </tr><tr>
    <td>
    	<input type="text" name="SubCode" value="<?php //echo $var1[11][0]; ?>">
    </td>
    <td>
    	<input type="text" name="SubName" value="<?php //echo $var2[11][0]; ?>">
    </td>
  </tr>
</tr>
</table>
-->


<!--now we will take the information of SGPA in a table of 2 rows and 8 columns,this info will be saved in Result table of database -->
<div class="rightOptions" id="rightOptions">
	<center>
	<img src="images/ccet logo.png" style="margin-bottom: 50px; width: 90%"></center>
	<fieldset>
		<form action="Step2.php" method="POST">
			<center>
				<h1><b>FILL YOUR DETAILS</b></h1>
				<div class="form-group" id="semt1">SGPA 1:<input type="number" class="form-control" name="SGPA1" step="any" id="sem1"/>
				</div>
				<div class="form-group" id="semt2">SGPA 2:<input type="number" class="form-control" name="SGPA2" step="any" id="sem2"/>
				</div>
				<div class="form-group" id="semt3">SGPA 3:<input type="number" class="form-control" name="SGPA3" step="any" id="sem3"/>
				</div>
				<div class="form-group" id="semt4">SGPA 4:<input type="number" class="form-control" name="SGPA4" step="any" id="sem4"/>
				</div>
				<div class="form-group" id="semt5">SGPA 5:<input type="number" class="form-control" name="SGPA5" step="any" id="sem5"/>
				</div>
				<div class="form-group" id="semt6">SGPA 6:<input type="number" class="form-control" name="SGPA6" step="any" id="sem6"/>
				</div>
				<div class="form-group" id="semt7">SGPA 7:<input type="number" class="form-control" name="SGPA7" step="any" id="sem7"/>
				</div>

				<br>
				<div class="form-group" id="cgpat"><br>CGPA<input type="number" class="form-control" name="CGPA" step="any" id="cgpa"/>
				</div>

				
				<div class="form-group" style="margin-top: 30px;margin-bottom: 100px"><center>
					<input id="submit" type="submit" name="submit" value="Enter Details" class="btn btn-primary submit"/>
				</center></div>
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
<!--<table>
	<caption></caption>
	<tr>
		<th>SGPA 1</th><TH>SGPA 2</TH><TH>SGPA 3</TH><TH>SGPA 4</TH><TH>SGPA 5</TH><th>SGPA 6</th><TH>SGPA 7</TH><TH>SGPA 8</TH>
		<TR>
			<td>
			<input type="number" name="SGPA1" step="any">
			</td>
			<td>
			<input type="number" name="SGPA2" step="any">
			</td>
			<td>
			<input type="number" name="SGPA3" step="any">
			</td>
			<td>
			<input type="number" name="SGPA4" step="any">
			</td>
			<td>
			<input type="number" name="SGPA5" step="any">
			</td>
			<td>
			<input type="number" name="SGPA6" step="any" >
			</td>
			<td>
			<input type="number" name="SGPA7" step="any" >
			</td>
			<td>
			<input type="number" name="SGPA8" step="any" >
			</td>

		</TR>
	</tr>
</table>

<hr>


<h3>CGPA  </h3><input type="number" name="CGPA" value="0" step="any"><span></span>
	
<input type="submit" name="submit" value="Enter Details">
</form>-->
<!--
<form action="test.php" method="POST">	
	<input type='hidden' name='input_name' value='<?php //echo (serialize($var1)); ?>' />
	<input type="submit" name="submit" value="click">
	</form>
-->
<!--
</fieldset>
</div>
</body>
</html>-->
