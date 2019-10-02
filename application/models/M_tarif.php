<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tarif extends CI_Model {
	
	public function rules()
	{
		return [      
	    ['field' => 'daya',
	      'label' => 'Daya',
	      'rules' => 'required'],
	    ['field' => 'perkwh',
	      'label' => 'Per/KWH',
	      'rules' => 'required|numeric']
	    ];
	}

	public function error_msg()
	{
		return array(               
	      'daya' => form_error('daya'),
	      'perkwh' => form_error('perkwh')
	    );
	}

	public function getAll()
	{
		return $this->db->get("tarif")->result();
	}

	public function getById($id)
	{
		return $this->db->where('id_tarif',$id)->get('tarif')->row();
	}

	public function add($object)
	{
		$this->db->insert('tarif', $object);
	}

	public function update($object,$id_tarif)
	{
		
		$this->db->where('id_tarif',$id_tarif)->update('tarif', $object);		
	}

	public function delete($id)
	{
		return $this->db->where('id_tarif', $id)->delete('tarif');
	}
}

/* End of file M_tarif.php */
/* Location: ./application/models/M_tarif.php */