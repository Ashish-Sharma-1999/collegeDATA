
<?php
session_start();
$conn = mysqli_connect("localhost","root","","collegeDATA");
if(mysqli_connect_errno())
{
    echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>connection failed due to some error </br> Please try after some time</div></div>";
}
else
{
    if(isset($_POST['submit']))
    {
        $required = array('TempAdd','Phone','PermAdd','StuType','Fee','Amount','DOP','RecpNum');
        $error= false;
        foreach ($required as $fields) {
            if(empty($_POST[$fields]))
            {
                $error = true;
                break;
            }
        }
        if($error)
        {
            echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>one or more fields are empty</div></div>";
        }
        else
        {
            $roll = $_SESSION['varname1'];
            $TempAdd=$_POST['TempAdd'];
            $PermAdd=$_POST['PermAdd'];
            $Phone=$_POST['Phone'];
            $StuType=$_POST['StuType'];
            $Fee=$_POST['Fee'];
            $Amount=$_POST['Amount'];
            $DOP = $_POST['DOP'];
            $RecpNum=$_POST['RecpNum'];
            echo "hello";

            $query="SELECT * FROM `AddFee` where RollNo = '$roll'";
            $rows=mysqli_query($conn,$query);
            if(mysqli_num_rows($rows)>0)
            {
                if(mysqli_query($conn,"UPDATE `AddFee` SET RollNo='$roll',TempAdd='$TempAdd',PermAdd='$PermAdd',Phone = '$Phone',StuType='$StuType',Fee='$Fee',Amount='$Amount',DOP='$DOP',RecpNum='$RecpNum' where RollNo='$roll'"))
                {
                    echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()' style='background-color:rgb(0,0,255);'>Successfully Done </div></div>";
                    header("Refresh:1;url=Step4.php");
                }
                else
                {
                    echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>connection failed due to some error </br> Please try after some time</div></div>";         
                }
            }
            else
            {
                $stmnt=$conn->prepare("INSERT into `AddFee` (`RollNo`,`TempAdd`,`PermAdd`,`Phone`,`StuType`,`Fee`,`Amount`,`DOP`,`RecpNum`) values(?,?,?,?,?,?,?,?,?)");
                $stmnt->bind_param("sssissdsi",$roll,$_POST['TempAdd'],$_POST['PermAdd'],$_POST['Phone'],$_POST['StuType'],$_POST['Fee'],$_POST['Amount'],$_POST['DOP'],$_POST['RecpNum']);
                if($stmnt->execute())
                {
                    echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()' style='background-color:rgb(0,0,255);'>Successfully Done </div></div>";
                    header("Refresh:1;url=Step4.php");
                }
                else
                {
                    echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>connection failed due to some error </br> Please try after some time</div></div>";
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
    <title>Registration Page 3</title>

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
<form action="Step3.php" method="POST">
    <center>
        <h3 style="color: white;"><b><u>Fill Your Details</u></b></h3>
    </center>
    <br>
    <center>
        <div class="form-group"><h4>Temporary Address:</h4>
            <input type="text" class="form-control" name="TempAdd" placeholder="Enter your temporary address" style="height: 60px;">
        </div>
        <div class="form-group"><h4>Permanent Address:</h4>
            <input type="text" class="form-control" name="PermAdd" placeholder="Enter your permanent address" style="height: 60px;">
        </div>
        <br>
        <div class="form-group">
            <input type="tel" name="Phone" pattern="[0-9]{10}" required class="form-control" placeholder="Enter your parent's Phone Number">
        </div>
        <br>    
        <div class="form-group" >
            <h4>Student type : 
            <input type="radio" name="StuType" value="Hostel" >  Hostel
            <input type="radio" name="StuType" value="Day Scholar" >  Day Scholar<br></h4>
        </div>        
        <div style="width: 80%; margin-left: 3%; float: left;">
            <div class="form-group" >
                <h4>Fees Paid : 
                <input type="radio" name="Fee" value="Yes" >  Yes<t>
                <input type="radio" name="Fee" value="No" >  No<br></h4>
            </div>
        </div>

        <div class="form-group">
            <h4>Date of Payment : <input type="Date" name="DOP" style="color: rgb(0,0,0) "></h4> 
        </div>   
        <br>

        <div class="form-group">
            <input type="Number" class="form-control" name="Amount" step="any" placeholder="Enter Amount of Fees Paid">
        </div>
        <br>
            
        <div class="form-group">
            <input type="text" class="form-control" name="RecpNum" placeholder="Enter Receipt Number">
        </div>
        <br>
    
        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary  active submit">
        </div>
    </center>
</div>
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