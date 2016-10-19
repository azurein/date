<?php
class Home_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
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
		$query = 	"SELECT a.facility_id,
					b.facility_name as table_name,
					a.facility_name as chair_name,
					'0' as available

					FROM participant_facility c

					JOIN facility a
					ON c.facility_id = a.facility_id
					AND c._status <> 'D'
					AND a._status <> 'D'

					JOIN facility b
					ON a.facility_parent_id = b.facility_id
					AND b._status <> 'D'

					WHERE c.participant_id = '".$participant_id."'


					UNION


					SELECT a.facility_id,
					b.facility_name as table_name,
					a.facility_name as chair_name,
					'1' as available

					FROM facility a

					JOIN facility b
					ON a.facility_parent_id = b.facility_id
					AND a._status <> 'D'
					AND b._status <> 'D'

					WHERE a.event_id = '".$_SESSION['event_id']."'
					AND a.group_id = '".$group_id."'
					AND a.facility_id NOT IN (SELECT facility_id FROM participant_facility WHERE event_id = '".$_SESSION['event_id']."')
					";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function checkAvailableFacility($group_id, $follower)
	{
		$query = 	"SELECT a.facility_id,
					b.facility_name as table_name,
					a.facility_name as chair_name

					FROM facility a

					JOIN facility b
					ON a.facility_parent_id = b.facility_id
					AND a._status <> 'D'
					AND b._status <> 'D'

					WHERE a.event_id = '".$_SESSION['event_id']."'
					AND a.group_id = '".$group_id."'
					AND a.facility_id NOT IN (SELECT facility_id FROM participant_facility WHERE event_id = '".$_SESSION['event_id']."' AND _status <> 'D')

					ORDER BY b.facility_id, a.facility_id";

		$data = $this->db->query($query)->result();
		return $data;
	}
}
