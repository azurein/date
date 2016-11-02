<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require __DIR__ . '/../../assets/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

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

        $data = $this->verification->verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers);

        $this->printStruk($data);

        $this->view('admin/home');
	}

    public function checkVerification($card_id)
    {
        $data = $this->kehadiran->checkVerification($card_id);
        return $data[0]['checkVerification'];
    }

    public function printStruk($data)
    {
        /* Open the printer; this will change depending on how it is connected */
        $connector = new FilePrintConnector("//ROBINCOSAMAS-PC/pos58");
        $printer = new Printer($connector);

        /* Date is kept the same for testing */
        date_default_timezone_set('Asia/Jakarta');
        $date = date('D, jS M Y h:i A');

        /* Start the printer */
        $printer = new Printer($connector);

        /* Logo */
        // try {
        //     $tux = EscposImage::load("http://localhost:88/date/assets/img/qrcode-sample.png", false);
        //     $printer -> bitImage($tux);
        //     $printer -> feed();
        // } catch (Exception $e) {
        //     /* Images not supported on your PHP, or image file not found */
        //     $printer -> text($e -> getMessage() . "\n");
        // }

        /* Judul, Tanggal */
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text( $data[0]['event_name']."\n");
        $printer -> selectPrintMode();
        $printer -> text($data[0]['address']."\n");
        $printer -> text($date."\n\n");

        $printer -> text("-------------------------------\n\n");

        /* Meja, Pemdamping */
        $printer -> setTextSize(2, 2);
        $printer -> text("Table : ".$data[0]['table_name']."\n");
        $printer -> selectPrintMode();
        $printer -> text("Number of Coming Guest(s) : ".$data[0]['follower']."\n\n");

        /* Peserta, Doorprize */
        $printer -> setJustification();
        $printer -> text("  Name      : ".$data[0]['participant_name']."\n");
        $printer -> text("  Group     : ".$data[0]['group_name']."\n");
        $printer -> text("  Doorprize : ".$data[0]['lottery_num']."\n\n");

        $printer -> text("-------------------------------\n\n");

        /* Footer */
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text("Souvenir : 1\n");
        $printer -> selectPrintMode();
        $printer -> text("*Please show this ticket to our usher\n\n\n\n\n");

        $printer -> cut();
        $printer -> close();
    }

}
