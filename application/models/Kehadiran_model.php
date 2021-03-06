<?php
class Kehadiran_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	public function getVerificationLog($key='', $user_id='', $event_id=''){
		$query = "SELECT privilege FROM users WHERE user_id = '".$user_id."' AND _status <> 'D'";
		$data = $this->db->query($query)->result_array();

		$userCondition = "";
		if ($data[0]['privilege'] != "1") {
			$userCondition = "AND a._user = '".$user_id."'";
		}

		$query = 	"SELECT DISTINCT
					CONCAT(DATE_FORMAT(a.verification_date, '%Y%m%d%H%i'), a.card_id) as log_id,
					a.card_id,
                    COALESCE(d.title_name, '') as title_name,
					c.participant_name,
					DATE_FORMAT(a.verification_date, '%H:%i') as verification_time,
					a.verification_date,
					e.operator_name

					FROM verification a

					JOIN card b
					ON a.card_id = b.card_id
					AND a._status <> 'D'
					AND b._status <> 'D'

					JOIN participant c
					ON b.participant_id = c.participant_id
					AND c._status <> 'D'

                    LEFT JOIN titles d
                    ON c.title_id = d.title_id
                    AND	d._status <> 'D'

					LEFT JOIN users e
					ON a._user = e.user_id
					AND e._status <> 'D'

					WHERE
					c.event_id = '".$event_id."'
					".$userCondition."
					AND (a.card_id LIKE '%".$key."%'
					OR c.participant_name LIKE '%".$key."%'
					OR a.verification_date LIKE '%".$key."%')

					ORDER BY
					a.verification_date DESC
					";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function checkCard($code){
		$query = 	"SELECT EXISTS (

						SELECT 1

						FROM card a
						JOIN participant b
						ON a.participant_id = b.participant_id
						AND a._status <> 'D'
						AND b._status <> 'D'

						WHERE
						card_id like '".$code."'
						AND a._status <> 'D'

					) AS checkCard
					";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function checkVerification($code){
		$query = 	"SELECT
						CASE WHEN c.card_id IS NOT NULL THEN 2
						WHEN b.card_id IS NOT NULL THEN 1
						ELSE 0
					END AS checkVerification,
					COALESCE(f.is_confirm, 0) AS is_confirm,
					COALESCE(e.title_name, '') AS title_name,
					COALESCE(d.participant_name, '') AS participant_name

					FROM card a

					LEFT JOIN verification b
					ON a.card_id = b.card_id
					AND b.card_id like '".$code."'
					AND a._status <> 'D'
					AND b._status <> 'D'

					LEFT JOIN delegate_verification c
					ON a.card_id = c.card_id
					AND c.card_id like '".$code."'
					AND c._status <> 'D'

					LEFT JOIN participant d
					ON c.delegate_to = d.participant_id
					AND d._status <> 'D'

					LEFT JOIN titles e
					ON d.title_id = e.title_id
					AND e._status <> 'D'

					LEFT JOIN participant f
	                ON a.participant_id = f.participant_id
	                AND f._status <> 'D'

					WHERE a.card_id like '".$code."'

					UNION

					SELECT
					-1 AS checkVerification,
					0 AS is_confirm,
					'' AS title_name,
					'' as participant_name";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getNewDate() {
		$query = "SELECT NOW() AS id";
		$result = $this->db->query($query);
		$newdate = $result->row()->id;
		return $newdate;
	}

	public function saveVerificationLog($data){
		$query = 	"INSERT INTO verification
					(card_id, verification_date, _status, _user, _date)
					VALUES(?, ?, STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s'),'I',?,NOW())
					";

		$data = $this->db->query($query,array(
			$data['card_id'],
			$data['newDate'],
			$data['userID']
		));

		return $data;
	}

	public function deactiveVerificationLog($data)
	{
		$query = 	"UPDATE participant_facility SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE participant_id IN (
						SELECT participant_id
						FROM card
						WHERE card_id IN (
							SELECT card_id
							FROM verification
							WHERE CONCAT(DATE_FORMAT(verification_date, '%Y%m%d%H%i'), card_id) = ?
						)
					)
					";

		$this->db->query($query,array(
			$data['userID'],
			$data['log_id']
		));

		$query = 	"UPDATE verification SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE CONCAT(DATE_FORMAT(verification_date, '%Y%m%d%H%i'), card_id) = ?
					";

		$data = $this->db->query($query,array(
			$data['userID'],
			$data['log_id']
		));

		return $data;
	}

	public function deactiveVerificationCard($data)
	{
		$query = 	"UPDATE verification SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE card_id = ?
					";

		$data = $this->db->query($query,array(
			$data['userID'],
			$data['card_id']
		));

		return $data;
	}

	public function getParticipantAttendance(){
		$query = 	"SELECT DISTINCT
					b.card_id,
                    concat(COALESCE(d.title_name, ''), a.participant_name) as participant_name,
					COALESCE(DATE_FORMAT(c.verification_date, '%H:%i'), '-') as verification_time

					FROM participant a

					JOIN card b
					ON a.participant_id = b.participant_id
					AND a.event_id = b.event_id
					AND a._status <> 'D'
					AND b._status <> 'D'

					LEFT JOIN verification c
					ON b.card_id = c.card_id
					AND c._status <> 'D'

                    LEFT JOIN titles d
                    ON a.title_id = d.title_id
                    AND	d._status <> 'D'

					WHERE
					b.event_id = $_SESSION[event_id]

                    ORDER BY
                    verification_time DESC
					";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getTotalVerified() {
		$user_id = $_SESSION['user_id'];
		$query = "	SELECT COUNT(a.card_id) AS TotalVerified
					FROM verification a
					JOIN card b
					ON a.card_id = b.card_id
					AND a._status <> 'D'
					AND b._status <> 'D'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getTotalVerifiedByUser($user_id) {
		$query = "	SELECT COUNT(a.card_id) AS TotalVerified
					FROM verification a
					JOIN card b
					ON a.card_id = b.card_id
					AND a._status <> 'D'
					AND b._status <> 'D'
					WHERE a._user = $user_id";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

}
