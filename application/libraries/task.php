<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Task {

	function isLoaded()
	{
		//checks session to see if a task is already loaded
		$CI =& get_instance();
		if($CI->session->userdata('task')==FALSE) return FALSE;
		else return TRUE;
	}
	
	function loadTask($tid)
	{
		//loads task into session data
		$CI =& get_instance();
		$CI->load->model('trials_model','tm');
		$CI->session->set_userdata('task',$CI->tm->getTask($tid));
		$CI->session->set_userdata('ind',0);
		return true;
		//return $CI->tm->getTask($tid);	
	}
	
	function run_next()
	{
		if($this->isLoaded()==FALSE)echo "Error: no task loaded";
		
		$CI =& get_instance();
		$CI->load->library('subject');
		//echo var_dump($CI->subject->verify_subjectbyid($CI->session->userdata('subject')));
		if($CI->subject->verify_subjectbyid($CI->session->userdata('subject'))==-1)
		{
			//echo "subject has already started this task it is no longer accessible";
			//exit();
		}
		$task=$CI->session->userdata('task');		
		if($CI->session->userdata('ind')<count($task['blocks'])) {
			
			$CI->load->library('block');
			$task=$CI->session->userdata('task');
			$bid=$task['blocks'][$CI->session->userdata('ind')];
			$CI->block->view($bid);
		}
		else
		{
			$this->endTask();
		}
		
	}
	
	function increment()
	{
		$CI =& get_instance();
		$ind=$CI->session->userdata('ind');
		$CI->session->set_userdata('ind',$ind+1);
		return true;
	}
	
	function endTask()
	{
		//do stuff
		$this->mark_complete();
		$data['code']=$this->generateCode();
		$CI=&get_instance();
		$CI->load->view('ended',$data);
		
		//echo ('Task is ended');
	}
	
	function mark_complete()
	{
		$CI =& get_instance();
		$set=$CI->session->userdata('set_id');
		$CI->load->model('results_model','rm');
		return $CI->rm->set_complete($set);
	}
	
	function generateCode()
	{
		//inserts generated code into database. Will be based on timestamp
		return md5(time());
	}
		
		
		
}
		