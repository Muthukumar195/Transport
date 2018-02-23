<?php
Class Driver_details_model extends CI_Model
{
 	function driver_details_list()
	{
		$this->db->select('*');
        $this->db->from('driver_details'); 		
		$this->db->order_by("Driver_dtl_id", "DESC");	 
		//$this->db->limit(8);
        $query = $this->db->get();               
        return $query;		
	}  
 
	// for displya driver details in select box 
	function driver_list()
	{
		$this->db->select('Driver_dtl_id, Driver_dtl_name');
        $this->db->from('driver_details'); 	
        $this->db->where('Driver_dtl_status', 'A'); 	
		$this->db->order_by("Driver_dtl_name", "ASC");			
        $query = $this->db->get();               
        return $query;	
	}
	// for display driver details in select box

	function add_deriver_details()
	{
		$user_data = array(
			'Driver_dtl_name' => $this->input->post('full_name'),
			'Driver_dtl_phone' => $this->input->post('phone_no'),
			'Driver_dtl_address' => $this->input->post('address'),
			'Driver_dtl_type' => $this->input->post('driver_type')			
		);	
		$this->db->set('Driver_dtl_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('driver_details', $user_data);			
		return true;		
	}  
	function get_driver_details($id)
	{		
		$this->db->select('*');
        $this->db->from('driver_details'); 		
		$this->db->where('Driver_dtl_id',$id); 
        $query = $this->db->get(); 
        $this->db->last_query(); 
        return $query;		 
	}
    function upload_file($file_extension)
	{		
		$this->db->select_max('Driver_dtl_id', 'max_id');
		$query = $this->db->get('driver_details'); 
		$res2 = $query->result_array();
        $max_id = $res2[0]['max_id'];		
		
		$file_name='lecense'.$max_id.$file_extension;	

		$data=array('Driver_dtl_license_file'=>$file_name);
		$this->db->where('Driver_dtl_id',$max_id);
		$this->db->update('driver_details',$data);
		//echo $this->db->last_query(); exit();
		return $file_name;
	}
	function edit_upload_file($file_extension)
	{
		$this->db->select_max('Driver_dtl_id', 'max_id');
		$query = $this->db->get('driver_details'); 
		$res2 = $query->result_array();
        $max_id = $this->input->post('id');		
		
		$file_name='lecense'.$max_id.$file_extension;	

		$data=array('Driver_dtl_license_file'=>$file_name);
		$this->db->where('Driver_dtl_id',$max_id);
		$this->db->update('driver_details',$data);
		//echo $this->db->last_query(); exit();
		return $file_name;
	}
	function edit_deriver_details($id)
	{
		$data=array('Driver_dtl_name'=>$this->input->post('full_name'), 'Driver_dtl_phone'=>$this->input->post('phone_no'), 'Driver_dtl_address'=>$this->input->post('address'), 'Driver_dtl_type'=>$this->input->post('driver_type'));
		$this->db->set('Driver_dtl_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Driver_dtl_id',$id);
		$this->db->update('driver_details',$data);
		return true;
	}
	function approve_driver()
	{
		$data=array('Driver_dtl_status'=>'A');
		$this->db->where('Driver_dtl_id',$this->input->get('id'));
		$this->db->update('driver_details',$data);
		return true;	 
	} 
	function deny_driver()
	{
		$data=array('Driver_dtl_status'=>'D');
		$this->db->where('Driver_dtl_id',$this->input->get('id'));
		$this->db->update('driver_details',$data);
		return true;	 
	}
	function delete_driver($id)
	{ 

	  $this->db->select('Daily_mvnt_dtl_driver_name');
	  $this->db->from('daily_moment_details');
	  $this->db->where('Daily_mvnt_dtl_driver_name', $id);
	  $query = $this->db->get();
	  $chk_exist='n';
	  if($query->num_rows()>0)
	  {
	  	$chk_exist='y';
	  }

	  $this->db->select('Vehicle_dtl_permanent_driver_name');
	  $this->db->from('vehicle_details');
	  $this->db->where('Vehicle_dtl_permanent_driver_name', $id);
	  $query = $this->db->get();
	  if($query->num_rows()>0)
	  {
	  	$chk_exist='y';
	  }
	  if($chk_exist!='y')
	  {
		  $this->db->where('Driver_dtl_id',$id);  
	      $this->db->delete('driver_details'); 
	      return true;
	  }
	  else
	  {  
	  	  return FALSE;
	  }    
	   
	}
	function ajax_check_full_name($ful_nme)
	{
		$this->db->select('Driver_dtl_name');
        $this->db->from('driver_details'); 		
		$this->db->where('Driver_dtl_name',$ful_nme); 
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
	function driver_count()
	{
		$this->db->select('Driver_dtl_id');
		$this->db->from('driver_details');
		$query = $this->db->get();
		return $query->num_rows();		
	}

	// start search driver list
	function search_driver_details_list()
	{	
		$this->db->select('*');
		$this->db->from('driver_details');         
        if($this->input->post('driver_type')||$this->input->post('full_name'))
        {
        	if(($this->input->post('driver_type')!= null) && ($this->input->post('full_name')==null))
        	{
        		//$whr_cntn='WHERE Driver_dtl_type="'.$this->input->post('driver_type').'"';
        		$this->db->where('Driver_dtl_type', $this->input->post('driver_type'));
        	}
        	if(($this->input->post('driver_type')== null) && ($this->input->post('full_name')!=null))
        	{
        		//$whr_cntn='WHERE Driver_dtl_name LIKE "%'.$this->input->post('full_name').'%"';
        		$this->db->where('Driver_dtl_name LIKE "%'.$this->input->post('full_name').'%"');
        	}
        	if(($this->input->post('driver_type')!= null) && ($this->input->post('full_name')!=null))
        	{
        		//$whr_cntn='WHERE Driver_dtl_type="'.$this->input->post('driver_type').'" AND Driver_dtl_name LIKE "%'.$this->input->post('full_name').'%"';
        		$this->db->where('Driver_dtl_type="'.$this->input->post('driver_type').'" AND Driver_dtl_name LIKE "%'.$this->input->post('full_name').'%"');
        	}       	
        }    
        $this->db->order_by('Driver_dtl_id', 'DESC');
		
		//$this->db->query("SELECT * FROM driver_details ".$whr_cntn." ORDER BY Driver_dtl_id DESC");
        $query = $this->db->get();
        $this->db->last_query();                
        return $query;
	}
	// end search driver list
	// start view driver pay amount details
	function view_driver_pay_amount($id)
	{
		$this->db->select('daily_moment_details.*, driver_details.Driver_dtl_id, driver_details.Driver_dtl_name, driver_pay_rate.Driver_pay_rate_place_name, driver_pay_rate.Driver_pay_rate_amount, vehicle_details.Vehicle_dtl_number,driver_payment_details.Driver_pymnt_pay_date,driver_payment_details.Driver_pymnt_pay_status');
        $this->db->from('daily_moment_details'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id=daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
		$this->db->join('driver_payment_details', 'driver_payment_details.Driver_pymnt_di_driver_name = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id=daily_moment_details.Daily_mvnt_dtl_place', 'left');
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id=daily_moment_details.Daily_mvnt_dtl_vehicle_no');	
		$this->db->where('daily_moment_details.Daily_mvnt_dtl_driver_name',$id); 
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC"); 
        $query = $this->db->get(); 
        //echo $this->db->last_query();  exit();
        return $query;	
	}
	// end view driver pay amount details
	
	
}
?>