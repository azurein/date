<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Undian extends Main_Controller {

  public function __construct()
	{
		parent::__construct();
        $this->load->model("Undian_model","undian");
	}

	public function index()
	{
		$_SESSION['user_id'] = '0';
		$_SESSION['event_id'] = '1';

		$this->view('admin/undian');
	}

	private function getSession($key){
		return $_SESSION[$key];
	}

  public function getAllParticipant(){
    $param = array(
      'event_id' => $this->getSession('event_id')
    );
		echo json_encode($this->undian->getAllParticipant($param));
	}

	public function getAllRightfulParticipant(){
    $param = array(
      'event_id' => $this->getSession('event_id'),
      'prize_id' => $this->input->post_get('prize_id')
    );
		echo json_encode($this->undian->getAllRightfulParticipant($param));
	}

  public function getPrize(){
    $idx = $this->input->post_get('index');
    $event_id = $this->getSession('event_id');
		$prizes = $this->undian->getPrize($event_id,$idx);

    // for( $i = 0 ; $i < count($prizes) ; $i++ ){
      $setting = $this->undian->getSetting($prizes[0]->prize_id);
      if(count($setting))
      {
        $winners = array();

        if($setting[0]->group_id == 0){
          for( $j = 0 ; $j < count($setting) ; $j++ ){
            array_push($winners , $this->undian->getWinnersbyParticipantID($setting[$j]->participant_id,$prizes[0]->prize_id)[0]);
          }
        }
        else if($setting[0]->participant_id == 0){
          $groupid = array();
          for( $j = 0 ; $j < count($setting) ; $j++ ){
            array_push($groupid,$setting[$j]->group_id);
          }
          $winners = $this->undian->getWinnersbyGroupID($groupid,$prizes[0]->prize_id,$prizes[0]->total_winner);
        }
        $prizes[0]->winners = $winners;
        $prizes[0]->set = true;
      }
			else
				$prizes[0]->set = false;

      $prizes[0]->nextAvailable = $this->undian->getNextAvailability($event_id,$idx+1) == 1 ? true : false ;

      $lotteryResult = $this->undian->getLotteryResult($prizes[0]->prize_id);

      if(count($lotteryResult) > 0){
        $prizes[0]->decided = true;
        $prizes[0]->result = $lotteryResult;
      }
      else{
        $prizes[0]->decided = false;
      }

			// unset($prizes[$i]->prize_id);
    // }

    echo json_encode($prizes);
  }

  public function saveWinner(){
    $old_participant = $this->input->post_get('old_participant');
    $participant = $this->input->post_get('participant');
    $prize_id = $this->input->post_get('prize_id');
    $user_id = $this->getSession('user_id');

    $this->undian->deletePrevData($prize_id, $old_participant);

    // print_r(count($participant));
    for($i = 0 ; $i < count($participant) ; $i++){
    //   print_r($i);
      $param = array(
        'participant_id' => $participant[$i],
        'prize_id' => $prize_id,
        'user_id' => $user_id
      );
      $this->undian->insertLottery($param);
    }
  }

}
