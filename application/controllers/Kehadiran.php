<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kehadiran extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("Kehadiran_model","kehadiran");
		$this->load->model("acara/Pengaturan_acara_model","pengaturan_acara");
	}

	public function index()
	{
        if(isset($_SESSION['user_id'])) {
            $status = $this->pengaturan_acara->checkAvailableEvent();
            $id = $this->pengaturan_acara->getActiveEvent();

            if($status[0]['status_active'] == 1 && isset($id)) {
                $_SESSION['event_id'] = $id[0]['event_id'];
                $this->view('admin/kehadiran');
            } else {
                $this->view('admin/acara/pengaturan_acara');
            }
        } else {
            header('Location: '.base_url());
        }
	}

	public function getVerificationLog()
	{
		$key = $this->input->post_get('key');
		$user_id = $_SESSION['user_id'];
		$event_id = $_SESSION['event_id'];
		$data = $this->kehadiran->getVerificationLog($key, $user_id, $event_id);
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
