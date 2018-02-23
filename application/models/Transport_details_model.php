<?php
Class Transport_details_model extends CI_Model
{
 	function transport_details_list()
	{
		$this->db->select('*');
        $this->db->from('transport_details'); 		
		$this->db->order_by("Transport_dtl_id", "DESC");	 
		//$this->db->limit(8);
        $query = $this->db->get();               
        return $query;		
	}  
 
	function add_transport_details()
	{
		$user_data = array(
			'Transport_dtl_name' => $this->input->post('transport_name'),
			'Transport_dtl_phone_no' => $this->input->post('phone_no'),
			'Transport_dtl_address' => $this->input->post('address')
		);	
		$this->db->set('Transport_dtl_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('transport_details', $user_data);			
		return true;		
	}  
	function get_transport_details($id)
	{		
		$this->db->select('*');
        $this->db->from('transport_details'); 		
		$this->db->where('Transport_dtl_id',$id); 
        $query = $this->db->get(); 
        //$this->db->last_query(); 
        return $query;		 
	}
	function edit_transport_details($id)
	{
		$data=array('Transport_dtl_name'=>$this->input->post('transport_name'), 'Transport_dtl_phone_no'=>$this->input->post('phone_no'), 'Transport_dtl_address'=>$this->input->post('address'));
		$this->db->set('Transport_dtl_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Transport_dtl_id',$id);
		$this->db->update('transport_details',$data);
		return true;
	}
	function approve_transport_details()
	{
		$data=array('Transport_dtl_status'=>'A');
		$this->db->where('Transport_dtl_id',$this->input->get('id'));
		$this->db->update('transport_details',$data);
		return true;	 
	} 
	function deny_transport_details()
	{
		$data=array('Transport_dtl_status'=>'D');
		$this->db->where('Transport_dtl_id',$this->input->get('id'));
		$this->db->update('transport_details',$data);
		return true;	 
	}
	function delete_transport_details()
	{
	  $this->db->select('Iso_mvnt_transport_name');
	  $this->db->from('iso_movement_details');
	  $this->db->where('Iso_mvnt_transport_name', $this->input->get('id'));
	  $query = $this->db->get();
	  if($query->num_rows()>0)
	  {
	  	$chk_exist='y';
	  }

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
	     $this->db->where('Transport_dtl_id', $this->input->get('id'));
         $this->db->delete('transport_details');
	     return true;
	  }
	  else
	  {
	  	return FALSE;
	  }
	}
	// start display transport name list
	function transport_name_list()
	{
		$this->db->select('Transport_dtl_id, Transport_dtl_name');
        $this->db->from('transport_details'); 		
		$this->db->where('Transport_dtl_status', 'A'); 
        $query = $this->db->get();
        return $query;
	}
	// end display transport name list
	// start view transport details list
	function view_transport_details($id)
	{
		$this->db->select('*');
        $this->db->from('transport_details'); 
		$this->db->where('Transport_dtl_id',$id);
        $query = $this->db->get();               
        return $query;
		
	}
	//end view transport detail list 
	function ajax_check_transport_name($trans_nme)
	{
		$this->db->select('Transport_dtl_name');
        $this->db->from('transport_details'); 		
		$this->db->where('Transport_dtl_name',$trans_nme); 
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
	function transport_count()
	{
		$this->db->select('Transport_dtl_id');
		$this->db->from('transport_details');
		$query = $this->db->get();
		return $query->num_rows();
	}

	// start view transport 
	function search_transport_list()
	{
		$this->db->select('*');
		$this->db->from('transport_details');         
        if($this->input->post('tranport_name')||$this->input->post('phone_number'))
        {
        	if(($this->input->post('tranport_name')!= null) && ($this->input->post('phone_number')==null))
        	{        		
        		$this->db->where('Transport_dtl_name LIKE "%'.$this->input->post('tranport_name').'%"');
        	}
        	if(($this->input->post('tranport_name')== null) && ($this->input->post('phone_number')!=null))
        	{        		
        		$this->db->where('Transport_dtl_phone_no LIKE "%'.$this->input->post('phone_number').'%"');
        	}
        	if(($this->input->post('tranport_name')!= null) && ($this->input->post('phone_number')!=null))
        	{        		
        		$this->db->where('Transport_dtl_name LIKE "%'.$this->input->post('tranport_name').'%" AND Transport_dtl_phone_no LIKE "%'.$this->input->post('phone_number').'%"');
        	}       	
        }    
        $this->db->order_by('Transport_dtl_id', 'DESC');		
		
        $query = $this->db->get();
        $this->db->last_query();                
        return $query;
	}
	// end view transport
	
	
}
?>