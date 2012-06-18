<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 //@TODO HANDLE WHEN NO RESPONSE IS A VALID ANSWER

	//@TODO Now implement task handling. String a series of blocks together and finish when the task is done.


/*	public function index()		//will eventually move this to another controller.
	{
		
		//THANKS TO HELPERS LOADING A BLOCK IS NOW ONE LINE OF CODE
		//$block=1;
		//$this->load->library('block');
		//$this->block->view($block);		
		//echo ('Welcome to the Brown University Laboratory For Neural Computation and Cognition Web Experiment Platform');
		$this->load->model('trials_model','tm');
		$data['anchors']=$this->tm->getTaskAnchors();
		$this->load->view('index',$data);
		//$this->load->library('experiment');
		//$this->experiment->get_image_rules(3,1,1);
	}
	*/
	function destroy()
	{
		$this->session->sess_destroy();
		echo "session destroyed";
	}
	
	function insert_task()						//RANDOM HELPER FUNCTION - UNNECESSARY IN FINAL PRODUCT
	{
		$this->load->model('trials_model','tm');
		$r=array(7,8,6,5);
		$this->tm->insertTask($r);
		
	}
	
/*	function balance()
	{
		$this->load->library('mturk');
		echo $this->mturk->balance();
	}*/
	
/*	function insert_trial()						//RANDOM HELPER FUNCTION - UNNECESSARY IN FINAL PRODUCT
	{
		$this->load->model('trials_model','tm');
		$this->tm->insertTrial();
		
	}
*/
	
/*	function insert_experiment($timeout=false,$validkeys=false)		//HELPER FUNCTION TO INSERT EXPERIMENT. SERIALIZES VALID KEYS
	{
		$this->load->model('trials_model','tm');
		//$this->tm->insertexperiment($timeout,$looptime,$numstims,$validkeys);
		$validkeys=array('d','k');
		$this->tm->insertExperiment(4000,$validkeys);
	}
*/

//End of file: welcome.php
}

?>