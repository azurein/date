<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require __DIR__ . '/../../assets/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class HomeSync extends Main_Controller {

    public $model_2;
	public $model_3;
	public $model_4;
	public $model_5;
    public $model_6;
    public $model_7;
    public $model_8;
    public $model_9;

   	public function __construct()
	{
		parent::__construct();
        $this->model_3 = FALSE;
        $this->model_4 = FALSE;
        $this->model_2 = FALSE;
        $this->model_5 = FALSE;
        $this->model_6 = FALSE;
        $this->model_7 = FALSE;
        $this->model_8 = FALSE;
        $this->model_9 = FALSE;

		$this->load->model("Home_model","home");
        $this->load->model("Peserta_model","peserta");
		$this->load->model("acara/Pengaturan_acara_model","pengaturan_acara");

        if($this->ping($this->config->item('model_2'))) {
        	$this->load->model("Home_model_2","home_2");
        	$this->model_2 = TRUE;
        }
        if($this->ping($this->config->item('model_3'))) {
        	$this->load->model("Home_model_3","home_3");
        	$this->model_3 = TRUE;
        }
        if($this->ping($this->config->item('model_4'))) {
        	$this->load->model("Home_model_4","home_4");
        	$this->model_4 = TRUE;
        }
        if($this->ping($this->config->item('model_5'))) {
        	$this->load->model("Home_model_5","home_5");
        	$this->model_5 = TRUE;
        }
        if($this->ping($this->config->item('model_6'))) {
            $this->load->model("Home_model_6","home_6");
            $this->model_6 = TRUE;
        }
        if($this->ping($this->config->item('model_7'))) {
            $this->load->model("Home_model_7","home_7");
            $this->model_7 = TRUE;
        }
        if($this->ping($this->config->item('model_8'))) {
            $this->load->model("Home_model_8","home_8");
            $this->model_8 = TRUE;
        }
        if($this->ping($this->config->item('model_9'))) {
            $this->load->model("Home_model_9","home_9");
            $this->model_9 = TRUE;
        }
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

    // Function to check response time
	public function ping($host,$port=80,$timeout=1) {
	    $fsock = fsockopen($host, $port, $errno, $errstr, $timeout);
	    if (!$fsock) {
	    	// fclose();
	    	return FALSE;
	    }
	    else {
	    	// fclose();
			return TRUE;
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
        $souvenir = $this->input->post_get('totalSouvenir2');
        $data = array(
            'new_id' => $this->getNewID(),
            'title' => $this->input->post_get('titleDdl'),
            'name' => $this->input->post_get('participantName2'),
            'phone_num' => $this->input->post_get('participantContact2'),
            'group' => $this->input->post_get('groupDdl'),
            'follower' => $this->input->post_get('participantFollower2'),
            'user_id' => $_SESSION['user_id'],
            'event_id' => $_SESSION['event_id'],
            'souvenir_qty' => $souvenir
        );

        $follower = $this->input->post_get('participantFollower2');
        $facilities = $this->input->post_get('selectFacility2');

        $result = $this->home->directRegistration($data, $facilities);
        $this->printStruk($result, $follower, $souvenir);

        if($this->model_2) {
            $this->home_2->directRegistration($data, $facilities);
        }
        if($this->model_3) {
            $this->home_3->directRegistration($data, $facilities);
        }
        if($this->model_4) {
            $this->home_4->directRegistration($data, $facilities);
        }
        if($this->model_5) {
            $this->home_5->directRegistration($data, $facilities);
        }
        if($this->model_6) {
            $this->home_6->directRegistration($data, $facilities);
        }
        if($this->model_7) {
            $this->home_7->directRegistration($data, $facilities);
        }
        if($this->model_8) {
            $this->home_8->directRegistration($data, $facilities);
        }
        if($this->model_9) {
            $this->home_9->directRegistration($data, $facilities);
        }

        $this->view('admin/home');
    }

    public function printStruk($data, $guest, $souvenir)
    {
        /* Open the printer; this will change depending on how it is connected */
        $connector = new FilePrintConnector($this->config->item('printer'));
        $printer = new Printer($connector);
        $logo = EscposImage::load($_SERVER["DOCUMENT_ROOT"]."/date/assets/img/acara/".$data[0]['event_img'] , false);

        /* Date is kept the same for testing */
        date_default_timezone_set('Asia/Jakarta');
        $date = date('D, jS M Y h:i A');

        /* Start the printer */
        $printer = new Printer($connector);

        $printer -> text(" \n");
        $printer -> bitImage($logo);
        $printer -> text("\n\n");

        /* Judul, Tanggal */
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text($data[0]['event_name']."\n");
        $printer -> selectPrintMode();
        $printer -> text($data[0]['address']."\n");
        $printer -> text($date."\n\n");

        $printer -> text("-------------------------------\n\n");

        /* Meja, Pemdamping */
        $printer -> setTextSize(2, 2);

        if($data[0]['table_name']) {
            $printer -> text("Table : ".$data[0]['table_name']."\n");
        }

        $printer -> selectPrintMode();
        $printer -> text("Number of Coming Guest(s) : ".($guest+1)."\n\n");

        /* Peserta, Doorprize */
        $printer -> setJustification();
        $printer -> text("  Name      : ".$data[0]['participant_name']."\n");
        // $printer -> text("  Group     : ".$data[0]['group_name']."\n");
        $printer -> text("  Doorprize : ".$data[0]['lottery_num']."\n\n");

        $printer -> text("-------------------------------\n\n");

        /* Footer */
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text("Souvenir : ".($souvenir+1)."\n");
        $printer -> selectPrintMode();
        $printer -> text("*Please show this ticket to our usher\n\n\n\n\n");

        $printer -> cut();
        $printer -> close();
    }

}
