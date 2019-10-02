<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function rules()
	{
		return [      
	    ['field' => 'nama_admin',
	      'label' => 'Nama Admin',
	      'rules' => 'required'],
		['field' => 'username',
	      'label' => 'Username',
	      'rules' => 'required|callback_checkUsername'],
	    ['field' => 'password',
	      'label' => 'Password',
	      'rules' => 'required'],	      	 
	    ['field' => 'id_level',
	      'label' => 'Tarif',
	      'rules' => 'required']
	  ];
	}

	public function rulesEdit()
	{
		return [      
	    ['field' => 'nama_admin',
	      'label' => 'Nama Admin',
	      'rules' => 'required'],
		['field' => 'username',
	      'label' => 'Username',
	      'rules' => 'required|callback_checkUsername'],
	    ['field' => 'password',
	      'label' => 'Password',
	      'rules' => ''],
	    ['field' => 'id_level',
	      'label' => 'Tarif',
	      'rules' => 'required']
	  ];
	}

	public function error_msg()
	{
		return array(               
	      'no_meter' => form_error('no_meter'),
	      'nama_admin' => form_error('nama_admin'),
	      'username' => form_error('username'),
	      'password' => form_error('password'),	      
	      'id_level' => form_error('id_level'),
	    );
	}

	public function getAll()
	{
		return $this->db->join('level','level.id_level=admin.id_level')->get("admin")->result();
	}

	public function getById($id)
	{
		return $this->db->where('id_admin',$id)->get('admin')->row();
	}

	public function add($object)
	{
		$this->db->insert('admin', $object);
	}

	public function update($object,$id_admin)
	{
		$this->db->where('id_admin',$id_admin)->update('admin', $object);		
	}

	public function delete($id)
	{
		return $this->db->where('id_admin', $id)->delete('admin');
	}

	public function getLevel()
	{
		return $this->db->get('level')->result();
	}

}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */