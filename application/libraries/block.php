<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Block {

	function get_settings($block_id,$json=false)		//json is a flag used to encode the valid responses array
	{
		$CI =& get_instance();
		$CI->load->model('trials_model','tm');
		$settings = $CI->tm->getBlockSettings($block_id);
		if($json==true)$settings['valid_responses']=json_encode($settings['valid_responses']);
		return $settings;
	}
	
	function get_trials($block)
	{
		$CI =& get_instance();
		$CI->load->model('trials_model','tm');
		return $CI->tm->getTrialsByBlock($block);
	}


	function get_view_data($block,$shuffle=true)
	{
		$data=$this->get_settings($block,true);		//binary flag uses a json encode on the valid responses array to make it passable to the JavaScript
		$CI =& get_instance();
		$CI->load->library('experiment');		
		
		$trials=$this->get_trials($block);
		if($shuffle==true)shuffle($trials);
		
		$data['numtrials']=count($trials);
		$data['trials']=array();
		
		
		$rules=$CI->experiment->load_image_rules($data['exp_id']);		//loads image replacement rules based on stimulus id parameters are experiment id and 
																				//randomization. set 2nd parameter to true in order to randomize stimulus associations
		//unset($data['exp_id']);

		foreach($trials as $row)
		{
			$trial=array();
			$trial['id']=$row['id'];
			foreach($row['stims'] as $key => $val)
			{
				$trial['stims'][$key]['img']=$rules[$val]['img'];
			}
			$trial['correct_array']=json_encode($row['correct']);
			$data['trials'][]=$trial;
		}
		return $data;
		
	}
	
	function view($block)
	{
		$CI =& get_instance();
		$CI->load->view('block_view',$this->get_view_data($block));
	}
	
/*	
		$block_id=3;
		$this->load->library('block');
		$data=$this->block->get_settings($block_id,true);  //binary flag uses a json encode on the valid responses array to make it passable to the JavaScript
		$exp_id=$data['exp_id'];
		unset($data['exp_id']);
		
		$t=$this->block->get_trials($block_id);
		shuffle($t);
		$data['numtrials']=count($t);
		$this->load->library('experiment');
		$rules=$this->experiment->load_image_rules(1,true);		//loads image replacement rules based on stimulus id parameters are experiment id and 
																					//randomization. set 2nd parameter to true in order to randomize stimulus associations
		foreach($t as $row)
		{
			$trial=array();
			$trial['id']=$row['id'];
			foreach($row['stims'] as $key => $val)
			{
				$trial['stims'][$key]['img']=$rules[$val];
			}
			$trial['correct_array']=json_encode($row['correct']);
			$data['trials'][]=$trial;
		}*/

}



/* End of file block.php */
?>