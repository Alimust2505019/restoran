<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('login')) {
			redirect('login','refresh');
		}
		$this->load->model('m_penggunaan','penggunaan');		
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('user_id_pelanggan')) {
			$data['bulan'] = array(
				1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
				7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember',
			);
			$data['data_tagihan'] = $this->penggunaan->getTagihanByIdPelanggan($this->session->userdata('user_id_pelanggan'));
			$data['view'] = 'page/home/index';
			$data['validation'] = 'validation';
			$this->load->view('layout/index',$data);	
		}else{
			$data['view'] = 'page/home/admin';
			$this->load->view('layout/index',$data);
		}
	}

	public function add()
	{		
		if(isset($_POST) && count($_POST) > 0){
			$this->form_validation->set_rules('file','File','trim|xss_clean');		
			$this->form_validation->set_rules('tanggal_bayar','Tanggal Bayar','required');
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = array(
					'file' => form_error('file'),
					'tanggal_bayar' => form_error('tanggal_bayar'),
				);
			}else{
				$id_tagihan = $this->input->post('id_tagihan',true);
				$tagihan = $this->penggunaan->getTagihanById($id_tagihan);				
				$this->load->helper('file');
				$new_name = time()."-".$tagihan->id_pelanggan."-".$id_tagihan;				
				$config['file_name'] = $new_name;
				$config['upload_path'] = './assets/bukti_pembayaran/';
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size']  = '2048';				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('file')){
					$data['error'] = true;
					$data['error_msg'] = array('file' => $this->upload->display_errors());
				}
				else{
					if ($this->db->where('id_tagihan',$id_tagihan)->get('pembayaran')->num_rows() > 0) {
						$objectTagihan = array(
							'status' => 'Pending', 
						);
						$objectPembayaran = array(							
							'tanggal_bayar' => $this->input->post('tanggal_bayar'),
							'bukti_pembayaran' => $this->upload->data('file_name')
						);
						$this->db->where('id_tagihan',$id_tagihan)->update('tagihan', $objectTagihan);
						$this->db->where('id_tagihan',$id_tagihan)->update('pembayaran', $objectPembayaran);
					}else{
						$objectTagihan = array(
						'status' => 'Pending', 
						);
						$objectPembayaran = array(
							'id_tagihan' => $id_tagihan, 
							'tanggal_bayar' => $this->input->post('tanggal_bayar'),
							'biaya_admin' => 1500,
							'total_bayar' => $tagihan->jumlah_tagihan + 1500,
							'bukti_pembayaran' => $this->upload->data('file_name')
						);
						$this->db->where('id_tagihan',$id_tagihan)->update('tagihan', $objectTagihan);
						$this->db->insert('pembayaran', $objectPembayaran);
					}
					$data['success'] = true;
					$data['redirect'] = 'pelanggan';
				}
			}
			echo json_encode($data);
		}else{
			redirect('pelanggan','refresh');
		}
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */