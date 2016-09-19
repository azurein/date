<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hadiah_acara extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();

		$this->load->model("acara/Hadiah_acara_model","hadiah_acara");

		$this->load->helper(array('url','form'));
	}
	
	public function index()
	{
		$_SESSION['user_id'] = '0';
		$_SESSION['event_id'] = '1';

		$this->view('admin/acara/hadiah_acara');
	}

	public function getGroups()
	{
		$data = $this->hadiah_acara->getGroups();

		echo json_encode($data);
	}

	public function getParticipants()
	{
		$data = $this->hadiah_acara->getParticipants();

		echo json_encode($data);
	}

	public function getParticipantsPrizeSetting()
	{
		$prize_id = $this->input->post_get('prize_id');

		$data = $this->hadiah_acara->getParticipantsPrizeSetting($prize_id);

		echo json_encode($data);
	}

	public function getGroupsPrizeSetting()
	{
		$prize_id = $this->input->post_get('prize_id');

		$data = $this->hadiah_acara->getGroupsPrizeSetting($prize_id);

		echo json_encode($data);
	}

	public function getPrize()
	{
		$data = $this->hadiah_acara->getPrize();

		echo json_encode($data);
	}

	public function getPrizeByID()
	{
		$prize_id = $this->input->post_get('prize_id');

		$data = $this->hadiah_acara->getPrizeByID($prize_id);

		echo json_encode($data);
	}

	public function getWinnerByID()
	{
		$prize_id = $this->input->post_get('prize_id');

		$data = $this->hadiah_acara->getWinnerByID($prize_id);

		echo json_encode($data);
	}

	public function uploadPrize()
	{
		$config = array(
					'upload_path'     => "assets/img/hadiah/",
					'allowed_types'   => "jpg|jpeg|png",
					'file_name'		  => $_FILES['userfile']['name'],
					'overwrite'       => TRUE
					);

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload())
		{
			$result = $this->upload->display_errors();
		}
		else
		{
			$result = $this->upload->data();
		}

		echo $config['file_name'];
	}

	public function savePrize()
	{
		$prize_id = $this->input->post_get('prize_id');

		$data = array(
			'prize_id' => $prize_id,
			'prize_name' => $this->input->post_get('prize_name'),
			'prize_descr' => $this->input->post_get('prize_descr'),
			'prize_img' => $this->input->post_get('prize_img'),
			'prize_priority' => $this->input->post_get('prize_priority'),
			'total_winner' => $this->input->post_get('total_winner')
		);

		if($prize_id == '') 
		{
			$result = $this->hadiah_acara->insertPrize($data);
		} 
		else
		{
			$prizeImage = explode(".", $this->input->post_get('prize_img'));

			if($prizeImage[0] != '')
			{
				$result = $this->hadiah_acara->updatePrize($data);

			}
			else
			{
				$result = $this->hadiah_acara->updatePrizeWithoutImage($data);
			}
		}

		echo $result;
	}

	public function saveParticipants()
	{
		$prize_id = $this->input->post_get('prize_id');

		$cutLastString = rtrim($this->input->post_get('participants'), ",");
		$participants = explode(",", $cutLastString);

		$cutLastStringTitle = rtrim($this->input->post_get('titles'), ",");
		$titles = explode(",", $cutLastStringTitle);

		$data = array(
			'prize_id' => $prize_id
		);

		for($i=0; $i < count($participants); $i++)
		{
			$result = $this->hadiah_acara->saveParticipants($data, $participants[$i], $titles[$i]);
		}

		echo $result;
	}

	public function saveGroups()
	{
		$prize_id = $this->input->post_get('prize_id');

		$cutLastString = rtrim($this->input->post_get('groups'), ",");
		$groups = explode(",", $cutLastString);

		$data = array(
			'prize_id' => $prize_id
		);

		foreach ($groups as $value) {
		    $result = $this->hadiah_acara->saveGroups($data, $value);
		}

		echo $result;
	}

	public function deletePrizeByID()
	{
		$data = array(
			'prize_id' => $this->input->post_get('prize_id')
		);

		$result = $this->hadiah_acara->deletePrizeByID($data);

		echo $result;
	}

	public function deleteParticipants()
	{
		$data = array(
			'prize_id' => $this->input->post_get('prize_id')
		);

		$result = $this->hadiah_acara->deleteParticipants($data);

		$cutLastString = rtrim($this->input->post_get('participants'), ",");
		$participants = explode(",", $cutLastString);

		$cutLastStringTitle = rtrim($this->input->post_get('titles'), ",");
		$titles = explode(",", $cutLastStringTitle);

		for($i=0; $i < count($participants); $i++)
		{
			$result = $this->hadiah_acara->removeParticipants($data, $participants[$i], $titles[$i]);
		}

		echo $result;
	}

	public function deleteGroups()
	{
		$data = array(
			'prize_id' => $this->input->post_get('prize_id')
		);

		$result = $this->hadiah_acara->deleteGroups($data);

		$cutLastString = rtrim($this->input->post_get('groups'), ",");
		$groups = explode(",", $cutLastString);

		foreach ($groups as $group) {
		    $result = $this->hadiah_acara->removeGroups($data, $group);
		}

		echo $result;
	}

	public function deleteParticipantsPrizeSetting()
	{
		$data = array(
			'prize_id' => $this->input->post_get('prize_id')
		);

		$result = $this->hadiah_acara->deleteParticipantsPrizeSetting($data);

		echo $result;
	}

	public function deleteGroupsPrizeSetting()
	{
		$data = array(
			'prize_id' => $this->input->post_get('prize_id')
		);

		$result = $this->hadiah_acara->deleteGroupsPrizeSetting($data);

		echo $result;
	}
}