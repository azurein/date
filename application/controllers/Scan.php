<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan extends Main_Controller {
	
   	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->view('admin/scan');
	}
}