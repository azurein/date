<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require __DIR__ . '/../../assets/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class VerificationSync extends Main_Controller {

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
        $this->model_2 = FALSE;
        $this->model_3 = FALSE;
        $this->model_4 = FALSE;
        $this->model_5 = FALSE;
        $this->model_6 = FALSE;
        $this->model_7 = FALSE;
        $this->model_8 = FALSE;
        $this->model_9 = FALSE;

		$this->load->model("Verification_model","verification");
        $this->load->model("Kehadiran_model","kehadiran");
        $this->load->model("Peserta_model","peserta");

        // if($this->ping($this->config->item('model_2'))) {
        // 	$this->load->model("Verification_model_2","verification_2");
        // 	$this->model_2 = TRUE;
        // }
        // if($this->ping($this->config->item('model_3'))) {
        // 	$this->load->model("Verification_model_3","verification_3");
        // 	$this->model_3 = TRUE;
        // }
        // if($this->ping($this->config->item('model_4'))) {
        // 	$this->load->model("Verification_model_4","verification_4");
        // 	$this->model_4 = TRUE;
        // }
        // if($this->ping($this->config->item('model_5'))) {
        // 	$this->load->model("Verification_model_5","verification_5");
        // 	$this->model_5 = TRUE;
        // }
        // if($this->ping($this->config->item('model_6'))) {
        //     $this->load->model("Verification_model_6","verification_6");
        //     $this->model_6 = TRUE;
        // }
        // if($this->ping($this->config->item('model_7'))) {
        //     $this->load->model("Verification_model_7","verification_7");
        //     $this->model_7 = TRUE;
        // }
        // if($this->ping($this->config->item('model_8'))) {
        //     $this->load->model("Verification_model_8","verification_8");
        //     $this->model_8 = TRUE;
        // }
        // if($this->ping($this->config->item('model_9'))) {
        //     $this->load->model("Verification_model_9","verification_9");
        //     $this->model_9 = TRUE;
        // }
	}

    public function index()
    {
        if(!isset($_SESSION['user_id'])) {
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

	public function verify()
	{
        try {

        $participant_id = $this->input->post_get('participantID');
        $card_id = $this->input->post_get('scannerInputQr');
        $follower =  $this->input->post_get('participantFollower1');
        $facilities = $this->input->post_get('selectFacility');
        $followers = $this->input->post_get('selectRepresentation');
        $souvenir_qty = $this->input->post_get('totalSouvenir');

        $curr_facilites = array();
        $fixed_facilites = array();
        $canceled_facilities = array();
        $additional_facilities = array();

        if(count($facilities) > 0) {
            //ambil fasilitas yang di-booking
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
        }

        $file = "C:/Users/KELOLATAMU/Desktop/error_log.txt";
        $msg = "Failed verification on ";
        $currdate = date('m/d/Y h:i:s a', time());

        $data = $this->verification->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers, $souvenir_qty);
        $this->printStruk($data, $follower, count($followers));

        if($this->model_2) {
			$this->verification_2->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers, $souvenir_qty);
		} else file_put_contents($file, $currdate.'. '.$this->config->item('model_2').": ".$card_id.PHP_EOL, FILE_APPEND | LOCK_EX);
		if($this->model_3) {
			$this->verification_3->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers, $souvenir_qty);
		} else file_put_contents($file, $currdate.'. '.$this->config->item('model_3').": ".$card_id.PHP_EOL, FILE_APPEND | LOCK_EX);
		if($this->model_4) {
			$this->verification_4->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers, $souvenir_qty);
		} else file_put_contents($file, $currdate.'. '.$this->config->item('model_4').": ".$card_id.PHP_EOL, FILE_APPEND | LOCK_EX);
		if($this->model_5) {
			$this->verification_5->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers, $souvenir_qty);
		} else file_put_contents($file, $currdate.'. '.$this->config->item('model_5').": ".$card_id.PHP_EOL, FILE_APPEND | LOCK_EX);
        if($this->model_6) {
            $this->verification_6->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers, $souvenir_qty);
        } else file_put_contents($file, $currdate.'. '.$this->config->item('model_6').": ".$card_id.PHP_EOL, FILE_APPEND | LOCK_EX);
        if($this->model_7) {
            $this->verification_7->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers, $souvenir_qty);
        } else file_put_contents($file, $currdate.'. '.$this->config->item('model_7').": ".$card_id.PHP_EOL, FILE_APPEND | LOCK_EX);
        if($this->model_8) {
            $this->verification_8->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers, $souvenir_qty);
        } else file_put_contents($file, $currdate.'. '.$this->config->item('model_8').": ".$card_id.PHP_EOL, FILE_APPEND | LOCK_EX);
        if($this->model_9) {
            $this->verification_9->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers, $souvenir_qty);
        } else file_put_contents($file, $currdate.'. '.$this->config->item('model_9').": ".$card_id.PHP_EOL, FILE_APPEND | LOCK_EX);

        } catch (Exception $e) {
            $this->session->set_flashdata('temp_card', $card_id);
            echo "<script>alert('Verifikasi gagal, pastikan koneksi printer dan wifi terhubung. Lakukan verifikasi kembali pada kode kartu dibawah ini.');</script>";
        }

        $this->view('admin/home');
	}

    public function checkVerification($card_id)
    {
        $data = $this->kehadiran->checkVerification($card_id);
        return $data[0]['checkVerification'];
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
        // $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        // $printer -> text($data[0]['event_name']."\n");
        // $printer -> selectPrintMode();
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
