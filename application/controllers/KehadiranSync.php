<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KehadiranSync extends Main_Controller {

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

		$this->load->model("Kehadiran_model","kehadiran");

		if($this->ping($this->config->item('model_2'))) {
			$this->load->model("Kehadiran_model_2","kehadiran_2");
			$this->model_2 = TRUE;
		}
		if($this->ping($this->config->item('model_3'))) {
			$this->load->model("Kehadiran_model_3","kehadiran_3");
			$this->model_3 = TRUE;
		}
		if($this->ping($this->config->item('model_4'))) {
			$this->load->model("Kehadiran_model_4","kehadiran_4");
			$this->model_4 = TRUE;
		}
		if($this->ping($this->config->item('model_5'))) {
			$this->load->model("Kehadiran_model_5","kehadiran_5");
			$this->model_5 = TRUE;
		}
		if($this->ping($this->config->item('model_6'))) {
            $this->load->model("Kehadiran_model_6","kehadiran_6");
            $this->model_6 = TRUE;
        }
        if($this->ping($this->config->item('model_7'))) {
            $this->load->model("Kehadiran_model_7","kehadiran_7");
            $this->model_7 = TRUE;
        }
        if($this->ping($this->config->item('model_8'))) {
            $this->load->model("Kehadiran_model_8","kehadiran_8");
            $this->model_8 = TRUE;
        }
        if($this->ping($this->config->item('model_9'))) {
            $this->load->model("Kehadiran_model_9","kehadiran_9");
            $this->model_9 = TRUE;
        }
	}

	public function index()
	{
		if(isset($_SESSION['user_id'])) {
    		$this->view('admin/kehadiran');
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

	public function getVerificationLog()
	{
		$key = $this->input->post_get('key');
		$data = $this->kehadiran->getVerificationLog($key);
		echo json_encode($data);
	}

	public function getTotalVerified()
	{
		$data = $this->kehadiran->getTotalVerified();
		echo json_encode($data);
	}

	public function getTotalVerifiedByUser()
	{
		$user_id = $_SESSION['user_id'];
		$result = $this->kehadiran->getTotalVerifiedByUser($user_id);
		echo json_encode($result);
	}

	public function checkCard()
	{
		$card_id = $this->input->post_get('card_id');
		$data = $this->kehadiran->checkCard($card_id);
		echo json_encode($data);
	}

	public function checkVerification()
	{
		$card_id = $this->input->post_get('card_id');
		$data = $this->kehadiran->checkVerification($card_id);
		echo json_encode($data);
	}

	public function getNewDate()
	{
		$newdate = $this->kehadiran->getNewDate();
		return $newdate;
	}

	public function saveVerificationLog()
	{
		$newDate = $this->getNewDate();

		$data = array(
			'newDate' => $newDate,
			'card_id' => $this->input->post_get('card_id'),
			'userID' => $_SESSION['user_id']
		);

		$result = $this->kehadiran->saveVerificationLog($data);
		if($this->model_2) {
			$this->kehadiran_2->saveVerificationLog($data);
		}
		if($this->model_3) {
			$this->kehadiran_3->saveVerificationLog($data);
		}
		if($this->model_4) {
			$this->kehadiran_4->saveVerificationLog($data);
		}
		if($this->model_5) {
			$this->kehadiran_5->saveVerificationLog($data);
		}
		if($this->model_6) {
			$this->kehadiran_6->saveVerificationLog($data);
		}
		if($this->model_7) {
			$this->kehadiran_7->saveVerificationLog($data);
		}
		if($this->model_8) {
			$this->kehadiran_8->saveVerificationLog($data);
		}
		if($this->model_9) {
			$this->kehadiran_9->saveVerificationLog($data);
		}
		echo $result;
	}

	public function deactiveVerificationLog()
	{
		$data = array(
			'log_id' => $this->input->post_get('id'),
			'userID' => $_SESSION['user_id']
		);
		$result = $this->kehadiran->deactiveVerificationLog($data);
		if($this->model_2) {
			$this->kehadiran_2->deactiveVerificationLog($data);
		}
		if($this->model_3) {
			$this->kehadiran_3->saveVerificationLog($data);
		}
		if($this->model_4) {
			$this->kehadiran_4->saveVerificationLog($data);
		}
		if($this->model_5) {
			$this->kehadiran_5->saveVerificationLog($data);
		}
		if($this->model_6) {
			$this->kehadiran_6->deactiveVerificationLog($data);
		}
		if($this->model_7) {
			$this->kehadiran_7->saveVerificationLog($data);
		}
		if($this->model_8) {
			$this->kehadiran_8->saveVerificationLog($data);
		}
		if($this->model_9) {
			$this->kehadiran_9->saveVerificationLog($data);
		}
		// echo $result;
		$this->index();
	}

	public function deactiveVerificationCard()
	{
		$data = array(
			'card_id' => $this->input->post_get('card_id'),
			'userID' => $_SESSION['user_id']
		);
		$result = $this->kehadiran->deactiveVerificationCard($data);
		if($this->model_2) {
			$this->kehadiran_2->deactiveVerificationCard($data);
		}
		if($this->model_3) {
			$this->kehadiran_3->deactiveVerificationCard($data);
		}
		if($this->model_4) {
			$this->kehadiran_4->deactiveVerificationCard($data);
		}
		if($this->model_5) {
			$this->kehadiran_5->deactiveVerificationCard($data);
		}
		if($this->model_6) {
			$this->kehadiran_6->deactiveVerificationCard($data);
		}
		if($this->model_7) {
			$this->kehadiran_7->deactiveVerificationCard($data);
		}
		if($this->model_8) {
			$this->kehadiran_8->deactiveVerificationCard($data);
		}
		if($this->model_9) {
			$this->kehadiran_9->deactiveVerificationCard($data);
		}
		echo $result;
	}

	public function export()
	{
		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$this->excel->getActiveSheet()->setTitle('Participant');

		$this->excel->getActiveSheet()->setCellValue('A1','Kode Kartu');
		$this->excel->getActiveSheet()->setCellValue('B1','Nama Peserta');
		$this->excel->getActiveSheet()->setCellValue('C1','Waktu Hadir');

		for($col= 'A' ; $col !== 'D' ; $col++){
			$this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
			$colFill = $this->excel->getActiveSheet()->getStyle($col.'1')->getFill();
			$colFill->getStartColor()->setARGB('#ffff00');
			$colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		}

		$data = $this->kehadiran->getParticipantAttendance();
		$dataLen = count($data);

		for ($i=0; $i < $dataLen ; $i++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.($i+2),$data[$i]['card_id'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.($i+2),$data[$i]['participant_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.($i+2),$data[$i]['verification_time'],PHPExcel_Cell_DataType::TYPE_STRING);
		}

		$this->excel->createSheet();

		$filename="listkehadiran.xls";

		header('Content-Type: application/vnd.ms-excel');

        header('Content-Disposition: attachment;filename="'.$filename.'"');

        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        $objWriter->save('php://output');

        $this->excel->disconnectWorksheets();
        unset($this->excel);
	}
}
