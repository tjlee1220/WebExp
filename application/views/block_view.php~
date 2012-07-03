<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml"><head>
<title><?php echo $name;?></title>
<script type="text/javascript" src="/webexp/js/jquery-1.6.1.min"></script>
<script type="text/javascript" src="/webexp/js/<?php echo $js_file;?>"></script>
<script type="text/javascript" src="/webexp/js/<?php echo $prac_js;?>"></script>
<script type="text/javascript" src="/webexp/js/json2"></script>
<style type ="text/css">
#instructions {
	font-family: helvetica;
	font-size: 18;
}
</style>
</head>
<body>
<div id="instructions" align="center"> <?php echo($instructions);?>
<div align="center" style="<?php if($practice==0) {echo 'display: none';}; ?>" >
<textarea rows="20" cols="60">
Informed Consent - Online Learning and Decision Making

You are being invited to participate voluntarily in this Brown University research study. The information in this form is provided to help you decide whether or not to take part.  Study personnel will be available to answer your questions and provide additional information.  If you decide to take part in the study, you will be asked to sign this consent form.
 
What is the purpose of this research study?

The purpose of this project is to study your performance on a series of computerized tasks as it relates to learning and decision making. 
In order to participate in this study you must be healthy, between the ages of 18 and 40, and have no medical history of brain injury, mental/psychiatric disorders or drug or alcohol abuse.

What will happen during this study?

You will be asked to complete a computerized task in which you will make decisions on various stimuli depending on the instructions and memory requirements for the task.  You may also be asked to complete some brief questionnaires, which may ask for sensitive personal information, such as specifics concerning your menstrual cycle. You are allowed to skip any questions which you do not wish to answer.   
It should be understood that there may be certain aspects of the study session which will not be fully disclosed until after your participation is complete. Upon completion of the study session, you will be given a full debriefing describing all research procedures and contact information by the experimenter. Any questions you may have will also be addressed. 

How long will I be in this study?

The length of your participation may range from approximately 10 minutes to 1 hour. You will be notified of the duration of your participation prior to beginning. 

Will there be any costs to me?

Aside from your time, there are no costs for taking part in the study.
  
Are there any risks to me?

There are no risks to you for participating.

Are there any benefits to me?

There is no direct benefit to you for participating.  However, your education in psychology may be enhanced by learning about the psychological concepts investigated in this study, the relevance of these concepts to everyday life, and how psychological research is conducted.

Will I be paid to participate in the study?

Monetary compensation will be provided to you through your Amazon.com Mechanical Turk member account. You will be compensated $0.08 per minute ($0.80 per 10 minutes) or for certain sessions based on your performance. If your compensation will be based on performance, you will be notified prior to beginning and given the option of abstaining participation.  

Will the information that is obtained from me be kept confidential?

Your records will be confidential. You will not be identified in any reports or publications resulting from the study.  It is possible that representatives of the sponsor that supports the research study will want to come to Brown University to review your information.  Representatives of regulatory agencies (including Brown University Research Protection Office) may access your records.  You may be asked for your Amazon.com Mechanical Turk username and email address for the purpose of compensation through Mechanical Turk member services, however, research personnel will not have access to your bank information at any time. All experiments conducted online are hosted on a Brown University secure server. Your data, including responses to questionnaires, will be maintained on a password-protected database on that server. Your email address will be maintained in a location that is separate from the rest of your information. To preserve confidentiality, you will be assigned a number and you will automatically be identified on all forms by number only such that your name and data collected about you are not linked in any way. Furthermore, any data stored on a computer will reference you only by this number. Only investigators delegated to this study will have access to this data and none of this data will be shared with third parties. In general, neither we nor anyone can absolutely guarantee the security of data transmitted over the web.
 
May I change my mind about participating?

Your participation in this study is voluntary. You may decide to not begin or to stop the study at any time.

Whom can I contact for additional information?

You can obtain further information about the research or voice concerns or complaints about the research by contacting the Principal Investigator, Michael Frank PhD at (401) 863-6871. If you have questions concerning your rights as a research participant, have general questions, concerns or complaints, or would like to give input about the research and cannot reach the research team, or want to talk to someone other than the research team, you may call the Brown University Research Protection Office at (401) 863-3050.  (If out of state, use the toll-free number 1-866-309-2095.) If you would like to contact the Research Protection Office via the web, please visit the following website: http://research.brown.edu/rschadmin/rpo_main.php

Your Signature

By clicking I Understand, I affirm that I have read the information contained in the form, that the study has been explained to me, and that I agree to take part in this study.  I do not give up any of my legal rights by signing this form.
</textarea>
</div>

