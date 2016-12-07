<?php
class Peserta_model_5 extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('model_5',TRUE);
	}

	public function getParticipant1($key='', $event_id=''){
		$query = 	"SELECT DISTINCT
					c.card_id,
					a.participant_id,
					b.title_name,
					a.participant_name,
					a.phone_num,
					a.group_id,
					d.group_name,
					a.follower,
					COALESCE(DATE_FORMAT(e.verification_date, '%H:%i'), '-') as verification_time,
					a.is_confirm,
					CASE
						WHEN f.reserve_at IS NULL AND f.checkin_at IS NULL	THEN 0
						WHEN f.checkin_at IS NULL 							THEN 1
						WHEN f.checkin_at IS NOT NULL						THEN 2
					END AS facility_status,
					e.verification_date

					FROM participant a

					JOIN titles b
					ON a.title_id = b.title_id
					AND a._status <> 'D'
					AND b._status <> 'D'

					JOIN card c
					ON a.participant_id = c.participant_id
					AND c._status <> 'D'

					JOIN groups d
					ON a.group_id = d.group_id
					AND d._status <> 'D'

                    LEFT JOIN verification e
                    ON c.card_id = e.card_id
					AND e._status <> 'D'

					LEFT JOIN participant_facility f
					ON a.participant_id = f.participant_id
					AND f._status <> 'D'

					WHERE
					a.event_id = '".$event_id."'
					AND (c.card_id LIKE '%".$key."%'
					OR CONCAT(b.title_name ,a.participant_name) LIKE '%".$key."%'
					OR d.group_name LIKE '%".$key."%'
					OR a.follower LIKE '%".$key."%'
					OR 'tidak hadir' = '".$key."')

					ORDER BY e.verification_date DESC
					";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getParticipantTable()
	{
		return $this->db->get('participant');
	}

	public function getParticipantByID($id)
	{
		$query = 	"SELECT
					participant_id,
					title_id,
					participant_name,
					phone_num,
					group_id,
					follower,
					delegate_to

					FROM participant
					WHERE participant_id = '".$id."'
					AND _status <> 'D'
					";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getParticipantFacility($id)
	{
		$query = 	"SELECT DISTINCT
					d.canvas_name,
					e.group_name,
					a.facility_id,
					b.facility_name as table_name,
					a.facility_name as chair_name

					FROM participant_facility c

					JOIN facility a
					ON c.facility_id = a.facility_id
					AND c._status <> 'D'
					AND a._status <> 'D'

					JOIN facility b
					ON a.facility_parent_id = b.facility_id
					AND b._status <> 'D'

					JOIN canvas d
					ON a.canvas_id = d.canvas_id
					AND d._status <> 'D'

					JOIN groups e
					ON a.group_id = e.group_id
					AND e._status <> 'D'

					WHERE c.participant_id = '".$id."'
					";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getAvailDelegateParticipant($participantID)
	{
		$query = 	"SELECT
					c.card_id,
					a.participant_id,
					b.title_name,
					a.participant_name

					FROM participant a

					JOIN titles b
					ON a.title_id = b.title_id
					AND b._status <> 'D'

					JOIN card c
					ON a.participant_id = c.participant_id
					AND c._status <> 'D'

					WHERE a._status <> 'D'
					AND a.participant_id <> '".$participantID."'
					AND
					(
						a.delegate_to IS NULL
						OR a.delegate_to = 0
					)
					AND a.event_id LIKE '$_SESSION[event_id]'
					";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getTitle1(){
		$query = "SELECT title_id,title_name FROM titles WHERE _status <> 'D'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}
	public function getGroup1(){
		$query = "SELECT group_id,group_name FROM groups WHERE _status <> 'D'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function createParticipant1($data, $newid=0){

		if($newid == 0) {
			$query = "INSERT INTO participant
			(participant_name,phone_num,title_id,delegate_to,follower_prev,follower,is_confirm,group_id,_status,_user,_date,event_id,souvenir_qty)
			VALUES(?,?,?,?,?,?,?,?,'I',?,NOW(),?,'0')
			";
			$this->db->query($query,array(
				$data['name'],
				$data['phone_num'],
				$data['title'],
				$data['delegate'],
				$data['follower'],
				$data['follower'],
				$data['is_confirm'],
				$data['group'],
				$data['userID'],
				$data['eventID']
			));
			$data = $this->db->insert_id();
		} else {
			$query = "INSERT INTO participant
			(participant_id,participant_name,phone_num,title_id,delegate_to,follower_prev,follower,is_confirm,group_id,_status,_user,_date,
			event_id,souvenir_qty)
			VALUES(?,?,?,?,?,?,?,?,?,'I',?,NOW(),?,'0')
			";
			$this->db->query($query,array(
				$newid,
				$data['name'],
				$data['phone_num'],
				$data['title'],
				$data['delegate'],
				$data['follower'],
				$data['follower'],
				$data['is_confirm'],
				$data['group'],
				$data['userID'],
				$data['eventID']
			));
		}

		return $data;
	}

	public function createCard($data)
	{
		$query = 	"INSERT INTO card
					(card_id,participant_id,_status,_user,_date,event_id)
					VALUES(?,?,'I',?,NOW(),?)
					";

		$data = $this->db->query($query,array(
			$data['newID'],
			$data['participantID'],
			$data['userID'],
			$data['eventID']
		));

	 	return $data;
	}

	public function changeParticipantStatus($data){

		$query = 	"UPDATE participant SET is_confirm = ? WHERE participant_id = ?";

		$data = $this->db->query($query,array(
			$data['is_confirm'],
			$data['participant_id']
		));
		return $data;
	}

	public function createCardWithID($data)
	{
		$query = 	"INSERT INTO card
					(card_id,participant_id,_status,_user,_date,event_id)
					VALUES(?,?,'I',?,NOW(),?)
					";

		$data = $this->db->query($query,array(
			$data['cardID'],
			$data['participantID'],
			$data['userID'],
			$data['eventID']
		));

		return $data;
	}

	public function editParticipant($data)
	{
		$query = 	"UPDATE participant SET
					title_id = ?,
					participant_name = ?,
					phone_num = ?,
					group_id = ?,
					follower_prev = ?,
					follower = ?,
					delegate_to = ?,
					_user = ?,
					event_id =?,
					_status = 'U',
					_date = NOW()
					WHERE participant_id = ?
					";

		$data = $this->db->query($query,array(
			$data['title'],
			$data['name'],
			$data['phone_num'],
			$data['group'],
			$data['follower'],
			$data['follower'],
			$data['delegate'],
			$data['userID'],
			$data['eventID'],
			$data['id']
		));

		return $data;
	}

	public function resetCardID($data)
	{
		$query = 	"UPDATE card SET
					card_id = ?,
					_user = ?,
					_status = 'U',
					_date = NOW()
					WHERE card_id = ?
					";

		$data = $this->db->query($query,array(
			$data['newID'],
			$data['userID'],
			$data['cardID']
		));

		return $data;
	}

	public function getNewID() {
		$lastid = $this->getLastID();
		$query = "SELECT CONCAT(CAST(NOW()+0 as CHAR(14)),'-','$lastid') as id";

		$result = $this->db->query($query);
		$newid = $result->row()->id;
		return $newid;
	}

	public function getLastID() {
		$query = 	"SELECT MAX(SUBSTRING_INDEX(card_id,'-',-1))+1 as id
					FROM card
					WHERE card_id LIKE '%-%'
					AND event_id LIKE '$_SESSION[event_id]'";

		$result = $this->db->query($query);
		$lastid = $result->row()->id;

		if($lastid === NULL)
			$lastid = '100';

		return $lastid;
	}

	public function deactiveParticipantById($data)
	{
		$query = 	"UPDATE participant SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE participant_id = ?
					";

		$this->db->query($query,array(
			$data['userID'],
			$data['participantID']
		));

		$query = "UPDATE participant SET
					delegate_to = null,
					_status = 'U',
					_user = ?,
					_date = NOW()
					WHERE delegate_to = ?
					AND _status <> 'D'";

		$data = $this->db->query($query,array(
			$data['userID'],
			$data['participantID']
		));

		return $data;
	}

	public function getTitleID($data) {
		$query = "SELECT title_id FROM titles WHERE _status <> 'D' AND title_name = '".$data."'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getGroupID($data) {
		$query = "SELECT group_id FROM groups WHERE _status <> 'D' AND group_name = '".$data."'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function updateTable($data, $user) {
		$checker = "SELECT b.card_id
					FROM participant a
					JOIN card b
					ON a.participant_id = b.participant_id
					AND a._status <> 'D'
					AND b._status <> 'D'

					WHERE b.card_id = ?
				";

		$update = "UPDATE participant a SET
					a.title_id =  COALESCE((
						SELECT title_id
						FROM titles
						WHERE LOWER(TRIM(title_name))  = LOWER(TRIM(?))
						AND _status <> 'D'
					),0),
					a.participant_name = ?,
					a.phone_num = ?,
					a.group_id =  COALESCE((
						SELECT group_id
						FROM groups
						WHERE LOWER(TRIM(group_name))  = LOWER(TRIM(?))
						AND _status <> 'D'
					),0),
					a.follower_prev = ?,
					a.follower = ?,
					a.is_confirm = ?,
					a.event_id = ?,
					a._user = ?,
					a._date = NOW()
					WHERE EXISTS(
						SELECT * FROM card b
					    WHERE b.card_id = ?
                        AND b.participant_id = a.participant_id
                        AND b._status <> 'D'
                    )";

		foreach ($data as $row) {
			$check = $this->db->query($checker,array(array_key_exists('A',$row)? $row['A']: ''))->result_array();
			$title_id = $this->getTitleID(array_key_exists('B',$row)? $row['B']: '');
			$group_id = $this->getGroupID(array_key_exists('E',$row)? $row['E']: '');

			if(empty($check) && array_key_exists('A',$row))
			{
				$param = array(
					'name' => array_key_exists('C',$row)? $row['C']: '',
					'phone_num' => array_key_exists('D',$row)? $row['D']: '',
					'title' => empty($title_id)? 0 : $title_id[0]['title_id'],
					'delegate' => 'null',
					'follower' => array_key_exists('F',$row)? $row['F']: 0,
					'follower' => array_key_exists('F',$row)? $row['F']: 0,
					'is_confirm' => array_key_exists('G',$row)? $row['G']: 0,
					'group' => empty($group_id)? 0 : $group_id[0]['group_id'],
					'userID' => $user['userID'],
					'eventID' => $user['eventID']
				);

				$result = $this->createParticipant1($param);

				$param = array(
					'participantID' => $result,
					'userID' => $user['userID'],
					'eventID' => $user['eventID'],
					'cardID' => $row['A']."-".$this->getLastID()
				);

				$this->createCardWithID($param);
			}
			else
			{
				$this->db->query($update,array(
					array_key_exists('B',$row)? $row['B']: '',
				 	array_key_exists('C',$row)? $row['C']: '',
					array_key_exists('D',$row)? $row['D']: '',
					array_key_exists('E',$row)? $row['E']: '',
					array_key_exists('F',$row)? $row['F']: 0,
					array_key_exists('F',$row)? $row['F']: 0,
					array_key_exists('G',$row)? $row['G']: 0,
					$user['eventID'],
					$user['userID'],
					array_key_exists('A',$row)? $row['A']: ''
				));
			}
		}
	}

	public function getTotalParticipant() {
		$query = 	"SELECT COUNT(a.participant_id) AS TotalParticipant

					FROM participant a

					JOIN card b
					ON a.participant_id = b.participant_id
					AND a._status <> 'D'
					AND b._status <> 'D'

					WHERE a.event_id LIKE '$_SESSION[event_id]'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

}
