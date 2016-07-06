<?php
class Peserta_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function getParticipant($search){
		$query = "SELECT participant_id,participant_name,title_name,delegate_to,group_name,follower
					FROM participant a
					JOIN title b ON a.title_id=b.title_id AND b.wht <> 'D'
					JOIN groups c ON a.group_id=c.group_id AND c.wht <> 'D'
					WHERE a.wht <> 'D' AND 
						(participant_name LIKE '%".$search."%' OR c.group_name LIKE '%".$search."%' 
						OR a.delegate_to LIKE '%".$search."%' OR a.follower LIKE '%".$search."%')
						AND event_id='".$this->session->userdata('active_event')."'";
		$data = $this->db->query($query)->result();
		return $data;
	}
	public function getTitle(){
		$query = "SELECT title_id,title_name FROM title WHERE wht <> 'D'";
		$data = $this->db->query($query)->result();
		return $data;
	}
	public function getGroup(){
		$query = "SELECT group_id,group_name FROM groups WHERE wht <> 'D'";
		$data = $this->db->query($query)->result();
		return $data;
	}
	public function getContact($participantId){
		$query = "SELECT contact_type,contact FROM contact WHERE wht <> 'D' AND participant_id='".$participantId."'";
		return $this->db->query($query)->result();
	}
	public function searchName($queryName){
		$query = "SELECT DISTINCT a.participant_name,a.participant_id 
					FROM participant a JOIN contact c ON a.participant_id=c.participant_id AND c.wht<>'D'
					WHERE a.wht <> 'D' AND (a.participant_name='".$queryName."' OR c.contact='".$queryName."')";
		return $this->db->query($query)->result()[0];
	}
	public function getFolowerNum($queryName){
		$query = "SELECT DISTINCT follower
					FROM participant WHERE wht <> 'D' AND participant_name='".$queryName."'";
		return $this->db->query($query)->result()[0]->follower;
	}
	public function createParticipant($newData)
	{
		$query = "INSERT INTO participant (participant_name,title_id,delegate_to,card_code,follower,group_id,event_id, wht, whn, who, how) 
					VALUES(?,?,?,?,?,?,?,'A',NOW(),?,'Application')";
		$this->db->query($query,array($newData['name'],$newData['title'],$newData['delegate'],$newData['card'],$newData['follower'],$newData['group'],
								$this->session->userdata('active_event'),$this->session->userdata('user_id')));
		return $this->db->insert_id();
	}
	public function createContact($contactList,$participantId)
	{
		for($i=0;$i<count($contactList);$i++){
			$query = "INSERT INTO contact (participant_id,contact_type,contact, wht, whn, who, how) 
						VALUES(?,?,?,'A',NOW(),?,'Application')";
			$this->db->query($query,array($participantId,$contactList[$i]['type'],$contactList[$i]['detail'],$this->session->userdata('user_id')));
		}
	}
	public function loadParticipant($participant){
		$query = "SELECT participant_id,title_id,participant_name,delegate_to,follower,card_code FROM participant 
					WHERE wht <> 'D' AND event_id='".$this->session->userdata('active_event')."' AND participant_id IN (".$participant.")";
		return $this->db->query($query)->result();
	}
	public function loadContact($participant){
		$query = "SELECT contact_type,contact,is_primary FROM contact
					WHERE wht <> 'D' AND participant_id ='".$participant."'";
		$result = $this->db->query($query)->result();
		return count($result)==0?array():$result[0];
	}
}