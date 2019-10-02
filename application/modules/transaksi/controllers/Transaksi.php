<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect('error/error_401','refresh');
		}if (!$this->session->userdata('user_id_admin')) {
			redirect('home','refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('m_pesanan','pesanan');
		//$data['id_admin'] = $this->session->userdata("id");
	}

	public function index()
	{
	

		$data['view'] = 'pesanan';	
		$data['dataAll'] = $this->pesanan->getAll();
		
		$data['judul'] = "<h2>Pesanan Makan</h2>";
		$data['validation'] = 'validation';
		$data['kode_pesanan']= $this->pesanan->kodepesanan();
		$date = date("Y-m-d");
		$data['data_menu'] = $this->pesanan->getMenu();
		$this->load->view('layout/index', $data);
		
	}

	public function add()
	{		
		if(isset($_POST) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->pesanan->rules());
			if (!$this->form_validation->run()) {
		      $data['error'] = true;
		      $data['error_msg'] = $this->pesanan->error_msg();
		    }else{
		      $object = array(
					'kode_pesanan' => $this->input->post('kode_pesanan',true), 
					'nama' => $this->input->post('nama',true),
					'meja' => $this->input->post('meja',true),
					'jumlah' => $this->input->post('jumlah',true),
					'id_menu' => $this->input->post('id_menu',true),
					'jumlah_bayar' => $this->input->post('jumlash_bayar',true),
					'date' => $this->input->post('date',true),
					
			  );
			  $this->pesanan->add($object);
			  

			 
			  //$this->pesanan->kodetampil;
		      $data['success'] = true;
		      $data['redirect'] = 'pesanan';
		    }
		    echo json_encode($data);
		}else{
			redirect('pesanan','refresh');
		}
	}

	public function edit_data($id)
	{
		$data = $this->pesanan->getById($id);
		echo json_encode($data);
	}

	public function ubah()
	{		
		if(isset($_POST['id_pesanan']) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->pesanan->rulesEdit());
			if (!$this->form_validation->run()) {
		      $data['error'] = true;
		      $data['error_msg'] = $this->pesanan->error_msg();
		    }else{
		      $object = array(
				
				'nama' => $this->input->post('nama'),
				'meja' => $this->input->post('meja'),
				'jumlah' => $this->input->post('jumlah'),
				'id_menu' => $this->input->post('id_menu'),
				
				'date' => $this->input->post('date'), 
					
			  );
		      $this->pesanan->update($object,$this->input->post('id_pesanan'));
		      $data['success'] = true;
		      $data['redirect'] = 'pesanan';
		    }
		    echo json_encode($data);
		}else{
			redirect('pesanan','refresh');
		}
	}

	public function delete($id)
	{		
		if ($this->pesanan->delete($id)) {			
			$this->session->set_flashdata('cek', 'value');
			redirect('pesanan','refresh');
		}else{
			echo '<script>alert("Data tidak dapat dihapus");</script>';
			redirect('pesanan','refresh');
		}
	}

}