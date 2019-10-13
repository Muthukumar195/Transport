<?php
Class User_login extends CI_Model
{
 	function validate()
	{	
		if($this->input->post('username')!='admin')
		{
			$this->db->select("admin.*, admin_user_rights_details.User_rights_type_value");
			$this->db->from('admin');
			$this->db->join('admin_user_rights_details', 'admin_user_rights_details.User_rights_id=admin.Admin_user_rights', 'left');
			$where = '(admin.Admin_email="'.$this->input->post('username').'" OR admin.Admin_username = "'.$this->input->post('username').'")';
			$this->db->where($where);		
			$this->db->where('admin.Admin_password', $this->input->post('password'));
			$this->db->where('admin.Admin_status', 'A');
			$query = $this->db->get();			
		}
		else
		{
			$where = '(Admin_email="'.$this->input->post('username').'" OR Admin_username = "'.$this->input->post('username').'")';
			$this->db->where($where);		
			$this->db->where('Admin_password', md5($this->input->post('password')));
			$this->db->where('Admin_status', 'A');
			$query = $this->db->get('admin');			
		}			
		if($query->num_rows() == 1)
		{ 
			$data['0']='true';
			$data['1']=$query;
			return $data;			
		}
		
	}  	
	public function forget_password($username)
	{
		$this->db->select('Reg_id, Reg_Name, Reg_User_name_id, Reg_password, Reg_email, Reg_country, Reg_state, Reg_country_code, Reg_mobile_number, Reg_city_id, Reg_profile_picture, Reg_created_dt_time, Reg_status');
        $this->db->from('registration');  		
		$where = '(Reg_User_name_id="'.$username.'" OR Reg_email = "'.$username.'" AND Reg_status="A")';
		$this->db->where($where);	 
		$this->db->limit(1);
        $query = $this->db->get();         
        return $query;
	}
	
	
	
}
?>