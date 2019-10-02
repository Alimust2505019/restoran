<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect('error/error_401','refresh');
		}if (!$this->session->userdata('user_id_admin')) {
			redirect('home','refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('m_menu','menu');
	}

	public function index()
	{
		$data['view'] = 'menu';	
		$data['dataAll'] = $this->menu->getAll();
		$data['judul'] = "<h2>Menu Makanan</h2>";
		$data['validation'] = 'validation';
		$this->load->view('layout/index', $data);
		
	}

	public function add()
	{		
		if(isset($_POST) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->menu->rules());
			if (!$this->form_validation->run()) {
		      $data['error'] = true;
		      $data['error_msg'] = $this->menu->error_msg();
		    }else{
		      $object = array(
					'nama_menu' => $this->input->post('nama_menu'), 
					'harga' => $this->input->post('harga'), 
					'status' => $this->input->post('status'),
			  );
		      $this->menu->add($object);
		      $data['success'] = true;
		      $data['redirect'] = 'menu';
		    }
		    echo json_encode($data);
		}else{
			redirect('menu','refresh');
		}
	}

	public function edit_data($id)
	{
		$data = $this->menu->getById($id);
		echo json_encode($data);
	}

	public function ubah()
	{		
		if(isset($_POST['id_menu']) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->menu->rules());
			if (!$this->form_validation->run()) {
		      $data['error'] = true;
		      $data['error_msg'] = $this->menu->error_msg();
		    }else{
		      $object = array(
					'nama_menu' => $this->input->post('nama_menu', true), 
					'harga' => $this->input->post('harga', true), 
					'status' => $this->input->post('status', true), 
			  );
		      $this->menu->update($object,$this->input->post('id_menu'));
		      $data['success'] = true;
		      $data['redirect'] = 'menu';
		    }
		    echo json_encode($data);
		}else{
			redirect('menu','refresh');
		}
	}

	public function delete($id)
	{		
		if ($this->menu->delete($id)) {			
			$this->session->set_flashdata('cek', 'value');
			redirect('menu','refresh');
		}else{
			echo '<script>alert("Data tidak dapat dihapus");</script>';
			redirect('menu','refresh');
		}
	}

}