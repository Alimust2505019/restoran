<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model {
	
	public function rules()
	{
		return [      
	    ['field' => 'nama_menu',
	      'label' => 'Nama_Menu',
	      'rules' => 'required'],
	    ['field' => 'harga',
	      'label' => 'harga',
		  'rules' => 'required'],
		['field' => 'status',
	      'label' => 'status',
	      'rules' => 'required'],
	    ];
	}

	public function error_msg()
	{
		return array(               
	      'nama_menu' => form_error('nama_menu'),
		  'harga' => form_error('harga'),
		  'status' => form_error('status')
	    );
	}

	public function getAll()
	{
		return $this->db->get("menu")->result();
	}

	public function getById($id)
	{
		return $this->db->where('id_menu',$id)->get('menu')->row();
	}

	public function add($object)
	{
		$this->db->insert('menu', $object);
	}

	public function update($object,$id_menu)
	{
		
		$this->db->where('id_menu',$id_menu)->update('menu', $object);		
	}

	public function delete($id)
	{
		return $this->db->where('id_menu', $id)->delete('menu');
	}
}

