<?php
class Undian_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	public function getAllParticipant($param){
		$query = "
		SELECT
		SUBSTRING_INDEX(c.card_id,'-',-1) AS participant_name,
		p.participant_id

		FROM participant p

		JOIN card c
		ON p.participant_id = c.participant_id
		AND c._status <> 'D'

		JOIN verification d
		ON c.card_id = d.card_id
		AND d._status <> 'D'

		WHERE p._status <> 'D'
		AND p.event_id = ".$param['event_id']."

		ORDER BY p.participant_id
		";

		return $this->db->query($query)->result();
	}

	public function getAllRightfulParticipant($param){
		$query = "
		SELECT
		SUBSTRING_INDEX(c.card_id,'-',-1) AS participant_name,
		p.participant_id

		FROM participant p

		JOIN card c
		ON p.participant_id = c.participant_id
		AND c._status <> 'D'

		LEFT JOIN lottery win
		ON win.participant_id = p.participant_id

		LEFT JOIN prize_setting willwin
		ON willwin.participant_id = p.participant_id
		AND willwin.prize_id <> ".$param['prize_id']."
		AND willwin._status <> 'D'

		WHERE p._status <> 'D'
		AND win.participant_id IS NULL
		AND willwin.participant_id IS NULL
		AND p.event_id = ".$param['event_id']."

		ORDER BY p.participant_id
		";

		return $this->db->query($query)->result();
	}

	public function getPrize($event_id,$idx){
		$query = "
		SELECT
		p.prize_id,
		p.prize_descr,
		p.prize_img,
		p.prize_name,
		p.total_winner

		FROM prize p

		WHERE p._status <> 'D'
		AND p.event_id = '".$event_id."'

		ORDER BY prize_priority DESC LIMIT ".$idx.",1
		";

		return $this->db->query($query)->result();
	}

	public function getLotteryResult($prize_id){
		$query = "
		SELECT

		SUBSTRING_INDEX(c.card_id,'-',-1) AS participant_name,
		l.participant_id

		FROM lottery l

		JOIN participant p
		ON p.participant_id = l.participant_id
		AND p._status <> 'D'

		JOIN card c
		ON p.participant_id = c.participant_id
		AND c._status <> 'D'

		JOIN titles t
		ON p.title_id = t.title_id
		AND t._status <> 'D'

		WHERE l.prize_id = ".$prize_id."
		AND l._status <> 'D'
		";

		return $this->db->query($query)->result();
	}

	public function getNextAvailability($event_id,$idx){
		$query = "
		SELECT IF (
			EXISTS(
				SELECT 1
				FROM prize
				WHERE _status <> 'D'
				AND event_id = '".$event_id."'

				ORDER BY prize_priority DESC LIMIT ".$idx.",1
			),
			TRUE,
			FALSE
		) as available
		";

		return $this->db->query($query)->result()[0]->available;
	}

	public function getSetting($prize_id){
		$query = "
		SELECT

		group_id,
		participant_id

		FROM prize_setting

		WHERE _status <> 'D'
		AND prize_id = '".$prize_id."'
		";

		return $this->db->query($query)->result();
	}

	public function getWinnersbyParticipantID($participant_id,$prize_id){
		$query = "
		SELECT

		SUBSTRING_INDEX(c.card_id,'-',-1) AS participant_name,
		p.participant_id

		FROM participant p

		JOIN card c
		ON p.participant_id = c.participant_id
		AND c._status <> 'D'

		JOIN titles t
		ON p.title_id = t.title_id
		AND t._status <> 'D'

		LEFT JOIN lottery win
		ON win.participant_id = p.participant_id
		AND win.prize_id <> ".$prize_id."
		AND win._status <> 'D'

		LEFT JOIN prize_setting willwin
		ON willwin.participant_id = p.participant_id
		AND willwin.prize_id <> ".$prize_id."
		AND willwin._status <> 'D'

		WHERE p._status <> 'D'
		AND win.participant_id IS NULL
		AND willwin.participant_id IS NULL
		AND p.participant_id = ".$participant_id."
		";

		return $this->db->query($query)->result();
	}

	public function getWinnersbyGroupID($group_id,$prize_id,$row){
		$query = "
		SELECT

		SUBSTRING_INDEX(c.card_id,'-',-1) AS participant_name,
		p.participant_id

		FROM participant p

		JOIN card c
		ON p.participant_id = c.participant_id
		AND c._status <> 'D'

		JOIN titles t
		ON p.title_id = t.title_id
		AND t._status <> 'D'

		LEFT JOIN lottery win
		ON win.participant_id = p.participant_id
		AND win.prize_id <> ".$prize_id."
		AND win._status <> 'D'

		LEFT JOIN prize_setting willwin
		ON willwin.participant_id = p.participant_id
		AND willwin.prize_id <> ".$prize_id."
		AND willwin._status <> 'D'

		WHERE p._status <> 'D'
		AND win.participant_id IS NULL
		AND willwin.participant_id IS NULL
		AND p.group_id in (";

		for($i = 0 ; $i < count($group_id) ; $i++){
			if($i>0){
				$query.= ",";
			}
			$query.=  $group_id[$i];
		}

		$query .= ") ORDER BY RAND() LIMIT ".$row."";

		return $this->db->query($query)->result();
	}

	public function insertLottery($data){
		$query = "
		INSERT INTO lottery (
			participant_id,
			prize_id,
			_status,
			_user,
			_date
			)
		VALUES (
			?,?,'I',?,NOW()
		)
		";

		return $this->db->query($query,array(
			$data['participant_id'],
			$data['prize_id'],
			$data['user_id']
		));
	}

	public function deletePrevData($prize_id, $participant_id){

		if (isset($participant_id)) {
			foreach ($participant_id as $key) {
				$query = "UPDATE lottery
				SET _status = 'D'
				WHERE prize_id = '".$prize_id."'
				AND participant_id = '".$key."'
				AND _status <> 'D'";

				$this->db->query($query);
			}
		}
	}
}
