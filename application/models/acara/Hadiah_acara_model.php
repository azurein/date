<?php
class Hadiah_acara_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();

		$this->db = $this->load->database('default',TRUE);
	}

	/*
		BEGIN GET FUNCTION
	*/
	public function getGroups()
	{
		$query = " SELECT
					group_id,
					group_name
					FROM groups
					WHERE _status <> 'D' ";

		$data = $this->db->query($query)->result_array();

		return $data;
	}

	public function getParticipants()
	{
		$query = " SELECT 
					CONCAT(b.title_name, a.participant_name) AS ParticipantName
					FROM participant a
					JOIN titles b ON a.title_id = b.title_id
					WHERE a._status <> 'D'
					AND b._status <> 'D'
					AND a.participant_id NOT IN (SELECT DISTINCT participant_id from prize_setting WHERE _status <> 'D') ";

		$data = $this->db->query($query)->result_array();

		return $data;
	}

	public function getParticipantsPrizeSetting($prize_id)
	{
		$query = " SELECT
					CONCAT(e.title_name, c.participant_name) AS ParticipantName
					FROM prize_setting a
					LEFT JOIN prize b ON a.prize_id = b.prize_id
					LEFT JOIN participant c ON a.participant_id = c.participant_id
					LEFT JOIN event d ON c.event_id = d.event_id
					LEFT JOIN titles e ON c.title_id = e.title_id
					WHERE a._status <> 'D' 
					AND b._status <> 'D'
					AND c._status <> 'D'
					AND a.prize_id = '".$prize_id."' 
					AND a.participant_id <> 0
					AND a.group_id = 0 ";

		$data = $this->db->query($query)->result_array();

		return $data;
	}

	public function getGroupsPrizeSetting($prize_id)
	{
		$query = " SELECT
					a.group_id
					FROM prize_setting a
					LEFT JOIN prize b ON a.prize_id = b.prize_id
					LEFT JOIN groups c ON a.group_id = c.group_id
					WHERE a._status <> 'D' 
					AND b._status <> 'D'
					AND a.prize_id = '".$prize_id."' 
					AND a.participant_id = 0
					AND a.group_id <> 0 ";

		$data = $this->db->query($query)->result_array();

		return $data;
	}

	public function getPrize()
	{
		$query = " SELECT
					prize_id,
					event_id,
					prize_name,
					prize_descr,
					prize_priority,
					prize_img,
					total_winner
					FROM prize
					WHERE _status <> 'D' ";

		$data = $this->db->query($query)->result_array();

		return $data;
	}

	public function getPrizeByID($prize_id)
	{
		$query = " SELECT
					prize_id,
					event_id,
					prize_name,
					prize_descr,
					prize_img,
					prize_priority,
					total_winner
					FROM prize
					WHERE _status <> 'D' 
					AND prize_id = '".$prize_id."' ";

		$data = $this->db->query($query)->result();

		return $data;
	}

	public function getWinnerByID($prize_id)
	{
		$query = " SELECT
					e.card_id,
					c.participant_name,
					d.group_name
					FROM prize_setting a
					JOIN prize b ON a.prize_id = b.prize_id
					JOIN participant c ON a.participant_id = c.participant_id
					JOIN groups d ON a.group_id = d.group_id
					JOIN card e ON c.participant_id = e.participant_id
					AND a._status <> 'D'
					AND b._status <> 'D'
					AND c._status <> 'D'
					AND d._status <> 'D'
					AND e._status <> 'D'
					WHERE a.prize_id = '".$prize_id."' ";

		$data = $this->db->query($query)->result();

		return $data;
	}
	/*
		END GET FUNCTION
	*/

	/*
		BEGIN CRUD FUNCTION
	*/
	public function insertPrize($data){
		$query = " INSERT INTO prize ( 
						event_id, 
						prize_name, 
						prize_descr, 
						prize_img, 
						prize_priority,
						total_winner,
						_status, 
						_user, 
						_date
					) 
					VALUES(?,?,?,?,?,?,'I',?,NOW())";

		$this->db->query($query,array(	
			$_SESSION['event_id'],
			$data['prize_name'],
			$data['prize_descr'], 
			$data['prize_img'],
			$data['prize_priority'],
			$data['total_winner'],
			$_SESSION['user_id']
		));

		$data = $this->db->insert_id();

		return $data;
	}

	public function saveGroups($data, $value){
		$query = " INSERT INTO prize_setting ( 
						prize_id, 
						participant_id, 
						group_id,
						_status, 
						_user, 
						_date
					) 
					VALUES(?,0,?,'I',?,NOW())";

		$this->db->query($query,array(
			$data['prize_id'],
			$value,
			$_SESSION['user_id']
		));

		$data = $this->db->insert_id();

		return $data;
	}

	public function saveParticipants($data, $participant, $title){
		$query = " SELECT 
					a.participant_id
					FROM participant a
					JOIN titles b ON a.title_id = b.title_id
					WHERE a.participant_name = '".$participant."'
					AND b.title_name = '".$title."'
					AND a._status <> 'D'
					AND b._status <> 'D' ";

		$dataParticipant = $this->db->query($query)->result();

		$query = " INSERT INTO prize_setting (  
						prize_id,
						participant_id, 
						group_id,
						_status,
						_user, 
						_date
					) 
					VALUES(?,?,0,'I',?,NOW())";

		$this->db->query($query,array(
			$data['prize_id'],
			$dataParticipant[0]->participant_id,
			$_SESSION['user_id']
		));

		$dataPrizeSetting = $this->db->insert_id();

		return $dataPrizeSetting;
	}

	public function updatePrize($data)
	{
		$query = " UPDATE prize SET
					event_id = ?,
					prize_name = ?,
					prize_descr = ?, 
					prize_img = ?,
					prize_priority = ?,
					total_winner = ?, 
					_status = 'U',
					_user = ?,
					_date = NOW()
					WHERE prize_id = ? "; 

		$data = $this->db->query($query,array(
			$_SESSION['event_id'],
			$data['prize_name'],
			$data['prize_descr'], 
			$data['prize_img'], 
			$data['prize_priority'],
			$data['total_winner'], 
			$_SESSION['user_id'],
			$data['prize_id']
		));

		return $data;
	}

	public function updatePrizeWithoutImage($data)
	{
		$query = " UPDATE prize SET
					event_id = ?,
					prize_name = ?,
					prize_descr = ?,
					prize_priority = ?,
					total_winner = ?, 
					_status = 'U',
					_user = ?,
					_date = NOW()
					WHERE prize_id = ? "; 

		$data = $this->db->query($query,array(
			$_SESSION['event_id'],
			$data['prize_name'],
			$data['prize_descr'],
			$data['prize_priority'],
			$data['total_winner'], 
			$_SESSION['user_id'],
			$data['prize_id']
		));

		return $data;
	}

	public function deletePrizeByID($data)
	{
		$query = " UPDATE prize a
			        LEFT JOIN prize_setting b
			        ON a.prize_id = b.prize_id
					SET a._status = 'D',
						b._status = 'D',
						a._user = ?,
						b._user = ?,
						a._date = NOW(),
						b._date = NOW()
					WHERE a.prize_id = ? ";

		$data = $this->db->query($query,array(
			$_SESSION['user_id'],
			$_SESSION['user_id'],
			$data['prize_id']
		));

		return $data;
	}

	public function deleteParticipantsPrizeSetting($data)
	{
		$query = " DELETE FROM prize_setting
					WHERE prize_id = ?
					AND group_id = 0 ";

		$data = $this->db->query($query,array(
			$data['prize_id']
		));

		return $data;
	}

	public function deleteGroupsPrizeSetting($data)
	{
		$query = " DELETE FROM prize_setting
					WHERE prize_id = ?
					AND participant_id = 0 ";

		$data = $this->db->query($query,array(
			$data['prize_id']
		));

		return $data;
	}

	public function deleteParticipants($data)
	{
		// $query = " DELETE FROM prize_setting
		// 			WHERE prize_id = ?
		// 			AND group_id = 0 ";

		// $data = $this->db->query($query,array(
		// 	$data['prize_id']
		// ));

		$query = " UPDATE prize_setting SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE prize_id = ?
					AND group_id = 0";

		$data = $this->db->query($query,array(
			$_SESSION['user_id'],
			$data['prize_id']
		));

		return $data;
	}

	public function removeParticipants($data, $participant, $title)
	{
		$query = " SELECT 
					a.participant_id
					FROM participant a
					JOIN titles b ON a.title_id = b.title_id
					WHERE a.participant_name = '".$participant."'
					AND b.title_name = '".$title."'
					AND a._status <> 'D'
					AND b._status <> 'D' ";

		$dataParticipant = $this->db->query($query)->result();

		$query = " DELETE FROM prize_setting
					WHERE prize_id = ?
					AND participant_id = ?
					AND group_id = 0
					AND _status = 'D' ";

		$data = $this->db->query($query,array(
			$data['prize_id'],
			$dataParticipant[0]->participant_id
		));

		return $data;
	}

	public function deleteGroups($data)
	{
		$query = " UPDATE prize_setting SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE prize_id = ?
					AND participant_id = 0 ";

		$data = $this->db->query($query,array(
			$_SESSION['user_id'],
			$data['prize_id']
		));

		return $data;
	}

	public function removeGroups($data, $groups)
	{
		$query = " DELETE FROM prize_setting
					WHERE prize_id = ?
					AND participant_id = 0
					AND group_id = ?
					AND _status = 'D' ";

		$data = $this->db->query($query,array(
			$data['prize_id'],
			$groups
		));

		return $data;
	}
	/*
		END CRUD FUNCTION
	*/
}