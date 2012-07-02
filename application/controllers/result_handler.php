<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_Handler extends CI_Controller {
/*		public function index()
		{
			echo 'hello world';
		}*/
		
		
		
		function submit()		//@TODO: HAS TO HANDLE BLOCK RESULT SETS AND TASK RESULT SETS
		{
			if($this->input->post('verify')==1)
			{
				//first save block set
				$block_set_id=$this->save_block_set();
				
				
				$results = json_decode($this->input->post('json_res'));
				$subject = $this->input->post('subject');
				//$this->load->model('subjects_model','sm');
				//$md5 = $this->sm->getSubjectByMd 
				$this->load->model('results_model','rm');
				$res=$this->rm->save_results($results,$block_set_id);
				
				
				
				$this->load->library('task');
				$this->task->increment();
				//$this->task->run_next();
				$this->load->helper('url');
				redirect('/participant/run_next');
				return $res;
			}
		}
		
		function save_block_set()
		{
			$this->load->library('task');
			$task=$this->session->userdata('task');
			$ind=$this->session->userdata('ind');
			$block=$task['blocks'][$ind];
			$this->load->model('trials_model','tm');
			$exp_id=$this->tm->getExpByBlock($block);
			if($this->session->userdata('set_id')!=""){
				$set_id=$this->session->userdata('set_id');		//need to make dynamic
			}
			else{
				$subject=$this->session->userdata('subject');
				$this->load->library('subject');
				$set_id=$this->subject->create_result_set($subject,$task['id']);
				$this->subject->load_result_set($set_id);
			}
			$this->load->model('trials_model','tm');
			$this->load->library('experiment');
			$rules=$this->experiment->load_image_rules($exp_id);
			$r=array();
			foreach($rules as $key=>$val)
			{
				$r[$val['id']]=$key;
			}
			$rules=$r;
			
			return $this->tm->save_block_result($set_id,$block,$ind,$rules);
		}

}
