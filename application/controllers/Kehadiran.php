<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kehadiran extends Main_Controller {
	
   	public function __construct()
	{
		parent::__construct();
		$this->load->model("Kehadiran_model","kehadiran");
	}
	
	public function index()
	{
		$this->view('admin/kehadiran');
	}
}