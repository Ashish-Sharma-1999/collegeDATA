<!DOCTYPE HTML>
<html>
	<head>
		<title>PrintIt</title>
		

		<link id="stylesheet" rel="stylesheet" type="text/css" href="style/printOut.css">

		<link rel="stylesheet" type="text/css" href="style/printbtn.css">


		<script>
            function loadsheet(){
            	if (navigator.userAgent.indexOf('Edge') >= 0){/* ...code for Edge.... */
					document.getElementById("stylesheet").href="style/PRINT.css";
				} 
				else {/* ...code for other browsers... */
					document.getElementById("stylesheet").href="style/printOut.css";

					if(navigator.userAgent.indexOf('Chrome')>=0){
						var tablerows=document.getElementsByClassName('preTr');
						var i;
						for(i=0;i<tablerows.length;i++)
							tablerows[i].style="height:3.5mm;";
					}
				}
            }
        </script>   
	</head>

<?php
	function PrintBox($VarStr, $MaxLen)
	{
		$VarStrLen=strlen($VarStr);
		if($VarStrLen>$MaxLen)
			$VarStrLen=$MaxLen;

		for($i=0;$i<$VarStrLen;$i++){
			if($VarStr[$i]!=' ')
				echo "<div class='Alpabt'>".$VarStr[$i]."</div>";
			else{
				echo "<div class='Alpabt'>_</div>";
			}
		}
	}

	function PrintBoxD($VarStr)
	{
		$Date=$VarStr;
		$VarStr[0]=$Date[8];
		$VarStr[1]=$Date[9];
		$VarStr[2]='/';
		$VarStr[3]=$Date[5];
		$VarStr[4]=$Date[6];
		$VarStr[5]='/';
		for($i=0;$i<4;$i++)
			$VarStr[$i+6]=$Date[$i];

		for($i=0;$i<10;$i++)
			echo "<div class='Alpabt'>".$VarStr[$i]."</div>";
	}

