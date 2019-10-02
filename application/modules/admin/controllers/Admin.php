<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect('error/error_401','refresh');
		}if (!$this->session->userdata('user_id_admin')) {
			redirect('home','refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('m_admin','admin');
	}

	public function index()
	{
		$data['view'] = 'admin';	
		$data['dataAll'] = $this->admin->getAll();
		$data['judul'] = "<h2>Admin</h2>";
		$data['data_level'] = $this->admin->getLevel();
		$data['validation'] = 'validation';
		$this->load->view('layout/index', $data);
		
	}

	public function add()
	{		
		if(isset($_POST) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->admin->rules());			
			$this->form_validation->set_message('checkUsername','Username Sudah Dipakai');
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->admin->error_msg();
			}else{
				$object = array(					
					'nama_admin' => $this->input->post('nama_admin',true),
					'username' => $this->input->post('username',true),
					'password' => md5($this->input->post('password',true)),					
					'id_level' => $this->input->post('id_level',true), 
				);
				$this->admin->add($object);
				$data['success'] = true;
				$data['redirect'] = 'admin';
			}
			echo json_encode($data);
		}else{
			redirect('admin','refresh');
		}
	}

	public function edit_data($id)
	{
		$data = $this->admin->getById($id);
		echo json_encode($data);
	}

	public function ubah()
	{		
		if(isset($_POST['id_admin']) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->admin->rulesEdit());
			$this->form_validation->set_message('checkUsername','Username Sudah Dipakai');
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->admin->error_msg();
			}else{
				$object = array(					
					'nama_admin' => $this->input->post('nama_admin',true),
					'username' => $this->input->post('username',true),					
					'id_level' => $this->input->post('id_level',true), 
				);
				$this->admin->update($object,$this->input->post('id_admin'));
				$data['success'] = true;
				$data['redirect'] = 'admin';
			}
			echo json_encode($data);
		}else{
			redirect('admin','refresh');
		}
	}

	public function delete($id)
	{		
		if ($this->admin->delete($id)) {						
			redirect('admin','refresh');
		}else{
			echo '<script>alert("Data tidak dapat dihapus");</script>';
			redirect('admin','refresh');
		}
	}	

	public function checkUsername($str)
	{
		$id =  $this->input->post('id_admin');
		if ($id) {
			$data_no_meter=$this->db->select('username')->where('id_admin',$id)->get('admin')->row();
			if ($str == $data_no_meter->username) {
				return true;
			}else{
				$data = $this->db->get_where('admin',array('username'=>$str))->num_rows();
				if ($data>0) {
					return false;
				}else{
					return true;
				}
			}
		}else{
			$data = $this->db->get_where('admin',array('username'=>$str))->num_rows();
			if ($data>0) {
				return false;
			}else{
				return true;
			}
		}
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */