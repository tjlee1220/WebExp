var trialorder=new Array(4);
trialorder[1]="1";
trialorder[2]="2";
trialorder[3]="3";
trialorder[4]="4";
trialorder.sort(function() {return 0.5 - Math.random()});

var responses= "Responses:";
var reactionTime1;
var reactionTime2;
var divid;
var t;
var i=0;
var a;


/*function toggle(){
//load or unloads images
    var ele = document.getElementById(divid);
    if(ele.style.display == "block") {
            ele.style.display = "none";
      }
    else {
        ele.style.display = "block";
    }
      
}
*/
function endExp(){
  //clearTimeout(a);
  //clearTimeout(t);
   //document.getElementById('txt2').innerHTML="You're done";
   alert("You're Done");
   //jQuery('#limesurvey input:text').val(responses);
   //jQuery('#limesurvey input:submit:eq(1)').click();
}


function tooSlow(){
	//timer for trials
	//document.getElementById('txt3').innerHTML="Too Slow!";
	alert("Too Slow!");
	//responses=responses+"nr, nr, ";
	toggle();
	setTimeout("newTrial()",1000);

}

/*function newTrial(){
	document.getElementById('txt3').innerHTML="";
}*/



function startPausing(){
//basic function for running trials 
  if(i<=3){
    document.getElementById('txt').innerHTML=i+"times left";
    var r=trialorder[i];
    divid = r;
    toggle();
    reactionTime1 = new Date().getTime();
    a=setTimeout("tooSlow()",4000);
    t=setTimeout("startPausing()",5000);
    i++;
  } 
  else{
  i++
   endExp();
  }
}



function keyCatcher(e){
var evtobj=window.event? event : e //distinguish between IE's explicit event object (window.event) and Firefox's implicit.
var unicode=evtobj.charCode? evtobj.charCode : evtobj.keyCode
var actualkey=String.fromCharCode(unicode)

if (actualkey=="g"&&i<=4){
reactionTime2 = new Date().getTime() - reactionTime1;
if(reactionTime2<4000){
responses=responses+"g, ";
responses=responses + reactionTime2 +", "; 
document.getElementById('txt').innerHTML="You pressed g";
toggle();
clearTimeout(a);
clearTimeout(t);
startPausing();
}
}

if (actualkey=="h"&&i<=4){

reactionTime2 = new Date().getTime() - reactionTime1;
if(reactionTime2<4000){
responses=responses+"h, ";
responses=responses + reactionTime2 + ", ";
document.getElementById('txt').innerHTML="You pressed h"; 
toggle();
clearTimeout(a);
clearTimeout(t);
startPausing();
}
}


}
document.onkeypress=keyCatcher