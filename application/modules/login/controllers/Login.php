<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');		
		$this->load->model('m_user','user');
	}

	public function index()
	{
		if (!$this->session->userdata('login')) {		
			$data['validation'] = 'validation';
			$data['action'] = base_url()."login/validate_admin";
			$this->load->view('login',$data);	
		}else{
			redirect('home','refresh');
		}
	}

	public function admin()
	{
		if (!$this->session->userdata('login')) {		
			$data['validation'] = 'validation';
			$data['action'] = base_url()."login/validate_admin";
			$this->load->view('login',$data);	
		}else{
			redirect('home','refresh');
		}
	}

	public function validate()
	{
		if(isset($_POST) && count($_POST) > 0){	
			$this->form_validation->set_rules($this->user->rules());		
			if (!$this->form_validation->run()) {
				$data['error']=true;
				$data['error_msg']=$this->user->error_msg();
			} else {
				if ($this->user->get_login()->num_rows()) {
					$data_pelanggan = $this->user->get_login()->row();
					$array = array(
						'login' => TRUE,
						'user_id_pelanggan' => $data_pelanggan->id_pelanggan,
						'user_no_meter' => $data_pelanggan->no_meter,
						'user_nama' => $data_pelanggan->nama,
						'user_username' => $data_pelanggan->username,
						'user_password' => $data_pelanggan->password,
						'user_alamat' => $data_pelanggan->alamat,
						'user_id_tarif' => $data_pelanggan->id_tarif,
					);			
					$this->session->set_userdata( $array );
					$data['redirect'] = 'home';
					$data['success'] = true;
				}else{
					$data['false']=true;
					$data['false_msg']='Email/Password Salah';
				}
			}
			echo json_encode($data);
		}
	}

	public function validate_admin()
	{
		if(isset($_POST) && count($_POST) > 0){	
			$this->form_validation->set_rules($this->user->rules());		
			if (!$this->form_validation->run()) {
				$data['error']=true;
				$data['error_msg']=$this->user->error_msg();
			} else {
				if ($this->user->get_loginAdmin()->num_rows()) {
					$data_pelanggan = $this->user->get_loginAdmin()->row();
					$array = array(
						'login' => TRUE,
						'user_id_admin' => $data_pelanggan->id_admin,						
						'user_nama_admin' => $data_pelanggan->nama_admin,
						'user_level' => $data_pelanggan->id_level,
						'user_username' => $data_pelanggan->username,
						'user_password' => $data_pelanggan->password,						
					);			
					$this->session->set_userdata( $array );
					$data['redirect'] = 'home';
					$data['success'] = true;
				}else{
					$data['false']=true;
					$data['false_msg']='Email/Password Salah';
				}
			}
			echo json_encode($data);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */