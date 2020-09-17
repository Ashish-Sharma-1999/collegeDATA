var angle=0;

function startrotation(){
	var devloper=document.getElementsByClassName('devphotobox');
	var devdot=document.getElementsByClassName('dot');
	var devname=document.getElementById('devtextbox');
	var names=['AAYUSHI','ASHISH','ABHIJEET','ABOLI'];
	changedevname();
	startrotate();
	setInterval(changedevname,5000);
	setInterval(startrotate,5000);

function changedevname(){
	devname.innerHTML=names[angle/90];
}

function startrotate(){	
	var temp;
	for(var i=0; i<4; i++){
		temp=angle+i*90;
		temp=temp%360;
		rotate(devloper[i],temp);
		temp=temp+45;
		temp=temp%360;
		rotatedot(devdot[i],temp);
	}
	angle+=90;
	angle=angle%360;
}
}

function rotate(devdiv,theeta)
{
	var hite=100;
	var wdth=100;
	var radius=100;
	var rotatid=setInterval(rotat,10);
function rotat() {
	var rad=theeta*Math.PI/180;
	if(theeta>180)
		diff=-Math.sin(rad)*25;
	else
		diff=0;
	hite=wdth=100+diff*2;
	radius=hite;
	var x=(150-diff)+Math.cos(rad)*radius;
	var y=(150-diff)+Math.sin(rad)*radius;
	
	y=y-diff*Math.sin(rad);
	x=x-diff*Math.cos(rad);

	devdiv.style="top: "+y+"px;left: "+x+"px; height: "+hite+"px; width: "+wdth+"px;";
	theeta++;
	theeta%=360;
	if(theeta%90==0)
		clearInterval(rotatid);
}
}

function rotatedot(devdiv,theeta)
{
	var radius=140;
	var rotatid=setInterval(rotat,10);
function rotat() {
	var rad=theeta*Math.PI/180;
	diff=-7;
	radius=100+diff*2;
	var x=(190-diff)+Math.cos(rad)*radius;
	var y=(190-diff)+Math.sin(rad)*radius;
	
	y=y-diff*Math.sin(rad);
	x=x-diff*Math.cos(rad);

	devdiv.style="top: "+y+"px;left: "+x+"px;";
	theeta++;
	theeta%=360;

	if((theeta+45)%90==0)
		clearInterval(rotatid);
}
}