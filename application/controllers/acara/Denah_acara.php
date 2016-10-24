<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denah_acara extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model("acara/Denah_acara_model","denah_acara");
		$this->load->helper(array('url','form'));
	}

	public function index()
	{
		$_SESSION['user_id'] = '0';
		$_SESSION['event_id'] = '1';

		$this->view('admin/acara/denah_acara');
	}

	public function getAutoCompleteParticipants()
	{
		$param = array(
			'group_id' => $this->input->post_get('group_id')
		);

		$data = $this->denah_acara->getAutoCompleteParticipants($param);

		echo json_encode($data);
	}

	public function getDetailCanvas()
	{
		$param = array(
			'canvas_slideid' => $this->input->post_get('canvas_slideid')
		);

		$result = $this->denah_acara->getDetailCanvas($param);
		echo json_encode($result);
	}

	public function checkCanvasName()
	{
		$param = array(
			'canvas_name' => $this->input->post_get('canvas_name'),
			'canvas_id' => $this->input->post_get('canvas_id')
		);

		$result = $this->denah_acara->checkCanvasName($param);
		echo json_encode($result);
	}

	public function insertCanvas()
	{
		$param = array(
			'canvas_name' => $this->input->post_get('canvas_name'),
			'canvas_slideid' => $this->input->post_get('canvas_slideid'),
			'canvas_img' => $this->input->post_get('canvas_img'),
			'canvas_width' => $this->input->post_get('canvas_width'),
			'canvas_height' => $this->input->post_get('canvas_height')
		);

		$result = $this->denah_acara->insertCanvas($param);
		echo json_encode($result);
	}

	public function updateCanvasName(){
		$param = array(
			'canvas_name' => $this->input->post_get('canvas_name'),
			'canvas_id' => $this->input->post_get('canvas_id')
		);

		$result = $this->denah_acara->updateCanvasName($param);
		echo json_encode($result);
	}

	public function deleteCanvas(){
		$param = array(
			'canvas_id' => $this->input->post_get('canvas_id')
		);

		$result = $this->denah_acara->deleteCanvas($param);
		echo json_encode($result);
	}

	public function getFacilityType(){
		$param = array(
			'is_parent' => $this->input->post_get('is_parent')
		);

		$result = $this->denah_acara->getFacilityType($param);

		echo json_encode($result);
	}

    public function getParentSummary(){
        $parent_status = $this->input->post_get('parent_status');
		$result = $this->denah_acara->getParentSummary($parent_status);
		echo json_encode($result);
	}

    public function getChildSummary(){
        $child_status = $this->input->post_get('child_status');
		$result = $this->denah_acara->getChildSummary($child_status);
		echo json_encode($result);
	}

	public function getFacilityGroup(){
		$result = $this->denah_acara->getFacilityGroup();
		echo json_encode($result);
	}

	public function getFacilityGroupFromFacility(){
		$param = array(
			'facility_id' => $this->input->post_get('facility_id')
		);

		$result = $this->denah_acara->getFacilityGroupFromFacility($param);

		echo json_encode($result);
	}

	public function loadFacilityFrom(){
		$param = array(
			'canvas_id' => $this->input->post_get('canvas_id'),
			'canvas_slideid' => $this->input->post_get('canvas_slideid')
		);
		$result = $this->denah_acara->loadFacilityFrom($param);
		echo json_encode($result);
	}

	public function addFacility(){
		$param = array(
			'facility_type_id' => $this->input->post_get('facility_type_id'),
			'facility_parent_id' => $this->input->post_get('facility_parent_id'),
			'canvas_id' => $this->input->post_get('canvas_id'),
			'canvas_slideid' => $this->input->post_get('canvas_slideid'),
			'group_id' => $this->input->post_get('group_id'),
			'facility_name' => $this->input->post_get('facility_name')
		);
		$result = $this->denah_acara->addFacility($param);
		echo json_encode($result);
	}

	public function getFacilityDetail(){
		$param = array(
			'canvas_id' => $this->input->post_get('canvas_id'),
			'canvas_slideid' => $this->input->post_get('canvas_slideid')
		);
		$result = $this->denah_acara->getFacilityDetail($param);
		echo json_encode($result);
	}

	public function uploadCanvasImage($id)
	{
		$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
		$config = array(
                  'upload_path'     => "assets/img/denah/",
                  'allowed_types'   => "jpg|jpeg|png|gif",
                  'file_name'		=> $id.'.'.$ext,
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

        //echo $config['upload_path'].$config['file_name'];
        echo $config['file_name'];
	}

	public function saveCanvasImage()
	{
		$param = array(
			'canvas_id' => $this->input->post_get('canvas_id'),
			'canvas_img' => $this->input->post_get('canvas_img')
		);

		$result = $this->denah_acara->saveCanvasImage($param);

		echo $result;
	}

	public function deleteFacility()
	{
		$param = array(
			'facility_id' => $this->input->post_get('facility_id')
		);

		$result = $this->denah_acara->deleteFacility($param);

		echo $result;
	}

	public function editFacility(){
		$param = array(
			'facility_id' => $this->input->post_get('facility_id'),
			'facility_name' => $this->input->post_get('facility_name'),
			'facility_type_id' => $this->input->post_get('facility_type_id'),
			'facility_parent_id' => $this->input->post_get('facility_parent_id'),
			'group_id' => $this->input->post_get('group_id')
		);

		$result = $this->denah_acara->editFacility($param);

		$param = array(
			'facility_parent_id' => $this->input->post_get('facility_id'),
			'group_id' => $this->input->post_get('group_id')
		);

		$result = $this->denah_acara->editGroupFacilityChild($param);

		echo $result;
	}

	public function saveParticipantFacility(){
		$participant = explode(' ', $this->input->post_get('participant'), 2);
		$status = $this->input->post_get('status');
		$error = false;

		if($status == 0){
			$paramDelete = array('facility_id' => $this->input->post_get('facility_id'));
			$this->denah_acara->deleteParticipantFollower($paramDelete);
			$param = array(
				'facility_id' => $this->input->post_get('facility_id'),
				'status' => $status
			);
		}else{
			$param = array(
				'title_name' => $participant[0],
				'participant_name' => $participant[1]
			);

			$result = $this->denah_acara->getParticipantsDetail($param);

			$paramSibling = array(
				'facility_id' => $this->input->post_get('facility_id'),
				'facility_parent_id' => $this->input->post_get('facility_parent_id')
			);
			$totalSibling = $this->denah_acara->getFacilitySiblings($paramSibling);

			$paramCheckParticipant = array(
				'facility_id' => $this->input->post_get('facility_id'),
				'participant_id' => $result[0]->participant_id
			);

			$CheckParticipant = $this->denah_acara->checkParticiantChangeStatus($paramCheckParticipant);

			if(!isset($totalSibling)){
				$totalSiblings = 0;
			}else{
				$totalSiblings = count($totalSibling);
			}
			if((intval($result[0]->follower) > $totalSiblings) && empty($CheckParticipant)){
				$error = true;
			}else{
				$paramDelete = array('facility_id' => $this->input->post_get('facility_id'));
				$this->denah_acara->deleteParticipantFollower($paramDelete);
				//re check siblings
				$totalSibling = $this->denah_acara->getFacilitySiblings($paramSibling);
				//to insert siblings
				for($i = 0;$i< intval($result[0]->follower);$i++){
					$param = array(
						'facility_id' => $totalSibling[$i]->facility_id,
						'participant_id' => $result[0]->participant_id,
						'title_id' => $result[0]->title_id,
						'status' => $status
					);

					$this->denah_acara->saveParticipantFacility($param);
				}
			}

			$param = array(
				'facility_id' => $this->input->post_get('facility_id'),
				'participant_id' => $result[0]->participant_id,
				'title_id' => $result[0]->title_id,
				'status' => $status
			);
		}
		if(!$error){
			$result = $this->denah_acara->saveParticipantFacility($param);
			echo $result;
		}else{
			echo (intval($result[0]->follower) - $totalSiblings);
		}
	}

	public function saveCoordinateFacility(){
		$param = array(
			'facility_id' => $this->input->post_get('facility_id'),
			'x_axis' => $this->input->post_get('x_axis'),
			'y_axis' => $this->input->post_get('y_axis')
		);

		$result = $this->denah_acara->saveCoordinateFacility($param);
		echo $result;
	}

	public function exportCanvasTemplateExcel(){
		$this->load->library('excel');

		$canvas_id = $_POST['currentCanvasID'];
		$canvas_name = $_POST['currentCanvasName'];

		$param = array('canvas_id' => $canvas_id);

		$styleArray = array('font' => array('bold' => true));
		$styleBorder = array(
				'borders' => array(
						'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
						)
				)
		);

		$styleLeft = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
	        )
	    );

	    $styleCenter = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

	    $hideFont = array(
			'font'  => array(
			    'bold'  => false,
			    'color' => array('rgb' => 'FFFFFF'),
			    'size'  => 1,
			    'name'  => 'Verdana'
			)
		);

	    //sheet 1
	    //-------------------------------------------------------------------
		$this->excel->setActiveSheetIndex(0);
		$sheetExcel = $this->excel->getActiveSheet();
        $sheetExcel->getDefaultStyle()->getFont()->setSize(12);
        $sheetExcel->getProtection()->setSheet(true);
		$sheetExcel->getStyle('A:E')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
		$sheetExcel->getStyle('A1:E2')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_PROTECTED);

		$sheetExcel->setTitle('Daftar Fasilitas');
		$result = $this->denah_acara->getTemplateExcel($param);
		//header
		$sheetExcel->setCellValue('A1',$canvas_name);
		$sheetExcel->getStyle('A1')->applyFromArray($styleCenter);
		$sheetExcel->mergeCells('A1:E1');
		$sheetExcel->setCellValue('A2','# Fasilitas');
		$sheetExcel->setCellValue('B2','Nama Fasilitas');
		$sheetExcel->setCellValue('C2','Jenis Fasilitas');
		$sheetExcel->setCellValue('D2','Group');
		$sheetExcel->setCellValue('E2','Fasilitas Dari #');

		

		$baris = 3;
		if(!empty($result)){
			for($i = 0; $i< count($result); $i++){
				$sheetExcel->setCellValue('A'.($i+$baris),$result[$i]->facility_id);
				$sheetExcel->setCellValue('B'.($i+$baris),$result[$i]->facility_name);
				$sheetExcel->setCellValue('C'.($i+$baris),$result[$i]->facility_type_name);
				$sheetExcel->setCellValue('D'.($i+$baris),$result[$i]->group_name);
				$sheetExcel->setCellValue('E'.($i+$baris),$result[$i]->facility_parent_id);
				$sheetExcel->setCellValue('M'.($i+$baris),$result[$i]->x_axis);
				$sheetExcel->setCellValue('N'.($i+$baris),$result[$i]->y_axis);
				$sheetExcel->setCellValue('O'.($i+$baris),$result[$i]->participant_id);
				$sheetExcel->setCellValue('P'.($i+$baris),$result[$i]->reserve_at);
				$sheetExcel->setCellValue('Q'.($i+$baris),$result[$i]->checkin_at);
			}
			$baris+=$i-1;
		}
		

		//atur tampilan
		$sheetExcel->getColumnDimension('A')->setWidth(10);
		$sheetExcel->getColumnDimension('B')->setWidth(20);
		$sheetExcel->getColumnDimension('C')->setWidth(15);
		$sheetExcel->getColumnDimension('D')->setWidth(15);
		$sheetExcel->getColumnDimension('E')->setWidth(15);
		
		$sheetExcel->getStyle('M3:Q'.$baris)->applyFromArray($hideFont);
		$sheetExcel->getStyle('A1:E2')->getFont()->setBold(true);
		//to focus at A2
		//$sheetExcel->getStyle('H2:I'.$baris)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_PROTECTED);

		//$sheetExcel->getStyle('A3:A'.($baris-1))->applyFromArray($styleLeft);
		//-------------------------------------------------------------------


		//Sheet 2
		//-------------------------------------------------------------------
		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(1);
		$sheetExcel = $this->excel->getActiveSheet();
        $sheetExcel->getDefaultStyle()->getFont()->setSize(12);

		$sheetExcel->setTitle('Daftar Jenis Fasilitas');

		//header
		$sheetExcel->setCellValue('A1','Jenis Fasilitas');
		$sheetExcel->getStyle('A1')->getFont()->setBold(true);


		//data
		$result = $this->denah_acara->getFacilityType(null);
		for($i = 0; $i < count($result); $i++){
			$sheetExcel->setCellValue('A'.($i+2),$result[$i]->facility_type_name);
		}

		//atur tampilan
		$sheetExcel->getColumnDimension('A')->setWidth(15);
		$sheetExcel->getStyle('A1:A'.($i+1))->applyFromArray($styleBorder);
		$sheetExcel->getProtection()->setSheet(true);
		//-------------------------------------------------------------------



		//Sheet 3
		//-------------------------------------------------------------------
		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(2);
		$sheetExcel = $this->excel->getActiveSheet();
        $sheetExcel->getDefaultStyle()->getFont()->setSize(12);

		$sheetExcel->setTitle('Daftar Grup');

		//header
		$sheetExcel->setCellValue('A1','Grup');
		$sheetExcel->getStyle('A1')->getFont()->setBold(true);

		//data
		$result = $this->denah_acara->getFacilityGroup();
		for($i = 0; $i < count($result); $i++){
			$sheetExcel->setCellValue('A'.($i+2),$result[$i]->group_name);
		}

		$sheetExcel->getStyle('A1:A'.($i+1))->applyFromArray($styleBorder);
		$sheetExcel->getProtection()->setSheet(true);
		//---------------------------------------------------------------------

		//export excel
		$this->excel->setActiveSheetIndex(0);
		$filename = 'Template Denah Acara.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function loadExcelCanvas(){
		$canvas_id = $_POST['currentCanvasID'];
		$canvas_slideid = $_POST['currentCanvasSlide'];
		$canvas_name = $_POST['currentCanvasName'];
		//to get facility type id by name
		$result = $this->denah_acara->getFacilityType(null);
		for($i = 0; $i < count($result); $i++){
			$facilityType[$result[$i]->facility_type_id] = $result[$i]->facility_type_name;
		}

		//to get facility group id by name
		$result = $this->denah_acara->getFacilityGroup();
		for($i = 0; $i < count($result); $i++){
			$facilityGroup[$result[$i]->group_id] = $result[$i]->group_name;
		}

		foreach ($_FILES as $file) {
        	$filePath = $file['tmp_name'];
        	$this->load->library('excel');

	        //read file from path
	        $objPHPExcel = PHPExcel_IOFactory::load($filePath);

	        //get only the Cell Collection
	        $cell_collection = $objPHPExcel->getSheet(0)->getCellCollection();
	        $error = '';
	        $isSameCanvas = true;
	        //extract to a PHP readable array format
	        foreach ($cell_collection as $cell) {
	            $column = $objPHPExcel->getSheet(0)->getCell($cell)->getColumn();
	            $row = $objPHPExcel->getSheet(0)->getCell($cell)->getRow();
	            $data_value = $objPHPExcel->getSheet(0)->getCell($cell)->getValue();

	            if ($row > 0) {
	            	if($row == 1){
	            		if($column == 'A' && $data_value != $canvas_name){
	            			$isSameCanvas = false;
	            		}
	            	}
	            	else if($row == 2) //check if template
	            	{
	            		if ($column == 'A' && $data_value != '# Fasilitas')
	            		{
                        	$error = 'excel yang dimasukkan salah';
                        	break;
                    	}
                    	if ($column == 'B' && $data_value != 'Nama Fasilitas')
	            		{
                        	$error = 'excel yang dimasukkan salah';
                        	break;
                    	}
                    	if ($column == 'C' && $data_value != 'Jenis Fasilitas')
	            		{
                        	$error = 'excel yang dimasukkan salah';
                        	break;
                    	}
                    	if ($column == 'D' && $data_value != 'Group')
	            		{
                        	$error = 'excel yang dimasukkan salah';
                        	break;
                    	}
                    	if ($column == 'E' && $data_value != 'Fasilitas Dari #')
	            		{
                        	$error = 'excel yang dimasukkan salah';
                        	break;
                    	}
	            	}
	            	else
	            	{
	                    if ($column == 'A' && $data_value != ''){
	                    	if($row != 3){ // cek if there is no data input yet
	                    		if(!isset($facility_id)){
	                    			$error = 'Data belum dimasukan pada cell: A3';
		                    		break;
	                    		}else{
		                    		if((array_search($data_value, $facility_id) !== false)){ //if have duplicate id
			                    		$error = 'id tidak boleh ada yang sama pada cell: '.$column.$row;
			                    		break;
			                    	}
			                    }
	                    	}
	                    	$facility_id[$row-3] = $data_value;
	                    }else if ($column == 'B' && $data_value != ''){
	                    	$facility_name[$row-3] = $data_value;
	                    }else if ($column == 'C' && $data_value != ''){
	                    	if(array_search($data_value, $facilityType) !== false){
	                    		$facility_type_name[$row-3] = $data_value;
	                    	}else{ //if facility type not found
	                    		$error = 'nama tipe fasilitas tidak sesuai pada cell: '.$column.$row;
	                    		break;
	                    	}
	                    }else if ($column == 'D' && $data_value != ''){
	                    	$group_name[$row-3] = $data_value;
	                    }else if ($column == 'E' && $data_value != ''){
	                    	if(array_search($data_value, $facility_id) !== false){
	                    		$facility_parent_id[$row-3] = $data_value;
	                    	}else{ //if parent from not found
	                    		$error = 'fasilitas dari tidak ketemu pada cell: '.$column.$row;
	                    		break;
	                    	}
	                    }else if ($column == 'E'){ //if facility from 0
	                    	if(!isset($group_name[$row-3])){
	                    		$error = 'wajib input group pada cell: D'.$row;
	                    		break;
	                    	}else if($group_name[$row-3] == ''){
	                    		$error = 'wajib input group pada cell: D'.$row;
	                    		break;
	                    	}else{
	                    		if(array_search($group_name[$row-3], $facilityGroup) !== false){

		                    	}else{ //if parentfrom not found
		                    		$error = 'nama group tidak sesuai pada cell: D'.$row;
		                    		break;
		                    	}
	                    	}
	                    }

	                    //hidden column
	                    if ($column == 'M' && $data_value != ''){
	                    	$x_axis[$row-3] = $data_value;
	                    }
	                    if ($column == 'N' && $data_value != ''){
	                    	$y_axis[$row-3] = $data_value;
	                    }
	                    if ($column == 'O' && $data_value != ''){
	                    	$participant_id[$row-3] = $data_value;
	                    }
	                    if ($column == 'P' && $data_value != ''){
	                    	$reserve_at[$row-3] = $data_value;
	                    }
	                    if ($column == 'Q' && $data_value != ''){
	                    	$checkin_at[$row-3] = $data_value;
	                    }
	            	}
	            }
	    	}

	    	//to validate empty data
	    	if(isset($facility_id)){
	    		for ($i=0; $i < count($facility_id); $i++) {
		    		if(!isset($facility_id[$i])){
		    			$error = 'Data belum dimasukan pada cell: A'.($i+3);
		    		}
		    		if(!isset($facility_name[$i])){
		    			$error = 'Data belum dimasukan pada cell: B'.($i+3);
		    		}
		    		if(!isset($facility_type_name[$i])){
		    			$error = 'Data belum dimasukan pada cell: C'.($i+3);
		    		}

		    		//to get groupname by parent's group name
		    		if(isset($facility_parent_id[$i]) && isset($group_name)){
		    			$group_name[$i] = $group_name[array_search($facility_parent_id[$i], $facility_id)];
		    		}
		    	}
	    	}

	    	//delete all current facility before insert new facility
	    	if($error == ''){
		    	$param = array(
		    		'canvas_id' => $canvas_id,
		    		'canvas_slideid' => $canvas_slideid
		    	);
		    	$this->denah_acara->deleteFacilityByExcel($param);

		    	$param = array(
		    		'facility_id' => $facility_id[0] //get first data to get last canvas_slideid
		    	);

		    	//delete old participant
		    	if($isSameCanvas){
			    	for ($i=0; $i < count($facility_id); $i++) {
			    		if(isset($participant_id[$i])){
							$param = array(
								'participant_id' => $participant_id[$i],
								'canvas_slideid' => $canvas_slideid
							);
							$this->denah_acara->deleteFacilityParticipant($param);
						}
			    	}
			    }

				for ($i=0; $i < count($facility_id); $i++) {
					$oldID[$i] = $facility_id[$i];
					$param = array(
						'facility_name' => $facility_name[$i],
						'facility_type_id' => array_search($facility_type_name[$i],$facilityType),
						'group_id' => array_search($group_name[$i],$facilityGroup),
						'facility_parent_id' => (isset($facility_parent_id[$i])? $newID[array_search($facility_parent_id[$i], $oldID)]:0),
						'x_axis' => ((isset($x_axis[$i]) && isset($y_axis[$i]))?$x_axis[$i]:rand(50,300)),
						'y_axis' => ((isset($x_axis[$i]) && isset($y_axis[$i]))?$y_axis[$i]:rand(50,400)),
						'canvas_id' => $canvas_id,
						'canvas_slideid' => $canvas_slideid
					);

					$newID[$i] = $this->denah_acara->insertFacilityByExcel($param);

					if(isset($participant_id[$i]) && $isSameCanvas){
						$transferParam = array(
							'facility_id' => $newID[$i],
							'participant_id' => $participant_id[$i],
							'reserve_at' => (isset($reserve_at[$i])?$reserve_at[$i]:null),
							'checkin_at' => (isset($checkin_at[$i])?$checkin_at[$i]:null)
						);
						$this->denah_acara->transferFacilityParticipant($transferParam);
					}				
				}
				echo 'sukses';
			}else{
				echo $error;
			}
	    }
	}

	public function getTableDetail(){
		$param = array(
			'facility_parent_id' => $this->input->post_get('facility_parent_id')
		);

		$result = $this->denah_acara->getTableDetail($param);
		echo json_encode($result);
	}

	public function deleteParticipantDifferentGroup(){
		$param = array(
			'facility_parent_id' => $this->input->post_get('facility_parent_id')
		);

		$result = $this->denah_acara->deleteParticipantDifferentGroup($param);
		echo json_encode($result);
	}
}
