<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PesertaSync extends Main_Controller {

	public $model_2;
	public $model_3;
	public $model_4;
	public $model_5;

   	public function __construct()
	{
		parent::__construct();
		$this->model_2 = FALSE;
		$this->model_3 = FALSE;
		$this->model_4 = FALSE;
		$this->model_5 = FALSE;

		$this->load->model("Peserta_model","peserta");

		if($this->ping($this->config->item('model_2'))) {
			$this->load->model("Peserta_model_2","peserta_2");
			$this->model_2 = TRUE;
		}
		if($this->ping($this->config->item('model_3'))) {
			$this->load->model("Peserta_model_3","peserta_3");
			$this->model_3 = TRUE;
		}
		if($this->ping($this->config->item('model_4'))) {
			$this->load->model("Peserta_model_4","peserta_4");
			$this->model_4 = TRUE;
		}
		if($this->ping($this->config->item('model_5'))) {
			$this->load->model("Peserta_model_5","peserta_5");
			$this->model_5 = TRUE;
		}
	}

	public function index()
	{
		if(isset($_SESSION['user_id'])) {
			$this->view('admin/peserta');
        } else {
            header('Location: '.base_url());
        }
	}

	// Function to check response time
	public function ping($host,$port=80,$timeout=10) {
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

	public function getForm()
	{
		$this->load->helper('form');
		echo form_open_multipart('PesertaSync/upload');
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
		if($this->model_2) {
			$this->peserta_2->updateTable($data,$user);
		}
		if($this->model_3) {
			$this->peserta_3->updateTable($data,$user);
		}
		if($this->model_4) {
			$this->peserta_4->updateTable($data,$user);
		}
		if($this->model_5) {
			$this->peserta_5->updateTable($data,$user);
		}
	}

	public function getParticipant()
	{
		$key = $this->input->post_get('key');
		$data = $this->peserta->getParticipant1($key);
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

	public function saveParticipant()
	{
		$id = $this->input->post_get('id');

		if($id == '')
		{
			$data = array(
				'title' => $this->input->post_get('title'),
				'name' => $this->input->post_get('name'),
				'phone_num' => $this->input->post_get('phone_num'),
				'group' => $this->input->post_get('group'),
				'follower' => $this->input->post_get('follower'),
				'is_confirm' => '0',
				'delegate' => $this->input->post_get('delegate'),
				'userID' => $_SESSION['user_id'],
				'eventID' => $_SESSION['event_id']
			);

			$result = $this->peserta->createParticipant1($data);

			if($this->model_2) {
				$this->peserta_2->createParticipant1($data, $result);
			}
			if($this->model_3) {
				$this->peserta_3->createParticipant1($data, $result);
			}
			if($this->model_4) {
				$this->peserta_4->createParticipant1($data, $result);
			}
			if($this->model_5) {
				$this->peserta_5->createParticipant1($data, $result);
			}

 			$newID = $this->getNewID();

			$data = array(
				'newID' => $newID,
				'participantID' => $result,
				'userID' => $_SESSION['user_id'],
				'eventID' => $_SESSION['event_id']
			);

			$result = $this->peserta->createCard($data);
			if($this->model_2) {
				$this->peserta_2->createCard($data);
			}
			if($this->model_3) {
				$this->peserta_3->createCard($data);
			}
			if($this->model_4) {
				$this->peserta_4->createCard($data);
			}
			if($this->model_5) {
				$this->peserta_5->createCard($data);
			}
			echo $result;
		}
		else
		{
			$data = array(
				'id' => $this->input->post_get('id'),
				'title' => $this->input->post_get('title'),
				'name' => $this->input->post_get('name'),
				'phone_num' => $this->input->post_get('phone_num'),
				'group' => $this->input->post_get('group'),
				'follower' => $this->input->post_get('follower'),
				'delegate' => $this->input->post_get('delegate'),
				'userID' => $_SESSION['user_id'],
				'eventID' => $_SESSION['event_id']
			);

			$result = $this->peserta->editParticipant($data);
			if($this->model_2) {
				$this->peserta_2->editParticipant($data);
			}
			if($this->model_3) {
				$this->peserta_3->editParticipant($data);
			}
			if($this->model_4) {
				$this->peserta_4->editParticipant($data);
			}
			if($this->model_5) {
				$this->peserta_5->editParticipant($data);
			}
			echo $result;
		}
	}

	public function getNewID()
	{
		$newid = $this->peserta->getNewID();
		return $newid;
	}

	public function resetCardID()
	{
		$newID = $this->getNewID();

		$data = array(
			'newID' => $newID,
			'cardID' => $this->input->post_get('cardID'),
			'userID' => $_SESSION['user_id']
		);

		$result = $this->peserta->resetCardID($data);
		if($this->model_2) {
			$this->peserta_2->resetCardID($data);
		}
		if($this->model_3) {
			$this->peserta_3->resetCardID($data);
		}
		if($this->model_4) {
			$this->peserta_4->resetCardID($data);
		}
		if($this->model_5) {
			$this->peserta_5->resetCardID($data);
		}
		echo $result;
	}

	public function deleteParticipantById()
	{
		$data = array(
			'participantID' => $this->input->post_get('id'),
			'userID' => $_SESSION['user_id']
		);
		$result = $this->peserta->deactiveParticipantById($data);
		if($this->model_2) {
			$this->peserta_2->deactiveParticipantById($data);
		}
		if($this->model_3) {
			$this->peserta_3->deactiveParticipantById($data);
		}
		if($this->model_4) {
			$this->peserta_4->deactiveParticipantById($data);
		}
		if($this->model_5) {
			$this->peserta_5->deactiveParticipantById($data);
		}
		echo $result;
	}

	public function getAvailDelegateParticipant()
	{
		$participantID = $this->input->post_get('participantID');
		$result = $this->peserta->getAvailDelegateParticipant($participantID);
		echo json_encode($result);
	}

	public function export()
	{
		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$this->excel->getActiveSheet()->setTitle('Participant');

		$this->excel->getActiveSheet()->setCellValue('A1','Kode Kartu');
		$this->excel->getActiveSheet()->setCellValue('B1','Title');
		$this->excel->getActiveSheet()->setCellValue('C1','Nama Peserta');
		$this->excel->getActiveSheet()->setCellValue('D1','Group');
		$this->excel->getActiveSheet()->setCellValue('E1','Follower');

		for($col= 'A' ; $col !== 'F' ; $col++){
			$this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
			$colFill = $this->excel->getActiveSheet()->getStyle($col.'1')->getFill();
			$colFill->getStartColor()->setARGB('#ffff00');
			$colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		}

		$data = $this->peserta->getParticipant1();
		$dataLen = count($data);

		for ($i=0; $i < $dataLen ; $i++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.($i+2),$data[$i]['card_id'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.($i+2),$data[$i]['title_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.($i+2),$data[$i]['participant_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.($i+2),$data[$i]['group_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue('E'.($i+2),$data[$i]['follower']);
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

	public function import(){
		$file = $_FILES;
		echo json_encode($file);
	}
}
