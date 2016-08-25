<?php

class Main_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->library('parser');
    }
	
	protected function view($page='login',$param='')
	{
		$path = array(
			'assets'=>$this->config->item('assets_url'),
			'page' => $page 
		);

		$this->parser->parse($page, array(
			'assets' 			=> $this->config->item('assets_url'),
			'includeCSS'  		=> $this->parser->parse('includes/css',$path),
			'includeScripts'	=> $this->parser->parse('includes/script',$path),
			'user_id'			=> $_SESSION['user_id'],
			'event_id'			=> $_SESSION['event_id'],
			'param'				=> $param
		));
	}
}

?>