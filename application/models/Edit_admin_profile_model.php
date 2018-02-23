<?php
Class Edit_admin_profile_model extends CI_Model
{
	
 	function get_admin_profile()
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('Admin_username',$this->session->userdata('username'));
		$query = $this->db->get();
		$this->db->last_query(); 	
		return $query;
	} 
	
	function edit_adminer_profile($id)
	{
		$data=array('Admin_fullname'=>$this->input->post('full_name'), 'Admin_email'=>$this->input->post('email'), 'Admin_phone'=>$this->input->post('phone_no'), 'Admin_username'=>$this->input->post('username'), 'Admin_password'=>$this->input->post('password'));
		$this->db->set('Admin_created_dt_tme', 'NOW()', FALSE);	
		$this->db->where('Admin_id',$id);
		$this->db->update('admin',$data);
		
		return true;
		
	}
	function edit_upload_file($file_extension)
	{
		$this->db->select_max('Admin_id', 'max_id');
		$query = $this->db->get('admin'); 
		$res2 = $query->result_array();
        $max_id = $this->input->post('id');		
		
		$file_name='profile_pic'.$max_id.$file_extension;	

		$data=array('Admin_profile'=>$file_name);
		$this->db->where('Admin_id',$max_id);
		$this->db->update('admin',$data);
		//echo $this->db->last_query(); exit();
		return $file_name;
	}
	function ajax_check_password($password)
	{
		$this->db->select('Admin_password');
        $this->db->from('admin'); 		
		$this->db->where('Admin_password',$password); 
        $query = $this->db->get(); 

        if ($query->num_rows() > 0) //if message exists
	   {
	   	return 1;
	   }
	   else
	   {
	   	 return 0;
	   }       	 
	}
	
}