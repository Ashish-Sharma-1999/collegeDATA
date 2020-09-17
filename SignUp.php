

<?php // this is from aayushi

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $conn = mysqli_connect("localhost","root","","collegeDATA");
    $connn = mysqli_connect("localhost","root","","collegeDATA");
    //$adminLogin = ""
    if(mysqli_connect_errno()){
        echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>connection falled</div></div>";

    }else{
    if(isset($_POST['submit'])){
        if($_POST['Password'] == $_POST['CPassword'])
        {    
            $rollNoo = $_POST['RollNo'];
            $result = mysqli_query($conn,"SELECT * from SignUp where RollNo= '$rollNoo'");
            $rows = mysqli_num_rows($result);
            if($rows>0){
                echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>You have already logged in with same Roll Number</div></div>";
            }
            else{
                $stmt = $conn->prepare("INSERT INTO `SignUp` (`RollNo`, `Name`, `Password`, `FName`, `MName`, `emailId`, `Phone`, `UID`, `Category`, `Gender`) VALUES (?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("ssssssiiss",$_POST['RollNo'],$_POST['Name'],$_POST['Password'],$_POST['FName'],$_POST['MName'],$_POST['emailId'],$_POST['Phone'],$_POST['UID'],$_POST['Category'],$_POST['Gender']);//$stmt->bind_param("ss",$_POST['roll'],$_POST['name']);
                $stmt4logintable = $connn->prepare("INSERT into `LoginIn` (`RollNo`, `Password`, `emailId`) values (?,?,?)");
                $stmt4logintable->bind_param("sss",$_POST['RollNo'],$_POST['Password'],$_POST['emailId']);
                if($stmt->execute() && $stmt4logintable->execute())
                {
                    echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()' style= 'background-color:rgb(0,0,255);'>SUCCESS</div></div>";
                }
                else{
                    echo "<div id='err' style='visibility: visible'><div id='errbox' onclick='hideErr()'>UNSUCCESSFUL</div></div>";
                }
            }
        }
    }
}

?>





<!DOCTYPE html>

    <html>
    
        <head>
    
            <title>Sign Up</title>

    
        <!-- latest compiled and minified css -->
 
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
       
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js">
    </script>

    <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>         

    <script type="text/javascript" src="script/navbar.js"></script>

<script>
 function encrypt()
{
    var cpass=document.getElementById('Cpassword').value;
    var chide=document.getElementById('chide').value;
    var pass=document.getElementById('password').value;
    var hide=document.getElementById('hide').value;
            
    if(pass.localeCompare(cpass) || pass=="")
    {
        ShowError('Error:Confirm Password not matching');
        document.getElementById('Cpassword').style="color:red";
        document.getElementById('password').style="color:red";
        return false;
    }
    else
    {
        document.getElementById("hide").value = document.getElementById("password").value;
        var hash = CryptoJS.MD5(pass);
        document.getElementById('password').value=hash;

        document.getElementById("chide").value = document.getElementById("Cpassword").value;
        var hash2 = CryptoJS.MD5(cpass);
        document.getElementById("Cpassword").value = hash2;
        return true;
    }
}
function checkFilled(){
    var rollno=document.getElementById('rollno').value;
    var name=document.getElementById('name').value;
    var email=document.getElementById('email').value;
    var pass=document.getElementById('password').value;
    var cpass=document.getElementById('Cpassword').value;
    var fname=document.getElementById('fname').value;
    var mname=document.getElementById('mname').value;
    var phone=document.getElementById('phone').value;
    var uid=document.getElementById('uid').value;
    var num=0;
    if(rollno==""){
        num++;
        document.getElementById('rollno').style="border-color:red";
    } 
    if(name==""){
        num++;
        document.getElementById('name').style="border-color:red";
    } 
    if(email==""){
        num++;
        document.getElementById('email').style="border-color:red";
    } 
    if(pass==""){
        num++;
        document.getElementById('password').style="border-color:red";
    }
    if(cpass==""){
        num++;
        document.getElementById('Cpassword').style="border-color:red";
    }
    if(fname==""){
        num++;
        document.getElementById('fname').style="border-color:red";
    } 
    if(mname==""){
        num++;
        document.getElementById('mname').style="border-color:red";
    } 
    if(phone==""){
        num++;
        document.getElementById('phone').style="border-color:red";
    } 
    if(uid==""){
        num++;
        document.getElementById('uid').style="border-color:red";
    } 
    
    if(num!=0)
    {
        ShowError('Error: ONE OR MORE fields are empty');
        return false;
    }
    else
    {
        return encrypt();
    }
}

    
</script>
</head>

    <body onresize="ReSzNav(),checkLogo()" onload="resolvePanel(),checkLogo()">  
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
                    <a href="SignUp.php"><span class="glyphicon glyphicon-user"></span> Sign up</a>
                </li>
                <li class="NvBrRt">
                    <a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
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
        
    <center><h1 id ="pageName">THE GENERIES</h1></center>


    <div id="mainTab" style="height: 800px">
        <div id="leftImage"><center><img id="clglogo" src="images/ccet logo.png"></center></div>

        <div class = "rightOptions" id="rightOptions">
        <fieldset>
            <form action="SignUp.php" method="POST">
        
                <center><h1><b>SIGN UP</b></h1></center>
                <center><div class="form-group">
                    <input type="text" class="form-control" name="RollNo" placeholder="Roll No" id='rollno' id="formselect">
                </div>  
                <div class="form-group">
                    <input type="text" class="form-control" name="Name" placeholder="Name" id='name' id="formselect">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="emailId" placeholder="Email Id" id='email' id="formselect">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="Password" placeholder="Password" id="password" value="" id="formselect">
                </div>
                    <input type="hidden" name="hide" id="hide" /> <br>
                <div class="form-group">
                    <input type="password" class="form-control" name="CPassword" placeholder="Confirm Password" id="Cpassword" value="" id="formselect">
                </div>   
                    <input type="hidden" name="hide" id="chide"/><br>
                <div class="form-group">
                    <input type="text" class="form-control" name="FName" placeholder="Father's Name" id='fname' id="formselect">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="MName" placeholder="Mother's Name" id='mname' id="formselect">
                </div>
                <div class="form-group">
                    <input type="int" class="form-control" name="Phone" placeholder="Contact Number" id='phone' id="formselect">
                </div>
                <div class="form-group">
                    <input type="int" class="form-control" name="UID" placeholder="UID Number" id='uid' id="formselect">
                </div>
                <div class="form-group">
                    <b>Category:</b>
                <!--<input type="text" name="General">-->
                <select name="Category" class="form-control">
                    <option value="General" selected>General</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                    <option value="OBCs">OBCs</option>
                <!--<option value="PwD">Person With Disability</option>
                <option value="Sports">Sports</option>
                <option value="J & k">J & K</option> -->
                </select>
                </div>
    
                <div class="form-group">
                    <select name="Gender" class="form-control">
                <option selected value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Transgender">Transgender</option>
                    </select>
                </div>
                </center>
                <!--<input type="text" name="Gender" placeholder="Gender">-->
                
                <center><input type="submit" name="submit" value="Upload" onclick="return checkFilled()" class="btn btn-primary submit">
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
