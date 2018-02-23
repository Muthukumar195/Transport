<?php
Class Party_payment_model extends CI_Model
{
 	function party_payments_list()
	{
		$this->db->select('daily_moment_details.*, vehicle_details.Vehicle_dtl_number, driver_pay_rate.Driver_pay_rate_place_name, party_details.Party_dtl_name, driver_details.Driver_dtl_name,party_payment.Party_payment_party_name,party_payment.Party_payment_paid_amount,party_payment.Party_payment_pay_status,party_payment.Party_payment_remarks,party_payment.Party_payment_pay_date,party_details.Party_dtl_id,party_billing.Party_billing_container_no');
        $this->db->from('daily_moment_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left'); 
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left'); 
        $this->db->join('party_details', 'party_details.Party_dtl_id = daily_moment_details.Daily_mvnt_dtl_party_name', 'left'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
		$this->db->join('party_payment', 'party_payment.Party_payment_party_name = daily_moment_details.Daily_mvnt_dtl_party_name', 'left');
		$this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		//$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_id", "DESC");
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
		$this->db->group_by('daily_moment_details.Daily_mvnt_dtl_party_name'); 
        $query = $this->db->get(); 
		//echo $this->db->last_query(); exit;              
        return $query;		
	} 
	function movement_outstand_payment(){
		$this->db->select('*');
        $this->db->from('daily_moment_details');
		//$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_id", "DESC");
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
        $query = $this->db->get();               
        return $query;
	}
	function party_outstand_payment(){
		$this->db->select('*');
        $this->db->from('party_payment');
		$this->db->order_by("party_payment.Party_payment_id", "DESC");
        $query = $this->db->get();               
        return $query;
	}
	function add_party_payment_details()
	{
		$user_data = array(
			'Party_payment_party_name' => $this->input->post('party_name'),
			'Party_payment_paid_amount' => $this->input->post('amount'),
			'Party_payment_pay_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('party_pay_date')))),
			'Party_payment_pay_status' => $this->input->post('party_pay_status'),
			'Party_payment_remarks' => $this->input->post('remarks')			
		);	
		$this->db->set('Party_payment_creatred_dt_tme', 'NOW()', FALSE);	
		$insert=$this->db->insert('party_payment', $user_data);			
		return true;		
	}
	
	function get_party_payment_details($id)
	{		
		$this->db->select('*');
        $this->db->from('party_payment');
		$this->db->join('party_details', 'party_details.Party_dtl_id=party_payment.Party_payment_party_name', 'left');
		$fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to'))
        {
			// start check Party Payment date
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')==null))
        	{	
        	
        		$m_date = '(party_payment.Party_payment_pay_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')== null) && ($this->input->post('m_date_to')!=null))
        	{        		
        		$m_date = '(party_payment.Party_payment_pay_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')!=null))
        	{	
        		$m_date = '(party_payment.Party_payment_pay_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'" AND Party_payment_pay_date<= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	// end  check Party Payment date
			
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
		$this->db->where('party_payment.Party_payment_party_name',$id); 
        $query = $this->db->get();
        return $query;		 
	}	
	// start view movement payment details in view option
	function get_movement_payment_details_unpaid($id)
	{
		$this->db->select('daily_moment_details.*, vehicle_details.Vehicle_dtl_number, driver_pay_rate.Driver_pay_rate_place_name, party_details.Party_dtl_name,party_details.Party_dtl_address,driver_details.Driver_dtl_name, container_details.Container_dtl_container_no,party_billing.Party_billing_container_no,party_billing.Party_billing_cni_no,party_billing.	Party_billing_from');
        $this->db->from('daily_moment_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left'); 
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left'); 
        $this->db->join('party_details', 'party_details.Party_dtl_id = daily_moment_details.Daily_mvnt_dtl_party_name', 'left'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
        $this->db->join('container_details', 'container_details.Container_dtl_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		$this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		 $fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to'))
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
        $this->db->where("daily_moment_details.Daily_mvnt_dtl_party_name", $id);
		$this->db->where("daily_moment_details.Daily_mvnt_dtl_party_pay_status", "U");
		//$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_id", "DESC");
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
		$query = $this->db->get(); 			                      
        return $query;	
	}
	// end view movement payment details in view option
	// start view movement payment details in view option
	function get_movement_payment_paid($id)
	{
		$this->db->select('daily_moment_details.*, vehicle_details.Vehicle_dtl_number, driver_pay_rate.Driver_pay_rate_place_name, party_details.Party_dtl_name,party_details.Party_dtl_address, driver_details.Driver_dtl_name, container_details.Container_dtl_container_no,party_billing.Party_billing_container_no,party_billing.Party_billing_cni_no,party_billing.	Party_billing_from');
        $this->db->from('daily_moment_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left'); 
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left'); 
        $this->db->join('party_details', 'party_details.Party_dtl_id = daily_moment_details.Daily_mvnt_dtl_party_name', 'left'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
        $this->db->join('container_details', 'container_details.Container_dtl_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		$this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		 $fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to'))
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
        $this->db->where("daily_moment_details.Daily_mvnt_dtl_party_name", $id);
		$this->db->where("daily_moment_details.Daily_mvnt_dtl_party_pay_status", "P");
		//$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_id", "DESC");
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
		//$this->db->limit(1);
		$query = $this->db->get(); 			                      
        return $query;	
	}
	// end view movement payment details in view option
	function edit_party_payment_details($id)
	{
		$user_data = array(
			'Party_payment_party_name' => $this->input->post('party_name'),
			'Party_payment_paid_amount' => $this->input->post('amount'),
			'Party_payment_pay_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('party_pay_date')))),
			'Party_payment_remarks' => $this->input->post('remarks')			
		);	
		$this->db->set('Party_payment_creatred_dt_tme', 'NOW()', FALSE);	
		$this->db->where('Party_payment_id',$id);
		$this->db->update('party_payment',$user_data);
		return true;
	}	
	function delete_party_payment_details()
	{	 
	    $this->db->where('Party_payment_party_name', $this->input->get('id'));
        $this->db->delete('party_payment');
	    return true;	  
	}
		
	
	
	// end view movement payment details in view option
}
?>