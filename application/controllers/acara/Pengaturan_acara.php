<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_acara extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("acara/Pengaturan_acara_model","pengaturan_acara");
	}

	public function index()
	{
        if(isset($_SESSION['user_id'])) {
            $this->view('admin/acara/pengaturan_acara');
        } else {
            header('Location: '.base_url());
        }
	}

	public function getEvent()
	{
		$data = $this->pengaturan_acara->getEvent();
		echo json_encode($data);
	}

	public function getEventByID()
	{
		$id = $this->input->post_get('id');
		$data = $this->pengaturan_acara->getEventByID($id);
		echo json_encode($data);
	}

	public function getSouvenir()
	{
		$id = $this->input->post_get('id');
		$data = $this->pengaturan_acara->getSouvenir($id);
		echo json_encode($data);
	}

	public function getModalDdl()
	{
		$event_type = $this->pengaturan_acara->getEventType();
		$city = $this->pengaturan_acara->getCity();

		$data = array(
			'event_type' => $event_type,
			'city' => $city
		);
		echo json_encode($data);
	}

	public function checkAvailableEvent()
	{
		$data = $this->pengaturan_acara->checkAvailableEvent();
		echo json_encode($data);
	}

	public function changeEventStatus()
	{
		$is_active = $this->input->post_get('status');
		$event_id = $this->input->post_get('id');
		$data = array(
			'is_active' => $is_active,
			'event_id' => $event_id
		);

		if($is_active == '1') {
			$_SESSION['event_id'] = $event_id;
		}

		$result = $this->pengaturan_acara->changeEventStatus($data);
		echo $result;
	}

	public function uploadEvent()
	{
		$config = array(
					'upload_path'     => "assets/img/acara/",
					'allowed_types'   => "jpg|jpeg|png",
					'file_name'		  => $_FILES['userfile']['name'],
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
		echo $config['file_name'];
	}

	public function saveEvent()
	{
		$id = $this->input->post_get('id');
		$data = array(
			'event_id' => $this->input->post_get('id'),
			'event_name' => $this->input->post_get('event_name'),
			'event_type_id' => $this->input->post_get('event_type_id'),
			'event_img' => $this->input->post_get('event_img'),
			'start_at' => $this->input->post_get('start_at'),
			'end_at' => $this->input->post_get('end_at'),
			'address' => $this->input->post_get('address'),
			'city' => $this->input->post_get('city'),
			'total_invitation' => $this->input->post_get('total_invitation'),
		);

		if($id == '') {
			$result = $this->pengaturan_acara->createEvent($data);

		} else {
			$result = $this->pengaturan_acara->editEvent($data);
		}
		echo $result;
	}

	public function saveSouvenir()
	{
		$user_id = $_SESSION['user_id'];
		$event_id = $this->input->post_get('id');

		$data = array(
			'user_id' => $user_id,
			'event_id' => $event_id
		);
		$result = $this->pengaturan_acara->clearSouvenir($data);

		for ($i=0; $i < $this->input->post_get('length'); $i++) {
			$counter = "$i";
			$data = array(
				'souvenir_name' => $this->input->post_get('souvenir_name_'.$i),
				'souvenir_qty' => $this->input->post_get('souvenir_qty_'.$i),
				'user_id' => $user_id,
				'event_id' => $event_id
			);
			$result = $this->pengaturan_acara->createSouvenir($data);
		}
		echo $result;
	}

	public function deleteEventByID()
	{
		$data = array(
			'event_id' => $this->input->post_get('id'),
			'user_id' => $_SESSION['user_id']
		);
		$result = $this->pengaturan_acara->deactiveEventByID($data);
		echo $result;
	}

    public function export()
	{
		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Berita Acara');

        $r = 1;
        $s = 0;
        $e = 0;

        $this->excel->getActiveSheet()->setCellValue('A'.$r,'Dear, [Client Name]'); $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'Thank you for using our service on your event. Here is the report of your event based on our'); $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'data collection from KELOLATAMU application. We hope this information can be useful for your'); $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'feedback.'); $r++;
        $r++;
        $data = $this->pengaturan_acara->getActiveEvent();
        $date = date_format(date_create($data[0]['start_at']), 'D, jS M Y h:i A');
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'Event Details'); $r++;
		$this->excel->getActiveSheet()->setCellValue('A'.$r,'Name');
        $this->excel->getActiveSheet()->setCellValue('C'.$r,': '.$data[0]['event_name']); $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'Location');
        $this->excel->getActiveSheet()->setCellValue('C'.$r,': '.$data[0]['address']); $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'Date & Time');
        $this->excel->getActiveSheet()->setCellValue('C'.$r,': '.$date); $r++;
        $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'Data Collection'); $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'I.');
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'Total Invitation : all guests who are invited by the client'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Total Attendees : the total guest who attended the event'); $r++;
        // Table I
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Group');
        $this->excel->getActiveSheet()->setCellValue('C'.$r,'Total Invitation');
        $this->excel->getActiveSheet()->setCellValue('D'.$r,'Total Attendees');
		for($col= 'B' ; $col !== 'E' ; $col++){
			$colFill = $this->excel->getActiveSheet()->getStyle($col.$r)->getFill();
			$colFill->getStartColor()->setARGB('#ffff00');
			$colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		}
		$data = $this->pengaturan_acara->getTableI();
		$dataLen = count($data); $r--;
		for ($i=0; $i < $dataLen ; $i++) {
            if($i == 0) {
                $s = $r+2;
            } else if($i == $dataLen-1) {
                $e = $r+2;
            }
			$this->excel->getActiveSheet()->setCellValue('B'.($r+2),$data[$i]['group_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue('C'.($r+2),$data[$i]['invite'],PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
			$this->excel->getActiveSheet()->setCellValue('D'.($r+2),$data[$i]['attend'],PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
            $r++;
		}
        $this->excel->getActiveSheet()->getStyle('B'.($s-1).':D'.$e)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )
        );
        $r++; $r++;
        $this->excel->getActiveSheet()->setCellValue('C'.$r,'=SUM(C'.$s.':C'.$e.')');
        $this->excel->getActiveSheet()->setCellValue('D'.$r,'=SUM(D'.$s.':D'.$e.')');
        for($col= 'C' ; $col !== 'E' ; $col++){
            $colFill = $this->excel->getActiveSheet()->getStyle($col.$r)->getFill();
            $colFill->getStartColor()->setARGB('#ffff00');
            $colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        }
        $this->excel->getActiveSheet()->getStyle('C'.$r.':D'.$r)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )
        );
        $r++; $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'II.');
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'Guest Confirmation of Attendance Record and the Actual Attendance on the event'); $r++;
        // Table II
        $this->excel->getActiveSheet()->setCellValue('C'.$r,'Name');
        $this->excel->getActiveSheet()->setCellValue('D'.$r,'Phone');
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Group');
        $this->excel->getActiveSheet()->setCellValue('E'.$r,'Number of Pax');
        $this->excel->getActiveSheet()->setCellValue('F'.$r,'Attendance');
		for($col= 'B' ; $col !== 'G' ; $col++){
			$colFill = $this->excel->getActiveSheet()->getStyle($col.$r)->getFill();
			$colFill->getStartColor()->setARGB('#ffff00');
			$colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		}
		$data = $this->pengaturan_acara->getTableII();
		$dataLen = count($data); $r--;
		for ($i=0; $i < $dataLen ; $i++) {
            if($i == 0) {
                $s = $r+2;
            } else if($i == $dataLen-1) {
                $e = $r+2;
            }
            $this->excel->getActiveSheet()->setCellValue('B'.($r+2),$data[$i]['group_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('C'.($r+2),$data[$i]['title_name']." ".$data[$i]['participant_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('D'.($r+2),$data[$i]['phone_num'],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue('E'.($r+2),$data[$i]['follower_prev']+1,PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
			$this->excel->getActiveSheet()->setCellValue('F'.($r+2),$data[$i]['follower']+1,PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
            $r++;
		}
        $this->excel->getActiveSheet()->getStyle('B'.($s-1).':F'.$e)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )
        );
        $r++; $r++;
        $this->excel->getActiveSheet()->setCellValue('E'.$r,'=SUM(E'.$s.':E'.$e.')');
        $this->excel->getActiveSheet()->setCellValue('F'.$r,'=SUM(F'.$s.':F'.$e.')');
        for($col= 'E' ; $col !== 'G' ; $col++){
            $colFill = $this->excel->getActiveSheet()->getStyle($col.$r)->getFill();
            $colFill->getStartColor()->setARGB('#ffff00');
            $colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        }
        $this->excel->getActiveSheet()->getStyle('E'.$r.':F'.$r)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )
        );
        $r++; $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Table Information:'); $r++;
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'a. Group: Guest Group Invitation [VVIP/VIP/Family/Friends/Others]'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'     "Others" may refer to :'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'     - the "uninvited" guest that present to the event'); $r++;
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'b. Name: Guest Name'); $r++;
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'c. Phone: Guest Phone Number'); $r++;
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'d. Number of Pax: Number of Pax that Valid in One Invitation'); $r++;
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'e. Attendance: The actual number of pax during the event');
        $r++; $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'III.');
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'Detailed Attendance Guest Report per Station / Per Guest Book'); $r++;
        $r++;
        // Table III
        $operator = $this->pengaturan_acara->getOperator();
        $operatorLen = count($operator);
        for ($i=0; $i < $operatorLen ; $i++) {
            $this->excel->getActiveSheet()->setCellValue('B'.$r,$operator[$i]['operator_name']); $r++;
            // $this->excel->getActiveSheet()->setCellValue('B'.$r,'No');
            $this->excel->getActiveSheet()->setCellValue('B'.$r,'Guest Name');
            $this->excel->getActiveSheet()->setCellValue('C'.$r,'Group');
            $this->excel->getActiveSheet()->setCellValue('D'.$r,'Time');
            $this->excel->getActiveSheet()->setCellValue('E'.$r,'Note');
    		for($col= 'B' ; $col !== 'F' ; $col++){
    			$colFill = $this->excel->getActiveSheet()->getStyle($col.$r)->getFill();
    			$colFill->getStartColor()->setARGB('#ffff00');
    			$colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    		}
            if($i == 0) {
                $this->excel->getActiveSheet()->getStyle('B'.$r.':E'.$r)->applyFromArray(
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        ),
                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        )
                    )
                );
            }
            $data = $this->pengaturan_acara->getTableIII($operator[$i]['user_id']);
    		$dataLen = count($data); $r--;
    		for ($j=0; $j < $dataLen ; $j++) {
                if($j == 0) {
                    $s = $r+2;
                } else if($j == $dataLen-1) {
                    $e = $r+2;
                }
                $date = date_format(date_create($data[$j]['verification_date']), 'H:i');
                // $this->excel->getActiveSheet()->setCellValue('B'.($r+2),$j+1,PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValue('B'.($r+2),$data[$j]['title_name']." ".$data[$j]['participant_name'],PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValue('C'.($r+2),$data[$j]['group_name'],PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValue('D'.($r+2),$date,PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValue('E'.($r+2),$data[$j]['note'],PHPExcel_Cell_DataType::TYPE_STRING);
                $r++;
    		}
            if($i == 0) {
                $this->excel->getActiveSheet()->getStyle('B'.($s).':E'.($r+1))->applyFromArray(
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        ),
                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        )
                    )
                );
            } else {
                $this->excel->getActiveSheet()->getStyle('B'.($s-1).':E'.$e)->applyFromArray(
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        ),
                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        )
                    )
                );
            }
            $r++; $r++; $r++;
        }
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Table Information:'); $r++;
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'a. Guest Name: Guest Name'); $r++;
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'b. Group: Guest Group Invitation [VVIP/VIP/Family/Friends/Others]'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'     "Others" may refer to :'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'     - the "uninvited" guest that present to the event'); $r++;
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'c. Time: Guest arriving time'); $r++;
		$this->excel->getActiveSheet()->setCellValue('B'.$r,'e. Note: - the "-" sign means the guest come for his / her self');
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'     - "Represented" means the Guest didn’t come but they  entrusted their angpao to'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'     other guest. For detailed Report, please refer to "SOUVENIR & GIFT RECORD" below'); $r++;
        $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'IV.');
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Souvenir & Gift (Angpao) Record'); $r++;
        // Table IV
        $s = $r;
        $data = $this->pengaturan_acara->getTableIV();
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Number of Souvenirs Available');
        $this->excel->getActiveSheet()->setCellValue('D'.$r,$data[0]['souvenir_qty'].' pcs',PHPExcel_Cell_DataType::TYPE_STRING); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Number of Distributed Souvenirs');
        $this->excel->getActiveSheet()->setCellValue('D'.$r,$data[0]['souvenir_dist'].' pcs',PHPExcel_Cell_DataType::TYPE_STRING); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Number of Leftover Souvenirs');
        $e = $r;
        $this->excel->getActiveSheet()->setCellValue('D'.$r,$data[0]['souvenir_left'].' pcs',PHPExcel_Cell_DataType::TYPE_STRING); $r++;
        $this->excel->getActiveSheet()->getStyle('B'.$s.':D'.$e)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'The following are the details:'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'a. Souvenir will only given if the guest bring Angpao (based on client agreements)'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'b. One Souvenir is for One Angpao (based on client agreements)'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'c. Event that may occur : guests that are confirmed not present can entrust their Angpao to '); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'     another guest, the souvenir will also be given to the guest (the record is provided below)'); $r++;
        $r++;
        // Table V
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Guest Name');
        // $this->excel->getActiveSheet()->setCellValue('C'.$r,'');
        $this->excel->getActiveSheet()->setCellValue('C'.$r,'Represented Guest');
        for($col= 'B' ; $col !== 'D' ; $col++){
            $colFill = $this->excel->getActiveSheet()->getStyle($col.$r)->getFill();
            $colFill->getStartColor()->setARGB('#ffff00');
            $colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        }
        $data = $this->pengaturan_acara->getTableV();
        $dataLen = count($data); $r--;
        for ($i=0; $i < $dataLen ; $i++) {
            if($i == 0) {
                $s = $r+2;
            } else if($i == $dataLen-1) {
                $e = $r+2;
            }
            $this->excel->getActiveSheet()->setCellValue('B'.($r+2),$data[$i]['participant_title']." ".$data[$i]['participant_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            // $this->excel->getActiveSheet()->setCellValue('C'.($r+2),'>>',PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('C'.($r+2),$data[$i]['represented_title']." ".$data[$i]['represented_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            $r++;
        }
        $this->excel->getActiveSheet()->getStyle('B'.($s-1).':C'.$e)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )
        );
        $r++; $r++; $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Table Information:'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'a. Guest Name : Guest who come and bring the Angpao (status : present)'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,"b. Represented Guests : Guest who couldn't come and entrust their Angpao"); $r++;
        $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'V.');
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'E-Maps'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Map seating guests during the event (file attached)'); $r++;
        $r++;
        // Table VI
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Details per table number:'); $r++;
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Table No.');
        $this->excel->getActiveSheet()->setCellValue('C'.$r,'Guest Name');
        for($col= 'B' ; $col !== 'D' ; $col++){
            $colFill = $this->excel->getActiveSheet()->getStyle($col.$r)->getFill();
            $colFill->getStartColor()->setARGB('#ffff00');
            $colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        }
        $data = $this->pengaturan_acara->getTableVI();
        $dataLen = count($data); $r--;
        for ($i=0; $i < $dataLen ; $i++) {
            if($i == 0) {
                $s = $r+2;
            } else if($i == $dataLen-1) {
                $e = $r+2;
            }
            $this->excel->getActiveSheet()->setCellValue('B'.($r+2),$data[$i]['facility_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('C'.($r+2),$data[$i]['title_name']." ".$data[$i]['participant_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            $r++;
        }
        $this->excel->getActiveSheet()->getStyle('B'.($s-1).':C'.$e)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )
        );
        $r++; $r++; $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,'VI.');
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Doorprize'); $r++;
        // Table VII
        $this->excel->getActiveSheet()->setCellValue('B'.$r,'Qty');
        $this->excel->getActiveSheet()->setCellValue('C'.$r,'Doorprize Name');
        $this->excel->getActiveSheet()->setCellValue('D'.$r,'Winner');
        $this->excel->getActiveSheet()->setCellValue('E'.$r,'Group');
        for($col= 'B' ; $col !== 'F' ; $col++){
            $colFill = $this->excel->getActiveSheet()->getStyle($col.$r)->getFill();
            $colFill->getStartColor()->setARGB('#ffff00');
            $colFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        }
        $data = $this->pengaturan_acara->getTableVII();
        $dataLen = count($data); $r--;
        for ($i=0; $i < $dataLen ; $i++) {
            if($i == 0) {
                $s = $r+2;
            } else if($i == $dataLen-1) {
                $e = $r+2;
            }
            $this->excel->getActiveSheet()->setCellValue('B'.($r+2),$data[$i]['total_winner'],PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('C'.($r+2),$data[$i]['prize_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('D'.($r+2),$data[$i]['title_name']." ".$data[$i]['participant_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValue('E'.($r+2),$data[$i]['group_name'],PHPExcel_Cell_DataType::TYPE_STRING);
            $r++;
        }
        $this->excel->getActiveSheet()->getStyle('B'.($s-1).':E'.$e)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )
        );
        $r++; $r++; $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,"Therefore this report we made based on actual event. If you have any inquiry, please don't hesitate"); $r++;
        $this->excel->getActiveSheet()->setCellValue('A'.$r,"to contact us.");

        for($col= 'C' ; $col !== 'G' ; $col++){
            $this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }
        $this->excel->getActiveSheet()->calculateColumnWidths();
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(19);
		$this->excel->createSheet();
		$filename="Berita Acara.xls";

		header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');

        $this->excel->disconnectWorksheets();
        unset($this->excel);
	}

}
