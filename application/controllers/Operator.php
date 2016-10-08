<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("Operator_model","operator");
	}

	public function index()
	{
        if(isset($_SESSION['user_id'])) {
			$this->view('admin/operator');
        } else {
            header('Location: '.base_url());
        }
	}

	public function getOperator()
	{
		$data = $this->operator->getOperator();
		echo json_encode($data);
	}

	public function getOperatorByID()
	{
		$id = $this->input->post_get('id');
		$data = $this->operator->getOperatorByID($id);
		echo json_encode($data);
	}

	public function saveOperator()
	{
		$id = $this->input->post_get('id');

		if($id == '')
		{
			$data = array(
				'operator_name' => $this->input->post_get('name'),
				'privilege' => $this->input->post_get('privilege'),
				'username' => $this->input->post_get('username'),
				'password' => $this->input->post_get('password')
			);

			$result = $this->operator->createOperator($data);
			echo $result;
		}
		else
		{
			$data = array(
                'user_id' => $id,
				'operator_name' => $this->input->post_get('name'),
				'privilege' => $this->input->post_get('privilege'),
				'username' => $this->input->post_get('username'),
				'password' => $this->input->post_get('password')
			);

			$result = $this->operator->editOperator($data);
			echo $result;
		}
	}

    public function deleteOperatorById()
	{
		$result = $this->operator->deactiveOperatorById($_SESSION['user_id'], $this->input->post_get('id'));
		echo $result;
	}

    public function checkUsername()
    {
        $username = $this->input->post_get('username');
        $curr_username = $this->input->post_get('curr_username');
        $data = $this->operator->checkUsername($username, $curr_username);
        echo json_encode($data);
    }
}
