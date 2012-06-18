<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function get_results($task=false)
	{
		if($task!='')
		{
			$this->load->model('admin_model','am');
			$results=$this->am->get_resultsetsbytask($task);
			$this->load->library('table');
			$r=array('ID','Subject ID','Task ID','Complete','notes','Timestamp','Link');
			array_unshift($results,$r);
			echo $this->table->generate($results);
		}
		else echo ('Please enter task id at end of url');
	}
	
	function get_block_sets($set_id)
	{
		$this->load->model('admin_model','am');
		$results=$this->am->get_blocksbyset($set_id);
		$this->load->library('table');
		$r=array('ID','Set ID','Block ID','Order Presented','notes','Timestamp','View','Download');
		array_unshift($results,$r);
		echo $this->table->generate($results);
	}
	
	function get_block_results($block_set_id,$dl=false)
	{
		$this->load->model('admin_model','am');
		$results=$this->am->get_blockresults($block_set_id);
		$this->load->library('table');
		$r=array('ID','Trial ID','Order Presented','Key', 'Feedback', 'Reaction Time','stim-left','stim_right','Timestamp');
		array_unshift($results,$r);
		if($dl!="download")echo $this->table->generate($results);
		else 
		{
			$data['data']=$results;
			$data['filename']=$this->am->get_filename($block_set_id);
			$data['stim_map']=$this->get_stim_map($block_set_id);
			$this->load->view('export_csv',$data);
		}
		
	}
	
	function get_stim_map($bid)
	{
		$map=$this->am->get_stim_map($bid,true);
		$data=array();
		array_unshift($map,array("Current Instance","Global Stim","Corresponding Image"));
		//array_merge($data,$map);
		return $map;	
	}

}
?>