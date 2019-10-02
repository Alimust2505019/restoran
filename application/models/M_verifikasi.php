<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_verifikasi extends CI_Model {

	
	public function getAll()
	{
		return $this->db->join('tagihan','tagihan.id_tagihan=pembayaran.id_tagihan')
						->join('penggunaan','tagihan.id_penggunaan=penggunaan.id_penggunaan')
						->join('pelanggan','penggunaan.id_pelanggan=pelanggan.id_pelanggan')
						->where('tagihan.status !=','Lunas')
						->get('pembayaran')
						->result();
	}

	public function update($object,$id_tagihan)
	{
		return $this->db->where('id_tagihan',$id_tagihan)->update('tagihan', $object);
	}

}

/* End of file M_verifikasi.php */
/* Location: ./application/models/M_verifikasi.php */