<?php
class Kartu_acara_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	public function getDesignByEvent($eventID)
	{
		$query = "SELECT
					cd.design_id,
					cd.component_id,
					cd.size,
					cd.x_axis,
					cd.y_axis,
					cd.rotation,
					cd.z_index,
					cd.font_type,
					cd.font_size,
					cd.value,
					cd.side,
					cd.comp_name,
					dc.component_name
					FROM card_design cd
					JOIN design_component dc
					ON cd.component_id = dc.component_id
					AND dc._status <> 'D'
					WHERE cd.event_id = ?
					AND cd._status <> 'D'
					ORDER BY cd.z_index";
		return $this->db->query($query,array(
			$eventID
		))->result();
	}

	public function getComponent()
	{
		$query = "SELECT
					component_id,
					component_name,
					default_img
					FROM design_component
					WHERE _status <> 'D'";
		return $this->db->query($query)->result();
	}

	public function insertDesign($data)
	{
		$query = "INSERT INTO card_design
			(event_id,component_id,size,x_axis,y_axis,rotation,z_index,font_type,font_size,value,side,comp_name,_status,_user,_date)
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?,'I',?,NOW())";

		$this->db->query($query,array(
			$data['event_id'],
			$data['component_id'],
			$data['size'],
			$data['x_axis'],
			$data['y_axis'],
			$data['rotation'],
			$data['z-index'],
			$data['font_type'],
			$data['font_size'],
			$data['val'],
			$data['side'],
			$data['comp_name'],
			$data['_user']
		));
		return $this->db->insert_id();
	}

	public function updateDesign($data)
	{
		$query = "UPDATE card_design SET
			component_id = ?,
			size = ?,
			x_axis = ?,
			y_axis = ?,
			rotation = ?,
			z_index = ?,
			font_type = ?,
			font_size = ?,
			value = ?,
			comp_name = ?,
			_status ='U',
			_user = ?,
			_date = NOW()
			WHERE design_id = ?
			AND event_id = ?
			AND side = ?";

		return $this->db->query($query,array(
			$data['component_id'],
			$data['size'],
			$data['x_axis'],
			$data['y_axis'],
			$data['rotation'],
			$data['z-index'],
			$data['font_type'],
			$data['font_size'],
			$data['val'],
			$data['comp_name'],
			$data['_user'],
			$data['dbid'],
			$data['event_id'],
			$data['side']
		));
	}

	public function deactiveDesign($data)
	{
		$query = "UPDATE card_design SET
			_status = 'D',
			_user = ?,
			_date = NOW()
			WHERE event_id = ?
			AND	design_id = ?";

		return $this->db->query($query,array(
			$data['_user'],
			$data['event_id'],
			$data['dbid']
		));
	}
}
