<?php
class Home_model_8 extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('model_8',TRUE);
	}

	public function getParticipantByCardID($card_id)
	{
		$query = 	"SELECT DISTINCT
					participant.participant_id,
					card.card_id,
					titles.title_name,
					participant.participant_name,
					participant.phone_num,
					groups.group_id,
					groups.group_name,
					participant.follower

					FROM participant

					JOIN card
					ON participant.participant_id = card.participant_id
					AND participant._status <> 'D'
					AND card._status <> 'D'

					JOIN titles
					ON participant.title_id = titles.title_id
					AND titles._status <> 'D'

					JOIN groups
					ON participant.group_id = groups.group_id
					AND groups._status <> 'D'

					WHERE card.card_id = '".$card_id."'
					";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getParticipantFacility($group_id, $participant_id)
	{
		$query = 	"SELECT DISTINCT
					canvas.canvas_name,
					groups.group_name,
					b.facility_name as table_name,
					a.facility_id,
					a.facility_name as chair_name,
					'0' as available

					FROM participant_facility

					JOIN facility a
					ON participant_facility.facility_id = a.facility_id
					AND participant_facility._status <> 'D'
					AND a._status <> 'D'

					JOIN facility b
					ON a.facility_parent_id = b.facility_id
					AND b._status <> 'D'

					JOIN canvas
					ON a.canvas_id = canvas.canvas_id
					AND canvas._status <> 'D'

					JOIN groups
					ON a.group_id = groups.group_id
					AND groups._status <> 'D'

					WHERE participant_facility.participant_id = '".$participant_id."'


					UNION

					SELECT canvas_name,
					group_name,
					table_name,
					facility_id,
					chair_name,
					available

					FROM (
						SELECT DISTINCT
						canvas.canvas_name,
						groups.group_name,
						b.facility_name as table_name,
						a.facility_id,
						a.facility_name as chair_name,
						'1' as available

						FROM facility a

						JOIN facility b
						ON a.facility_parent_id = b.facility_id
						AND a._status <> 'D'
						AND b._status <> 'D'

						JOIN canvas
						ON a.canvas_id = canvas.canvas_id
						AND canvas._status <> 'D'

						JOIN groups
						ON a.group_id = groups.group_id
						AND groups._status <> 'D'

						WHERE a.event_id = '".$_SESSION['event_id']."'
						AND a.facility_id NOT IN (SELECT facility_id FROM participant_facility WHERE event_id = '".$_SESSION['event_id']."')

						ORDER BY canvas.canvas_name, groups.group_name, b.facility_name, a.facility_name
					) a
					";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function checkAvailableFacility($group_id, $follower)
	{
		$query = 	"SELECT DISTINCT
					canvas.canvas_name,
					groups.group_name,
					b.facility_name as table_name,
					a.facility_id,
					a.facility_name as chair_name

					FROM facility a

					JOIN facility b
					ON a.facility_parent_id = b.facility_id
					AND a._status <> 'D'
					AND b._status <> 'D'

					JOIN canvas
					ON a.canvas_id = canvas.canvas_id
					AND canvas._status <> 'D'

					JOIN groups
					ON a.group_id = groups.group_id
					AND groups._status <> 'D'

					WHERE a.event_id = '".$_SESSION['event_id']."'
					AND a.group_id = '".$group_id."'
					AND a.facility_id NOT IN (SELECT facility_id FROM participant_facility WHERE event_id = '".$_SESSION['event_id']."' AND _status <> 'D')


					UNION


					SELECT canvas_name,
					group_name,
					table_name,
					facility_id,
					chair_name

					FROM (
						SELECT DISTINCT
						canvas.canvas_name,
						groups.group_name,
						b.facility_name as table_name,
						a.facility_id,
						a.facility_name as chair_name

						FROM facility a

						JOIN facility b
						ON a.facility_parent_id = b.facility_id
						AND a._status <> 'D'
						AND b._status <> 'D'

						JOIN canvas
						ON a.canvas_id = canvas.canvas_id
						AND canvas._status <> 'D'

						JOIN groups
						ON a.group_id = groups.group_id
						AND groups._status <> 'D'

						WHERE a.event_id = '".$_SESSION['event_id']."'
						AND a.group_id <> '".$group_id."'
						AND a.facility_id NOT IN (SELECT facility_id FROM participant_facility WHERE event_id = '".$_SESSION['event_id']."' AND _status <> 'D')

						ORDER BY canvas.canvas_name, groups.group_name, b.facility_name, a.facility_name
					) a
					";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function getParticipantRepresentation($participant_id)
	{
		$query = 	"SELECT
					c.card_id,
					a.participant_id,
					b.title_name,
					a.participant_name,
					a.phone_num,
					CASE WHEN d.card_id IS NULL THEN 0 ELSE 1 END AS selected

					FROM participant a

					JOIN titles b
					ON a.title_id = b.title_id
					AND b._status <> 'D'

					JOIN card c
					ON a.participant_id = c.participant_id
					AND c._status <> 'D'

					LEFT JOIN delegate_verification d
					ON c.card_id = d.card_id
					AND d._status <> 'D'

					WHERE a._status <> 'D'
					AND a.delegate_to = '".$participant_id."'";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function directRegistration($data, $facilities)
	{
		$query = 	"INSERT INTO participant (
					participant_name, phone_num, title_id, delegate_to, follower_prev, follower, group_id, _status, _user, _date, event_id, is_confirm, souvenir_qty
					) VALUES(?, ?, ?, NULL, ?, ?, ?, 'I', ?, NOW(), ?, '1', ?)";
		$this->db->query($query,array(
			$data['name'],
			$data['phone_num'],
			$data['title'],
			$data['follower'],
			$data['follower'],
			$data['group'],
			$data['user_id'],
			$_SESSION['event_id'],
			$data['souvenir_qty']
		));
		$new_participant_id = $this->db->insert_id();

		$query = 	"INSERT INTO card
					(card_id,participant_id,_status,_user,_date,event_id)
					VALUES(?,?,'I',?,NOW(),?)
					";
		$this->db->query($query,array(
			$data['new_id'],
			$new_participant_id,
			$data['user_id'],
			$data['event_id']
		));

		if($facilities) {
			//pencatatan kehadiran baru
			$query = 	"INSERT INTO verification (
						card_id, verification_date, _status, _user, _date
						) VALUES(?, STR_TO_DATE(NOW(), '%Y-%m-%d %H:%i:%s'), 'I', ?, NOW())
						";
			$data = $this->db->query($query,array(
				$data['new_id'],
				$_SESSION['user_id']
			));

			for ($i=0; $i < count($facilities); $i++) {
				$query = 	"INSERT INTO participant_facility (
							event_id, facility_id, participant_id, reserve_at, checkin_at, _status, _user, _date
							) VALUES(?, ?, ?, NULL, NOW(), 'I', ?, NOW())";

				$this->db->query($query,array(
					$_SESSION['event_id'],
					$facilities[$i],
					$new_participant_id,
					$_SESSION['user_id']
				));
			}
		}

		$data = $this->print_card_data($new_participant_id);
		return $data;
	}

	public function print_card_data($participant_id)
	{
		$query = 	"SELECT DISTINCT
					event.event_name,
					event.event_img,
					event.address,
					b.facility_name as table_name,
					participant.follower,
					titles.title_name,
					participant.participant_name,
					groups.group_name,
					RIGHT(card.card_id, 3) AS lottery_num

					FROM event

					JOIN participant
					ON event.event_id = participant.event_id
					AND event._status <> 'D'
					AND participant._status <> 'D'

					JOIN titles
					ON participant.title_id = titles.title_id
					AND titles._status <> 'D'

					JOIN card
					ON participant.participant_id = card.participant_id
					AND card._status <> 'D'

					JOIN groups
					ON participant.group_id = groups.group_id

					LEFT JOIN participant_facility
					ON participant.participant_id = participant_facility.participant_id
					AND participant_facility._status <> 'D'

					LEFT JOIN facility a
					ON participant_facility.facility_id = a.facility_id
					AND a._status <> 'D'

					LEFT JOIN facility b
					ON a.facility_parent_id = b.facility_id
					AND b._status <> 'D'

					WHERE event.is_active = '1'
					AND event.event_id = $_SESSION[event_id]
					AND participant.participant_id = $participant_id";

		$data = $this->db->query($query)->result_array();
		return $data;
	}
}
