function ReSzNav(){
    if (window.innerWidth>600) {
        document.getElementById("NvBrCnt").style="visibility :visible;";
        document.getElementById("HdNav").style="visibility: hidden";
    }
    else{
        document.getElementById("NvBrCnt").style="visibility :hidden;";
        document.getElementById("HdNav").style="visibility: hidden";
    }
}

function expNav(){
    document.getElementById("NvBrCnt").style="visibility :visible;";
    document.getElementById("HdNav").style="visibility: visible";
}

function comNav(){
    document.getElementById("NvBrCnt").style="visibility: hidden;";
    document.getElementById("HdNav").style="visibility: hidden;";
}


function checkLogo(){
    leftImageWidth=document.getElementById("leftImage").offsetWidth;
    leftImageHeigth=document.getElementById("leftImage").offsetHeight;

    if(leftImageHeigth<leftImageWidth){
        document.getElementById("clglogo").style="width:auto;height:80%;";
    }
    else{
        document.getElementById("clglogo").style="width:80%;height:auto;";
    }
}

function resolvePanel(){
    windowWidth=window.innerWidth;
    
    if(windowWidth>600)
    {
        document.getElementById("mainTab").style="height :auto;";
        ROH=document.getElementById("rightOptions").offsetHeight;
        LIH=document.getElementById("leftImage").offsetHeight;
        str="height: ";
        if(ROH<LIH){
            str1=str+LIH+"px;";
            document.getElementById("mainTab").style=str1;
        }
        else{
            str2=str+ROH+"px;";
            document.getElementById("mainTab").style=str2;
        }
    }
}

function ShowError(errMessage){
    document.getElementById('err').style="visibility:visible; width:100%; height:100%;";
    document.getElementById('errbox').innerHTML=errMessage;
}

function hideErr(){
    document.getElementById("err").style.visibility="hidden";
}

/*function getSem(){
    presentSem=<?php $SEM = $_SESSION['varname3']; echo $SEM; //varname3=semester number?>;
            
    if(presentSem==1){
        document.getElementById("cgpa").style="display:none";

        document.getElementById("cgpat").style="display:none";

        document.getElementById("submit").value="Next";
    }
    for(i=presentSem;i<9;i++){
        document.getElementById("sem"+i).style="display:none";

        document.getElementById("semt"+i).style="display:none;";
    }
}*/