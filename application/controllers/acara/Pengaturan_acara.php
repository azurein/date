<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_acara extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("acara/Pengaturan_acara_model","pengaturan_acara");
	}

	public function index()
	{
        if(isset($_SESSION['user_id'])) {
            $this->view('admin/acara/pengaturan_acara');
        } else {
            header('Location: '.base_url());
        }
	}

	public function getEvent()
	{
		$data = $this->pengaturan_acara->getEvent();
		echo json_encode($data);
	}

	public function getEventByID()
	{
		$id = $this->input->post_get('id');
		$data = $this->pengaturan_acara->getEventByID($id);
		echo json_encode($data);
	}

	public function getSouvenir()
	{
		$id = $this->input->post_get('id');
		$data = $this->pengaturan_acara->getSouvenir($id);
		echo json_encode($data);
	}

	public function getModalDdl()
	{
		$event_type = $this->pengaturan_acara->getEventType();
		$city = $this->pengaturan_acara->getCity();

		$data = array(
			'event_type' => $event_type,
			'city' => $city
		);
		echo json_encode($data);
	}

	public function checkAvailableEvent()
	{
		$data = $this->pengaturan_acara->checkAvailableEvent();
		echo json_encode($data);
	}

	public function changeEventStatus()
	{
		$is_active = $this->input->post_get('status');
		$event_id = $this->input->post_get('id');
		$data = array(
			'is_active' => $is_active,
			'event_id' => $event_id
		);

		if($is_active == '1') {
			$_SESSION['event_id'] = $event_id;
		}

		$result = $this->pengaturan_acara->changeEventStatus($data);
		echo $result;
	}

	public function uploadEvent()
	{
		$config = array(
					'upload_path'     => "assets/img/acara/",
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

	public function saveEvent()
	{
		$id = $this->input->post_get('id');
		$data = array(
			'event_id' => $this->input->post_get('id'),
			'event_name' => $this->input->post_get('event_name'),
			'event_type_id' => $this->input->post_get('event_type_id'),
			'event_img' => $this->input->post_get('event_img'),
			'start_at' => $this->input->post_get('start_at'),
			'end_at' => $this->input->post_get('end_at'),
			'address' => $this->input->post_get('address'),
			'city' => $this->input->post_get('city'),
			'total_invitation' => $this->input->post_get('total_invitation'),
		);

		if($id == '') {
			$result = $this->pengaturan_acara->createEvent($data);

		} else {
			$result = $this->pengaturan_acara->editEvent($data);
		}
		echo $result;
	}

	public function saveSouvenir()
	{
		$user_id = $_SESSION['user_id'];
		$event_id = $this->input->post_get('id');

		$data = array(
			'user_id' => $user_id,
			'event_id' => $event_id
		);
		$result = $this->pengaturan_acara->clearSouvenir($data);

		for ($i=0; $i < $this->input->post_get('length'); $i++) {
			$counter = "$i";
			$data = array(
				'souvenir_name' => $this->input->post_get('souvenir_name_'.$i),
				'souvenir_qty' => $this->input->post_get('souvenir_qty_'.$i),
				'user_id' => $user_id,
				'event_id' => $event_id
			);
			$result = $this->pengaturan_acara->createSouvenir($data);
		}
		echo $result;
	}

	public function deleteEventByID()
	{
		$data = array(
			'event_id' => $this->input->post_get('id'),
			'user_id' => $_SESSION['user_id']
		);
		$result = $this->pengaturan_acara->deactiveEventByID($data);
		echo $result;
	}

}
