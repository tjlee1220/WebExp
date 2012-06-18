<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
			//Leave this commented for security reasons
class Generate extends CI_Controller {

	/*function PST()		//will eventually move this to another controller.
	{
			$stim_pairs=array(
							array(1,2),
							array(2,1),
							array(3,4),
							array(4,3),
							array(5,6),
							array(6,5),
							);
			$stim_prob=array(
								1=>80,
								2=>20,
								3=>70,
								4=>30,
								5=>60,
								6=>40);
			$trials=array();
			foreach($stim_pairs as $pair)
			{
				for($i=0;$i<10;$i++)
				{
					$prob=array($stim_prob[$pair[0]],$stim_prob[$pair[1]]);
					$r=array(
					//'id' => 1,
					'exp_id' => 3,
					//'stims' => serialize($pair),
					//'correct' => serialize($this->generateCorrect($prob));
					'stims' => serialize($pair),
					'correct' => serialize($this->generateCorrectPST($prob))
					);
					$trials[]=$r;
				}
			
			}
			
			$this->load->model('trials_model','tm');
			echo ($this->tm->insertBatchTrials($trials));
		}*/
		
		/*function generateCorrectPST($pair)
		{
			$rand=array(
						mt_rand(0, 100),
						mt_rand(0, 100)
						);
						
			$feedback=array();
			if($rand[0]<=$pair[0])$feedback[0]=1;
			else $feedback[0]=0;
			if($rand[1]<=$pair[1])$feedback[1]=1;
			else $feedback[1]=0;
			
			return $feedback;
		}*/
		
		/*function generateCostConf()			//right if blue left if yellow
		{
		
				$stims=array(1,2,3,4,5,6,7,8);
				$trials=array();
				foreach($stims as $stim)
				{
					for($i=0; $i<5; $i++)		//generates trials with stim on left
					{
						$r=array(
						'block_id' => 4,
						'stims' => serialize(array($stim,0)),
						'correct' => serialize($this->generateCorrectCC($stim,true))
						);
						$trials[]=$r;
					}
					
					for($i=0; $i<5; $i++)		//generates trials with stim on left
					{
						$r=array(
						'block_id' => 4,
						'stims' => serialize(array(0,$stim)),
						'correct' => serialize($this->generateCorrectCC($stim,false))
						);
						$trials[]=$r;
					}
				}
			
			//echo var_dump($trials);
			$this->load->model('trials_model','tm');
			echo ($this->tm->insertBatchTrials($trials));

		}*/
		
		/*function generateCorrectCC($stim, $on_left=true)
		{
			switch($stim)
			{
				case 1:
					$feedback=array(0,1);
					break;
					
				case 2:
					$feedback=array(1,0);
					break;
				
				case 3:										//blue congruent means that neutral if on left but positive if on right
					if($on_left==true){
						$feedback=array(0,2);
					}
					else {
						$feedback=array(0,1);
					}
					break;
				
				case 4:										//yellow congruent means that positive if on left but neutral if on right
					if($on_left==true){
						$feedback=array(1,0);
					}
					else {
						$feedback=array(2,0);
					}
					break;
				
				case 5:									//blue incongruent means that positive if on left but neutral if on right
					if($on_left==true){
						$feedback=array(0,1);
					}
					else {
						$feedback=array(0,2);
						$feedback=array(0,2);
					}
					break;
				
				case 6:								//yellow incongruent means that neutral if on left but positive if on right
					if($on_left==true){
						$feedback=array(2,0);
					}
					else {
						$feedback=array(1,0);
					}
					break;
				
				case 7:
					$feedback=array(0,2);
					break;
				
				case 8:
					$feedback=array(2,0);
					break;
			}
			return $feedback;
				
		}*/
		
		/*function subjects()
		{
			$data=array();
			for($i=1;$i<=50;$i++)
			{
				$r=array(
					'id'=>$i,
					'md5_identifier'=>md5($i),
					'assigned_task'=>3
					);
				$data[]=$r;
			}
			
			$this->db->insert_batch('subjects',$data);
			return true;
		}*/
		
