<?php
Class Party_details_model extends CI_Model
{
 	function party_details_list()
	{
		$this->db->select('*');
        $this->db->from('party_details');
		$this->db->order_by("Party_dtl_id", "DESC");	 
		//$this->db->limit(8);
        $query = $this->db->get();               
        return $query;		
	} 
	function add_party_details()
	{
		$user_data = array(
			'Party_dtl_name' => $this->input->post('full_name'),
			'Party_dtl_phone_no' => $this->input->post('phone_no'),
			'Party_dtl_address' => $this->input->post('address'),
		);	
		$this->db->set('Party_dtl_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('party_details', $user_data);			
		return true;		
	}
	
	
	function get_party_details($id)
	{		
		$this->db->select('*');
        $this->db->from('party_details');
		$this->db->where('Party_dtl_id',$id); 
        $query = $this->db->get();
		//echo $this->db->last_query(); exit();
        //$this->db->last_query();
		 
        return $query;		 
	}	
	function edit_party_details($id)
	{
		$data=array('Party_dtl_name'=>$this->input->post('full_name'), 'Party_dtl_phone_no'=>$this->input->post('phone_no'), 'Party_dtl_address'=>$this->input->post('address'));
		$this->db->set('Party_dtl_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Party_dtl_id',$id);
		$this->db->update('party_details',$data);
		return true;
	}
	function approve_party_details()
	{
		$data=array('Party_dtl_status'=>'A');
		$this->db->where('Party_dtl_id',$this->input->get('id'));
		$this->db->update('party_details',$data);
		return true;	 
	} 
	function deny_party_details()
	{
		$data=array('Party_dtl_status'=>'D');
		$this->db->where('Party_dtl_id',$this->input->get('id'));
		$this->db->update('party_details',$data);
		return true;	 
	}
	function delete_party_details()
	{
	  $this->db->select('Daily_mvnt_dtl_party_name');
	  $this->db->from('daily_moment_details');
	  $this->db->where('Daily_mvnt_dtl_party_name', $this->input->get('id'));
	  $query = $this->db->get();
	  if($query->num_rows()>0)
	  {
	  	$chk_exist='y';
	  }
	  if($chk_exist!='y')
	  {
	    $this->db->where('Party_dtl_id', $this->input->get('id'));
        $this->db->delete('party_details');
	    return true;
	  }
	  else
	  {
	  	return false;
	  }
	}
	function get_party_advance_details($id)
	{		
		$this->db->select('*');
        $this->db->from('party_details');
		$this->db->where('Party_dtl_id',$id); 
        $query = $this->db->get();
		//echo $this->db->last_query(); exit();
        //$this->db->last_query();
		 
        return $query;		 
	}
	function view_party_advance($adv)
	{		
		$this->db->select('party_details.*,daily_moment_details.Daily_mvnt_dtl_party_adv,daily_moment_details.Daily_mvnt_dtl_date,daily_moment_details.Daily_mvnt_dtl_party_name,daily_moment_details.Daily_mvnt_dtl_place,daily_moment_details.Daily_mvnt_dtl_rent,driver_pay_rate.Driver_pay_rate_place_name');
        $this->db->from('party_details');
		$this->db->join('daily_moment_details','daily_moment_details.Daily_mvnt_dtl_party_name = party_details.Party_dtl_id','left');
		$this->db->join('driver_pay_rate','driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place');
		$this->db->where('Party_dtl_id',$adv);
        $query = $this->db->get();
		//echo $this->db->last_query(); exit();
        //$this->db->last_query();
        return $query;		 
	}
	
	// start display party name list
	function party_name_list()
	{
		$this->db->select('Party_dtl_id, Party_dtl_name');
        $this->db->from('party_details'); 		
		$this->db->where("Party_dtl_status", "A"); 
		$this->db->order_by("Party_dtl_name", "ASC");
        $query = $this->db->get();
        return $query;
	}
	// end display party name list
	// Start ajax check party name 
	function ajax_check_party_name($party_nme)
	{
		$this->db->select('Party_dtl_name');
        $this->db->from('party_details'); 		
		$this->db->where('Party_dtl_name',$party_nme); 
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
	//end ajax check party name
	function party_count()
	{
		$this->db->select('Party_dtl_id');
		$this->db->from('party_details');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	

	
	
}
?>