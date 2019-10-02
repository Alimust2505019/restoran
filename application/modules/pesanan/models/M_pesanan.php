<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesanan extends CI_Model {
	
	public function rules()
	{
		return [      
	    ['field' => 'kode_pesanan',
	      'label' => 'Kode_pesanan',
		  'rules' => 'required'],

		['field' => 'nama',
	      'label' => 'Nama',
		  'rules' => 'required'], 

		['field' => 'meja',
	      'label' => 'Meja',
		  'rules' => 'required'],

		['field' => 'jumlah',
	      'label' => 'Jumlah',
		  'rules' => 'required'], 

		['field' => 'id_menu',
	      'label' => 'Id_menu',
		  'rules' => 'required'],


		['field' => 'date',
	      'label' => 'Date',
		  'rules' => 'required']
		];
		
	}

	public function rulesEdit()
	{
		return [      
			
  
		  ['field' => 'nama',
			'label' => 'Nama',
			'rules' => 'required'], 
			
			['field' => 'jumlah',
			  'label' => 'Jumlah',
			  'rules' => 'required'], 

		  ['field' => 'meja',
			'label' => 'Meja',
			'rules' => 'required'],
  
  
		  ['field' => 'id_menu',
			'label' => 'Id_menu',
			'rules' => 'required'],
		
			['field' => 'jumlah_bayar',
			'label' => 'jumlah_bayar',
			'rules' => 'required'],
  
  
		  ['field' => 'date',
			'label' => 'Date',
			'rules' => 'required']
		  ];
	}

	public function error_msg()
	{
		return array(               
		  'kode_pesanan' => form_error('kode_pesanan'),
		  'nama' => form_error('nama'),
		  'meja' => form_error('meja'),
		  'jumlah' => form_error('jumlah'),
		  'id_menu' => form_error('id_menu'),
		  
		  'date' => form_error('date'),

		  
	    );
	}

	public function getAll()
	{
		//return $this->db->join('menu','menu.id_menu=pesanan.id_menu')->get("pesanan")->result();
		
		return $this->db->join('menu','menu.id_menu=pesanan.id_menu')->get("pesanan")->result();
	}

	public function getMenu()
	{
		return $this->db->where('status = 1')->get("menu")->result();
	}


	public function getadmin()
	{
		return $this->db->get("admin")->result();
	}

	

	public function getById($id)
	{
		return $this->db->where('id_pesanan',$id)->get('pesanan')->row();
	}

	


	public function add($object)
	{
		$this->db->insert('pesanan', $object);
	
	}
	

	public function update($object,$id_pesanan)
	{
		
		$this->db->where('id_pesanan',$id_pesanan)->update('pesanan', $object);		
	}

	public function delete($id)
	{
		return $this->db->where('id_pesanan', $id)->delete('pesanan');
	}

	public function kodepesanan(){
		$this->db->select('RIGHT(pesanan.kode_pesanan,2)as kode_pesanan', FALSE);
		$this->db->order_by('kode_pesanan','DESC');
		$this->db->limit(1);
		$query=$this->db->get('pesanan');

		if($query->num_rows() <> 0){

			$data=$query->row();
			$kode = intval($data->kode_pesanan)+1;
		}else{
			$kode =1;
		}

		$tanggal=date('dmY');
		$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
		$kodetampil = "ERP".$tanggal."-".$batas;
		return $kodetampil;

		
	}

	public function total(){

		$this->db->select('RIGHT(pesanan.jumlah,2)as jumlah', FALSE);
		$query=$this->db->get('pesanan');

		$this->db->select('RIGHT(menu.harga,2)as harga', FALSE);
		$query=$this->db->get('menu');

		$jumlah_bayar = $jumlah * $harga;
		return $total_bayar;
		

	}

	public function jumlahbayar(){
		$jumlah_bayar = $jumlah * $harga;
		
		return $jumlah_bayar;
	}

	

	
}

