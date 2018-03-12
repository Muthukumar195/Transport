<?php

class Transport_payment_model extends CI_model
{
	
	public function transport_payment_list(){

		$this->db->select('daily_moment_details.*, transport_payment.*, transport_details.Transport_dtl_id, transport_details.Transport_dtl_name, driver_pay_rate.Driver_pay_rate_id, driver_pay_rate.Driver_pay_rate_place_name, party_billing.Party_billing_id, party_billing.Party_billing_container_no,vehicle_details.Vehicle_dtl_id, vehicle_details.Vehicle_dtl_number');
		$this->db->from('daily_moment_details');
		$this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left');
		$this->db->join('transport_details', 'transport_details.Transport_dtl_id = daily_moment_details.Daily_mvnt_dtl_trp_name', 'left');
		$this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left');
		$this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		$this->db->join('transport_payment', 'transport_payment.Transport_payment_trans_name = daily_moment_details.Daily_mvnt_dtl_trp_name', 'left');
		$this->db->where('Daily_mvnt_dtl_transport_type',"O");
		$this->db->group_by('Daily_mvnt_dtl_trp_name');
        $this->db->order_by('Transport_payment_id', "DESC");
		$query = $this->db->get();
		return $query;
	}
    public function transport_iso_payment_list(){

		$this->db->select('iso_movement_details.*, transport_payment.*, transport_details.Transport_dtl_id, transport_details.Transport_dtl_name');
		$this->db->from('iso_movement_details');
        $this->db->join('transport_details', 'transport_details.Transport_dtl_id = iso_movement_details.Iso_mvnt_transport_name', 'left');
		$this->db->join('transport_payment', 'transport_payment.Transport_payment_trans_name = iso_movement_details.Iso_mvnt_transport_name', 'left');
		$this->db->group_by('Iso_mvnt_transport_name');
        $this->db->order_by('Transport_payment_id', "DESC");
		$query = $this->db->get();
		return $query;
	}
  
