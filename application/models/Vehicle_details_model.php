<?php
Class Vehicle_details_model extends CI_Model
{
 	function vehicle_details_list()
	{		
	   $this->db->select('vehicle_details.*, transport_details.Transport_dtl_id, transport_details.Transport_dtl_name');
       $this->db->from('vehicle_details');
	   $this->db->join('transport_details', 'transport_details.Transport_dtl_id = vehicle_details.Vehicle_dtl_transport_name', 'Left');
	   $this->db->order_by("vehicle_details.Vehicle_dtl_id", "DESC"); 
       $query = $this->db->get();
	   return $query;             
       		
	} 
   // for displya vehicle details in select box 
	function vehicle_list()
	{
		$this->db->select('Vehicle_dtl_id, Vehicle_dtl_number');
        $this->db->from('vehicle_details'); 	
        $this->db->where('Vehicle_dtl_status', 'A'); 	
		$this->db->order_by("Vehicle_dtl_id", "ASC");			
        $query = $this->db->get();               
        return $query;	
	}
	// for display vehicle details in select box 

	function add_vehicle_details()
	{   $vehicle_make=""; $vehicle_permit=""; $trans_name="";
		if($this->input->post('vehicle_make')!=null){ $vehicle_make = $this->input->post('vehicle_make'); }
		if($this->input->post('vehicle_permit')!=null){ $vehicle_permit = $this->input->post('vehicle_permit'); }
		if($this->input->post('trans_name')!=null){ $trans_name = $this->input->post('trans_name'); }
		$user_data = array(
			'Vehicle_dtl_number' => $this->input->post('vehicle_number'),
			'Vehicle_dtl_make' => $vehicle_make,
			'Vehicle_dtl_permit' => $vehicle_permit,
			'Vehicle_dtl_transport' => $this->input->post('transport_type'),
			'Vehicle_dtl_transport_name' => $trans_name
		);	
		$this->db->set('Vehicle_dtl_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('vehicle_details', $user_data);			
		return true;		
	}  
	function get_vehicle_details($id)
	{		
		$this->db->select('*');
        $this->db->from('vehicle_details'); 		
		$this->db->where('Vehicle_dtl_id',$id);
        $query = $this->db->get(); 
        //$this->db->last_query(); 
        return $query;		 
	}	
	function edit_vehicle_details($id)
	{
		$vehicle_make=""; $vehicle_permit=""; $trans_name="";
		if($this->input->post('vehicle_make')!=null){ $vehicle_make = $this->input->post('vehicle_make'); }
		if($this->input->post('vehicle_permit')!=null){ $vehicle_permit = $this->input->post('vehicle_permit'); }
		if($this->input->post('trans_name')!=null){ $trans_name = $this->input->post('trans_name'); }
		$data = array('Vehicle_dtl_number' => $this->input->post('vehicle_number'),'Vehicle_dtl_make' => $vehicle_make,'Vehicle_dtl_permit' => $vehicle_permit,'Vehicle_dtl_transport' => $this->input->post('transport_type'),'Vehicle_dtl_transport_name' => $trans_name);
		$this->db->set('Vehicle_dtl_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Vehicle_dtl_id',$id);
		$this->db->update('vehicle_details',$data);
		return true;
	}
	function approve_vehicle()
	{
		$data=array('Vehicle_dtl_status'=>'A');
		$this->db->where('Vehicle_dtl_id',$this->input->get('id'));
		$this->db->update('vehicle_details',$data);
		return true;	 
	} 
	function deny_vehicle()
	{
		$data=array('Vehicle_dtl_status'=>'D');
		$this->db->where('Vehicle_dtl_id',$this->input->get('id'));
		$this->db->update('vehicle_details',$data);
		return true;	 
	}
	function delete_vehicle()
	{
       $this->db->select('Daily_mvnt_dtl_vehicle_no');
	   $this->db->from('daily_moment_details');
	   $this->db->where('Daily_mvnt_dtl_vehicle_no', $this->input->get('id'));
	   $query = $this->db->get();
	   if($query->num_rows()>0)
	   {
	  	 $chk_exist='y';
	   }
	   if($chk_exist!='y')
	   {
	     $this->db->where('Vehicle_dtl_id', $this->input->get('id'));
         $this->db->delete('vehicle_details');
	     return true;
	   }
	   else
	   {
	   	return FALSE;
	   }
	}	
	// start display Thirumala transport vehicle number list
	function vehicle_number_list()
	{
		$this->db->select('Vehicle_dtl_id, Vehicle_dtl_number');
        $this->db->from('vehicle_details'); 		
		$this->db->where('Vehicle_dtl_status', 'A');
		$this->db->where('Vehicle_dtl_transport', 'T'); 
        $query = $this->db->get();
        return $query;
	}
	// end display  Thirumala transport  vehicle number list
	// start display other transport vehicle number list
	function vehicle_other_list()
	{
		$this->db->select('Vehicle_dtl_id, Vehicle_dtl_number');
        $this->db->from('vehicle_details'); 		
		$this->db->where('Vehicle_dtl_status', 'A');
		$this->db->where('Vehicle_dtl_transport', 'O'); 
        $query = $this->db->get();
        return $query;
	}
	// end display other transport vehicle number list
	// start view details
	function view_vehicle_details($id)
	{
		$this->db->select('vehicle_details.*, transport_details.Transport_dtl_id, transport_details.Transport_dtl_name');
        $this->db->from('vehicle_details');
	    $this->db->join('transport_details', 'transport_details.Transport_dtl_id = vehicle_details.Vehicle_dtl_transport_name', 'Left');
		$this->db->where('vehicle_details.Vehicle_dtl_id',$id); 
        $query = $this->db->get();
        return $query;		 
	}
	// end view details
	// Start check ajax vehicle number
	function ajax_check_vehicle_number($number)
	{
		$this->db->select('Vehicle_dtl_number');
        $this->db->from('vehicle_details'); 		
		$this->db->where('Vehicle_dtl_number',$number); 
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
	 //End check ajax vehicle number
	function vehicle_count()
	{
		$this->db->select('Vehicle_dtl_id');
		$this->db->from('vehicle_details');
		$query = $this->db->get();
		return $query->num_rows();	
	}

	// start search vehicle list
	function search_vehicle_details_list()
	{	
	   $this->db->select('vehicle_details.*, transport_details.Transport_dtl_id, transport_details.Transport_dtl_name');
       $this->db->from('vehicle_details');
	   $this->db->join('transport_details', 'transport_details.Transport_dtl_id = vehicle_details.Vehicle_dtl_transport_name', 'Left');
        if($this->input->post('vehicle_permit_type')||$this->input->post('Vehicle_no')||$this->input->post('transport_type'))
        {
        	if(($this->input->post('vehicle_permit_type')!= null) && ($this->input->post('Vehicle_no')==null))
        	{	
        		$this->db->where('vehicle_details.Vehicle_dtl_permit LIKE "%'.$this->input->post('vehicle_permit_type').'%"');
        	}
        	if(($this->input->post('vehicle_permit_type')== null) && ($this->input->post('Vehicle_no')!=null))
        	{        		
        		$this->db->where('vehicle_details.Vehicle_dtl_number LIKE "%'.$this->input->post('Vehicle_no').'%"');
        	}
        	if(($this->input->post('vehicle_permit_type')!= null) && ($this->input->post('Vehicle_no')!=null))
        	{        		
        		$this->db->where('vehicle_details.Vehicle_dtl_permit LIKE"%'.$this->input->post('Vehicle_no').'%" AND vehicle_details.Vehicle_dtl_number LIKE "%'.$this->input->post('Vehicle_no').'%"');
        	}     	
        	if($this->input->post('transport_type')!= null)
        	{
				$this->db->where('vehicle_details.Vehicle_dtl_transport ="'.$this->input->post('transport_type').'"');
        	}      	
        }    
        $this->db->order_by('vehicle_details.Vehicle_dtl_id', 'DESC'); 		
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();            
        return $query;
	}
	// end search vehicle list
	
	
	//start get transport name 
	function get_transport_name($oth_transport){
		
		$this->db->select('vehicle_details.*, transport_details.Transport_dtl_id, transport_details.Transport_dtl_name');
        $this->db->from('vehicle_details');
	    $this->db->join('transport_details', 'transport_details.Transport_dtl_id = vehicle_details.Vehicle_dtl_transport_name', 'Left');
		$this->db->where('Vehicle_dtl_id', $oth_transport);
		$query = $this->db->get();
		return $query;
	}
	//end get transport name 
	
}
?>