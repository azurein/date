<?php
class Update_model_3 extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
		$this->db_3 = $this->load->database('model_3',TRUE);
	}

	public function lastUpdate(){

		$query = "DELETE FROM canvas";
		$this->db->query($query);
		$this->db_3->get('canvas');
		foreach ($query->result() as $row) {
			  $this->db->insert('canvas',$row);
		}

		$query = "DELETE FROM card";
		$this->db->query($query);
		$this->db_3->get('card');
		foreach ($query->result() as $row) {
			  $this->db->insert('card',$row);
		}

		$query = "DELETE FROM delegate_verification";
		$this->db->query($query);
		$this->db_3->get('delegate_verification');
		foreach ($query->result() as $row) {
			  $this->db->insert('delegate_verification',$row);
		}

		$query = "DELETE FROM event";
		$this->db->query($query);
		$this->db_3->get('event');
		foreach ($query->result() as $row) {
			  $this->db->insert('event',$row);
		}

		$query = "DELETE FROM facility";
		$this->db->query($query);
		$this->db_3->get('facility');
		foreach ($query->result() as $row) {
			  $this->db->insert('facility',$row);
		}

		$query = "DELETE FROM lottery";
		$this->db->query($query);
		$this->db_3->get('lottery');
		foreach ($query->result() as $row) {
			  $this->db->insert('lottery',$row);
		}

		$query = "DELETE FROM participant";
		$this->db->query($query);
		$this->db_3->get('participant');
		foreach ($query->result() as $row) {
			$this->db->insert('participant',$row);
		}

		$query = "DELETE FROM participant_facility";
		$this->db->query($query);
		$this->db_3->get('participant_facility');
		foreach ($query->result() as $row) {
			  $this->db->insert('participant_facility',$row);
		}

		$query = "DELETE FROM prize";
		$this->db->query($query);
		$this->db_3->get('prize');
		foreach ($query->result() as $row) {
			  $this->db->insert('prize',$row);
		}

		$query = "DELETE FROM souvenir";
		$this->db->query($query);
		$this->db_3->get('souvenir');
		foreach ($query->result() as $row) {
			  $this->db->insert('souvenir',$row);
		}

		$query = "DELETE FROM users";
		$this->db->query($query);
		$this->db_3->get('users');
		foreach ($query->result() as $row) {
			  $this->db->insert('users',$row);
		}

		$query = "DELETE FROM verification";
		$this->db->query($query);
		$this->db_3->get('verification');
		foreach ($query->result() as $row) {
			  $this->db->insert('verification',$row);
		}

	}

}
