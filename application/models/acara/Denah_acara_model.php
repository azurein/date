<?php
class Denah_acara_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}
	public function getAutoCompleteParticipants($data)
	{
		$query = "SELECT
		CONCAT(b.title_name, a.participant_name) AS ParticipantName
		FROM participant a
		JOIN titles b ON a.title_id = b.title_id
		WHERE a._status <> 'D'
		AND b._status <> 'D'
		AND a.group_id = ".$data['group_id']."
		AND a.participant_id NOT IN (
		SELECT DISTINCT participant_id FROM participant_facility z
		JOIN facility y ON z.facility_id=y.facility_id
		AND z.event_id=y.event_id
		JOIN canvas x ON y.canvas_id=x.canvas_id
		WHERE y._status <> 'D'
		AND x._status <> 'D'
		AND z.event_id = ".$_SESSION['event_id'].")
		AND a.event_id = ".$_SESSION['event_id']."";
		$data = $this->db->query($query)->result_array();
		return $data;
	}
	public function getDetailCanvas($data){
		$query = "SELECT * FROM canvas WHERE event_id = '".$_SESSION['event_id']."' AND canvas_slideid = '".$data['canvas_slideid']."' AND _status <> 'D'";
		$data = $this->db->query($query)->result();
		//if(empty($data)){
		//	$data = array('0' => (object) array('Result' => 0 ));
		//}
		return $data;
	}
	public function checkCanvasName($data){
		$query = "SELECT '1' FROM canvas WHERE canvas_name = '".$data['canvas_name']."' AND canvas_id <> '".$data['canvas_id']."' AND _status <> 'D' AND event_id = '".$_SESSION['event_id']."'";
		$data = $this->db->query($query)->result();
		return $data;
	}
	public function insertCanvas($data){
		$query = "
		INSERT INTO canvas (
							event_id,
							canvas_name,
							canvas_slideid,
							canvas_img,
							canvas_width,
							canvas_height,
							_status,
							_user,
							_date
					)
					VALUES(?,?,?,?,?,?,'I',?,NOW())";
		$this->db->query($query,array(
			$_SESSION['event_id'],
			$data['canvas_name'],
			$data['canvas_slideid'],
			$data['canvas_img'],
			$data['canvas_width'],
			$data['canvas_height'],
			$_SESSION['user_id']
		));
		$data = $this->db->insert_id();
		return $data;
	}
	public function updateCanvasName($data){
		$query = "UPDATE canvas SET canvas_name = ?, _status = 'U', _user = ? WHERE canvas_id = ?";

		$data = $this->db->query($query,array(
			$data['canvas_name'],
			$_SESSION['user_id'],
			$data['canvas_id']
		));
		return $data;
	}
	public function deleteCanvas($data){
		$query = "UPDATE canvas SET _status = 'D', _user = ? WHERE canvas_id = ?";

		$data = $this->db->query($query,array(
			$_SESSION['user_id'],
			$data['canvas_id']
		));
		return $data;
	}
	public function getFacilityType($data){
		if($data['is_parent'] == null){
			$query = "SELECT facility_type_id, facility_shape, facility_type_name, is_parent FROM facility_type WHERE _status <> 'D'";
		}else{
			$query = "SELECT facility_type_id, facility_shape, facility_type_name, is_parent FROM facility_type WHERE is_parent = '".$data['is_parent']."' AND _status <> 'D'";
		}

		$data = $this->db->query($query)->result();
		return $data;
	}
	public function getFacilityGroup(){
		$query = "SELECT group_id, group_name, bookable, priority FROM groups WHERE _status <> 'D'";

		$data = $this->db->query($query)->result();
		return $data;
	}
	public function getFacilityGroupFromFacility($data){
		$query = "SELECT group_id FROM facility WHERE facility_id = ".$data['facility_id']." AND _status <> 'D' AND event_id = ".$_SESSION['event_id'];

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function loadFacilityFrom($data){
		$query = "SELECT facility_id,facility_name FROM facility a JOIN facility_type b ON a.facility_type_id=b.facility_type_id WHERE event_id = ".$_SESSION['event_id']." AND canvas_id = ".$data['canvas_id']." AND canvas_slideid = ".$data['canvas_slideid']." AND a._status <> 'D' AND b._status <> 'D' AND is_parent = 1";

		$data = $this->db->query($query)->result();
		return $data;
	}
	public function addFacility($data){
		$query = "
		INSERT INTO facility (
							facility_type_id,
							facility_parent_id,
							canvas_id,
							canvas_slideid,
							event_id,
							group_id,
							facility_name,
							x_axis,
							y_axis,
							_status,
							_user,
							_date

					)
					VALUES(?,?,?,?,?,?,?,?,?,'I',?,NOW())";
		$this->db->query($query,array(
			$data['facility_type_id'],
			$data['facility_parent_id'],
			$data['canvas_id'],
			$data['canvas_slideid'],
			$_SESSION['event_id'],
			$data['group_id'],
			$data['facility_name'],
			rand(50,300),
			rand(50,400),
			$_SESSION['user_id']
		));
		$data = $this->db->insert_id();
		return $data;
	}
	public function getFacilityDetail($data){
		$query = "SELECT a.facility_id,a.facility_type_id,facility_parent_id,canvas_id, canvas_slideid, a.group_id, facility_name, x_axis, y_axis, facility_shape, facility_type_name,is_parent,group_name, priority, d.participant_id, participant_name, title_name , reserve_at, checkin_at
			FROM facility a
			JOIN facility_type b ON a.facility_type_id=b.facility_type_id
			JOIN groups c ON a.group_id=c.group_id
			LEFT JOIN participant_facility d ON a.facility_id=d.facility_id AND a.event_id=d.event_id AND d._status <> 'D'
			LEFT JOIN participant e ON  d.participant_id=e.participant_id AND a.event_id=e.event_id AND e._status <> 'D'
			LEFT JOIN titles f ON f.title_id=e.title_id AND f._status <> 'D' WHERE canvas_id = ".$data['canvas_id']." AND canvas_slideid = ".$data['canvas_slideid']." AND a.event_id = ".$_SESSION['event_id']." AND a._status <> 'D' AND b._status <> 'D' AND c._status <> 'D' ORDER BY is_parent DESC, priority ASC,facility_id ASC";

		$data = $this->db->query($query)->result();
		return $data;
	}
	public function saveCanvasImage($data){
		$query = " UPDATE canvas SET
					canvas_img = ?,
					_status = 'U',
					_user = ?,
					_date = NOW()
					WHERE canvas_id = ?";
		$this->db->query($query,array(
			$data['canvas_img'],
			$_SESSION['user_id'],
			$data['canvas_id']
		));
		$data = $this->db->insert_id();
		return $data;
	}
	public function deleteFacility($data){
		$query = " UPDATE facility SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE facility_id = ?
					OR facility_parent_id = ?";
		$this->db->query($query,array(
			$_SESSION['user_id'],
			$data['facility_id'],
			$data['facility_id']
		));
		$data = $this->db->insert_id();
		return $data;
	}
	public function editFacility($data){
		$query = " UPDATE facility SET
					facility_name = ?,
					facility_type_id = ?,
					facility_parent_id = ?,
					group_id = ?,
					_status = 'U',
					_user = ?,
					_date = NOW()
					WHERE facility_id = ?
					AND _status <> 'D'";
		$this->db->query($query,array(
			$data['facility_name'],
			$data['facility_type_id'],
			$data['facility_parent_id'],
			$data['group_id'],
			$_SESSION['user_id'],
			$data['facility_id']
		));
		$data = $this->db->insert_id();
		return $data;
	}
	public function editGroupFacilityChild($data){
		$query = " UPDATE facility SET
					group_id = ?,
					_status = 'U',
					_user = ?,
					_date = NOW()
					WHERE facility_parent_id = ?
					AND _status <> 'D'";
		$this->db->query($query,array(
			$data['group_id'],
			$_SESSION['user_id'],
			$data['facility_parent_id']
		));
		$data = $this->db->insert_id();
		return $data;
	}
	public function getParticipantsDetail($data){
		$query = "	SELECT participant_id,participant_name,a.title_id, title_name, follower FROM participant a
					JOIN titles b ON a.title_id=b.title_id
					WHERE a._status <> 'D'
					AND b._status <> 'D'
					AND CONCAT(TRIM(title_name),TRIM(participant_name)) = 
					'".trim($data['participant_name'])."'
					LIMIT 1";
		$data = $this->db->query($query)->result();
		return $data;
	}

	public function checkParticiantChangeStatus($data){ // return 1 if exists
		$query = "SELECT '1' FROM participant_facility
					WHERE _status <> 'D'
					AND event_id = ".$_SESSION['event_id']."
					AND facility_id = ".$data['facility_id']."
					AND participant_id = ".$data['participant_id'];
		$data = $this->db->query($query)->result();
		return $data;
	}

	public function saveParticipantFacility($data){
		$status = $data['status'];
		if($status == 0){ //available
			$query = "DELETE FROM participant_facility
					WHERE event_id = ?
					AND facility_id = ?";
			$this->db->query($query,array(
				$_SESSION['event_id'],
				$data['facility_id']
			));
		}else if($status == 1){ //booking
			$query = "DELETE FROM participant_facility
					WHERE event_id = ?
					AND facility_id = ?";
			$this->db->query($query,array(
				$_SESSION['event_id'],
				$data['facility_id']
			));
			$query = "
			INSERT INTO participant_facility (
								event_id,
								facility_id,
								participant_id,
								reserve_at,
								checkin_at,
								_status,
								_user,
								_date
						)
						VALUES(?,?,?,NOW(),null,'I',?,NOW())";
			$this->db->query($query,array(
				$_SESSION['event_id'],
				$data['facility_id'],
				$data['participant_id'],
				$_SESSION['user_id']
			));
		}else if($status == 2){ //check in
			$query = "SELECT '1' FROM participant_facility
						WHERE event_id = ".$_SESSION['event_id']."
						AND facility_id = ".$data['facility_id'];
			if(empty($this->db->query($query)->result())){
				$query = "
				INSERT INTO participant_facility (
									event_id,
									facility_id,
									participant_id,
									reserve_at,
									checkin_at,
									_status,
									_user,
									_date
							)
							VALUES(?,?,?,NULL,NOW(),'I',?,NOW())";
				$this->db->query($query,array(
					$_SESSION['event_id'],
					$data['facility_id'],
					$data['participant_id'],
					$_SESSION['user_id']
				));
			}else{
				$query = "
				UPDATE participant_facility
						SET checkin_at = NOW(),
						_status = 'U',
						_user = ?,
						_date = NOW()
						WHERE event_id = ?
						AND facility_id = ?
						AND participant_id = ?
							";
				$this->db->query($query,array(
					$_SESSION['user_id'],
					$_SESSION['event_id'],
					$data['facility_id'],
					$data['participant_id']
				));
			}
		}
		$data = $this->db->insert_id();
		return $data;
	}

	public function saveCoordinateFacility($data){
		$query = " UPDATE facility SET
					x_axis = ?,
					y_axis = ?,
					_status = 'U',
					_user = ?
					WHERE facility_id = ?";
		$this->db->query($query,array(
			$data['x_axis'],
			$data['y_axis'],
			$_SESSION['user_id'],
			$data['facility_id']
		));
		$data = $this->db->insert_id();
		return $data;
	}

	public function getTemplateExcel($data){
		$query = "SELECT canvas_name, a.facility_id, facility_name, facility_type_name, group_name, facility_parent_id,x_axis, y_axis, participant_id, reserve_at, checkin_at
					FROM facility a
					JOIN canvas b ON a.canvas_id=b.canvas_id
					JOIN facility_type c ON a.facility_type_id=c.facility_type_id
					JOIN groups d ON a.group_id=d.group_id
					LEFT JOIN participant_facility e ON a.facility_id=e.facility_id
					WHERE a._status <> 'D'
					AND b._status <> 'D'
					AND c._status <> 'D'
					AND c._status <> 'D'
					AND a.canvas_id = ".$data['canvas_id']."
					AND a.event_id = ".$_SESSION['event_id']."
					ORDER BY facility_id";
		$data = $this->db->query($query)->result();
		return $data;
	}

	public function deleteFacilityByExcel($data){
		$query = "UPDATE facility SET _status = 'D', _user = ? WHERE canvas_id = ? AND canvas_slideid = ? AND event_id = ? AND _status <> 'D'";

		$data = $this->db->query($query,array(
			$_SESSION['user_id'],
			$data['canvas_id'],
			$data['canvas_slideid'],
			$_SESSION['event_id']
		));
		return $data;
	}

	public function insertFacilityByExcel($data){
		$query = "
		INSERT INTO facility (
							facility_type_id,
							facility_parent_id,
							canvas_id,
							canvas_slideid,
							event_id,
							group_id,
							facility_name,
							x_axis,
							y_axis,
							_status,
							_user,
							_date
					)
					VALUES(?,?,?,?,?,?,?,?,?,'I',?,NOW())";
		$this->db->query($query,array(
			$data['facility_type_id'],
			$data['facility_parent_id'],
			$data['canvas_id'],
			$data['canvas_slideid'],
			$_SESSION['event_id'],
			$data['group_id'],
			$data['facility_name'],
			$data['x_axis'],
			$data['y_axis'],
			$_SESSION['user_id']
		));
		$data = $this->db->insert_id();
		return $data;
	}

	public function transferFacilityParticipant($data){
		$query = "
			INSERT INTO participant_facility (
								event_id,
								facility_id,
								participant_id,
								reserve_at,
								checkin_at,
								_status,
								_user,
								_date
						)
						VALUES(?,?,?,?,?,'I',?,NOW())";
			$this->db->query($query,array(
				$_SESSION['event_id'],
				$data['facility_id'],
				$data['participant_id'],
				$data['reserve_at'],
				$data['checkin_at'],
				$_SESSION['user_id']
			));
		$data = $this->db->insert_id();
		return $data;
	}

	// public function checkCanvasByParticipant($data){
	// 	$query = "SELECT a.canvas_id, a.canvas_slideid
	// 				FROM facility a
	// 				JOIN participant_facility b ON a.facility_id=b.facility_id AND a.event_id=b.event_id
	// 				WHERE a.event_id=".$_SESSION['event_id']." AND participant_id = ".$data['participant_id'];
	// 	$data = $this->db->query($query)->result();
	// 	return $data;
	// }

	public function deleteFacilityParticipant($data){

		$query = "UPDATE participant_facility a
					JOIN facility b ON a.facility_id=b.facility_id
					AND a.event_id=b.event_id
					SET a._status = 'D',
					a._user = ".$_SESSION['user_id'].",
					a._date = NOW()
					WHERE a._status <> 'D'
					AND b._status <> 'D'
					AND a.participant_id = ".$data['participant_id']."
					AND a.event_id = ".$_SESSION['event_id']."
					AND b.canvas_slideid = ".$data['canvas_slideid'];

		$data = $this->db->query($query);
		return $data;
	}

	public function getFacilitySiblings($data){
		$query = "SELECT facility_id FROM facility WHERE facility_parent_id = ".$data['facility_parent_id']." AND facility_id <> ".$data['facility_id']." AND _status <> 'D' AND facility_id NOT IN (SELECT facility_id FROM participant_facility WHERE _status <> 'D' AND event_id = ".$_SESSION['event_id'].") AND facility_parent_id <> 0 ORDER BY facility_id";//0 = dont have any siblings
		$data = $this->db->query($query)->result();
		return $data;
	}

	public function deleteParticipantFollower($data){
		$query = "SELECT participant_id FROM participant_facility WHERE facility_id = ".$data['facility_id'];
		$participant_id = $this->db->query($query)->result();
		if(!empty($participant_id)){
			$query = "DELETE FROM participant_facility WHERE participant_id = ".$participant_id[0]->participant_id." AND _status <> 'D' AND event_id = ".$_SESSION['event_id'];
		}
		return $this->db->query($query);
	}

	public function deleteParticipantDifferentGroup($data){
		$query = "DELETE a
					FROM participant_facility a
					JOIN facility b ON a.facility_id=b.facility_id WHERE b._status <> 'D' AND b.facility_parent_id = ".$data['facility_parent_id']." AND b.event_id = ".$_SESSION['event_id'];

		return $this->db->query($query);
	}

	public function getParentSummary($status = '3'){
		$query = "SELECT 0";

		switch ($status) {
			case '1':
			$query = 	"SELECT COUNT(a.facility_id) as count_parent
						FROM facility a
						JOIN facility_type b
						ON a.facility_type_id = b.facility_type_id
						AND a._status <> 'D'
						AND b._status <> 'D'
						WHERE b.is_parent = 1
						AND a.facility_id NOT IN (
						    SELECT facility_parent_id as facility_id
						    FROM facility a
						    JOIN participant_facility b
						    ON a.facility_id = b.facility_id
						    AND a._status <> 'D'
						    AND b._status <> 'D'
						)
						AND a.event_id = ".$_SESSION['event_id']."";
			break;

			case '2':
			$query = 	"SELECT COUNT(a.facility_id) as count_parent
						FROM facility a
						JOIN facility_type b
						ON a.facility_type_id = b.facility_type_id
						AND a._status <> 'D'
						AND b._status <> 'D'
						WHERE b.is_parent = 1
						AND a.facility_id IN (
						    SELECT facility_parent_id as facility_id
						    FROM facility a
						    JOIN participant_facility b
						    ON a.facility_id = b.facility_id
						    AND a._status <> 'D'
						    AND b._status <> 'D'
						    AND b.checkin_at IS NULL
						)
						AND a.event_id = ".$_SESSION['event_id']."";
			break;

			default:
			$query = 	"SELECT COUNT(a.facility_id) as count_parent
						FROM facility a
						JOIN facility_type b
						ON a.facility_type_id = b.facility_type_id
						AND a._status <> 'D'
						AND b._status <> 'D'
						WHERE b.is_parent = 1
						AND a.facility_id IN (
						    SELECT facility_parent_id as facility_id
						    FROM facility a
						    JOIN participant_facility b
						    ON a.facility_id = b.facility_id
						    AND a._status <> 'D'
						    AND b._status <> 'D'
						    AND b.checkin_at IS NOT NULL
						)
						AND a.event_id = ".$_SESSION['event_id']."";
			break;
		}

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getChildSummary($status = '3'){
		$query = "SELECT 0";

		switch ($status) {
			case '1':
			$query = 	"SELECT COUNT(a.facility_id) as count_child
						FROM facility a
						JOIN facility_type b
						ON a.facility_type_id = b.facility_type_id
						AND a._status <> 'D'
						AND b._status <> 'D'
						WHERE b.is_parent = 0
						AND a.facility_id NOT IN (
						    SELECT a.facility_id
						    FROM facility a
						    JOIN participant_facility b
						    ON a.facility_id = b.facility_id
						    AND a._status <> 'D'
						    AND b._status <> 'D'
						)
						AND a.event_id = ".$_SESSION['event_id']."";
			break;

			case '2':
			$query = 	"SELECT COUNT(a.facility_id) as count_child
						FROM facility a
						JOIN participant_facility b
						ON a.facility_id = b.facility_id
						AND a._status <> 'D'
						AND b._status <> 'D'
						JOIN facility_type c
						ON a.facility_type_id = c.facility_type_id
						AND c._status <> 'D'
						WHERE c.is_parent = 0
						AND b.checkin_at IS NULL
						AND a.event_id = ".$_SESSION['event_id']."";
			break;

			default:
			$query = 	"SELECT COUNT(a.facility_id) as count_child
						FROM facility a
						JOIN participant_facility b
						ON a.facility_id = b.facility_id
						AND a._status <> 'D'
						AND b._status <> 'D'
						JOIN facility_type c
						ON a.facility_type_id = c.facility_type_id
						AND c._status <> 'D'
						WHERE c.is_parent = 0
						AND b.checkin_at IS NOT NULL
						AND a.event_id = ".$_SESSION['event_id']."";
			break;
		}

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getTableDetail($data){
		$query = 	"SELECT
					facility.facility_name,
					COALESCE(titles.title_name, '-') as title_name,
					COALESCE(participant.participant_name, '-') as participant_name,
					groups.group_name,
					COALESCE(DATE_FORMAT(verification.verification_date, '%H:%i'),'-') as verification_time
					FROM facility
					LEFT JOIN participant_facility
					ON facility.facility_id = participant_facility.facility_id
					AND facility.event_id = participant_facility.event_id
					AND facility._status <> 'D'
					AND participant_facility._status <> 'D'
					LEFT JOIN participant
					ON participant_facility.participant_id = participant.participant_id
					AND participant_facility.event_id = participant.event_id
					AND participant._status <> 'D'
					LEFT JOIN groups
					ON facility.group_id = groups.group_id
					AND groups._status <> 'D'
					LEFT JOIN titles
					ON participant.title_id = titles.title_id
					AND titles._status <> 'D'
					LEFT JOIN card
					ON participant.participant_id = card.participant_id
					AND participant.event_id = card.event_id
					AND card._status <> 'D'
					LEFT JOIN verification
					ON card.card_id = verification.card_id
					AND verification._status <> 'D'
					WHERE facility.event_id = '".$_SESSION['event_id']."'
					AND facility.facility_parent_id = '".$data['facility_parent_id']."'
					ORDER BY facility.facility_name";

		$data = $this->db->query($query)->result();
		return $data;
	}

}
