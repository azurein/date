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

		$query = 	"SELECT event_id, event_name, address, start_at
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

	public function getTableI() {
		$query = 	"SELECT
					groups.group_name,
					invite,
					attend

					FROM groups

					LEFT JOIN (
					SELECT
					participant.group_id,
					COUNT(card.participant_id) as invite

					FROM card

					JOIN participant
					ON card.participant_id = participant.participant_id
					AND card.event_id = participant.event_id
					AND participant._status <> 'D'

					WHERE participant.event_id = '$_SESSION[event_id]'

					GROUP BY participant.group_id
					) invite
					ON groups.group_id = invite.group_id

					LEFT JOIN (
					SELECT
					participant.group_id,
					COUNT(verification.card_id) as attend

					FROM verification

					JOIN card
					ON verification.card_id = card.card_id
					AND verification._status <> 'D'
					AND card._status <> 'D'

					JOIN participant
					ON card.participant_id = participant.participant_id
					AND card.event_id = participant.event_id
					AND participant._status <> 'D'

					WHERE participant.event_id = '$_SESSION[event_id]'
					GROUP BY participant.group_id
					) attend
					ON groups.group_id = attend.group_id

					WHERE invite <> '' AND attend <> ''";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getTableII() {
		$query = 	"SELECT
					titles.title_name,
					participant.participant_name,
					participant.phone_num,
					groups.group_name,
					participant.follower_prev,
					participant.follower

					FROM participant

					JOIN titles
					ON participant.title_id = titles.title_id
					AND participant._status <> 'D'
					AND titles._status <> 'D'

					JOIN groups
					ON participant.group_id = groups.group_id
					AND groups._status <> 'D'

					ORDER BY
					participant.participant_name,
					participant.follower";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getOperator(){

		$query = 	"SELECT DISTINCT
					users.user_id,
					UPPER(users.operator_name) AS operator_name

					FROM verification

					JOIN users
					ON verification._user = users.user_id
					AND verification._status <> 'D'
					AND users._status <> 'D'

					JOIN card
					ON verification.card_id = card.card_id
					AND card._status <> 'D'

					WHERE
					card.event_id = '$_SESSION[event_id]'

					ORDER BY
					operator_name";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getTableIII($user_id) {
		$query = 	"SELECT a.* FROM (

					SELECT
					groups.group_id,
					groups.group_name,
					titles.title_name,
					participant.participant_name,
					verification.verification_date,
					'-' AS note

					FROM verification

					JOIN card
					ON verification.card_id = card.card_id
					AND verification._status <> 'D'
					AND card._status <> 'D'

					JOIN participant
					ON card.participant_id = participant.participant_id
					AND participant._status <> 'D'

					JOIN titles
					ON participant.title_id = titles.title_id
					AND titles._status <> 'D'

					JOIN groups
					ON participant.group_id = groups.group_id
					AND groups._status <> 'D'

					WHERE
					participant.event_id = '$_SESSION[event_id]'
					AND verification._user = '$user_id'

					UNION

					SELECT
					groups.group_id,
					groups.group_name,
					titles.title_name,
					participant.participant_name,
					delegate_verification.verification_date,
					'Represented' AS note

					FROM delegate_verification

					JOIN card
					ON delegate_verification.card_id = card.card_id
					AND delegate_verification._status <> 'D'
					AND card._status <> 'D'

					JOIN participant
					ON card.participant_id = participant.participant_id
					AND participant._status <> 'D'

					JOIN titles
					ON participant.title_id = titles.title_id
					AND titles._status <> 'D'

					JOIN groups
					ON participant.group_id = groups.group_id
					AND groups._status <> 'D'

					WHERE
					participant.event_id = '$_SESSION[event_id]'
					AND delegate_verification._user = '$user_id'

					) a

					ORDER BY
					a.participant_name,
					a.verification_date";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getTableIV() {
		$query = 	"SELECT
					a.souvenir_id,
					a.souvenir_qty,
					b.souvenir_dist,
					(a.souvenir_qty - b.souvenir_dist) as souvenir_left

					FROM (
					SELECT
					souvenir.souvenir_id,
					souvenir.souvenir_qty

					FROM event

					JOIN souvenir
					ON event.event_id = souvenir.event_id
					AND event._status <> 'D'
					AND souvenir._status <> 'D'

					WHERE
					event.event_id = '$_SESSION[event_id]'

					ORDER BY
					souvenir.souvenir_id

					LIMIT 1
					) a

					JOIN (
					SELECT
					souvenir.souvenir_id,
					SUM(participant.souvenir_qty) as souvenir_dist

					FROM event

					JOIN souvenir
					ON event.event_id = souvenir.event_id
					AND event._status <> 'D'
					AND souvenir._status <> 'D'

					JOIN participant
					ON event.event_id = participant.event_id
					AND participant._status <> 'D'

					WHERE
					event.event_id = '$_SESSION[event_id]'

					GROUP BY
					souvenir.souvenir_id

					ORDER BY
					souvenir.souvenir_id

					LIMIT 1
					) b

					ON a.souvenir_id = b.souvenir_id";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getTableV() {
		$query = 	"SELECT DISTINCT
					b.event_id,
					b2.title_name AS participant_title,
					b.participant_name,
					d.event_id,
					COALESCE(d2.title_name, '') AS represented_title,
					COALESCE(d.participant_name, '-') AS represented_name

					FROM verification

					JOIN card a
					ON verification.card_id = a.card_id
					AND verification._status <> 'D'
					AND a._status <> 'D'

					JOIN participant b
					ON a.participant_id = a.participant_id
					AND a.event_id = b.event_id
					AND a._status <> 'D'

					JOIN titles b2
					ON b.title_id = b2.title_id
					AND b2._status <> 'D'

					JOIN card c
					ON b.delegate_to = c.participant_id
					AND c._status <> 'D'

					LEFT JOIN participant d
					ON c.participant_id = d.participant_id
					AND c.event_id = d.event_id
					AND d._status <> 'D'

					LEFT JOIN titles d2
					ON d.title_id = d2.title_id
					AND d2._status <> 'D'

					LEFT JOIN delegate_verification
					ON c.card_id = delegate_verification.card_id
					AND delegate_verification._status <> 'D'

					WHERE
					a.event_id = '$_SESSION[event_id]'";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getTableVI() {
		$query = 	"SELECT
					b.facility_name,
					titles.title_name,
					participant.participant_name,
					CASE WHEN participant.phone_num LIKE '%on%the%spot%' THEN 'Ya' ELSE '' END AS is_onthespot

					FROM participant_facility

					JOIN facility a
					ON participant_facility.facility_id = a.facility_id
					AND participant_facility._status <> 'D'
					AND a._status <> 'D'

					JOIN facility b
					ON a.facility_parent_id = b.facility_id
					AND b._status <> 'D'

					JOIN participant
					ON participant_facility.participant_id = participant.participant_id

					JOIN titles
					ON participant.title_id = titles.title_id
					AND titles._status <> 'D'

					WHERE
					participant_facility.event_id = '$_SESSION[event_id]'

					ORDER BY
					b.facility_name";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getTableVII() {
		$query = 	"SELECT
					prize.prize_priority,
					prize.prize_name,
					prize.total_winner,
					titles.title_name,
					participant.participant_name,
					groups.group_name

					FROM prize

					JOIN lottery
					ON prize.prize_id = lottery.prize_id
					AND prize._status <> 'D'
					AND lottery._status <> 'D'

					JOIN participant
					ON lottery.participant_id = participant.participant_id
					AND participant._status <> 'D'

					JOIN titles
					ON participant.title_id = titles.title_id
					AND titles._status <> 'D'

					JOIN groups
					ON participant.group_id = groups.group_id
					AND groups._status <> 'D'

					WHERE
					prize.event_id = '$_SESSION[event_id]'

					ORDER BY
					prize.prize_priority";

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
