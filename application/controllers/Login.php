<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("Login_model","login");
        $this->load->model("acara/Pengaturan_acara_model","pengaturan_acara");
	}

	public function index()
	{
		if(isset($_SESSION['user_id'])) {
            header('Location: '.base_url().'kehadiran');
        } else {
            $this->session->set_flashdata('login_status','none');
            $this->view('admin/login');
        }
	}

    public function checkLoginData()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
		$data = $this->login->checkLoginData($username, $password);
        if(count($data) > 0) {
            $_SESSION['user_id'] = $data[0]['user_id'];
            header('Location: '.base_url().'kehadiran');
        } else {
            $this->session->set_flashdata('login_status','failed');
            $this->view('admin/login');
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        header('Location: '.base_url());
    }
}