	function daily_movement_payment(){
		$this->db->select('*');
        $this->db->from('daily_moment_details');
		$this->db->where('Daily_mvnt_dtl_transport_type',"O");
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
        $query = $this->db->get(); 
        return $query;
	}
	function iso_movement_payment(){
		
		$this->db->select('*');
		$this->db->from('iso_movement_details');
		$this->db->where('Iso_mvnt_vehicle_type', "O");
		$this->db->order_by('iso_movement_details.Iso_mvnt_id', "DESC");
		$query = $this->db->get();       
		return $query;
	}
	function transport_payment(){
		$this->db->select('*');
        $this->db->from('transport_payment');
		$this->db->order_by("transport_payment.Transport_payment_id", "DESC");
        $query = $this->db->get();               
        return $query;
	}
	function add_transport_payment()
	{
		$user_data = array(
			'Transport_payment_trans_name' => $this->input->post('transport_name'),
			'Transport_payment_amount' => $this->input->post('amount'),
			'Transport_payment_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('transport_pay_date')))),
			'Transport_payment_remark' => $this->input->post('remarks')			
		);	
		$this->db->set('Transport_payment_creatred_dt_tme', 'NOW()', FALSE);	
		$insert=$this->db->insert('transport_payment', $user_data);			
		return true;		
	}
    
	
	function get_transport_payment_details($id)
	{		
		$this->db->select('transport_payment.*,transport_details.Transport_dtl_id,');
        $this->db->from('transport_payment');
		$this->db->join('transport_details', 'transport_details.Transport_dtl_id=transport_payment.Transport_payment_trans_name', 'left');
		 $fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to'))
        {
			// start check Transport Payment date
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')==null))
        	{	
        	
        		$m_date = '(transport_payment.Transport_payment_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')== null) && ($this->input->post('m_date_to')!=null))
        	{        		
        		$m_date = '(transport_payment.Transport_payment_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')!=null))
        	{	
        		$m_date = '(transport_payment.Transport_payment_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'" AND Transport_payment_date<= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$m_date;
        	}
        	// end  check Transport Payment date
			
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
		$this->db->where('transport_payment.Transport_payment_trans_name',$id); 
        $query = $this->db->get();	 
        return $query;		 
	}	
	// start view movement payment details in view option
	function get_movement_payment_details_unpaid($id)
	{
		$this->db->select('daily_moment_details.*, transport_details.*,driver_pay_rate.Driver_pay_rate_place_name, party_billing.Party_billing_container_no, vehicle_details.Vehicle_dtl_id, vehicle_details.Vehicle_dtl_number');
        $this->db->from('daily_moment_details'); 
		$this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left');
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left');
		 $this->db->join('transport_details', 'transport_details.Transport_dtl_id = daily_moment_details.Daily_mvnt_dtl_trp_name', 'left');
		$this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		 $fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to'))
        {
			// start check DAily Movement date
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
        	// end  check DAily Movement date
			
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
        $this->db->where("daily_moment_details.Daily_mvnt_dtl_trp_name", $id);
		$this->db->where("daily_moment_details.Daily_mvnt_dtl_transport_type", "O");
		$this->db->where("daily_moment_details.Daily_mvnt_dtl_transport_pay_status", "U");
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
		$query = $this->db->get();
        return $query;	
	}
	// end view movement payment details in view option
	// start view movement payment details in view option
	function get_movement_payment_paid($id)
	{ 
		$this->db->select('daily_moment_details.*, transport_details.*,driver_pay_rate.Driver_pay_rate_place_name, party_billing.Party_billing_container_no, vehicle_details.Vehicle_dtl_id, vehicle_details.Vehicle_dtl_number');
        $this->db->from('daily_moment_details'); 
		$this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left');
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left'); 
        $this->db->join('transport_details', 'transport_details.Transport_dtl_id = daily_moment_details.Daily_mvnt_dtl_trp_name', 'left');
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
			
        }
         $this->db->where("daily_moment_details.Daily_mvnt_dtl_trp_name", $id);
		$this->db->where("daily_moment_details.Daily_mvnt_dtl_transport_type", "O");
		$this->db->where("daily_moment_details.Daily_mvnt_dtl_transport_pay_status", "P");
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
		//$this->db->limit(1);
		$query = $this->db->get(); 	
		//echo $this->db->last_query(); exit;		                      
        return $query;	
	}
	// end view movement payment details in view option
	
	// start view iso movement payment details in unpaid
	function iso_movement_payment_unpaid($id)
	{
		$this->db->select('iso_movement_details.*');
        $this->db->from('iso_movement_details');
		$fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to'))
        {
			// start check iso Movement date
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')==null))
        	{	
        		//$this->db->where('vehicle_document_details.Vehicle_doc_dtl_m_permit_from="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from')))).'"');
        		$i_date = '(iso_movement_details.Iso_mvnt_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'")';
        		$fnl_where[]=$i_date;
        	}
        	if(($this->input->post('m_date_from')== null) && ($this->input->post('m_date_to')!=null))
        	{        		
        		$i_date = '(iso_movement_details.Iso_mvnt_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$i_date;
        	}
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')!=null))
        	{	
        		$i_date = '(iso_movement_details.Iso_mvnt_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'" AND Iso_mvnt_date <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$i_date;
        	}
        	// end  check iso Movement date
			
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
		
        $this->db->where("iso_movement_details.Iso_mvnt_transport_name", $id);
		$this->db->where("iso_movement_details.Iso_mvnt_vehicle_type", "O");
		$this->db->where("iso_movement_details.Iso_mvnt_paid_status", "U");
		$this->db->order_by("iso_movement_details.Iso_mvnt_id", "DESC");
		$query = $this->db->get();
		//echo $this->db->last_query(); exit; 			                      
        return $query;	
	}
	// end view movement payment details in view option
	
	// start view iso movement payment details in Paid
	function iso_movement_payment_paid($id)
	{
		$this->db->select('iso_movement_details.*');
        $this->db->from('iso_movement_details');
		$fnl_where=array();       
        if($this->input->post('m_date_from')||$this->input->post('m_date_to'))
        {
			// start check iso Movement date
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')==null))
        	{	
        		//$this->db->where('vehicle_document_details.Vehicle_doc_dtl_m_permit_from="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from')))).'"');
        		$i_date = '(iso_movement_details.Iso_mvnt_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'")';
        		$fnl_where[]=$i_date;
        	}
        	if(($this->input->post('m_date_from')== null) && ($this->input->post('m_date_to')!=null))
        	{        		
        		$i_date = '(iso_movement_details.Iso_mvnt_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$i_date;
        	}
        	if(($this->input->post('m_date_from')!= null) && ($this->input->post('m_date_to')!=null))
        	{	
        		$i_date = '(iso_movement_details.Iso_mvnt_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_from')))).'" AND Iso_mvnt_date <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_date_to')))).'")';
        		$fnl_where[]=$i_date;
        	}
        	// end  check iso Movement date
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
		
        $this->db->where("iso_movement_details.Iso_mvnt_transport_name", $id);
		$this->db->where("iso_movement_details.Iso_mvnt_vehicle_type", "O");
		$this->db->where("iso_movement_details.Iso_mvnt_paid_status", "P");
		$this->db->order_by("iso_movement_details.Iso_mvnt_id", "DESC");
		$query = $this->db->get();
		//echo $this->db->last_query(); exit; 			                      
        return $query;	
	}
	// end view movement payment details Paid
	
	function delete_transport_payment()
	{	 
	    $this->db->where('Transport_payment_trans_name', $this->input->get('id'));
        $this->db->delete('transport_payment');
	    return true;	  
	}
		
	
	
	// end view movement payment details in view option
  
}

?>