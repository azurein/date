<?php
class Login_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	public function checkLoginData($username, $password){
		$query = 	"	SELECT *
						FROM users
						WHERE
						username = '".$username."'
						AND password = '".$password."'
						AND _status <> 'D'";

		$data = $this->db->query($query)->result_array();
		return $data;
	}
}
