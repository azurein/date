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

	public function getParticipantRepresentation($participant_id)
	{
		$query = 	"SELECT
					c.card_id,
					a.participant_id,
					b.title_name,
					a.participant_name,
					a.phone_num

					FROM participant a

					JOIN titles b
					ON a.title_id = b.title_id
					AND b._status <> 'D'

					JOIN card c
					ON a.participant_id = c.participant_id
					AND c._status <> 'D'

					WHERE a._status <> 'D'
					AND a.delegate_to = '".$participant_id."'";

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
}
