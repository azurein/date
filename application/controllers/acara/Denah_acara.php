<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denah_acara extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("acara/Denah_acara_model","denah_acara");
		$this->load->helper(array('url','form'));
	}
	
	public function index()
	{
		$_SESSION['user_id'] = '0';
		$_SESSION['event_id'] = '1';

		$this->view('admin/acara/denah_acara');
	}

	public function getAutoCompleteParticipants()
	{
		$data = $this->denah_acara->getAutoCompleteParticipants();

		echo json_encode($data);
	}

	public function getDetailCanvas()
	{
		$param = array(
			'canvas_slideid' => $this->input->post_get('canvas_slideid')
		);

		$result = $this->denah_acara->getDetailCanvas($param);
		echo json_encode($result);
	}

	public function insertCanvas()
	{
		$param = array(
			'canvas_name' => $this->input->post_get('canvas_name'),
			'canvas_slideid' => $this->input->post_get('canvas_slideid'),
			'canvas_img' => $this->input->post_get('canvas_img'),
			'canvas_width' => $this->input->post_get('canvas_width'),
			'canvas_height' => $this->input->post_get('canvas_height')
		);

		$result = $this->denah_acara->insertCanvas($param);
		echo json_encode($result);
	}

	public function updateCanvasName(){
		$param = array(
			'canvas_name' => $this->input->post_get('canvas_name'),
			'canvas_id' => $this->input->post_get('canvas_id')
		);

		$result = $this->denah_acara->updateCanvasName($param);
		echo json_encode($result);
	}

	public function deleteCanvas(){
		$param = array(
			'canvas_id' => $this->input->post_get('canvas_id')
		);

		$result = $this->denah_acara->deleteCanvas($param);
		echo json_encode($result);
	}

	public function getFacilityType(){
		$param = array(
			'is_parent' => $this->input->post_get('is_parent')
		);

		$result = $this->denah_acara->getFacilityType($param);
		
		echo json_encode($result);
	}

	public function getFacilityGroup(){
		$result = $this->denah_acara->getFacilityGroup();
		echo json_encode($result);
	}

	public function loadFacilityFrom(){
		$param = array(
			'canvas_id' => $this->input->post_get('canvas_id'), 
			'canvas_slideid' => $this->input->post_get('canvas_slideid')
		);
		$result = $this->denah_acara->loadFacilityFrom($param);
		echo json_encode($result);
	}

	public function addFacility(){
		$param = array(
			'facility_type_id' => $this->input->post_get('facility_type_id'),
			'facility_parent_id' => $this->input->post_get('facility_parent_id'),
			'canvas_id' => $this->input->post_get('canvas_id'),
			'canvas_slideid' => $this->input->post_get('canvas_slideid'),
			'group_id' => $this->input->post_get('group_id'),
			'facility_name' => $this->input->post_get('facility_name')
		);
		$result = $this->denah_acara->addFacility($param);
		echo json_encode($result);
	}

	public function getFacilityDetail(){
		$param = array(
			'canvas_id' => $this->input->post_get('canvas_id'),
			'canvas_slideid' => $this->input->post_get('canvas_slideid')
		);
		$result = $this->denah_acara->getFacilityDetail($param);
		echo json_encode($result);
	}

	public function uploadCanvasImage($id)
	{
		$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
		$config = array(
                  'upload_path'     => "assets/img/denah/",
                  'allowed_types'   => "jpg|jpeg|png|gif",
                  'file_name'		=> $id.'.'.$ext,
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

        //echo $config['upload_path'].$config['file_name'];
        echo $config['file_name'];
	}

	public function saveCanvasImage()
	{		
		$param = array(
			'canvas_id' => $this->input->post_get('canvas_id'),
			'canvas_img' => $this->input->post_get('canvas_img')
		);

		$result = $this->denah_acara->saveCanvasImage($param);

		echo $result;
	}

	public function deleteFacility()
	{		
		$param = array(
			'facility_id' => $this->input->post_get('facility_id')
		);

		$result = $this->denah_acara->deleteFacility($param);

		echo $result;
	}

	public function editFacility(){
		$param = array(
			'facility_id' => $this->input->post_get('facility_id'),
			'facility_name' => $this->input->post_get('facility_name'),
			'facility_type_id' => $this->input->post_get('facility_type_id'),
			'facility_parent_id' => $this->input->post_get('facility_parent_id'),
			'group_id' => $this->input->post_get('group_id')
		);

		$result = $this->denah_acara->editFacility($param);

		$param = array(
			'facility_parent_id' => $this->input->post_get('facility_id'), 
			'group_id' => $this->input->post_get('group_id')
		);

		$result = $this->denah_acara->editGroupFacilityChild($param);

		echo $result;
	}

	public function saveParticipantFacility(){
		$participant = explode(' ', $this->input->post_get('participant'), 2);
		$status = $this->input->post_get('status');

		if($status == 0){
			$param = array(
				'facility_id' => $this->input->post_get('facility_id'),
				'status' => $status
			);
		}else{
			$param = array(
				'title_name' => $participant[0],
				'participant_name' => $participant[1],
			);

			$result = $this->denah_acara->getParticipantsDetail($param);

			$param = array(
				'facility_id' => $this->input->post_get('facility_id'),
				'participant_id' => $result[0]->participant_id,
				'title_id' => $result[0]->title_id,
				'status' => $status
			);
		}

		$result = $this->denah_acara->saveParticipantFacility($param);
		echo $result;
	}

	public function saveCoordinateFacility(){
		$param = array(
			'facility_id' => $this->input->post_get('facility_id'),
			'x_axis' => $this->input->post_get('x_axis'),
			'y_axis' => $this->input->post_get('y_axis')
		);

		$result = $this->denah_acara->saveCoordinateFacility($param);
		echo $result;
	}
}
