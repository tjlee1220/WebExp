<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml"><head>
<title><?php echo $name; ?></title>
<script type="text/javascript" src="/webexp/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="/webexp/js/<?php echo $js_file;?>.js"></script>
<script type="text/javascript" src="/webexp/js/<?php echo $prac_js;?>.js"></script>
<script type="text/javascript" src="/webexp/js/json2.js"></script>
<style type ="text/css">
#instructions {
	font-family: helvetica;
	font-size: 18;
}
</style>
</head>
<body>
<div id="instructions" align="center"> <?php echo($instructions);?>
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
	<input type="hidden" name="subject" id="subject" value="">
	<input type="hidden" name="trial_type" id="trial_type" value="<? echo $trial_type ?>">
	<input type="hidden" name="verify"	value="1">
</form>

<script>
	// Run the practice trial first
	$('#start_prac').click(function(){
		$('#instructions').hide();
		$('#practice').show();
		trial_prac(<?php echo 48 . ',' . $valid_responses . ',' . 2000 . ',' . $fb_time . ',' . $fixation ?>); //Sends trial information to practice js file
	});
	//After the practice trial, run the main trial
	$('#start_trials').click(function(){
		$('#instructions').hide();
		$('#start_trials').remove();
		$('#start').show();
		trial(<?php echo $numstims . ',' . $valid_responses . ',' . $timeout . ',' . $fb_time . ',' . $fixation ?>); //Sends trial information to main js file
	});
	//trial(<?php echo $numstims . ',' . $valid_responses . ',' . $timeout ?>);
	$(document).keypress(function(e){keypress(e);});
</script>

</body>
</html>