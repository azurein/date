<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartu_acara extends Main_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('acara/Kartu_acara_model','kartu');
	}

    public function index()
    {
        $user_array = array(
            'event_id' => '1',
            'user_id' => '2'
        );
        $this->session->set_userdata('userdata', $user_array);

        $this->view('admin/acara/kartu_acara');
    }

    protected function getSession($key=null)
    {
        $user_data = $this->session->userdata('userdata');

        if(isset($key))
        {
            $user_data = $user_data[$key];
        }
        return $user_data;
    }

    public function getDesign()
    {
        $data = $this->kartu->getDesignByEvent($this->getSession('event_id'));
        echo json_encode($data);
    }

    private function getParticipantDetailByID($id){
        return $this->kartu->getParticipantByID($id);
    }

    public function getComponents()
    {
        $comp = $this->kartu->getComponent();
        echo json_encode($comp);
    }

    public function getForm ()
    {
        $this->load->helper('form');
        echo form_open_multipart('Kelola_peserta/uploadImg',array('id'=>'addCompFile'));
    }

    public function uploadImg($name)
    {
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $name;
        $this->load->library('upload', $config);

        $_FILES['upload'] = $this->input->post_get('data');

        if ( ! $this->upload->do_upload('newImg'))
        {
            $error = array(
                    'status' => 0,
                    'error' => $this->upload->display_errors()
                );
            echo json_encode($error);
        }
        else
        {
            echo json_encode(array(
                'status' => 1 ,
                'val' =>  'img/'.$this->upload->data()['file_name']
            ));
        }

    }

    public function saveObj()
    {
        $default = $this->kartu->getComponentDefaultByID($this->input->post_get('compID'))[0]->default_img;
        $data = array(
            'event_id' => $this->getSession('event_id'),
            'component_id' => $this->input->post_get('compID'),
            'size' => $this->input->post_get('scale'),
            'x_axis' => $this->input->post_get('x'),
            'y_axis' => $this->input->post_get('y'),
            'rotation' => $this->input->post_get('rotation'),
            'z-index' => $this->input->post_get('idx'),
            'font_type' => $this->input->post_get('fontType') == '' ? NULL : $this->input->post_get('fontType'),
            'font_size' => $this->input->post_get('fontSize') == '' ? NULL : $this->input->post_get('fontSize'),
            '_user' => $this->getSession('user_id'),
            'val' => $default == NULL ? $this->input->post_get('val') : NULL,
            'side' => $this->input->post_get('side'),
            'comp_name' => $this->input->post_get('name'),
            'color' => $this->input->post_get('color') == '' ? NULL : $this->input->post_get('color'),
            'opacity' => $this->input->post_get('opacity') == '' ? NULL : $this->input->post_get('opacity')
        );
        $return = $this->kartu->insertDesign($data);
        echo json_encode($return);
    }

    public function updateObjState()
    {
        $data = array(
            'component_id' => $this->input->post_get('compID'),
            'size' => $this->input->post_get('scale'),
            'x_axis' => $this->input->post_get('x'),
            'y_axis' => $this->input->post_get('y'),
            'rotation' => $this->input->post_get('rotation'),
            'z-index' => $this->input->post_get('idx'),
            'font_type' => $this->input->post_get('fontType') == '' ? NULL : $this->input->post_get('fontType'),
            'font_size' => $this->input->post_get('fontSize') == '' ? NULL :$this->input->post_get('fontSize'),
            '_user' => $this->getSession('user_id'),
            'val' => $this->input->post_get('val') == '' ? NULL : $this->input->post_get('val'),
            'comp_name' => $this->input->post_get('name'),
            'dbid' => $this->input->post_get('dbid'),
            'event_id' => $this->getSession('event_id'),
            'side' => $this->input->post_get('side'),
            'color' => $this->input->post_get('color') == '' ? NULL : $this->input->post_get('color'),
            'opacity' => $this->input->post_get('opacity') == '' ? NULL : $this->input->post_get('opacity')
        );
        $data = $this->kartu->updateDesign($data);
        echo json_encode($data);
    }

    public function deactiveObjState()
    {
        $data = array(
            '_user' => $this->getSession('user_id'),
            'event_id' => $this->getSession('event_id'),
            'dbid' => $this->input->post_get('dbid'),
        );
        $result = $this->kartu->deactiveDesign($data);
        echo json_encode($result);
    }
}
