<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hadiah_acara extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("acara/Hadiah_acara_model","hadiah_acara");
	}
	
	public function index()
	{
		$_SESSION['user_id'] = '0';

		$this->view('admin/acara/hadiah_acara');
	}

}