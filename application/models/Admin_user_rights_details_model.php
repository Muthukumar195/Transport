<?php
Class Admin_user_rights_details_model extends CI_Model
{
 	function admin_user_rights_details_list()
	{
		$this->db->select('*');
        $this->db->from('admin_user_rights_details'); 		
		$this->db->order_by("User_rights_id", "DESC");	 
		//$this->db->limit(8);
        $query = $this->db->get();               
        return $query;		
	} 
	 
    function get_admin_user_rights($id)
	{
		$this->db->select('*');
        $this->db->from('admin_user_rights_details');
		$this->db->where("User_rights_id", $id); 		
		$this->db->order_by("User_rights_id", "DESC");	 
		//$this->db->limit(8);
        $query = $this->db->get();               
        return $query;		
	} 
	

	function add_admin_user_rights_details()
	{
		$user_value=array($this->input->post('user_rights'));
		$user_vll_with_cmma='';
		$cmma_cnt = count($user_value[0]);
		$cmma_chk=0;
		foreach($user_value[0] as $user_vll){
				$user_vll_with_cmma .= $user_vll;		
				if($cmma_chk<$cmma_cnt-1)
				{
					 $user_vll_with_cmma .= ',';	
				}
				$cmma_chk++;
		}		
		$user_data = array(
			'User_rights_name' => $this->input->post('user_type'),
			'User_rights_type_value' => $user_vll_with_cmma,			
		);
		
		
		$this->db->set('User_rights_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('admin_user_rights_details', $user_data);
		$this->db->last_query(); 			
		return true;		
		
	}  
	function get_admin_user_rights_details($id)
	{		
		$this->db->select('*');
        $this->db->from('admin_user_rights_details'); 		
		$this->db->where('User_rights_id',$id); 
        $query = $this->db->get(); 
        $this->db->last_query(); 
        return $query;		 
	}
	
	function edit_admin_user_rights_details($id)
	{
		$user_value=array($this->input->post('user_rights'));
		$user_vll_with_cmma='';
		$cmma_cnt = count($user_value[0]);
		$cmma_chk=0;
		foreach($user_value[0] as $user_vll){
				$user_vll_with_cmma .= $user_vll;		
				if($cmma_chk<$cmma_cnt-1)
				{
					 $user_vll_with_cmma .= ',';	
				}
				$cmma_chk++;
		}
		$data=array('User_rights_name'=>$this->input->post('user_type'), 'User_rights_type_value'=> $user_vll_with_cmma);
		$this->db->set('User_rights_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('User_rights_id',$id);
		$this->db->update('admin_user_rights_details',$data);
		//echo $this->db->last_query(); exit;
		return true;
	}
	function approve_user_rights()
	{
		$data=array('User_rights_status'=>'A');
		$this->db->where('User_rights_id',$this->input->get('id'));
		$this->db->update('admin_user_rights_details',$data);
		return true;	 
	} 
	function deny_user_rights()
	{
		$data=array('User_rights_status'=>'D');
		$this->db->where('User_rights_id',$this->input->get('id'));
		$this->db->update('admin_user_rights_details',$data);
		return true;	 
	}
	function delete_user_rights($id)
	{
	   $this->db->select('Admin_user_rights');
	  $this->db->from('admin');
	  $this->db->where('Admin_user_rights', $id);
	  $query = $this->db->get();
	  $chk_exist='n';
	  if($query->num_rows()>0)
	  {
	  	$chk_exist='y';
	  }
	  if($chk_exist!='y')
	  {
		  $this->db->where('User_rights_id',$id);  
	      $this->db->delete('admin_user_rights_details'); 
	      return true;
	  }
	  else
	  {  
	  	  return FALSE;
	  }       
	     
	   
	}
	function ajax_check_user_type($user_type)
	{
		$this->db->select('User_rights_name');
        $this->db->from('admin_user_rights_details'); 		
		$this->db->where('User_rights_name',$user_type); 
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