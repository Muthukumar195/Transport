<?php
class Profit_model extends CI_Model
{ 
 	function daily_movement_details_list()  
	{ 
		$this->db->select('daily_moment_details.*, vehicle_details.Vehicle_dtl_number, vehicle_details.Vehicle_dtl_id, driver_pay_rate.Driver_pay_rate_place_name, party_details.Party_dtl_name, driver_details.Driver_dtl_name, container_details.Container_dtl_container_no,party_billing.Party_billing_container_no, transport_details.Transport_dtl_id, transport_details.Transport_dtl_name');
        $this->db->from('daily_moment_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left'); 
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left'); 
        $this->db->join('party_details', 'party_details.Party_dtl_id = daily_moment_details.Daily_mvnt_dtl_party_name', 'left'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
        $this->db->join('container_details', 'container_details.Container_dtl_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		 $this->db->join('transport_details', 'transport_details.Transport_dtl_id = daily_moment_details.Daily_mvnt_dtl_trp_name', 'left'); 
		 $this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left'); 
		
		 $fnl_where=array();       
        if($this->input->post('from_date')||$this->input->post('to_date')||$this->input->post('transport')||$this->input->post('driver')||$this->input->post('party')||$this->input->post('place')||$this->input->post('veh_no')||$this->input->post('trans_type'))
        { //echo 'sdfsdaf'; exit;
			// start check daily movement date
        	if(($this->input->post('from_date')!= null) && ($this->input->post('to_date')==null))
        	{
        		$daily_mvnt = '(daily_moment_details.Daily_mvnt_dtl_date >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('from_date')))).'")';
        		$fnl_where[]=$daily_mvnt;
        	}
        	if(($this->input->post('from_date')== null) && ($this->input->post('to_date')!=null))
        	{        		
        		$daily_mvnt = '(daily_moment_details.Daily_mvnt_dtl_date <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('to_date')))).'")';
        		$fnl_where[]=$daily_mvnt;
        	}
        	if(($this->input->post('from_date')!= null) && ($this->input->post('from_date')!=null))
        	{	
        		$daily_mvnt = '(daily_moment_details.Daily_mvnt_dtl_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('from_date')))).'" AND Daily_mvnt_dtl_date <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('to_date')))).'")';
        		$fnl_where[]=$daily_mvnt;
        	}
        	// end check daily movement date
			//transport search
			if($this->input->post('transport')!=null){
				$trans = '(daily_moment_details.Daily_mvnt_dtl_trp_name ='.$this->input->post('transport').')';
				$fnl_where[]=$trans;
			}
			//driver search
			if($this->input->post('driver')!=null){
				$driver = '(daily_moment_details.Daily_mvnt_dtl_driver_name ='.$this->input->post('driver').')';
				$fnl_where[]=$driver;
			}
			//party search
			if($this->input->post('party')!=null){
				$party = '(daily_moment_details.Daily_mvnt_dtl_party_name ='.$this->input->post('party').')';
				$fnl_where[]=$party;
			}
			//place search
			if($this->input->post('place')!=null){
				$place = '(daily_moment_details.Daily_mvnt_dtl_place ='.$this->input->post('place').')';
				$fnl_where[]=$place;
			}
			//veh_no search
			if($this->input->post('veh_no')!=null){
					$veh_no = '(daily_moment_details.Daily_mvnt_dtl_vehicle_no ='.$this->input->post('veh_no').')';
					$fnl_where[]=$veh_no;
			}
			//Transport type		
			if($this->input->post('trans_type')!=null){
			
				$trans = '(daily_moment_details.Daily_mvnt_dtl_transport_type ="'.$this->input->post('trans_type').'")';
				$fnl_where[]=$trans;
			}
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
		//$this->db->where('Daily_mvnt_dtl_transport_type', "T");
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC"); 
		//echo $this->db->last_query(); exit;			
        $query = $this->db->get();               
        return $query;		
	} 
	
	function sm_transport_list(){
		$trs = array(13,14);
		$this->db->select('daily_moment_details.*, party_details.Party_dtl_name, driver_details.Driver_dtl_name, transport_details.Transport_dtl_id, transport_details.Transport_dtl_name');
        $this->db->from('daily_moment_details'); 
        $this->db->join('party_details', 'party_details.Party_dtl_id = daily_moment_details.Daily_mvnt_dtl_party_name', 'left'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');      
		$this->db->join('transport_details', 'transport_details.Transport_dtl_id = daily_moment_details.Daily_mvnt_dtl_trp_name', 'left');
		$this->db->where_in('daily_moment_details.Daily_mvnt_dtl_trp_name',$trs);
		$this->db->where('daily_moment_details.Daily_mvnt_dtl_transport_type','O');
		 $fnl_where=array();       
        if($this->input->post('from_date')||$this->input->post('to_date')||$this->input->post('transport')||$this->input->post('driver')||$this->input->post('party')||$this->input->post('place')||$this->input->post('trans_type'))
        { //echo 'sdfsdaf'; exit;
			// start check daily movement date
        	if(($this->input->post('from_date')!= null) && ($this->input->post('to_date')==null))
        	{
        		$daily_mvnt = '(daily_moment_details.Daily_mvnt_dtl_date >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('from_date')))).'")';
        		$fnl_where[]=$daily_mvnt;
        	}
        	if(($this->input->post('from_date')== null) && ($this->input->post('to_date')!=null))
        	{        		
        		$daily_mvnt = '(daily_moment_details.Daily_mvnt_dtl_date <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('to_date')))).'")';
        		$fnl_where[]=$daily_mvnt;
        	}
        	if(($this->input->post('from_date')!= null) && ($this->input->post('from_date')!=null))
        	{	
        		$daily_mvnt = '(daily_moment_details.Daily_mvnt_dtl_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('from_date')))).'" AND Daily_mvnt_dtl_date <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('to_date')))).'")';
        		$fnl_where[]=$daily_mvnt;
        	}
        	// end check daily movement date
			//transport search
			if($this->input->post('transport')!=null){
				$trans = '(daily_moment_details.Daily_mvnt_dtl_trp_name ='.$this->input->post('transport').')';
				$fnl_where[]=$trans;
			}
			//driver search
			if($this->input->post('driver')!=null){
				$driver = '(daily_moment_details.Daily_mvnt_dtl_driver_name ='.$this->input->post('driver').')';
				$fnl_where[]=$driver;
			}
			//party search
			if($this->input->post('party')!=null){
				$party = '(daily_moment_details.Daily_mvnt_dtl_party_name ='.$this->input->post('party').')';
				$fnl_where[]=$party;
			}
			//place search
			if($this->input->post('place')!=null){
				$place = '(daily_moment_details.Daily_mvnt_dtl_place ='.$this->input->post('place').')';
				$fnl_where[]=$place;
			}
				//Transport type		
			if($this->input->post('trans_type')!=null){
			
				$trans = '(daily_moment_details.Daily_mvnt_dtl_transport_type ="'.$this->input->post('trans_type').'")';
				$fnl_where[]=$trans;
			}
                       
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
		
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC"); 
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query;
	}
	
	function iso_movement_details_list()
	{
		$this->db->select('*,cod.Container_dtl_container_no as continer1,cod2.Container_dtl_container_no as continer2');
        $this->db->from('iso_movement_details');
        $this->db->join('vehicle_details','vehicle_details.Vehicle_dtl_id = iso_movement_details.Iso_mvnt_vehicle_no','left');
	    $this->db->join('container_details as cod','cod.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no','left');
		$this->db->join('container_details as cod2','cod2.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no2','left');
		$this->db->join('transport_details','transport_details.Transport_dtl_id = iso_movement_details.	Iso_mvnt_transport_name','left');
		 $fnl_where=array();       
        if($this->input->post('from_date')||$this->input->post('to_date'))
        {
			// start check daily movement date
        	if(($this->input->post('from_date')!= null) && ($this->input->post('to_date')==null))
        	{
        		$daily_mvnt = '(iso_movement_details.Iso_mvnt_date >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('from_date')))).'")';
        		$fnl_where[]=$daily_mvnt;
        	}
        	if(($this->input->post('from_date')== null) && ($this->input->post('to_date')!=null))
        	{        		
        		$daily_mvnt = '(iso_movement_details.Iso_mvnt_date <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('to_date')))).'")';
        		$fnl_where[]=$daily_mvnt;
        	}
        	if(($this->input->post('from_date')!= null) && ($this->input->post('from_date')!=null))
        	{	
        		$daily_mvnt = '(iso_movement_details.Iso_mvnt_date >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('from_date')))).'" AND Iso_mvnt_date <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('to_date')))).'")';
        		$fnl_where[]=$daily_mvnt;
        	}
        	// end check daily movement date
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
		$this->db->order_by("Iso_mvnt_date","DESC");
	    $query=$this->db->get();
	    return $query; 
	} 
	
	
	
}
?>