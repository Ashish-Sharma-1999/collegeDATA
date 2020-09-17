<!DOCTYPE html>
<html>
    <head>
        <title> CCET | Chandigarh</title> 
    
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
       
        <script type="text/javascript" src="script/navbar.js"></script>
        
    </head>

    <body onresize="ReSzNav()">
        <div id="HdNav" onclick="comNav()">hello</div>
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
            <center><h1 id="pageName">THE GENERIES</h1></center>
            <center>
                <div id="banner_content">
                    <a href="developer.html" class="btn btn-danger btn-lg active">CCET DEGREE WING</a>     
                </div>
            </center>
        <div class="ftr">
            Copyright © CCET Degree Wing. All Rights Reserved | Contact Us: +91 90000 00000
        </div>
    </body>
</html>