<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
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
    			$this->view('admin/peserta');
    		} else {
    			$this->view('admin/acara/pengaturan_acara');
    		}
        } else {
            header('Location: '.base_url());
        }
	}

	public function getForm()
	{
		$this->load->helper('form');
		echo form_open_multipart('Peserta/upload');
	}

	public function upload()
	{
		$filename = 'listpeserta'.date('YmdHis');

		$config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;

        $this->load->library('upload', $config);

        $_FILES['upload'] = $this->input->post_get('data');

        if ( ! $this->upload->do_upload('uploadXls'))
        {
                $error = array(
                	'status' => 0,
                	'error' => $this->upload->display_errors()
                );
                echo json_encode($error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

           	$this->uploadData($filename);

			echo json_encode(array('status' => 1 ));
        }
	}

	private function uploadData($filename){
		$this->load->library('excel');
		$this->load->helper('file');

		$file = './uploads/'.$filename;

		$file = file_exists($file.'.xls')? $file.'.xls' : $file.'.xlsx';

		$objReader = PHPExcel_IOFactory::createReaderForFile($file);
		$objReader->setReadDataOnly(true);
		$objReader->setLoadSheetsOnly("Participant");
		$this->excel = $objReader->load($file);

		$cell_collection = $this->excel->getActiveSheet()->getCellCollection();

		foreach ($cell_collection as $cell) {
		    $column = $this->excel->getActiveSheet()->getCell($cell)->getColumn();
		    $row = $this->excel->getActiveSheet()->getCell($cell)->getRow();
		    $data_value = $this->excel->getActiveSheet()->getCell($cell)->getValue();
		    if ($row != 1) {
		        $data[$row][$column] = $data_value;
		    }
		}

		$this->excel->disconnectWorksheets();
		unset($this->excel);

		delete_files('./uploads');

		$user = array(
			'userID' => $_SESSION['user_id'],
			'eventID' => $_SESSION['event_id']
		);

		$this->peserta->updateTable($data,$user);
	}

	public function getParticipant()
	{
		$key = $this->input->post_get('key');
		$event_id = $_SESSION['event_id'];
		$data = $this->peserta->getParticipant1($key, $event_id);
		echo json_encode($data);
	}

	public function getParticipantByID()
	{
		$id = $this->input->post_get('id');
		$data = $this->peserta->getParticipantByID($id);
		echo json_encode($data);
	}

	public function getTotalParticipant()
	{
		$data = $this->peserta->getTotalParticipant();
		echo json_encode($data);
	}

	public function getModalDdl()
	{
		$title = $this->peserta->getTitle1();
		$group = $this->peserta->getGroup1();

		$data = array(
			'title' => $title,
			'group' => $group
		);

		echo json_encode($data);
	}

	public function getNewID()
	{
		$newid = $this->peserta->getNewID();
		return $newid;
	}

	public function getAvailDelegateParticipant()
	{
		$participantID = $this->input->post_get('participantID');
		$result = $this->peserta->getAvailDelegateParticipant($participantID);
		echo json_encode($result);
	}

    public function changeParticipantStatus()
	{
		$is_confirm = $this->input->post_get('status');
		$participant_id = $this->input->post_get('id');
		$data = array(
			'is_confirm' => $is_confirm,
			'participant_id' => $participant_id
		);

		$result = $this->peserta->changeParticipantStatus($data);
		echo $result;
	}

	public function export()
	{
		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$this->excel->getActiveSheet()->setTitle('Participant');

		$this->excel->getActiveSheet()->setCellValue('A1','Kode Kartu');
		$this->excel->getActiveSheet()->setCellValue('B1','Title');
		$this->excel->getActiveSheet()->setCellValue('C1','Nama Peserta');
		$this->excel->getActiveSheet()->setCellValue('D1','Kontak');
		$this->excel->getActiveSheet()->setCellValue('E1','Group');
		$this->excel->getActiveSheet()->setCellValue('F1','Follower');
        $this->excel->getActiveSheet()->setCellValue('G1','Konfirmasi');

		for($col= 'A' ; $col !== 'H' ; $col++){
			$this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
			$colFill = $this->excel->getActiveSheet()->getStyle($col.'1')->getFill();
			$colFill->getStartColor()->setARGB('#ffff00');
			$colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		}

		$event_id = $_SESSION['event_id'];
		$data = $this->peserta->getParticipant1('',$event_id);
		$dataLen = count($data);

		for ($i=0; $i < $dataLen ; $i++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.($i+2),$data[$i]['card_id'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.($i+2),$data[$i]['title_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.($i+2),$data[$i]['participant_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('D'.($i+2),$data[$i]['phone_num'],PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('E'.($i+2),$data[$i]['group_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue('F'.($i+2),$data[$i]['follower']);
            $this->excel->getActiveSheet()->setCellValue('G'.($i+2),$data[$i]['is_confirm']);
		}

		$this->excel->createSheet();

		$this->excel->setActiveSheetIndex(1);

		$this->excel->getActiveSheet()->setTitle('Title');

		$data = $this->peserta->getTitle1();
		$dataLen = count($data);

		$this->excel->getActiveSheet()->setCellValue('A1','Title');

		$colFill = $this->excel->getActiveSheet()->getStyle('A1')->getFill();

		$colFill->getStartColor()->setARGB('#ffff00');
		$colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		for ($i = 0 ; $i < $dataLen-1 ; $i++){
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.($i+2),$data[$i+1]['title_name'],PHPExcel_Cell_DataType::TYPE_STRING);
		}

		$this->excel->createSheet();

		$this->excel->setActiveSheetIndex(2);

		$this->excel->getActiveSheet()->setTitle('Group');

		$data = $this->peserta->getGroup1();
		$dataLen = count($data);

		$this->excel->getActiveSheet()->setCellValue('A1','Group');

		$colFill = $this->excel->getActiveSheet()->getStyle('A1')->getFill();

		$colFill->getStartColor()->setARGB('#ffff00');
		$colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		for ($i = 0 ; $i < $dataLen-1 ; $i++){
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.($i+2),$data[$i+1]['group_name'],PHPExcel_Cell_DataType::TYPE_STRING);
		}

		$this->excel->setActiveSheetIndex(0);

		$filename="listpeserta.xls";

		header('Content-Type: application/vnd.ms-excel');

        header('Content-Disposition: attachment;filename="'.$filename.'"');

        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        $objWriter->save('php://output');

        $this->excel->disconnectWorksheets();
        unset($this->excel);
	}

}
