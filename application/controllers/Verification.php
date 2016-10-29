<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verification extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("Verification_model","verification");
        $this->load->model("Kehadiran_model","kehadiran");
        $this->load->model("Peserta_model","peserta");
	}

    public function index()
    {
        if(!isset($_SESSION['user_id'])) {
            header('Location: '.base_url());
        }
    }

	public function verify()
	{
        $participant_id = $this->input->post_get('participantID');
        $card_id = $this->input->post_get('scannerInputQr');
        $follower =  $this->input->post_get('participantFollower1');
        $facilities = $this->input->post_get('selectFacility');
        $followers = $this->input->post_get('selectRepresentation');

        //ambil fasilitas yang di-booking
        $curr_facilites = array();
        $temp_facilites = $this->peserta->getParticipantFacility($participant_id);
        foreach ($temp_facilites as $temp_facility) {
            array_push($curr_facilites, $temp_facility->facility_id);
        }

        //compare fasilitas yang di-booking dengan fasilitas yang akan di-checkin, adanya tiga kemungkinan:
        //fasilitas yang tetap jadi
        $fixed_facilites = array_values(array_intersect($curr_facilites, $facilities));
        //fasilitas yang tidak jadi
        $canceled_facilities = array_values(array_diff($curr_facilites, $facilities));
        //fasilitas tambahan
        $additional_facilities = array_values(array_diff($facilities, $curr_facilites));

        $this->verification->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers);
        $this->view('admin/home');
	}

    public function checkVerification($card_id)
    {
        $data = $this->kehadiran->checkVerification($card_id);
        return $data[0]['checkVerification'];
    }

}
