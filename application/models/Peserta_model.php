<?php
class Peserta_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	public function getParticipant1($key='', $event_id=''){
		$query = 	"SELECT
					c.card_id,
					a.participant_id,
					b.title_name,
					a.participant_name,
					a.group_id,
					d.group_name,
					a.follower,
					CASE WHEN e.card_id IS NULL THEN 'Tidak Hadir' ELSE 'Hadir' END AS status_kehadiran

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

	public function createParticipant1($data){
		$query = 	"INSERT INTO participant
					(participant_name,title_id,delegate_to,follower,group_id,_status,_user,_date,event_id)
					VALUES(?,?,?,?,?,'I',?,NOW(),?)
					";

		$this->db->query($query,array(
			$data['name'],
			$data['title'],
			$data['delegate'],
			$data['follower'],
			$data['group'],
			$data['userID'],
			$data['eventID']
		));
		$data = $this->db->insert_id();
		
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
					group_id = ?,
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
			$data['group'],
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
		$query = "SELECT CAST(NOW()+0 as CHAR(14)) AS id";
		$result = $this->db->query($query);
		$newid = $result->row()->id;
		return $newid;
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

	public function getTitleID($data)
	{
		$query = "SELECT title_id FROM titles WHERE _status <> 'D' AND title_name = '".$data."'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getGroupID($data)
	{
		$query = "SELECT group_id FROM groups WHERE _status <> 'D' AND group_name = '".$data."'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function updateTable($data, $user){
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
					a.group_id =  COALESCE((
						SELECT group_id
						FROM groups
						WHERE LOWER(TRIM(group_name))  = LOWER(TRIM(?))
						AND _status <> 'D'
					),0),
					a.follower = ?,
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
			$group_id = $this->getGroupID(array_key_exists('D',$row)? $row['D']: '');

			if(empty($check) && array_key_exists('A',$row))
			{
				$param = array(
					'name' => array_key_exists('C',$row)? $row['C']: '',
					'title' => empty($title_id)? 0 : $title_id[0]['title_id'],
					'delegate' => 'null',
					'follower' => array_key_exists('E',$row)? $row['E']: 0,
					'group' => empty($group_id)? 0 : $group_id[0]['group_id'],
					'userID' => $user['userID'],
					'eventID' => $user['eventID']
				);

				$result = $this->createParticipant1($param);

				$param = array(
					'participantID' => $result,
					'userID' => $user['userID'],
					'eventID' => $user['eventID'],
					'cardID' => $row['A']
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
					$user['eventID'],
					$user['userID'],
					array_key_exists('A',$row)? $row['A']: ''
				));
			}
		}
	}

	//old function
	public function getParticipant($search){
		$query = "SELECT participant_id,participant_name,title_name,delegate_to,group_name,follower
					FROM participant a
					JOIN title b ON a.title_id=b.title_id AND b.wht <> 'D'
					JOIN groups c ON a.group_id=c.group_id AND c.wht <> 'D'
					WHERE a.wht <> 'D' AND 
						(participant_name LIKE '%".$search."%' OR c.group_name LIKE '%".$search."%' 
						OR a.delegate_to LIKE '%".$search."%' OR a.follower LIKE '%".$search."%')
						AND event_id='".$_SESSION['event_id']."'";
		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getTitle(){
		$query = "SELECT title_id,title_name FROM title WHERE wht <> 'D'";
		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getGroup(){
		$query = "SELECT group_id,group_name FROM groups WHERE wht <> 'D'";
		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getContact($participantId){
		$query = "SELECT contact_type,contact FROM contact WHERE wht <> 'D' AND participant_id='".$participantId."'";
		return $this->db->query($query)->result();
	}

	public function searchName($queryName){
		$query = "SELECT DISTINCT a.participant_name,a.participant_id 
					FROM participant a JOIN contact c ON a.participant_id=c.participant_id AND c.wht<>'D'
					WHERE a.wht <> 'D' AND (a.participant_name='".$queryName."' OR c.contact='".$queryName."')";
		return $this->db->query($query)->result()[0];
	}

	public function getFolowerNum($queryName){
		$query = "SELECT DISTINCT follower
					FROM participant WHERE wht <> 'D' AND participant_name='".$queryName."'";
		return $this->db->query($query)->result()[0]->follower;
	}

	public function createParticipant($newData){
		$query = "INSERT INTO participant (participant_name,title_id,delegate_to,card_code,follower,group_id,event_id, wht, whn, who, how) 
					VALUES(?,?,?,?,?,?,?,'A',NOW(),?,'Application')";

		$this->db->query($query,array($newData['name'],$newData['title'],$newData['delegate'],$newData['card'],
			$newData['follower'],$newData['group'],
								$_SESSION['event_id'],$_SESSION['user_id']));
		$data = $this->db->insert_id();

		return $data;
	}

	public function createContact($contactList,$participantId){
		for($i=0;$i<count($contactList);$i++){
			$query = "INSERT INTO contact (participant_id,contact_type,contact, wht, whn, who, how) 
						VALUES(?,?,?,'A',NOW(),?,'Application')";

			$this->db->query($query,array($participantId,$contactList[$i]['type'],$contactList[$i]['detail'],$_SESSION['user_id']));
		}
	}

	public function loadParticipant($participant){
		$query = "SELECT participant_id,title_id,participant_name,delegate_to,follower,card_code FROM participant 
					WHERE wht <> 'D' AND event_id='".$_SESSION['event_id']."' AND participant_id IN (".$participant.")";
		return $this->db->query($query)->result();
	}

	public function loadContact($participant){
		$query = "SELECT contact_type,contact,is_primary FROM contact
					WHERE wht <> 'D' AND participant_id ='".$participant."'";
		$result = $this->db->query($query)->result();
		return count($result)==0?array():$result[0];
	}

	public function getTotalParticipant() {
		$user_id = $_SESSION['user_id'];
		$query = "	SELECT COUNT(participant_id) AS TotalParticipant
					FROM participant WHERE _status <> 'D'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

}
