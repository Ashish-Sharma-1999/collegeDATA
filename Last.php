<?php
            session_start();
            $conn=mysqli_connect("localhost","root","","collegeDATA");
            if(mysqli_connect_errno())
            {
                echo "connection_aborted";
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
                $rows = mysqli_query($conn,"SELECT * from `SignUp` where RollNo = '$roll'")  or die('Error querying database.');
                if(mysqli_num_rows($rows)>0)
                {
                    $obj = mysqli_fetch_all($rows,MYSQLI_NUM);
                }

                else{
                     echo "empty results";
                }



            $rowsADD = mysqli_query($conn,"SELECT *from `AddFee` where RollNo = '$roll'") or die('Error querying database.');
            if(mysqli_num_rows($rowsADD)>0)
            {
                $objADD = mysqli_fetch_all($rowsADD,MYSQLI_NUM);
            }
            else{
                echo "empty results";
            }




            $rowsdetails = mysqli_query($conn,"SELECT * from `subranchsem` where Semester='$Sem'");
            $rowi= mysqli_num_rows($rowsdetails);
            if($rowi>0){
                $objSubCode = mysqli_fetch_all($rowsdetails,MYSQLI_NUM);
            }
            else{
                echo "empty results";
            }



            $res=mysqli_query($conn,"SELECT * FROM `Result` where RollNo='$roll'") or die('Error querying database.');
            if(mysqli_num_rows($res)>0)
            {
                $resObj = mysqli_fetch_all($res,MYSQLI_NUM);
            }
            else
                echo "empty result";
            
        }

    ?>


<!DOCTYPE html>
<html>
<head>
    <title>Last Page</title>

    <!-- latest compiled and minified css -->
 
       <link rel="stylesheet" href="bootstrap/bootstrap_/css/bootstrap.min.css" type="text/css">
 
       
 
       <!-- linking Stylesheet-->
   
     <link rel="stylesheet" href="style/Index.css" type="text/css"/>

    <link rel="stylesheet" href="style/last.css" type="text/css"/>   

     
        <!--jquery Library -->
     
    <script type="text/javascript"  src="bootstrap/bootstrap_/js/jquery-3.3.1.min.js">
    </script>
        
    

    <!-- latest compiled and minified JavaScript -->
     
    <script type="text/javascript" src="bootstrap/bootstrap_/js/bootstrap.min.js">
    </script>
        
    <meta name="viewport" content="width=device-width , initial-scale=1">
       
    <script type="text/javascript" src="script/navbar.js"></script>