?>

	<body onload="loadsheet()">

		<div class="btnHldr">
			<div class="button" onclick="window.print()">PRINT</div>
			<a href="Logout.php"><div class="button">LOGOUT</div></a>
		</div>

		<?php 
        session_start();
        $conn=mysqli_connect("localhost","root","","collegeDATA");
        if(mysqli_connect_errno())
        {
            //echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>connection_aborted</div></div>";
        }
        else
        {
            $objADD;
            $objSubCode;
            $resObj;
            $roll = $_SESSION['varname1'];
            //$roll = 'co1730';//////////////////////////to test the code fill the rollno otherwise make it comment
            $query = "SELECT * FROM `images` where RollNo='$roll'";
            $objim = mysqli_query($conn,$query);
            $objimm = mysqli_fetch_array($objim);
            

        
            $Sem=$_SESSION['varname3'];
            $bran=$_SESSION['varname4'];
            $rows = mysqli_query($conn,"SELECT * from `SignUp` where RollNo = '$roll'")  or die("<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Error querying database.</div></div>");
            if(mysqli_num_rows($rows)>0)
            {
                $obj = mysqli_fetch_all($rows,MYSQLI_NUM);
            }

            else{
               // echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>empty results</div></div>";
            }



            $rowsADD = mysqli_query($conn,"SELECT *from `AddFee` where RollNo = '$roll'") or die("<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Error querying database.</div></div>");
            if(mysqli_num_rows($rowsADD)>0)
            {
                $objADD = mysqli_fetch_all($rowsADD,MYSQLI_NUM);
            }
            else{
                //echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>empty results</div></div>";
            }




            $rowsdetails = mysqli_query($conn,"SELECT * from `subranchsem` where Semester='$Sem'");
            $rowi= mysqli_num_rows($rowsdetails);
            if($rowi>0){
                $objSubCode = mysqli_fetch_all($rowsdetails,MYSQLI_NUM);
            }
            else{
                //echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>empty results</div></div>";
            }



            $res=mysqli_query($conn,"SELECT * FROM `Result` where RollNo='$roll'") or die('Error querying database.');
            if(mysqli_num_rows($res)>0)
            {
                $resObj = mysqli_fetch_all($res,MYSQLI_NUM);
            }
            //else
                //echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>empty results</div></div>";   
        }
    ?>


		<div id="RegForm">
			<img src="images/form1.png" id="RegFormBg">

			<div class="fields row1 Sem" id="Sem">
				<?php echo $_SESSION['varname3']; ?>
			</div>

			<div class="fields row1 Session" id="Session">
				<?php $date = date("Y");$date1=$date+1;echo "$date to $date1";?>
			</div>

			<div class="fields row1 ClgRollNo" id="ClgRollNo">
				<?php echo $_SESSION['varname1']; ?>
			</div>

			<div class="fields row1 Branch" id="Branch">
				<?php echo $_SESSION['varname4']; ?>
			</div>

			<div class="fields row2 UIDno" id="UIDno">
				<?php echo $obj[0][7]; ?>
			</div>

			<div class="fields row2 UniReg" id="UniReg">
				34564345
			</div>

			<div class="SPhoto" id="SPhoto">
				<img src= <?php echo '"data:image3/jpeg;base64,'.base64_encode($objimm['image3']).'"'; ?>
				/> 
			</div>

			<div class="boxPan Name SName" id="SName">
				<?php printBox($obj[0][1],22); ?>
			</div>

			<div class="boxPan Name FName" id="FName">
				<?php printBox($obj[0][3],22); ?>
			</div>

			<div class="boxPan Name MName" id="MName">
				<?php printBox($obj[0][4],22); ?>
			</div>

			<!--Address & Phone Box-->
			<div class="boxPan TAdd" id="TAdd">
				<?php printBox($objADD[0][1],46); ?>
			</div>

			<div class="boxPan PAdd" id="PAdd">
				<?php printBox($objADD[0][2],46); ?>
			</div>

			<div class="boxPan row3 SMobile" id="SMobile">
				<?php printBox($obj[0][6],10); ?>
			</div>

			<div class="fields row3 EMail" id="EMail">
				<?php echo $obj[0][5];?>
			</div>

			<div class="boxPan row4 PMobile" id="PMobile">
				<?php printBox($obj[0][6],10); ?>
			</div>

			<div class="fields row4 Category" id="Category">
				<?php echo $obj[0][8];?>
			</div>

			<?php  
				$rowno=5;
				$colno=1;
				for($row=0; $row<$rowi; $row++){
					echo '<div class="fields row'.$rowno.' col'.$colno.' sub" id="Sub1">['.$objSubCode[$row][2].']'.$objSubCode[$row][3].'</div>';
					$colno++;
					if($colno>4){
						$colno=1;
						$rowno++;
					}
				}
			?>

			<?php
				$PreSem=$_SESSION['varname3'];
				$date=date("Y");
				$date=$date-$PreSem/2+0.5;
				$date1=$date+1;

				echo "<table class='PreAcdPro'>";
				for($row=0;$row<7;$row++){
					echo "<tr class='preTr'>\n<td>$date to $date1</td>\n";
					echo "<th>".$resObj[0][$row+3]."</th>\n</tr>\n";
					if($row%2==0){
						$date=$date1;
						$date1++;
					}
				}
				echo "</table>";
			?>

			<?php
				$studType=$objADD[0][4];
				echo '<div class="fields row8 ';
				if($studType=="Hostel")
					echo 'hostel">';
				else
					echo 'day">';
				echo '<img src="images/tick.jpg"></div>';
			?>


			<div class="boxPan row9 Date" id="Date">
				<?php printBoxD($objADD[0][7]); ?>
			</div>

			<?php
				$feePaid=$objADD[0][5];
				echo '<div class="fields day ';
				if($feePaid=="Yes")
					echo 'row9">';
				else
					echo 'row10">';
				echo '<img src="images/tick.jpg"></div>';
			?>

			<div class="fields row10 AmtPd" id="AmtPd">
				<?php echo $objADD[0][6]; ?>
			</div>

			<div class="fields row10 BnkRcptNo" id="BnkRcptNo">
				<?php echo $objADD[0][8]; ?>
			</div>

			<div class="fields DT">
				<?php echo date("d/m/Y"); ?>
			</div>

			<?php
				$db = mysqli_connect("localhost","root","","collegeDATA"); //keep your db name
				$sql = "SELECT * FROM images WHERE RollNo = '$roll'";//use $rolltemp to test
				$sth = $db->query($sql);
				$result=mysqli_fetch_array($sth);
				//echo '<img src="data:image2/jpeg;base64,'.base64_encode( $result['image2'] ).'"/>';
			?>
			
			<div class="PSign" id="PSign">
				<img src= <?php echo '"data:image2/jpeg;base64,'.base64_encode($objimm['image2']).'"'; ?>
				/> 
			</div>

			<div class="SSign" id="SSign">
				<img src= <?php echo '"data:image1/jpeg;base64,'.base64_encode($objimm['image1']).'"'; ?>
				/> 
			</div>
		</div>
	</body>
</html>