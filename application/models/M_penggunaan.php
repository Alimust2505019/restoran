<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penggunaan extends CI_Model {

	public function rules()
	{
		return [
			[
				'field' => 'nama',
				'label' => 'Nama',
				'rules' => 'required'
			],
			[
				'field' => 'bulan',
				'label' => 'Bulan',
				'rules' => 'required'
			],
			[
				'field' => 'tahun',
				'label' => 'Tahun',
				'rules' => 'required'
			],
			[
				'field' => 'meteran_awal',
				'label' => 'Meteran Awal',
				'rules' => 'required'
			],
			[
				'field' => 'meteran_akhir',
				'label' => 'Meteran Akhir',
				'rules' => 'required'
			],
		];
	}

	public function error_msg()
	{
		return array(
			'nama' => form_error('nama'),
			'bulan' => form_error('bulan'),
			'tahun' => form_error('tahun'),
			'meteran_awal' => form_error('meteran_awal'),
			'meteran_akhir' => form_error('meteran_akhir')
		);
	}

	public function getPelanggan()
	{
		return $this->db->join('tarif','tarif.id_tarif=pelanggan.id_tarif')->get('pelanggan')->result();
	}

	public function getTagihanById($id_tagihan)
	{
		return $this->db->select('pelanggan.id_pelanggan, pelanggan.nama, jumlah_tagihan')
						->where('tagihan.id_tagihan',$id_tagihan)
						->join('penggunaan','penggunaan.id_penggunaan=tagihan.id_penggunaan')
						->join('pelanggan','pelanggan.id_pelanggan=penggunaan.id_pelanggan')
						->get('tagihan')->row();
	}

	public function getTagihanByIdPelanggan($id_pelanggan)
	{
		return $this->db->select('penggunaan.id_pelanggan,id_tagihan,tagihan.id_penggunaan, bulan,tahun,meteran_awal,meteran_akhir,jumlah_tagihan,status')
						->where('penggunaan.id_pelanggan',$id_pelanggan)
						->join('penggunaan','penggunaan.id_penggunaan=tagihan.id_penggunaan')
						->join('pelanggan','pelanggan.id_pelanggan=penggunaan.id_pelanggan')
						->get('tagihan')->result();
	}


	public function checkPengunaan($bulan,$tahun,$id_pelanggan)
	{
		return $this->db->where('bulan',$bulan)->where('tahun',$tahun)->where('id_pelanggan',$id_pelanggan)->get('penggunaan')->num_rows();
	}

	public function add($object)
	{
		$this->db->insert('penggunaan', $object);
		$id_pesanan = $this->db
			->where('id_pesanan',$object['id_pesanan'])
			->order_by('id_pesanan','desc')
			->limit(1)
			->get('pesanan')
			->row()
			->id_pesanan;
		$menu = $this->db->select('harga')				
				->join('menu','menu.id_menu=pesanan.id_menu')
				->where('id_pesanan',$object['id_pesanan'])
				->get('pesanan')
				->row()
				->harga;	
		$object2 = array(
			'id_pesanan' => $id_penggunaan, 
			
			'jumlah_bayar' => $menu * ($object['jumlah'] )
		);

		return $this->db->insert('jumlah_bayar', $object2);
	}

	public function checkPelanggan($id_pelanggan)
	{
		return $this->db->where('id_pelanggan',$id_pelanggan)->get('pelanggan')->num_rows();
	}

	public function deletePenggunaanTagihan($id_tagihan,$id_penggunaan)
	{
		$this->db->where('id_tagihan',$id_tagihan)->delete('tagihan');
		return  $this->db->where('id_penggunaan',$id_penggunaan)->delete('penggunaan');
	}

	public function getByIdTagihan($id_tagihan)
	{
		$this->db->select('tanggal_bayar')->where('id_tagihan',$id_tagihan)->get('pembayaran')->row();
	}
}

/* End of file M_penggunaan.php */
/* Location: ./application/models/M_penggunaan.php */