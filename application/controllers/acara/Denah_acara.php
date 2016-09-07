<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denah_acara extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("acara/Denah_acara_model","denah_acara");
	}
	
	public function index()
	{
		$_SESSION['user_id'] = '0';

		$this->view('admin/acara/denah_acara');
	}

}