<?php
class Pengaturan_acara_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	public function getEvent(){

		$query = 	"SELECT
					event_id,
					event_name,
					event_img,
					b.event_type_id,
					event_type_name,
					start_at,
					end_at,
					ROUND(time_to_sec((TIMEDIFF(end_at, start_at))) / 60) as duration,
					address,
					city,
					total_invitation,
					is_active

					FROM event a

					JOIN event_type b
					ON a.event_type_id = b.event_type_id
					AND a._status <> 'D'
					AND b._status <> 'D'";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getEventByID($id)
	{
		$query = 	"SELECT
					event_id,
					event_name,
					event_img,
					b.event_type_id,
					event_type_name,
					start_at,
					end_at,
					ROUND(time_to_sec((TIMEDIFF(end_at, start_at))) / 60) as duration,
					address,
					city,
					total_invitation,
					is_active

					FROM event a

					JOIN event_type b
					ON a.event_type_id = b.event_type_id
					AND a._status <> 'D'
					AND b._status <> 'D'
					WHERE event_id = '".$id."'";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getSouvenir($id)
	{
		$query = 	"SELECT
					souvenir_id,
					souvenir_name,
					souvenir_qty

					FROM souvenir
					WHERE event_id = '".$id."' AND _status <> 'D'";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function checkAvailableEvent(){

		$query = 	"SELECT EXISTS (
						SELECT 1
						FROM event 
						WHERE is_active = 1
    					AND _status <> 'D'
					) AS status_active";
		
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getActiveEvent(){

		$query = 	"SELECT event_id 
					FROM event 
					WHERE is_active = 1
					AND _status <> 'D'";
		
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function changeEventStatus($data){

		$query = 	"UPDATE event SET is_active = ? WHERE event_id = ?";
		
		$data = $this->db->query($query,array(
			$data['is_active'],			
			$data['event_id']
		));
		return $data;
	}

	public function getEventType()
	{
		$query = "SELECT event_type_id, event_type_name FROM event_type WHERE _status <> 'D' ORDER BY event_type_name";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getCity()
	{
		$query = "SELECT city FROM city WHERE _status <> 'D' ORDER BY city";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function createEvent($data){
		$query = "	INSERT INTO event (
						event_type_id, 
						event_name, 
						event_img, 
						start_at, 
						end_at, 
						address, 
						city, 
						late_tolerance, 
						total_invitation,
						is_active, 
						_status, 
						_user, 
						_date
					) 
					VALUES(?,?,?,?,?,?,?,0,?,0,'I',?,NOW())";

		$this->db->query($query,array(	
			$data['event_type_id'], 
			$data['event_name'],
			$data['event_img'], 
			$data['start_at'], 
			$data['end_at'],
			$data['address'], 
			$data['city'], 
			$data['total_invitation'],
			$_SESSION['user_id']
		));

		$data = $this->db->insert_id();
		return $data;
	}

	public function editEvent($data)
	{
		$query = 	"UPDATE event SET
					event_type_id = ?,
					event_name = ?,
					event_img = ?, 
					start_at = ?,
					end_at = ?,
					address = ?, 
					city = ?,
					total_invitation = ?,
					_status = 'U',
					_user = ?,
					_date = NOW()
					WHERE event_id = ?"; 

		$data = $this->db->query($query,array(
			$data['event_type_id'], 
			$data['event_name'],
			$data['event_img'], 
			$data['start_at'], 
			$data['end_at'],
			$data['address'], 
			$data['city'], 
			$data['total_invitation'],
			$_SESSION['user_id'],
			$data['event_id'], 
		));
		return $data;
	}

	public function deactiveEventByID($data)
	{
		$query = 	"UPDATE event SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE event_id = ?
					";

		$data = $this->db->query($query,array(
			$data['user_id'],
			$data['event_id']
		));
		return $data;
	}

	public function clearSouvenir($data)
	{
		$query = 	"UPDATE souvenir SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE event_id = ?
					";

		$data = $this->db->query($query,array(
			$data['user_id'],
			$data['event_id']
		));
		return $data;
	}

	public function createSouvenir($data){
		$query = "	INSERT INTO souvenir (
						event_id, 
						souvenir_name, 
						souvenir_qty, 
						_status, 
						_user, 
						_date
					) 
					VALUES(?,?,?,'I',?,NOW())";

		$this->db->query($query,array(	
			$data['event_id'], 
			$data['souvenir_name'],
			$data['souvenir_qty'], 
			$data['user_id']
		));

		$data = $this->db->insert_id();
		return $data;
	}
}