<!--If practice is turned on '1', then practice trial must be completed in order to show the main task button-->
<!--If practice is turned off '0', then the main task button will show up right away-->
</br><button name="start_trials" id="start_trials" align="center" style="<?php if($practice==1) {echo 'display: none';}; ?>" ><font size="10" face="arial" color="black">Begin Task</font></button>
<button name="start_prac" id="start_prac" align="center" style="<?php if($practice==0) {echo 'display: none';}; ?>" ><font size="10" face="arial" color="black">I Understand</font></button></div>
<div id="practice" style="display : none" align="center"><font size="20" face="arial" color="black"> PRACTICE TRIAL </font></div>
<div id="start" style="display : none" align="center"><font size="20" face="arial" color="black"> STARTING TRIALS </font></div>
<div style="margin-top: 150px;"><table width="100%" align="center">
<?php foreach($trials as $i=>$trial) : ?>
	<tr id="row_<?php echo($i);?>" value="<?php echo($trial['correct_array']);?>" trialno="<?php echo($trial['id']);?>"  style="display : none">
	<?php foreach($trial['stims'] as $key=>$t) : ?>	
	<td id="cell_<?php echo($i . "_" . $key);?>"><div align="center" ><img src="/webexp/img/<?php echo($t['img']);?>"  alt="<?php echo($t['img']);?>" width="200" height="200" /></div></td>
	<?php endforeach; ?></tr>
	<?php endforeach; ?>
	<tr id="row_64" value="[0,2]" trialno="" style="display : none">
		<td id="cell_64_0"><div align="center" ><img src="/webexp/img/CC/blue_triangle.png"  alt="CC/blue_triangle.png" width="200" height="200" /></div></td>
		<td id="cell_64_1"><div align="center" ><img src="/webexp/img/blank.png" alt="blank.png" width="200" height="200" /></div></td>
	</tr> 
	<tr id="row_65" value="[2,0]" trialno="" style="display : none">
		<td id="cell_65_0"><div align="center" ><img src="/webexp/img/blank.png" alt="blank.png" width="200" height="200" /></div></td>
		<td id="cell_65_1"><div align="center" ><img src="/webexp/img/CC/yellow_hex.png" alt="CC/yellow_hex.png" width="200" height="200" /></div></td>
	</tr>
	<tr id="row_66" value="[0,1]" trialno=""  style="display : none">
		<td id="cell_66_0"><div align="center" ><img src="/webexp/img/blank.png"  alt="blank.png" width="200" height="200" /></div></td>
		<td id="cell_66_1"><div align="center" ><img src="/webexp/img/CC/blue_triangle.png"  alt="CC/blue_triangle.png" width="200" height="200" /></div></td>
	</tr> 
	<tr id="row_67" value="[2,0]" trialno=""  style="display : none">
		<td id="cell_67_0"><div align="center" ><img src="/webexp/img/CC/yellow_hex.png" alt="CC/yellow_hex.png" width="200" height="200" /></div></td>
		<td id="cell_67_1"><div align="center" ><img src="/webexp/img/blank.png"  alt="blank.png" width="200" height="200" /></div></td>
	</tr>
	<tr id="positive_feedback" name="feedback"style="display : none"><td colspan="2"><div style="padding-top: 25px;" align="center" id="positive_feedback_div" name="feedback"><img src="/webexp/img/<?php echo($positive_img);?> " width="100" height="100" alt="+1" /><div></td></tr>
	<tr id="negative_feedback" name="feedback" style="display : none"><td colspan="2"><div style="padding-top: 25px;" align="center" id="negative_feedback_div" name="feedback"><img src="/webexp/img/<?php echo($negative_img);?> " width="100" height="100" alt="-3" /><div></td></tr>
	<tr id="neutral_feedback" name="feedback" style="display : none"><td colspan="2"><div style="padding-top: 25px;" align="center" id="neutral_feedback_div" name="feedback"><img src="/webexp/img/<?php echo($neutral_img);?> " width="100" height="100" alt="0" /><div></td></tr>
		<tr id="fixation" name="fixation" style="display : none"><td colspan="2"><div align="center" id="fixation_div" name="fixation"><img src="/webexp/img/Fixation_Cross.png" width="200" height="200" alt="fixation" /><div></td></tr>
	</table>
</div>

<form action="/webexp/index.php/result_handler/submit" name="myform" method="post">
	<input type="hidden" name="json_res" id="json_res" value="">
	<!--<input type="hidden" name="subject" id="subject" value="">-->
	<input type="hidden" name="verify"	value="1">
</form>

<script>
	// Run the practice trial first
	$('#start_prac').click(function(){
		$('#instructions').hide();
		$('#practice').show();
		trial_prac(<?php echo 47 . ',' . $valid_responses . ',' . 2000 . ',' . $fb_time . ',' . $fixation ?>); //Sends trial information to practice js file
	});
	//After the practice trial, run the main trial
	$('#start_trials').click(function(){
		$('#instructions').hide();
		$('#start_trials').remove();
		$('#start').show();
		trial(<?php echo $numstims . ',' . $valid_responses . ',' . $timeout . ',' . $fb_time . ',' . $fixation ?>); //Sends trial information to main js file
	});
	//trial(<?php echo $numtrials . ',' . $valid_responses . ',' . $timeout ?>);
	$(document).keypress(function(e){keypress(e);});
</script>
</body>
</html>