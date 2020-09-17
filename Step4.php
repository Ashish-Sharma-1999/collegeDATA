<?php
    session_start();
    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName     = 'collegeDATA';
        
    //Create connection and select DB
    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName) or die("<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Error connecting to MySQL server.</div></div>");
   // echo $rolli;
    $roll = $_SESSION['varname1'];
    if(mysqli_connect_errno()){ 
        echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Connection ERROR found!</div></div>";
    }
    else{
        if(isset($_POST["submit"])){
            // $rolli = $_POST["RollNo"]
            $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName) or die("<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Error connecting to MySQL server.</div></div>");
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            $check1 = getimagesize($_FILES["image1"]["tmp_name"]);
            $check2 = getimagesize($_FILES["image2"]["tmp_name"]);
            $check3 = getimagesize($_FILES["image3"]["tmp_name"]);
            if($check !== false && $check1 !== false && $check2 !== false && $check3 !== false){
                $image = $_FILES['image']['tmp_name'];
                $image1 = $_FILES['image1']['tmp_name'];
                $image2 = $_FILES['image2']['tmp_name'];
                $image3 = $_FILES['image3']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));
                $imgContent1 = addslashes(file_get_contents($image1));
                $imgContent2 = addslashes(file_get_contents($image2));
                $imgContent3 = addslashes(file_get_contents($image3));

                /*
                * Insert image data into databasp0-=
                */
                $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
                if($db->connect_error){
                    die("<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>Connection failed: ". $db->connect_error."</div></div>");
                }
                //echo $roll;
                $dataTime = date("Y-m-d H:i:s");
                $rowResult= $db->query("SELECT * from `images` where `RollNo` ='$roll'");
                $num=mysqli_num_rows($rowResult);
                //echo $num.'</br>';
                //$rowResult = mysqli_query($conn,"SELECT * from `images` where RollNo ='$roll'");
                if ($num>0) 
                {
                    $query = "DELETE from `images` where RollNo='$roll'";
                    if(mysqli_query($conn,$query)){
                        if(mysqli_query($conn,"INSERT into images (RollNo,image,image1,image2,image3,created) VALUES ('$roll','$imgContent','$imgContent1','$imgContent2','$imgContent3','$dataTime')")){
                            header("Refresh:0;url=Last.php");
                        }      
                        else{
                            echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>File upload failed, please try again</div></div>";
                        }
                    }
                }
                else{
                    $insert = $db->query("INSERT into images (RollNo,image,image1,image2, image3,created) VALUES ('$roll','$imgContent','$imgContent1','$imgContent2','$imgContent3','$dataTime')");
        
                    if($insert){
                        header("Refresh:0;url=Last.php");
                    }
                    else{
                        echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>connection failed due to some error </br> Please try after some time</div></div>"; 
                    }
                } 
            }
            else{
                echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>one or more fields are empty</div></div>";
            }
        }
    }
?>

<!DOCTYPE html>
<html><head>
    <title>
    Registration Page 4
</title>
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
<body>

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
    <form action="Step4.php" method="POST" enctype="multipart/form-data">
        <center><h1><b>Upload Files</b></h1></center>
        <div class="uploadbox">
            Select Bank Receipt to upload :
            <input type="file" name="image">
        </div>

        <div class="uploadbox">
            Upload Your Sign : 
            <input type="file" name="image1">
        </div>

        <div class="uploadbox">
            Upload Parent's Sign : 
            <input type="file" name="image2">
        </div>

        <div class="uploadbox">
            Upload Your Photo : 
            <input type="file" name="image3">
        </div>

        <!--<input type="text" name="RollNo">-->
        <center>
            <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary submit">
        </center>
    </form></fieldset>
</div>
</div>


<div id="err"><div id="errbox" onclick="hideErr()"></div></div>
        <div class="ftr">   
            Copyright © CCET Degree Wing. All Rights Reserved | Contact Us: +91 90000 00000
        </div>

</body>
</html>
