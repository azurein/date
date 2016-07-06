<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_peserta extends Main_Controller {
	
   	public function __construct()
	{
		parent::__construct();
		$this->load->model("Peserta_model","peserta");
	}
	
	public function index()
	{
		$this->view('admin/kelola_peserta');
	}
}