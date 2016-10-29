<?php
class Kehadiran_model_4 extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('model_4',TRUE);
	}

	public function getVerificationLog($key=''){
		$query = 	"SELECT DISTINCT
					CONCAT(DATE_FORMAT(a.verification_date, '%Y%m%d%H%i%s'), a.card_id) as log_id,
					a.card_id,
                    COALESCE(d.title_name, '') as title_name,
					c.participant_name,
					DATE_FORMAT(a.verification_date, '%H:%i') as verification_time,
					a.verification_date

					FROM verification a

					JOIN card b
					ON a.card_id = b.card_id
					AND a._status <> 'D'
					AND b._status <> 'D'

					JOIN participant c
					ON b.participant_id = c.participant_id
					AND b.event_id = c.event_id
					AND c._status <> 'D'

                    LEFT JOIN titles d
                    ON c.title_id = d.title_id
                    AND	d._status <> 'D'

					WHERE
					b.event_id = 1
					AND a._user = 0
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
		$query = 	"SELECT EXISTS (

						SELECT 1

						FROM card a

						JOIN verification b
						ON a.card_id = b.card_id
						AND a._status <> 'D'
						AND b._status <> 'D'

						WHERE
						a.card_id like '".$code."'

					) AS checkVerification
					";

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
					(card_id, participant_id, verification_date, _status, _user, _date)
					VALUES(?, ?, STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s'),'I',?,NOW())
					";

		$data = $this->db->query($query,array(
			$data['card_id'],
			$data['participant_id'],
			$data['newDate'],
			$data['userID']
		));

		return $data;
	}

	public function deactiveVerificationLog($data)
	{
		$query = 	"UPDATE verification SET
					_status = 'D',
					_user = ?,
					_date = NOW()
					WHERE CONCAT(DATE_FORMAT(verification_date, '%Y%m%d%H%i%s'), card_id) = ?
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
					b.event_id = 1

                    ORDER BY
                    verification_time DESC
					";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

}
