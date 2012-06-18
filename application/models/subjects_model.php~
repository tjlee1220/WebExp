<?php

class Subjects_Model extends CI_Model {				//@TODO FUNCTIONS BELOW SHOULD RETURN FALSE IF QUERIES RETURN NULL SET or If more than one.
	
		function __construct(){
			parent::__construct();
			}
			
		function getSubjectByMd5($md5)
		{
			$q="SELECT * FROM subjects WHERE md5_identifier = '$md5'";
			$res=$this->db->query($q);
			if($res->num_rows()>0)
			{
				foreach($res->result() as $r)
				{
					$data=array(
						'id'=>$r->id,
						'md5'=>$r->md5_identifier,
						'task'=>$r->assigned_task
						);
				}
				return $data;
			}else return false;
			
			
		}
		
}