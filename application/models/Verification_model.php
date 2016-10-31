<?php
class Verification_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	public function verify($participant_id, $card_id, $follower, $fixed_facilites, $canceled_facilities, $additional_facilities, $followers)
	{
		//non-aktif kehadiran lama
		$query = "UPDATE verification SET _status = 'D', _user = ?, _date = NOW() WHERE card_id = ?";
		$this->db->query($query,array(
			$_SESSION['user_id'],
			$card_id
		));

		//pencatatan kehadiran baru
		$query = 	"INSERT INTO verification (
					card_id, verification_date, _status, _user, _date
					) VALUES(?, STR_TO_DATE(NOW(), '%Y-%m-%d %H:%i:%s'), 'I', ?, NOW())
					";
		$data = $this->db->query($query,array(
			$card_id,
			$_SESSION['user_id']
		));

		//update follower
		$query = "UPDATE participant SET follower = ?, _status = 'U', _user = ?, _date = NOW() WHERE participant_id = ?";
		$this->db->query($query,array(
			$follower,
			$_SESSION['user_id'],
			$participant_id
		));

		//fasilitas yang tetap jadi
		$fixed_facilites = implode(",", $fixed_facilites);
		$fixed_facilites_condition = "AND facility_id IN (".$fixed_facilites.")";
		$query = "UPDATE participant_facility SET checkin_at = NOW(), _status = 'U', _user = ?, _date = NOW() WHERE participant_id = ? ?";
		$this->db->query($query,array(
			$_SESSION['user_id'],
			$participant_id,
			$fixed_facilites_condition
		));

		//fasilitas yang tidak jadi
		if ($canceled_facilities) {
			$canceled_facilities = implode(",", $canceled_facilities);
			$canceled_facilities_condition = "AND facility_id IN (".$canceled_facilities.")";
			$query = "DELETE FROM participant_facility WHERE participant_id = ? ?";
			$this->db->query($query,array(
				$participant_id,
				$canceled_facilities_condition
			));
		}

		//fasilitas tambahan
		if($additional_facilities) {
			for ($i=0; $i < count($additional_facilities); $i++) {
				$query = 	"INSERT INTO participant_facility (
							event_id, facility_id, participant_id, reserve_at, checkin_at, _status, _user, _date
							) VALUES(?, ?, ?, NULL, NOW(), 'I', ?, NOW())";

				$this->db->query($query,array(
					$_SESSION['event_id'],
					$additional_facilities[$i],
					$participant_id,
					$_SESSION['user_id']
				));
			}
		}

		//pendamping
		if($followers) {
			//non-aktif kehadiran pendamping
			$query = "UPDATE delegate_verification SET _status = 'D', _user = ?, _date = NOW() WHERE delegate_to = ?";
			$this->db->query($query,array(
				$_SESSION['user_id'],
				$participant_id
			));

			for ($i=0; $i < count($followers); $i++) {
				//pencatatan ulang kehadiran pendamping
				$query = 	"INSERT INTO delegate_verification (
							card_id, verification_date, delegate_to, _status, _user, _date
							) VALUES(?, STR_TO_DATE(NOW(), '%Y-%m-%d %H:%i:%s'), ?, 'I', ?, NOW())
							";
				$data = $this->db->query($query,array(
					$followers[$i],
					$participant_id,
					$_SESSION['user_id']
				));

				//unbook fasilitas pendamping
				$query = 	"DELETE FROM participant_facility WHERE participant_id in (
								SELECT participant_id FROM card WHERE card_id = ?
							)";
				$this->db->query($query,array(
					$followers[$i]
				));

				//update konfirmasi hadir menjadi silang
				$query = 	"UPDATE participant SET is_confirm = 0, _status = 'U', _user = ?, _date = NOW() WHERE participant_id in (
								SELECT participant_id FROM card WHERE card_id = ?
							)";
				$this->db->query($query,array(
					$_SESSION['user_id'],
					$followers[$i]
				));
			}
		}

		return $data;
	}

}
