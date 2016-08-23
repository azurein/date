<?php
class Update_model_4 extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
		$this->db_2 = $this->load->database('model_4',TRUE);
	}

	public function lastUpdate(){
		$query = "DELETE FROM participant";
		$this->db->query($query);

		$query = "DELETE FROM card";
		$this->db->query($query);

		$query = "DELETE FROM verification";
		$this->db->query($query);

		$query = $this->db_2->get('participant');
		foreach ($query->result() as $row) {
		      $this->db->insert('participant',$row);
		}

		$query = $this->db_2->get('card');
		foreach ($query->result() as $row) {
		      $this->db->insert('card',$row);
		}

		$query = $this->db_2->get('verification');
		foreach ($query->result() as $row) {
		      $this->db->insert('verification',$row);
		}
	}

}