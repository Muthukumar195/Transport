<?php
Class Container_model extends CI_Model
{
	/**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
	

	//fill your state dropdown depending on the selected coutry
    public function getcontainerno($id_container=string)
    {
        $this->db->select('Iso_mvnt_id,Iso_mvnt_container_no');
        $this->db->from('iso_movement_details');
        $this->db->where('Iso_mvnt_container_no',$id_container); 
        $query = $this->db->get();
         
        return $query;
    }
	
	//fill your cities dropdown depending on the selected city
     public function getcontainernum($id_container_num=string)
    {
        $this->db->select('Container_dtl_id,	Container_dtl_container_no,Container_dtl_size');
        $this->db->from('container_details');
        $this->db->where('Container_dtl_size',"T",$id_container_num); 
        $query = $this->db->get();
         
        return $query;
    }
	
}
?>