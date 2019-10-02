<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {

	public function rules()
	{
		return [      
	    ['field' => 'no_meter',
	      'label' => 'No Meter',
	      'rules' => 'required|callback_checkNoMeter'],
	    ['field' => 'nama',
	      'label' => 'Nama',
	      'rules' => 'required'],
		['field' => 'username',
	      'label' => 'Username',
	      'rules' => 'required|callback_checkUsername'],
	    ['field' => 'password',
	      'label' => 'Password',
	      'rules' => 'required'],	      
	    ['field' => 'alamat',
	      'label' => 'Alamat',
	      'rules' => 'required'],
	    ['field' => 'id_tarif',
	      'label' => 'Tarif',
	      'rules' => 'required']
	  ];
	}

	public function rulesEdit()
	{
		return [      
	    ['field' => 'no_meter',
	      'label' => 'No Meter',
	      'rules' => 'required|callback_checkNoMeter'],
	    ['field' => 'nama',
	      'label' => 'Nama',
	      'rules' => 'required'],
		['field' => 'username',
	      'label' => 'Username',
	      'rules' => 'required|callback_checkUsername'],
	    ['field' => 'password',
	      'label' => 'Password',
	      'rules' => ''],	      
	    ['field' => 'alamat',
	      'label' => 'Alamat',
	      'rules' => 'required'],
	    ['field' => 'id_tarif',
	      'label' => 'Tarif',
	      'rules' => 'required']
	  ];
	}

	public function error_msg()
	{
		return array(               
	      'no_meter' => form_error('no_meter'),
	      'nama' => form_error('nama'),
	      'username' => form_error('username'),
	      'password' => form_error('password'),
	      'alamat' => form_error('alamat'),
	      'id_tarif' => form_error('id_tarif'),
	    );
	}

	public function getAll()
	{
		return $this->db->join('tarif','tarif.id_tarif=pelanggan.id_tarif')->get("pelanggan")->result();
	}

	public function getById($id)
	{
		return $this->db->where('id_pelanggan',$id)->get('pelanggan')->row();
	}

	
	public function add($object)
	{
		$this->db->insert('pelanggan', $object);
	}

	public function add($object)
	{
		$this->db->insert('transaksi', $object);
	}


	public function update($object,$id_pelanggan)
	{
		$this->db->where('id_pelanggan',$id_pelanggan)->update('pelanggan', $object);		
	}

	public function delete($id)
	{
		return $this->db->where('id_pelanggan', $id)->delete('pelanggan');
	}

	public function getTarif()
	{
		return $this->db->get('tarif')->result();
	}

}

/* End of file M_pelanggan.php */
/* Location: ./application/models/M_pelanggan.php */