<?php
class Operator_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	public function getOperator(){
		$query = "SELECT * FROM users WHERE _status <> 'D'";

		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function getOperatorByID($id)
	{
		$query = 	"SELECT * FROM users WHERE user_id = '".$id."' AND _status <> 'D'";

		$data = $this->db->query($query)->result();
		return $data;
	}

	public function createOperator($data){
		$query = 	"INSERT INTO users
					(operator_name,privilege,username,password,_status,_user,_date)
					VALUES(?,?,?,?,'I',?,NOW())";

		$this->db->query($query,array(
			$data['operator_name'],
			$data['privilege'],
			$data['username'],
			$data['password'],
			$_SESSION['user_id']
		));
		$data = $this->db->insert_id();
		return $data;
	}

	public function editOperator($data)
	{
		$query = "UPDATE users SET operator_name = ?, privilege = ?, username = ?, password = ?, _status = 'U', _user = ? WHERE user_id = ?";

		$data = $this->db->query($query,array(
			$data['operator_name'],
			$data['privilege'],
			$data['username'],
			$data['password'],
			$_SESSION['user_id'],
			$data['user_id']
		));
		return $data;
	}

	public function deactiveOperatorById($id, $user_id)
	{
		$query = "UPDATE users SET _status = 'D', _user = ? WHERE user_id = ?";

		$data = $this->db->query($query,array($id, $user_id));
		return $data;
	}

	public function checkUsername($username, $curr_username) {
		$query = 	"SELECT EXISTS (
						SELECT 1 FROM users WHERE username like '".$username."' AND username not like '".$curr_username."' AND _status <> 'D'
					) AS checkUsername
					";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

}
