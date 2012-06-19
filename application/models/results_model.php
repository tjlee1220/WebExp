<?php

//Deals with taking results settings from database
//Also deals with adding block results to the database
class Results_Model extends CI_Model {
	
	
	function __construct(){
			parent::__construct();
			}
			
	
	
	
	function getResultSetBySubject($sid)
	{
		$q="SELECT * FROM result_sets WHERE subject_id = $sid";
			$res=$this->db->query($q);
			if($res->num_rows()==1)
			{
				foreach($res->result() as $r)
				{
					$data=array(
						'id'=>$r->id,
						'subject_id'=>$r->subject_id,
						'task'=>$r->task_id,
						'complete'=>$r->complete
						);
				}
				return $data;
			}else return false;
		
	}
	
	function create_result_set($sid,$tid)
	{
		$data=array(
				'subject_id'=>$sid,
				'task_id'=>$tid,
				'complete' => 0);
		$this->db->insert('result_sets',$data);
		return $this->db->insert_id();		
	}
	
	function set_complete($set)
	{
		$this->db->where('id',$set);
		$data=array('complete'=>1);
		$this->db->update('result_sets',$data);
		return $this->db->insert_id();
	}
	
	function save_results($results_array,$block_set_id)	
	{
		$data=array();
		foreach($results_array as $key=>$res)
		{
			$data[]=array(
						'block_set_id'			=>$block_set_id,	//make this dynamic too
						'trial_id'				=>$res->trialid,
						'order_presented'		=>$key+1,
						'key_pressed'			=>$res->actualkey,
						'stim_loc'				=>$res->selected,
						'feedback'				=>$res->correct,
						'reaction_time'		=>$res->rt
						);
		}
		return $this->db->insert_batch('results', $data); 

	}
	
	
	
	
		
		
	}
?>