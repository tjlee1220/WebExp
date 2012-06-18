<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Subject {

	function verify_subject($md5) //verifies if the subject exists
	{
		$CI =& get_instance();
		$CI->load->model('subjects_model','sm'); //loads subjects_model to check $md5 
		$subject=$CI->sm->getSubjectByMd5($md5); // assigns the return value of getSubjectByMd5 to $subject; $data array with information on subject or false
		//echo var_dump($subject);
		if($subject==false)return 0; // if subject does not exist, end function
		//elseif($this->check_start($subject['id'])==false) return -1;
		elseif($this->check_start($subject['id'])==false) echo var_dump($this->check_start($subject['id']));
		else return $subject;
	}
	
	function verify_subjectbyid($id)
	{
		if($id!=""){
			if($this->check_start('id')==false) return -1;
			else return 1;
		}
		else return 0;
	}
	
	function check_start($sid)	//returns true if subject has not yet started their task indicated by the first block being submitted
	{
		$CI=&get_instance();
		$CI->load->model('results_model','rm');
		$res=$CI->rm->getResultSetBySubject($sid);
		if($res!=false)return false;
		else return true;
	}
	
	function load_subject($sid,$tid) // loads subject id and task id
	{
		$CI=&get_instance();
		$CI->session->set_userdata('subject',$sid);
		$CI->load->library('task');
		$CI->task->loadTask($tid);
		//$set_id=$this->create_result_set($sid)
		
	}
	
	function create_result_set($sid,$tid)
	{
		$CI=&get_instance();
		$CI->load->model('results_model','rm');
		$set_id=$CI->rm->create_result_set($sid,$tid);
		return $set_id;
	}
	
	function load_result_set($set_id)
	{
		$CI=&get_instance();
		$CI->session->set_userdata('set_id',$set_id);
		
	}
	
}