<?php
require('./excel/vendor/autoload.php');

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('my_model');
 date_default_timezone_set('Asia/Jakarta');
    	$this->load->library('form_validation');
      $this->load->library('pdf_bep');
      $this->load->library('Pdf');
	}

public function index(){
			if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');

            $data = array(
                'title' => 'Home',
                'main' => 'admin/dashboard/dashboard',
                'username' => $session_data['username'],
				        'getgroup' => $this->my_model->editgroup($session_data['username']),

								 );
            $this->load->view('admin/index', $data);

        } else {

            redirect('admin/login', 'refresh');

        }


}


function login(){
		$this->load->view('admin/login');
	}

function logout() {
         $this->session->unset_userdata('logged_in');
         $this->session->sess_destroy();
         redirect(base_url('admin/login'), 'refresh');
     }

function clogin() {
		$this->load->helper('form');
    	$this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');


        if($this->form_validation->run() == FALSE) {
            $this->load->view('admin/login');
            } else {
                redirect(base_url('admin/index'), 'refresh');
            }
     }

function check_database($password){
    $username =$this->input->post('username');
    $result   =$this->my_model->login($username,$password);
    if($result){
      $sess_array=array();
      foreach ($result as $row) {
        $sess_array=array('username'=>$row->username,'password'=>$row->password);

        $this->session->set_userdata('logged_in',$sess_array);
      }
      return TRUE;
    }else{
      $this->form_validation->set_message('check_database','Invalid username or password');
      return FALSE;
    }
  }

    // =============================MEMBER==========================/////

    function profile(){
      if($this->session->userdata('logged_in')){

        $session_data =$this->session->userdata('logged_in');
        $data['username'] =$session_data['username'];
        $data['title']   ='Member';
        $data['main']     ='member/laman_member'; 
        $data['ambilgroup'] = $this->my_model->getgroup($session_data['username']);
        $data['getgroup'] = $this->my_model->getgroup($session_data['username']);
        $this->load->view('admin/index',$data);

      }else{
        redirect('admin/login','refresh');
      }
    }

    //============================HAK AKSES=========================/////

    function hakakses(){
      if($this->session->userdata('logged_in')){

        $session_data =$this->session->userdata('logged_in');
        $data['username'] =$session_data['username'];
        $data['title']   ='Administrator';
        $data['main']     ='admin/hakakses/hakakses';
        $data['ambilgroup']= $this->my_model->gtgroup();
        $data['getgroup'] = $this->my_model->getgroup($session_data['username']);
        $this->load->view('admin/index',$data);

      }else{
        redirect('admin/login','refresh');
      }
    }


    function json_list(){
      $result = $this->db->get('users')->result_array();
      print_r(json_encode($result));
    }
    

    function tambah_group(){
      if($this->session->userdata('logged_in')){
        $session_data     = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $data['title']    = 'Tambah Member';
        $data['main']     = 'admin/hakakses/tambah_group';
        $data['getgroup'] = $this->my_model->editgroup($session_data['username']);
        $this->load->view('admin/index',$data);

      }else{
        redirect('admin/login','refresh');
      }
    }


    function simpangroup(){
      $this->form_validation->set_rules('username','Username','required');
      $this->form_validation->set_rules('password','Password','required');
    
      $username = $this->input->post('username');
      if($this->form_validation->run() == FALSE){
          $this->tambah_group();
      }else{
          $this->my_model->savegroup();
          redirect('admin/hakakses/'.$username,'refresh');
      }
    }

    function hapusgroup(){
      $this->my_model->hapusgroup($this->uri->segment(3,0));
      redirect('admin/hakakses','refresh');
    }

    function editgroup(){
      if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['title'] = 'Edit Group Permission';
            $data['main'] = 'admin/hakakses/form_edit_group';
            $data['ambilgroup'] = $this->my_model->getgroup($this->uri->segment(3,0));
            $data['getgroup'] = $this->my_model->getgroup($session_data['username']);
            $this->load->view('admin/index',$data);
        } else {
            redirect('admin/login', 'refresh');
        }
    }

    function simpanedit(){
      $username = $this->input->post('username');

      $config['upload_path'] = './foto/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //Allowing types
      $config['max_size'] = '2048';
      $config['encrypt_name'] = FALSE;
      $this->load->library('upload',$config);
  
      $this->upload->initialize($config);

      if(!$this->upload->do_upload('gambar')){
        $data =array(
          'nama'=>$this->input->post('nama'),
          'nik'=>$this->input->post('nik'),
          'no_hp'=>$this->input->post('no'),
          'jenis_k'=>$this->input->post('jenis_k'),
          'password'=>$this->input->post('password'),
          'born_date'=>$this->input->post('date'),
          'foto'=>$this->input->post('gambarlama'),
  
        );
  
        $data2=array(
          'updated_at'=> date("Y-m-d H:i:s"),
        );
    }
   else{
      $data =array(
        'nama'=>$this->input->post('nama'),
        'nik'=>$this->input->post('nik'),
        'no_hp'=>$this->input->post('no'),
        'jenis_k'=>$this->input->post('jenis_k'),
        'password'=>$this->input->post('password'),
        'born_date'=>$this->input->post('date'),
        'foto'=>$this->upload->file_name,
      );

      $data2=array(
        'updated_at'=> date("Y-m-d H:i:s"),
      );
    }
      $this->my_model->simpanedit($data, $username);
      $this->my_model->simpaneditps($data2,$username);
      redirect('admin/hakakses','refresh');
  }


  function simpaneditmember(){
    $username = $this->input->post('username');

    $config['upload_path'] = './foto/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //Allowing types
    $config['max_size'] = '2048';
    $config['encrypt_name'] = FALSE;
    $this->load->library('upload',$config);

    $this->upload->initialize($config);

    if(!$this->upload->do_upload('gambar')){
      $data =array(
        'nama'=>$this->input->post('nama'),
        'nik'=>$this->input->post('nik'),
        'no_hp'=>$this->input->post('no'),
        'jenis_k'=>$this->input->post('jenis_k'),
        'password'=>$this->input->post('password'),
        'born_date'=>$this->input->post('date'),
        'foto'=>$this->input->post('gambarlama'),

      );

      $data2=array(
        'updated_at'=> date("Y-m-d H:i:s"),
      );
  }
 else{
    $data =array(
      'nama'=>$this->input->post('nama'),
      'nik'=>$this->input->post('nik'),
      'no_hp'=>$this->input->post('no'),
      'jenis_k'=>$this->input->post('jenis_k'),
      'password'=>$this->input->post('password'),
      'born_date'=>$this->input->post('date'),
      'foto'=>$this->upload->file_name,
    );

    $data2=array(
      'updated_at'=> date("Y-m-d H:i:s"),
    );
  }
    $this->my_model->simpanedit($data, $username);
    $this->my_model->simpaneditps($data2,$username);
    redirect('admin/profile','refresh');
}

}
