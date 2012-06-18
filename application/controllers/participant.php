<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Participant extends CI_Controller {

	function start($md5)
	{
		$this->load->library('subject');
		$subject=$this->subject->verify_subject($md5);
		//echo var_dump($subject);
		if($subject==0){
			 echo "invalid subject number";
			 return false;
		}
		elseif($subject==-1){
			echo "subject has already started this task it is no longer accessible";
			return false;
		}
		else{
			$this->subject->load_subject($subject['id'],$subject['task']);
			/**$set_id=$this->subject->create_result_set($subject['id'],$subject['task']);
			$this->subject->load_result_set($set_id);**/
			//load instructions
			$this->load->library('task');
			$this->task->run_next();
		}
	}
	function run_next()
	{
		$this->load->library('task');
		$this->task->run_next();
	}









}
?>