</head>
<body onresize="ReSzNav()">
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
                    <a href="printout.php"><span class="glyphicon glyphicon-align-justify"></span> Print It</a>
                </li>
            </ul>
        </div>
    <div id="bgimg" style='background-image:url("images/130805054358_patshaala.jpg");'></div>

    
    
    <center><div id="lastTab">
        <table class="LastTable">
            <tr>
                <td>
                    <h1>YOUR DETAILS</h1>
                </td>
            </tr>


            <tr>
                <td style="padding: 0px;">
                <table style="width: 100%;margin: 0;">
                    <tr id="nocol">
                        <td>
                            Name:- <?php echo $obj[0][1];?> 
                        </td>

                        <td>
                            <?php echo '<img src="data:image3/jpeg;base64,'.base64_encode($objimm['image3']).'" style="width:3.5cm; height:4.5cm; float: right"/>';?>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
            
            <tr>
                <td>
                    College Roll No. :- <?php echo $_SESSION['varname1']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Branch :- <?php echo $_SESSION['varname4']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Semester :- <?php echo $_SESSION['varname3']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Session :- <?php $date = date("Y");$date1=$date+1;echo "$date to $date1";?>
                </td>
            </tr>

            <tr>
                <td>
                    UID No. :- <?php echo $obj[0][7]; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Father's name :- <?php echo $obj[0][3];?>
                </td>
            </tr>

            <tr>
                <td>
                    Mother's name :- <?php echo $obj[0][4];?>
                </td>
            </tr>

            <tr>
                <td>
                    Present Address :-<?php echo $objADD[0][1];?>
                </td>
            </tr>

            <tr>
                <td>
                    Permanent Address :- <?php echo $objADD[0][2];?>
                </td>
            </tr>

            <tr>
                <td>
                    Phone Number :- <?php echo $obj[0][6]; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Email id :- <?php echo $obj[0][5];?>
                </td>
            </tr>

            <tr>
                <td>
                    Category :- <?php echo $obj[0][8];?>
                </td>
            </tr>

            <tr>
                <td>
                    <center>
                    <?php 
                        echo "<table border =\"1\" style='border-collapse: collapse'>";
                        //echo "<div class:'row row_style col-xs-6 col-lg-5'>";
                        echo "<caption><h3>Acedemic Details</h3></caption>
                            <tr>
                                <th>Subject code</th>
                                <th>Subject Name</th>
                            </tr>";
                        for ($row=0; $row<$rowi; $row++)
                        {
                            echo "<tr> \n";
                            for ($col=2; $col <=3; $col++) 
                            {
                                echo "<td>".$objSubCode[$row][$col]."</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                        //echo"</div>";
                    ?>
                    </center>
                </td>
            </tr>

            <tr>
                <td>
                    <center>
                    <?php
                        $str="SGPA"; 
                        echo "<table border=\"1\" style='border-collapse: collapse'>\n";
                        echo "<caption><h3>Acedemic Performance </h3></caption>\n";
                        for($col=3; $col<10; $col++){
                            echo "<tr>\n
                                <th>".$str.($col-2)."</th>
                                \n<td>".$resObj[0][$col]."</td></tr>";
                        }
                        echo "<tr>
                        <th>CGPA</th>\n<td>".$resObj[0][10]."</td>\n</tr></table>";
                    ?>
                    </center>
                </td>
            </tr>

            <tr>
                <td>
                    <h4><span>
                        <h3><b>In case of any non-declaration of results, student should update the inforamtion in the result declaration.</b></h3>
                        Type of Student:<?php echo $objADD[0][4]; ?><br>
   
                        Fee Paid: <?php echo $objADD[0][5]; ?>
                        | Fee Paid on Date: <?php echo $objADD[0][7]; ?><br>
                        Amount Paid: <?php echo $objADD[0][6]; ?>
                        | Bank Receipt No: <?php echo $objADD[0][8]; ?>

                        <p>I Solemnly declare that:</p>
                        <p>1. The Information given above is correct to the best of my knowledge & I am fully responsible for any errors/wrong data.</p>
                        <p>2. Indiscipline I may be fined, expelled or rusticated for any activity subversive of the college discipline.</p>
                        <p>3. I will maintain 75% attendance in all subjects during the course of my semester as mandatory condition
                        for appearing in INTERNAL & EXTERNAL EXAMINATION. 
                        </p>
                    </span></h4>
                </td>
            </tr>

            <tr>
                <td style="padding: 0px;"> 
                    <table>
                        <tr id="nocol">
                            <td>
                                Signature Of Parent :-
            
                                <?php
                                $db = mysqli_connect("localhost","root","","collegeDATA"); //keep your db name
                                $sql = "SELECT * FROM images WHERE RollNo = '$roll'";//use $rolltemp to test
                                $sth = $db->query($sql);
                                $result=mysqli_fetch_array($sth);
                                echo '<img src="data:image2/jpeg;base64,'.base64_encode( $result['image2'] ).'" style="width:5cm; height:1.5cm;"/>';
                                ?>
                            </td>

                            <td>
                                Signature of Candidate:- <?php echo '<img src="data:image1/jpeg;base64,'.base64_encode( $result['image1'] ).'" style="width:5cm; height:1.5cm;"/>';?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div></center>

    <div class="ftr">   
        Copyright © CCET Degree Wing. All Rights Reserved | Contact Us: +91 90000 00000
    </div>
</body>
</html>