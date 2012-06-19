//Javascript Function for the first practice trial before main trial is executed
//this is a test
function trial_prac(numstims,validkeys,time,fb_time,fixation){
	this.timer=0;					//bool variable for whether or not this.timer is on. 0 - Off , 1- On
	this.rt_start;					//stores the current time at the beginning of each trial. Global because needs to be accessed by keypress function
	this.timeout;					//timeout timer
	this.next_trial;
	this.i=-1; //index of current trial
	this.numWrong = 0; //counts number of incorrect responses for the practice trial
	this.res=new Array();
	$(document).ready(function(){
		//$('#subject').val(prompt("Please Enter Your Subject Number",0));		
		//alert('Starting Trials');
		setTimeout('begin()', 1000);
	});
		
	//setup the page to begin practice task
	//Show fixation cross, run startTrial()
	this.begin = function()
	{
		alert("Before starting, you must complete a practice trial in order to ensure that you understand the task");
		$('#fixation').show();
		setTimeout("startTrial()", fixation);
	}
	
	this.startTrial = function()
	{
		/*basic function for running trials - start trial is the primary driver for the experiments - */
		$("#fixation").hide();
		this.i++; //increments at beginning of next trial.
			
		if(this.i<numstims)			//if iterator is less than the predefined number of trials.
		{
			 //document.getElementById('txt').innerHTML=i+"times left";
			 
			 //var r=trialorder[i];
			 //divid = "divids"+r;
			 //toggle();
			 $("#row_"+this.i).toggle();									//toggles any element with the id of the iterator. Idea being all elements start off hidden and are unhidden one at a time.
			 this.timer=1;													//timer is on once the image is shown. allows for keypresses to be collected
			 this.rt_start = new Date().getTime();					//stores current time
			 this.timeout=setTimeout("tooSlow()",time);			//callback to tooSlow after the number of milliseconds indicated. 
			 //this.next_trial=setTimeout("startTrial()",5000);	//the maximum amount of time allotted to each trial. @TODO This could be replaced by adding a setTimeout in tooSlow
			 
		} 
		else
		{
			// If the iterator has reached predefined number of trials. End practice, return to the start to begin main trial
			alert('End of Practice.');
			checkWrongAns();
			//If too many wrong responses, start over practice trial
			if (checkWrongAns() == true) {
				$('#practice').remove();
				$('#start_prac').remove();
				$("#instructions").show();
				$("#start_trials").show();
				
				alert("Feel free to reread the instructions and then begin the main task.");
			} else {
				begin();
				this.i =- 1;
				this.numWrong = 0;	
			}
		}
	}
	
	this.repeatTrial=function()
	{
	 //document.getElementById('txt').innerHTML=i+"times left";
			 
			 $("#fixation").hide();
			 //var r=trialorder[i];
			 //divid = "divids"+r;
			 //toggle();
			 $("#row_"+this.i).toggle();									//toggles any element with the id of the iterator. Idea being all elements start off hidden and are unhidden one at a time.
			 this.timer=1;													//timer is on once the image is shown. allows for keypresses to be collected
			 this.rt_start = new Date().getTime();					//stores current time
			 this.timeout=setTimeout("tooSlow()",time);			//callback to tooSlow after the number of milliseconds indicated. 
			 //this.next_trial=setTimeout("startTrial()",5000);	//the maximum amount of time allotted to each trial. @TODO This could be replaced by adding a setTimeout in tooSlow
	}		 
	
	
	this.tooSlow = function()
	{
		//this.timer for trials
		//document.getElementById('txt3').innerHTML="Too Slow!";
		this.timer=0;
		alert("Too Slow! Make sure you click back on the main screen after closing this otherwise it will not register keyboard clicks");
		//responses=responses+"nr, nr, ";
		$("#row_"+this.i).toggle();
		//setTimeout("newTrial()",1000);
		var y=document.getElementById("row_" + this.i).getAttribute("trialno");
		this.res.push(new result(y,'no response',-1,-1,-1));
		$("#fixation").show();
		this.next_trial=setTimeout("repeatTrial()",fixation);
	}
	
	this.is_correct=function(selected)
	{
		//In the practice trial no feedback is given
		//Each response will provide a neutral feedback
		//However if a negative response is given, the bg color will still shift to red
		
		var x=document.getElementById("row_" + this.i).getAttribute("value");
		x=eval(x);
		//var y=document.getElementById("row_" + this.i).getAttribute("trialno");
		//alert(x + '<br>' + selected + "<br>" + "Checking if " + x[selected] + "= 1");
		//alert("Completed Trial no: " + y);
		var td=$("#cell_"+ this.i + "_" + selected).parent().find('img[alt!="blank.png"]').parent().parent();
		if(x[selected]==1)
		{
			//$("#positive_feedback").toggle();
			var div=$('#neutral_feedback_div')
			
			//$("#cell_"+ this.i + "_" + selected).parent().find('img[alt!="blank.png"]').parent().parent().attr('bgColor','#00FF00');
			td.attr('bgColor', '#6D7B8D');
			//div.unhide()
			//td.append(div);
			div.clone().appendTo(td);
			setTimeout('clear()',fb_time);
			return 1;
		}
		else if(x[selected]==0)
		{
			//$("#negative_feedback").toggle();
			//$("#cell_"+ this.i + "_" + selected).parent().find('img[alt!="blank.png"]').parent().parent().attr('bgColor','#FF0000');
			var div=$('#neutral_feedback_div')
			td.attr('bgColor','#FF0000');
			//td.append(div);
			div.clone().appendTo(td);
			setTimeout('clear(true)',fb_time);
			alert("You provided an incorrect response.\n\nRemeber: \nIf the picture is YELLOW, press the LEFT ('d') key.\nIf the picutre is BLUE, press the RIGHT ('k') key.");
			this.numWrong++; //increase variable numWrong
			return 0;
		}
		else if(x[selected]==2)
		{		
			//neutral feedback
			//$("#neutral_feedback").toggle();
			var div=$('#neutral_feedback_div')
			//$("#cell_"+ this.i + "_" + selected).parent().find('img[alt!="blank.png"]').parent().parent().attr('bgColor','#0000FF');
			td.attr('bgColor','#6D7B8D');
			//td.append(div);
			div.clone().appendTo(td);
			setTimeout('clear()',fb_time);
			return 2;
		}
		else if(x[selected]==3)
		{
			//nofeedback
			clear();
			return 3;
		}
		
	}
	
	//clears the page in preparation for next stimuli 
	this.clear = function(repeat)
	{
		var td=$("td[id^='cell_"+this.i +"']").parent().find('img[alt!="blank.png"]').parent().parent();
		td.attr('bgColor','#FFFFFF');
		td.find('div[name="feedback"]').remove();
		$("#row_"+this.i).toggle();
		$("#fixation").show();
		if(!repeat) var repeat=false;
		if (repeat==false)	setTimeout('startTrial()',fixation);
		else setTimeout('repeatTrial()',fixation);
	}
	
	//Deals with keys pressed
	//Makes sure that they key pressed is a valid key
	this.keypress = function(e){
	
	//function keyCatcher(e){
		var rt_trial=new Date().getTime() - this.rt_start;			//calculates reaction time immediately. dismisses if keypress is invalid.
		validkeys=eval(validkeys);	//@TODO need to make this array dynamic
		var evtobj=window.event? event : e; 										//distinguish between IE's explicit event object (window.event) and Firefox's implicit.
		var unicode=evtobj.charCode? evtobj.charCode : evtobj.keyCode;
		var actualkey=String.fromCharCode(unicode);
		var selected=$.inArray(actualkey,validkeys);		//returns index of selected answer
	
		if(this.timer==1 && selected!=-1) // and is in response key set *** HAVE TO ADD THIS***
		{
	/*		sw	var evtobj=window.event? event : e //distinguish between IE's explicit event object (window.event) and Firefox's implicit.
	var unicode=evtobj.charCode? evtobj.charCode : evtobj.keyCode
	var actualkey=String.fromCharCode(unicode)itch (String.fromCharCode(e.keyCode).toLowerCase())
			{
				case 'a':
					
					var rt_trial=new Date().getTime() - this.rt_start;
					this.timer = 0;
					$("#"+i).toggle();
					//feedback goes here feedback()
					break;
				
				case 's':
					var rt_trial=new Date().getTime() - this.rt_start;
					this.timer = 0;
					$("#"+i).toggle();
					//feedback goes here feedback()
					break;
			}*/
			//var res = String.fromCharCode(e.keyCode).toLowerCase();
			//var res = actualkey;
			
			this.timer=0;
			clearTimeout(this.timeout);
			clearTimeout(this.next_trial);
			var res = actualkey;
			var iscorrect=is_correct(selected);
			var y=document.getElementById("row_" + this.i).getAttribute("trialno");
			this.res.push(new result(y,res,selected,iscorrect,rt_trial));
			
			//$("#row_"+this.i).toggle();
			//feedback and result function goes here
			
		}
	}
	
	
	/*if (actualkey=="g"&&i<=4){
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
	document.getElementByIindex.php/result_handler/submitd('txt').innerHTML="You pressed h"; 
	toggle();
	clearTimeout(a);
	clearTimeout(t);
	startPausing();
	}
	}
	
	
	}*/
	
	this.checkWrongAns = function() {
		// Checks number of wrong responses during the practice trial
		// If the number of wrong responses is too high, return false and repeat practice
		// Number of allowed incorrect responses is too; easily changed
		if (this.numWrong > 2) {
			alert("You provided more than 2 incorrect responses.\n Please repeat the practice again to ensure you understand the task.");
			return false;
		}
		else {
			return true;	
		}
	}
}
