<?php

class WelcomeController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->output->enable_profiler($this->config->item('debugProfiler'));
		
	}
	
	function index(){
		$arrDados['siteInclude'] = $this->load->view("siteInclude", null, TRUE);

		$arrDados['siteJavascript'] = $this->load->view("siteJavascript.js", null, TRUE);
		
		$this->load->view('welcomeView',$arrDados);
	}
	function testeAjax(){
		
		header('Content-Type: text/html; charset=iso-8859-1');
		header('Pragma: no-cache');
		header('cache-Control: no-cache, must-revalidate'); 
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		
		$variable = 1000000000;
		
        for ($i=0; $i < $variable ; $i++) { 
            
        }
		
		echo "Funçãoo ajax executada";
		
	}
}

/* End of file WelcomeController.php */
/* Location: ./aplication/controllers/WelcomeController.php */