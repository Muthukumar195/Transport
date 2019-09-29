<?php
Class Driver_payment_model extends CI_Model
{
 	function driver_payment_list()
	{
		$this->db->select('daily_moment_details.*, vehicle_details.Vehicle_dtl_number, driver_pay_rate.Driver_pay_rate_place_name, party_details.Party_dtl_name, driver_details.Driver_dtl_name,driver_payment_details.Driver_pymnt_di_driver_name,driver_payment_details.Driver_pymnt_id,driver_payment_details.Driver_pymnt_pay_date,driver_payment_details.Driver_pymnt_pay_status,driver_payment_details.Driver_pymnt_remarks,driver_payment_details.Driver_pymnt_amount,driver_payment_details.Driver_pymnt_status');
        $this->db->from('daily_moment_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left'); 
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left'); 
        $this->db->join('party_details', 'party_details.Party_dtl_id = daily_moment_details.Daily_mvnt_dtl_party_name', 'left'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
       
		$this->db->join('driver_payment_details', 'driver_payment_details.Driver_pymnt_di_driver_name = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
		$this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
        $this->db->where('Daily_mvnt_dtl_transport_type', "T");
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
		$this->db->group_by('driver_details.Driver_dtl_name');
        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        return $query;	
	}  
	function add_driver_payment()
	{
		$user_data = array(
		    'Driver_pymnt_di_driver_name' => $this->input->post('driver_name'),
			'Driver_pymnt_pay_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pay_date')))),
			'Driver_pymnt_pay_status' => $this->input->post('driver_pay_status'),
			'Driver_pymnt_remarks' => $this->input->post('driver_remark'),
			'Driver_pymnt_amount' => $this->input->post('driver_amount'),
		);	
		$this->db->set('Driver_pymnt_created_dt_tme', 'NOW()', FALSE);	
		$insert=$this->db->insert('driver_payment_details', $user_data);			
		return true;		
	}  
	
	function get_driver_payment($id)
	{
		//echo $date_id; exit;		
		$this->db->select('*');
        $this->db->from('driver_payment_details');
		$this->db->join('driver_details','driver_details.Driver_dtl_id = driver_payment_details.Driver_pymnt_di_driver_name','left');	
		$fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to'))
        {
			// start check Driver Payment date
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')==null))
        	{	
        	
        		$m_date = '(driver_payment_details.Driver_pymnt_pay_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')== null) && ($this->input->post('m_date_to')!=null))
        	{        		
        		$m_date = '(driver_payment_details.Driver_pymnt_pay_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')!=null))
        	{	
        		$m_date = '(driver_payment_details.Driver_pymnt_pay_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'" AND Driver_pymnt_pay_date<= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	// end  check Driver Payment date
			
			$fnl_where_last=''; $fnl_count=0; 
        	foreach ($fnl_where as $whr_val) 
        	{    $fnl_count;
        		$fnl_where_last .= ''.$whr_val.'';
        		if(($fnl_count>=0)&&($fnl_count<(count($fnl_where)-1)))
        		{
        			$fnl_where_last .= ' And ';  
        		}     		
        		$fnl_count++;
        	}        	
        	
        	$this->db->where($fnl_where_last); 
        }
		$this->db->where('driver_payment_details.Driver_pymnt_di_driver_name',$id);
        $query = $this->db->get(); 
       // $this->db->last_query();  exit;
        return $query;		 
	}
	// start view movement payment details in view option
	function get_movement_payment_details($id)
	{
		$this->db->select('daily_moment_details.*, vehicle_details.Vehicle_dtl_number,driver_pay_rate.Driver_pay_rate_place_name, party_details.Party_dtl_name, driver_details.Driver_dtl_name,party_billing.Party_billing_container_no');
        $this->db->from('daily_moment_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left'); 
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left'); 
        $this->db->join('party_details', 'party_details.Party_dtl_id = daily_moment_details.Daily_mvnt_dtl_party_name', 'left'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
		$this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
       
	   $fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to')||$this->input->post('driver_pay_status'))
        {
			//echo 'dffg'; exit;
			// start check m permit
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')==null))
        	{	
        		//$this->db->where('vehicle_document_details.Vehicle_doc_dtl_m_permit_from="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from')))).'"');
        		$m_date = '(daily_moment_details.Daily_mvnt_dtl_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')== null) && ($this->input->post('m_date_to')!=null))
        	{        		
        		$m_date = '(daily_moment_details.Daily_mvnt_dtl_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')!=null))
        	{	
        		$m_date = '(daily_moment_details.Daily_mvnt_dtl_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'" AND Daily_mvnt_dtl_date <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	// end check m permit
			if(($this->input->post('driver_pay_status')!= null))
        	{	
        		$dr_sts = '(daily_moment_details.Daily_mvnt_dtl_driver_pay_status = "'.$this->input->post('driver_pay_status').'")';
        		$fnl_where[]=$dr_sts;
        	}
			//cheack Driver pay status in daily mvnt
			$fnl_where_last=''; $fnl_count=0; 
        	foreach ($fnl_where as $whr_val) 
        	{    $fnl_count;
        		$fnl_where_last .= ''.$whr_val.'';
        		if(($fnl_count>=0)&&($fnl_count<(count($fnl_where)-1)))
        		{
        			$fnl_where_last .= ' And ';  
        		}     		
        		$fnl_count++;
        	}        	
        	
        	$this->db->where($fnl_where_last); 
			//echo $this->db->last_query(); exit;
        }
	
        $this->db->where("daily_moment_details.Daily_mvnt_dtl_driver_name", $id);
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
		//echo $this->db->last_query(); exit;
		$query = $this->db->get(); 			                      
        return $query;	
	}
	// end view movement payment details in view option
	
	// start view iso movement payment details in view option
	function get_iso_movement_payment_details($id)
	{
		$this->db->select('iso_movement_details.*, vehicle_details.Vehicle_dtl_number,  driver_details.Driver_dtl_name');
        $this->db->from('iso_movement_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = iso_movement_details.Iso_mvnt_vehicle_no', 'left'); 
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = iso_movement_details.Iso_mvnt_driver_name', 'left');
	   $fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to')||$this->input->post('driver_pay_status'))
        {
			//echo 'dffg'; exit;
			// start check m permit
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')==null))
        	{	
        		//$this->db->where('vehicle_document_details.Vehicle_doc_dtl_m_permit_from="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from')))).'"');
        		$m_date = '(iso_movement_details.Iso_mvnt_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')== null) && ($this->input->post('m_date_to')!=null))
        	{        		
        		$m_date = '(iso_movement_details.Iso_mvnt_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')!=null))
        	{	
        		$m_date = '(iso_movement_details.Iso_mvnt_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'" AND Iso_mvnt_date <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	// end check m permit
			if(($this->input->post('driver_pay_status')!= null))
        	{	
        		$dr_sts = '(iso_movement_details.Iso_mvnt_driver_pay_status = "'.$this->input->post('driver_pay_status').'")';
        		$fnl_where[]=$dr_sts;
        	}
			//cheack Driver pay status in daily mvnt
			$fnl_where_last=''; $fnl_count=0; 
        	foreach ($fnl_where as $whr_val) 
        	{    $fnl_count;
        		$fnl_where_last .= ''.$whr_val.'';
        		if(($fnl_count>=0)&&($fnl_count<(count($fnl_where)-1)))
        		{
        			$fnl_where_last .= ' And ';  
        		}     		
        		$fnl_count++;
        	}        	
        	
        	$this->db->where($fnl_where_last); 
			//echo $this->db->last_query(); exit;
        }
	
        $this->db->where("iso_movement_details.Iso_mvnt_driver_name", $id);
		$this->db->order_by("iso_movement_details.Iso_mvnt_date", "DESC");
		//echo $this->db->last_query(); exit;
		$query = $this->db->get(); 			                      
        return $query;	
	}
	// end view iso movement payment details in view option
	
	function edit_driver_payment($id)
	{
		$data=array(
		    'Driver_pymnt_di_mvnt_id' => $this->input->post('movement_date'),
			'Driver_pymnt_pay_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pay_date')))),
			'Driver_pymnt_pay_status' => $this->input->post('driver_pay_status'),
			'Driver_pymnt_remarks' => $this->input->post('driver_remark'),
			'Driver_pymnt_other_expences' => $this->input->post('other_expences')
			);
		$this->db->set('Driver_pymnt_created_dt_tme', 'NOW()', FALSE);	
		$this->db->where('Driver_pymnt_id',$id);
		$this->db->update('driver_payment_details',$data);
		return true;
	}
	
	function delete_driver_payment()
	{
	    $this->db->where('Driver_pymnt_id', $this->input->get('id'));
		$this->db->delete('driver_payment_details'); 
	    return true;
	}	
	// start search driver_payment list
	function search_driver_payment_list()
	{	$this->db->select('*');
        $this->db->from('driver_payment_details');
		$this->db->join('daily_moment_details', 'daily_moment_details.Daily_mvnt_dtl_id = driver_payment_details.Driver_pymnt_di_mvnt_id', 'left'); 
		$this->db->join('driver_details','driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name','left');
		$this->db->join('driver_pay_rate','driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place','left');
		$this->db->join('vehicle_details','vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no','left');
		
		$fnl_where=array();       
        if($this->input->post('driver_name')||$this->input->post('place_name')||$this->input->post('Paid_from')||$this->input->post('Paid_to')||$this->input->post('movement_from')||$this->input->post('movement_to')||$this->input->post('driver_pay_status'))
        {
			// start check driver_name
        	if($this->input->post('driver_name')!= null)
        	{	        		
        		$driver_name = '(driver_details.Driver_dtl_name LIKE "%'.$this->input->post('driver_name').'%")';
        		$fnl_where[]=$driver_name;
        	}        	
        	// end check driver_name
			// start check place_name
        	if($this->input->post('place_name')!= null)
        	{	        		
        		$place_name = '(driver_pay_rate.Driver_pay_rate_place_name LIKE "%'.$this->input->post('place_name').'%")';
        		$fnl_where[]=$place_name;
        	}        	
        	// end check place_name
			// start check pay date
        	if(($this->input->post('Paid_from')!= null) && ($this->input->post('Paid_to')==null))
        	{	        		
        		$paid_date = '(driver_payment_details.Driver_pymnt_pay_date >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('Paid_from')))).'")';
        		$fnl_where[]=$paid_date;
        	}
        	if(($this->input->post('Paid_from')== null) && ($this->input->post('Paid_to')!=null))
        	{        		
        		$paid_date = '(driver_payment_details.Driver_pymnt_pay_date <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('Paid_to')))).'")';
        		$fnl_where[]=$paid_date;
        	}
        	if(($this->input->post('Paid_from')!= null) && ($this->input->post('Paid_to')!=null))
        	{	
        		$paid_date = '(driver_payment_details.Driver_pymnt_pay_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('Paid_from')))).'" AND Driver_pymnt_pay_date <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('Paid_to')))).'")';
        		$fnl_where[]=$paid_date;
        	}
        	// end check pay date
			// start check Movement date
        	if(($this->input->post('movement_from')!= null) && ($this->input->post('movement_to')==null))
        	{	        		
        		$movement_date = '(daily_moment_details.Daily_mvnt_dtl_date >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('movement_from')))).'")';
        		$fnl_where[]=$movement_date;
        	}
        	if(($this->input->post('movement_from')== null) && ($this->input->post('movement_to')!=null))
        	{        		
        		$movement_date = '(daily_moment_details.Daily_mvnt_dtl_date <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('Paid_to')))).'")';
        		$fnl_where[]=$movement_date;
        	}
        	if(($this->input->post('movement_from')!= null) && ($this->input->post('movement_to')!=null))
        	{	
        		$movement_date = '(daily_moment_details.Daily_mvnt_dtl_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('movement_from')))).'" AND Daily_mvnt_dtl_date <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('movement_to')))).'")';
        		$fnl_where[]=$movement_date;
        	}
        	// end check Movement date
        	// start check driver pay status        	
        	if($this->input->post('driver_pay_status')!= null)
        	{	
        		$driver_pay_status = '(driver_payment_details.Driver_pymnt_pay_status ="'.$this->input->post('driver_pay_status').'")';
				$fnl_where[]=$driver_pay_status;
        		
        	} 
        	// end check driver pay status 

			$fnl_where_last=''; $fnl_count=0; 
        	foreach ($fnl_where as $whr_val) 
        	{    $fnl_count;
        		$fnl_where_last .= ''.$whr_val.'';
        		if(($fnl_count>=0)&&($fnl_count<(count($fnl_where)-1)))
        		{
        			$fnl_where_last .= ' And ';  
        		}     		
        		$fnl_count++;
        	}        	
        	
        	$this->db->where($fnl_where_last); 
        }
      
        $this->db->order_by('Driver_pymnt_pay_date', 'DESC');
		
		
        $query = $this->db->get();
        $this->db->last_query();            
        return $query;
	}
	// end Driver_payment
}
?>