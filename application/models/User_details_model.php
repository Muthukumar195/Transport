<?php
Class User_details_model extends CI_Model
{
 	function user_details_list()
	{
		$this->db->select('*');
        $this->db->from('admin');
		$this->db->join('admin_user_rights_details','admin_user_rights_details.User_rights_id = admin.Admin_user_rights','left');	
		$this->db->where('Admin_username!="admin"');
		$this->db->order_by("Admin_id", "DESC");	 
		//$this->db->limit(8);
        $query = $this->db->get();               
        return $query;		
	}  
	
	function add_user_details()
	{
		$user_data = array(
			'Admin_fullname' => $this->input->post('full_name'),
			'Admin_email' => $this->input->post('email'),
			'Admin_phone' => $this->input->post('phone_no'),
			'Admin_username' => $this->input->post('user_name'),
			'Admin_password' => $this->input->post('password'),
			'Admin_user_rights' => $this->input->post('user_rights')
		);	
		$this->db->set('Admin_created_dt_tme', 'NOW()', FALSE);	
		$insert=$this->db->insert('admin', $user_data);			
		return true;		
	}  
	function get_user_details($id)
	{		
		$this->db->select('*');
        $this->db->from('admin');
		$this->db->join('admin_user_rights_details','admin_user_rights_details.User_rights_id = admin.Admin_user_rights','left'); 		
		$this->db->where('Admin_id',$id); 
		$this->db->where('Admin_username!="admin"');
        $query = $this->db->get(); 
        $this->db->last_query(); 
        return $query;		 
	}
	
	function upload_file($file_extension)
	{		
		$this->db->select_max('Admin_id', 'max_id');
		$query = $this->db->get('admin'); 
		$res2 = $query->result_array();
        $max_id = $res2[0]['max_id'];		
		
		$file_name='profile_pic'.$max_id.$file_extension;	

		$data=array('Admin_profile'=>$file_name);
		$this->db->where('Admin_id',$max_id);
		$this->db->update('admin',$data);
		//echo $this->db->last_query(); exit();
		return $file_name;
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
	function edit_user_details($id)
	{
		$data=array('Admin_fullname'=>$this->input->post('full_name'), 'Admin_email'=>$this->input->post('email'), 'Admin_phone'=>$this->input->post('phone_no'), 'Admin_username'=>$this->input->post('user_name'), 'Admin_password'=>$this->input->post('password'), 'Admin_user_rights'=>$this->input->post('user_rights'));
		$this->db->set('Admin_created_dt_tme', 'NOW()', FALSE);	
		$this->db->where('Admin_id',$id);
		$this->db->update('admin',$data);
		return true;
	}
	function approve_user()
	{
		$data=array('Admin_status'=>'A');
		$this->db->where('Admin_id',$this->input->get('id'));
		$this->db->update('admin',$data);
		return true;	 
	} 
	function deny_user()
	{
		$data=array('Admin_status'=>'D');
		$this->db->where('Admin_id',$this->input->get('id'));
		$this->db->update('admin',$data);
		return true;	 
	}
	function delete_user($id)
	{
		
		  $this->db->where('Admin_id',$id);  
	      $this->db->delete('admin'); 
	      return true;
	}
	function ajax_check_username($user_name)
	{
		$this->db->select('Admin_username');
        $this->db->from('admin'); 		
		$this->db->where('Admin_username',$user_name); 
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
	function ajax_check_password($pass)
	{
		$this->db->select('Admin_password');
        $this->db->from('admin'); 		
		$this->db->where('Admin_password',$pass); 
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
?>