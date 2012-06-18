<?php

class Admin_Model extends CI_Model {
	
	
	function __construct(){
			parent::__construct();
			}
			
	function get_resultsets($limit=false)
	{
		$query="SELECT * FROM result_sets ORDER BY timestamp DESC";
		if($limit!='') $query = $query . " LIMIT $limit";
		$res= $this->db->query($query);
		$data=array();
		if($res->num_rows()>0)
			{
				foreach($res->result() as $r)
				{
					$data[]=array(
						'id'=>$r->id,
						'subject_id'=>$r->subject_id,
						'task_id'=>$r->task_id,
						'complete'=>$r->complete,
						'notes'=>$r->notes,
						'timestamp'=>$r->timestamp
						);
				}
				return $data;
			}else return false;
	}
	
	function get_resultsetsbytask($tid,$limit=false)
	{
		$query="SELECT * FROM result_sets WHERE task_id = $tid AND complete = 1 ORDER BY timestamp DESC";
		if($limit!='') $query = $query . " LIMIT $limit";
		$res= $this->db->query($query);
		$data=array();
		$this->load->helper('url');	//anchor stuff
		if($res->num_rows()>0)
			{
				foreach($res->result() as $r)
				{
					$data[]=array(
						'id'=>$r->id,
						'subject_id'=>$r->subject_id,
						'task_id'=>$r->task_id,
						'complete'=>$r->complete,
						'notes'=>$r->notes,
						'timestamp'=>$r->timestamp,
						'anchor'=>anchor("admin/get_block_sets/".$r->id,"view")		//anchor stuff
						);
				}
				return $data;
			}else return false;
	}
	
	function get_blocksbyset($set_id)
	{
		$query="SELECT * FROM block_results WHERE set_id = $set_id ORDER BY order_presented ASC";
		$res= $this->db->query($query);
		$data=array();
		$this->load->helper('url');	//anchor stuff
		if($res->num_rows()>0)
			{
				foreach($res->result() as $r)
				{
					$data[]=array(
						'id'=>$r->id,
						'set_id'=>$r->set_id,
						'block_id'=>$r->block_id,
						'order_presented'=>$r->order_presented,
						'notes'=>$r->notes,
						'timestamp'=>$r->timestamp,
						'view'=>anchor("admin/get_block_results/".$r->id,"view"),		//anchor stuff
						'download'=>anchor("admin/get_block_results/".$r->id . "/download","download")		//anchor
						);
				}
				return $data;
			}else return false;
	}
	
	function get_blockresults($id)
	{
		$query="SELECT *, results.id AS id, trials.id AS tid FROM results LEFT JOIN trials ON results.trial_id = trials.id WHERE block_set_id = $id ORDER BY trial_id ASC, order_presented ASC ";
		$res= $this->db->query($query);
		$data=array();
		if($res->num_rows()>0)
			{
				foreach($res->result() as $r)
				{
					$stims=unserialize($r->stims);
					$data[]=array(
						'id'=>$r->id,
						'trial_id'=>$r->trial_id,
						'order_presented'=>$r->order_presented,
						'key'=>$r->key_pressed,
						//'stim_loc'=>$r->stim_loc,
						'feedback'=>$r->feedback,
						'rt'=>$r->reaction_time,
						'stim-left'=>$stims[0],
						'stim-right'=>$stims[1],
						'timestamp'=>$r->timestamp
						);
				}
				return $data;
			}else return false;
	}
	
	function get_stim_map($block_set,$text=false)
	{
		$res=$this->db->query("SELECT id, block_id, stim_map FROM block_results WHERE id=$block_set");
		if($res->num_rows()>0)
		{
			$res=$res->row();
			$stims=$res->stim_map;
			$stims=unserialize($stims);
		}else return false;
		if($text==false)
		{
			$data=array();
			foreach($stims as $key=>$stim)
			{
				$data[]=array(
					'instance'=>$key,
					'stim_code'=>$stim
					);
			}
				
		}
		else
		{
			$block=$res->block_id;
			$r=$this->db->query("SELECT exp_id FROM blocks WHERE id=$block");
			if($r->num_rows()>0)
			{
				$r=$r->row();
				$exp=$r->exp_id;
			}else return false;
			$r=$this->db->query("SELECT stim_id,img,notes FROM stimulus_images WHERE exp_id=$exp");		//not sure if this whole bit is necessary
			$map=array();
			if($r->num_rows()>0)
			{
				foreach($r->result() as $row)
				{
					if($row->notes!='')$map[$row->stim_id]=str_replace(" ","_",$row->notes);
					else $map[$row->stim_id]=$row->img;
				}
			}else return false;
			$data=array();
	 		foreach($stims as $key=>$stim)
			{
				$data[]=array(
					'instance'=>$key,
					'stim_code'=>$stim,
					'corresponding_stim'=>$map[$stim]
					);
			}
		}
		return $data;
		
	}
	
	function get_filename($block_set_id)
	{
		$r=$this->db->query("SELECT set_id,block_id FROM block_results WHERE id=$block_set_id LIMIT 1");
		$r=$r->row();
		$res_set=$r->set_id;
		$res=$this->db->query("SELECT subject_id,name FROM result_sets RIGHT JOIN tasks ON result_sets.task_id = tasks.id WHERE result_sets.id=$res_set");
		$res=$res->row();
		$fn=str_replace(" ","_",$res->name) . "_Subject_" . $res->subject_id . "_block_" . $r->block_id;
		return $fn;
	}
		
	
			
}

?>