<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("Home_model","home");
        $this->load->model("Peserta_model","peserta");
		$this->load->model("acara/Pengaturan_acara_model","pengaturan_acara");
	}

	public function index()
	{
        if(isset($_SESSION['user_id'])) {
            $status = $this->pengaturan_acara->checkAvailableEvent();
            $id = $this->pengaturan_acara->getActiveEvent();

            if($status[0]['status_active'] == 1 && isset($id)) {
                $_SESSION['event_id'] = $id[0]['event_id'];
                $this->view('admin/home');
            } else {
                $this->view('admin/acara/pengaturan_acara');
            }
        } else {
            header('Location: '.base_url());
        }
	}

    public function getNewID()
	{
		$newid = $this->peserta->getNewID();
		return $newid;
	}

	public function getParticipantByCardID()
	{
		$card_id = $this->input->post_get('card_id');
		$data = $this->home->getParticipantByCardID($card_id);
		echo json_encode($data);
	}

    public function getParticipantRepresentation()
	{
		$participant_id = $this->input->post_get('participant_id');
		$data = $this->home->getParticipantRepresentation($participant_id);
		echo json_encode($data);
	}

    public function getParticipantFacility()
	{
        $group_id = $this->input->post_get('group_id');
		$participant_id = $this->input->post_get('participant_id');
		$data = $this->home->getParticipantFacility($group_id, $participant_id);
		echo json_encode($data);
	}

    public function checkAvailableFacility()
	{
		$group_id = $this->input->post_get('group_id');
        $follower = $this->input->post_get('follower');
		$data = $this->home->checkAvailableFacility($group_id, $follower);
		echo json_encode($data);
	}

    public function directRegistration()
    {
        $data = array(
            'new_id' => $this->getNewID(),
            'title' => $this->input->post_get('titleDdl'),
            'name' => $this->input->post_get('participantName2'),
            'phone_num' => $this->input->post_get('participantContact2'),
            'group' => $this->input->post_get('groupDdl'),
            'follower' => $this->input->post_get('participantFollower2'),
            'user_id' => $_SESSION['user_id'],
            'event_id' => $_SESSION['event_id']
        );

        $facilities = $this->input->post_get('selectFacility2');

        $this->home->directRegistration($data, $facilities);
        $this->view('admin/home');
    }

}