		/*function generateCCtest()
		{
			$stim_pairs=array(
							array(1,2),
							array(1,3),
							array(1,4),
							array(2,3),
							array(2,4),
							array(3,4),
							array(2,1),
							array(3,1),
							array(4,1),
							array(3,2),
							array(4,2),
							array(4,3)						
							);
			$trials=array();
			foreach($stim_pairs as $pair)
				{
					for($i=0; $i<4; $i++)		//generates trials with stim on left
					{
						$r=array(
						'block_id' => 5,
						'stims' => serialize($pair),
						'correct' => serialize(array(3,3))
						);
						$trials[]=$r;
					}
				
				}
				$this->db->insert_batch('trials',$trials);	
		}*/
		
		
		function generateCostConf()			//right if blue left if yellow
		{
		
				$stims=array(1,2,3,4,5,6,7,8);
				$trials=array();
				
				$bid=7;
				foreach($stims as $stim)
				{
					$res=$this->generateCorrectCC($stim,true);
					for($i=0; $i<4; $i++)		//generates trials with stim on left
					{
						$r=array(
						'block_id' => $bid,
						'stims' => serialize(array($stim,0)),
						'correct' => serialize($res[0]),
						'condition' => $res[1]
						);
						$trials[]=$r;
					}
					
					$res=$this->generateCorrectCC($stim,false);
					
					for($i=0; $i<4; $i++)		//generates trials with stim on left
					{
						$r=array(
						'block_id' => $bid,
						'stims' => serialize(array(0,$stim)),
						'correct' => serialize($res[0]),
						'condition' => $res[1]
						);
						$trials[]=$r;
					}
				}
			
			//echo var_dump($trials);
			$this->load->model('trials_model','tm');
			echo ($this->tm->insertBatchTrials($trials));

		}
		
		function generateCorrectCC($stim, $on_left=true)
		{
			switch($stim)
			{
				case 1:										// 100 Percent Positive = Condition 1
					$feedback=array(0,1);
					$condition = 1;
					break;
					
				case 2:
					$feedback=array(1,0);				// 100 Percent Positive= Condition 1
					$condition = 1;
					break;
				
				case 3:										//blue congruent means that neutral if on left but positive if on right= Condition 2
					if($on_left==true){
						$feedback=array(0,2);
					}
					else {
						$feedback=array(0,1);
					}
					$condition = 2;
					break;
				
				case 4:										//yellow congruent means that positive if on left but neutral if on right= Condition 2
					if($on_left==true){
						$feedback=array(1,0);
					}
					else {
						$feedback=array(2,0);
					}
					$condition = 2;
					break;
				
				case 5:									//blue incongruent means that positive if on left but neutral if on right= Condition 3
					if($on_left==true){
						$feedback=array(0,1);
					}
					else {
						$feedback=array(0,2);
						$feedback=array(0,2);
					}
					$condition = 3;
					break;
				
				case 6:								//yellow incongruent means that neutral if on left but positive if on right= Condition 3
					if($on_left==true){
						$feedback=array(2,0);
					}
					else {
						$feedback=array(1,0);
					}
					$condition = 3;
					break;
				
				case 7:								//0% positive= Condition 4
					$feedback=array(0,2);
					$condition = 4;
					break;
				
				case 8:								//0%POSITIVE= Condition 4
					$feedback=array(2,0);
					$condition = 4;
					break;
			}
			return array($feedback,$condition);
				
		}
		
		/*function subjects()
		{
			$data=array();
			for($i=1;$i<=50;$i++)
			{
				$r=array(
					'id'=>$i,
					'md5_identifier'=>md5($i),
					'assigned_task'=>3
					);
				$data[]=$r;
			}
			
			$this->db->insert_batch('subjects',$data);
			return true;
		}*/
		
		function generateCCtest()
		{
			$stim_pairs=array(
							array(1,2),
							array(1,3),
							array(1,4),
							array(2,3),
							array(2,4),
							array(3,4),
							array(2,1),
							array(3,1),
							array(4,1),
							array(3,2),
							array(4,2),
							array(4,3)						
							);
			$trials=array();
			foreach($stim_pairs as $pair)
				{
					for($i=0; $i<4; $i++)		//generates trials with stim on left
					{
						$r=array(
						'block_id' => 8,
						'stims' => serialize($pair),
						'correct' => serialize(array(3,3)),
						'condition'=>0
						);
						$trials[]=$r;
					}
				
				}
				$this->db->insert_batch('trials',$trials);	
		}
}
?>