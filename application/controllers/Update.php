<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends Main_Controller {

	public $model_2;
	public $model_3;
	public $model_4;
	public $model_5;
	public $model_6;
	public $model_7;
	public $model_8;
	public $model_9;

   	public function __construct()
	{
		parent::__construct();
		$this->model_2 = FALSE;
		$this->model_3 = FALSE;
		$this->model_4 = FALSE;
		$this->model_5 = FALSE;
		$this->model_6 = FALSE;
		$this->model_7 = FALSE;
		$this->model_8 = FALSE;
		$this->model_9 = FALSE;

		if($this->ping($this->config->item('model_2'))) {
			$this->load->model("Update_model_2","update_2");
			$this->model_2 = TRUE;
		}
		else if($this->ping($this->config->item('model_3'))) {
			$this->load->model("Update_model_3","update_3");
			$this->model_3 = TRUE;
		}
		else if($this->ping($this->config->item('model_4'))) {
			$this->load->model("Update_model_4","update_4");
			$this->model_4 = TRUE;
		}
		else if($this->ping($this->config->item('model_5'))) {
			$this->load->model("Update_model_5","update_5");
			$this->model_5 = TRUE;
		}
		else if($this->ping($this->config->item('model_6'))) {
			$this->load->model("Update_model_6","update_6");
			$this->model_6 = TRUE;
		}
		else if($this->ping($this->config->item('model_7'))) {
			$this->load->model("Update_model_7","update_7");
			$this->model_7 = TRUE;
		}
		else if($this->ping($this->config->item('model_8'))) {
			$this->load->model("Update_model_8","update_8");
			$this->model_8 = TRUE;
		}
		else if($this->ping($this->config->item('model_9'))) {
			$this->load->model("Update_model_9","update_9");
			$this->model_9 = TRUE;
		}
	}

	public function index()
	{
		if(isset($_SESSION['user_id'])) {
			if($this->model_2) {
				$this->update_2->lastUpdate();
				echo "<script>alert('Update berhasil dari ".$this->config->item('model_2').". Silahkan Login kembali.');</script>";
				$this->logout();
			} else if($this->model_3) {
				$this->update_3->lastUpdate();
				echo "<script>alert('Update berhasil dari ".$this->config->item('model_3').". Silahkan Login kembali.');</script>";
				$this->logout();
			} else if($this->model_4) {
				$this->update_4->lastUpdate();
				echo "<script>alert('Update berhasil dari ".$this->config->item('model_4').". Silahkan Login kembali.');</script>";
				$this->logout();
			} else if($this->model_5) {
				$this->update_5->lastUpdate();
				echo "<script>alert('Update berhasil dari ".$this->config->item('model_5').". Silahkan Login kembali.');</script>";
				$this->logout();
			} else if($this->model_6) {
				$this->update_6->lastUpdate();
				echo "<script>alert('Update berhasil dari ".$this->config->item('model_6').". Silahkan Login kembali.');</script>";
				$this->logout();
			} else if($this->model_7) {
				$this->update_7->lastUpdate();
				echo "<script>alert('Update berhasil dari ".$this->config->item('model_7').". Silahkan Login kembali.');</script>";
				$this->logout();
			} else if($this->model_8) {
				$this->update_8->lastUpdate();
				echo "<script>alert('Update berhasil dari ".$this->config->item('model_8').". Silahkan Login kembali.');</script>";
				$this->logout();
			} else if($this->model_9) {
				$this->update_9->lastUpdate();
				echo "<script>alert('Update berhasil dari ".$this->config->item('model_9').". Silahkan Login kembali.');</script>";
				$this->logout();
			} else {
				echo "<script>alert('Update gagal');</script>";
			}

			$this->view('admin/login');

        } else {
            header('Location: '.base_url());
        }
	}

	// Function to check response time
	public function ping($host,$port=80,$timeout=1) {
	    $fsock = fsockopen($host, $port, $errno, $errstr, $timeout);
	    if (!$fsock) {
	    	// fclose();
	    	return FALSE;
	    }
	    else {
	    	// fclose();
			return TRUE;
	    }
	}

	public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['event_id']);
        unset($_SESSION['privilege']);
        unset($_SESSION['operator_name']);
    }

}
