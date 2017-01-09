<?php
class Update_model_4 extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
		$this->db_4 = $this->load->database('model_4',TRUE);
	}

	public function lastUpdate(){
		
		$query = "DELETE FROM canvas";
		$this->db->query($query);
		$query = $this->db_2->get('canvas');
		$result = $query->result();
		if($result)
	   		$this->db->insert_batch('canvas', $result);

		$query = "DELETE FROM card";
		$this->db->query($query);
		$query = $this->db_2->get('card');
		$result = $query->result();
		if($result)
	   		$this->db->insert_batch('card',$result);

		$query = "DELETE FROM delegate_verification";
		$this->db->query($query);
		$query = $this->db_2->get('delegate_verification');
		$result = $query->result();
		if($result)
			$this->db->insert_batch('delegate_verification',$result);

		$query = "DELETE FROM event";
		$this->db->query($query);
		$query = $this->db_2->get('event');
		$result = $query->result();
		if($result)
			$this->db->insert_batch('event',$result);

		$query = "DELETE FROM facility";
		$this->db->query($query);
		$query = $this->db_2->get('facility');
		$result = $query->result();
		if($result)
			$this->db->insert_batch('facility',$result);

		$query = "DELETE FROM lottery";
		$this->db->query($query);
		$query = $this->db_2->get('lottery');
		$result = $query->result();
		if($result)
			$this->db->insert_batch('lottery',$result);

		$query = "DELETE FROM participant";
		$this->db->query($query);
		$query = $this->db_2->get('participant');
		$result = $query->result();
		if($result)
			$this->db->insert_batch('participant',$result);

		$query = "DELETE FROM participant_facility";
		$this->db->query($query);
		$query = $this->db_2->get('participant_facility');
		$result = $query->result();
		if($result)
			$this->db->insert_batch('participant_facility',$result);

		$query = "DELETE FROM prize";
		$this->db->query($query);
		$query = $this->db_2->get('prize');
		$result = $query->result();
		if($result)
			$this->db->insert_batch('prize',$result);

		$query = "DELETE FROM souvenir";
		$this->db->query($query);
		$query = $this->db_2->get('souvenir');
		$result = $query->result();
		if($result)
			$this->db->insert_batch('souvenir',$result);

		$query = "DELETE FROM users";
		$this->db->query($query);
		$query = $this->db_2->get('users');
		$result = $query->result();
		if($result)
			$this->db->insert_batch('users',$result);

		$query = "DELETE FROM verification";
		$this->db->query($query);
		$query = $this->db_2->get('verification');
		$result = $query->result();
		if($result)
		 	$this->db->insert_batch('verification',$result);
		 
	}

}
