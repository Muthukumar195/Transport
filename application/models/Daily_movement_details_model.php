<?php
Class Daily_movement_details_model extends CI_Model
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
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC"); 			
        $query = $this->db->get();               
        return $query;		
	}  
	function read_daily_movement_details($id)
	{
		$this->db->select('daily_moment_details.*, vehicle_details.Vehicle_dtl_number, driver_pay_rate.Driver_pay_rate_place_name, driver_pay_rate.Driver_pay_rate_diesel_rate, party_details.Party_dtl_name, driver_details.Driver_dtl_name, container_details.Container_dtl_container_no, driver_payment_details.	Driver_pymnt_pay_date,driver_payment_details.Driver_pymnt_pay_status,driver_payment_details.Driver_pymnt_remarks, party_payment.Party_payment_pay_date,party_payment.Party_payment_party_name,party_payment.Party_payment_pay_status,party_payment.	Party_payment_paid_amount,transport_details.Transport_dtl_name,party_billing.Party_billing_container_no');
        $this->db->from('daily_moment_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left'); 
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left'); 
        $this->db->join('party_details', 'party_details.Party_dtl_id = daily_moment_details.Daily_mvnt_dtl_party_name', 'left'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
        $this->db->join('container_details', 'container_details.Container_dtl_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		$this->db->join('driver_payment_details', 'driver_payment_details.Driver_pymnt_di_driver_name = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
		$this->db->join('party_payment', 'party_payment.Party_payment_party_name = daily_moment_details.Daily_mvnt_dtl_party_name', 'left');
		 $this->db->join('transport_details', 'transport_details.Transport_dtl_id = daily_moment_details.Daily_mvnt_dtl_trp_name', 'left'); 
		 $this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left'); 
        $this->db->where("daily_moment_details.Daily_mvnt_dtl_id", $id);
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_id", "DESC");
		$this->db->limit(1);
		 
        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
		
        return $query;
			
	}
	function add_daily_movement_details($id)
	{  
		$this->db->select('*');
        $this->db->from('driver_pay_rate'); 		
		$this->db->where('Driver_pay_rate_id',$id); 		
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        $fnl_res=$query->result();
        $fnl_res_amount=$fnl_res[0]->Driver_pay_rate_amount;
		$dsl_ltr = $fnl_res[0]->Driver_pay_rate_diesel_ltr;
		$dsl_rate = $fnl_res[0]->Driver_pay_rate_diesel_rate;
		$crnt_dsl_rate = $this->input->post('diesel_rate');
		if(empty($crnt_dsl_rate)==false){
			if($dsl_rate < $crnt_dsl_rate){
				$inc_rate = intval($crnt_dsl_rate)-intval($dsl_rate);
				$new_rate = intval($inc_rate)*intval($dsl_ltr);
				$fnl_res_amount = intval($new_rate)+intval($fnl_res_amount);
			}
			elseif($dsl_rate > $crnt_dsl_rate){
				
				$dec_rate = intval($dsl_rate)-intval($crnt_dsl_rate);
				$new_rate = intval($dec_rate)*intval($dsl_ltr);
				$fnl_res_amount = intval($fnl_res_amount)-intval($new_rate);
			}
		}
		else{
			$fnl_res_amount=$fnl_res[0]->Driver_pay_rate_amount;
		}
		if(empty($crnt_dsl_rate)==true){
			$dis_status = "D";
		}
		else{
			$dis_status = "N";
		}
        $driver_tp = intval($fnl_res_amount)+intval($this->input->post('other_expenses'));  
        $this->input->post('rent'); 
        $profit= intval($this->input->post('rent'))-intval($driver_tp);       
        if($this->input->post('transport_type')=="T"){ $vehicle = $this->input->post('vehicle_no'); }else{ $vehicle = $this->input->post('other_vehicle'); }
		$user_data = array(
			'Daily_mvnt_dtl_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('daily_movement_date')))),
			'Daily_mvnt_dtl_transport_type' => $this->input->post('transport_type'),	
			'Daily_mvnt_dtl_vehicle_no' => $vehicle,
			//'Daily_mvnt_dtl_other_vehicle_no'=>$this->input->post('other_vehicle'),
			'Daily_mvnt_dtl_container_type'=>$this->input->post('container_type'),
			'Daily_mvnt_dtl_container_no' => $this->input->post('container_no'),
			'Daily_mvnt_dtl_new_container_no'=>$this->input->post('new_con_no'),
			'Daily_mvnt_dtl_place' => $this->input->post('place_name'),
			'Daily_mvnt_dtl_pickup_place' => $this->input->post('pick_up'),
			'Daily_mvnt_dtl_drop_place' => $this->input->post('drop'),
			'Daily_mvnt_dtl_loading_status' => $this->input->post('loading_status'),
			'Daily_mvnt_dtl_party_name' => $this->input->post('party_name'),
			'Daily_mvnt_dtl_party_adv' => $this->input->post('party_advance'),
			'Daily_mvnt_dtl_driver_name' => $this->input->post('driver_name'),
			'Daily_mvnt_dtl_advance' => $this->input->post('driver_advance'),
			'Daily_mvnt_dtl_trp_name' => $this->input->post('transport_name'),
			'Daily_mvnt_dtl_trp_adv' => $this->input->post('transport_advance'),
			'Daily_mvnt_dtl_trp_rent' => $this->input->post('transport_rent'),
			'Daily_mvnt_dtl_driver_basic_pay' => $fnl_res_amount,
			'Daily_mvnt_dtl_driver_total_pay' => $driver_tp,
			'Daily_mvnt_dtl_diesel_rate' => $crnt_dsl_rate,
			'Daily_mvnt_dtl_diesel_rate_status' => $dis_status,
			'Daily_mvnt_dtl_party_mamul' => $this->input->post('party_mamul'),
			'Daily_mvnt_dtl_rent' => $this->input->post('rent'),
			'Daily_mvnt_dtl_profit' => $profit
		);	
		$this->db->set('Daily_mvnt_dtl_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('daily_moment_details', $user_data);			
		return true;		
	}  	
	function edit_daily_movement_details($id, $place_name)
	{
		$this->db->select('*');
        $this->db->from('driver_pay_rate'); 		
		$this->db->where('Driver_pay_rate_id',$place_name); 		
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        $fnl_res=$query->result();
        $fnl_res_amount=$fnl_res[0]->Driver_pay_rate_amount;
		$dsl_ltr = $fnl_res[0]->Driver_pay_rate_diesel_ltr;
		$dsl_rate = $fnl_res[0]->Driver_pay_rate_diesel_rate;
		$crnt_dsl_rate = $this->input->post('diesel_rate');
		if(empty($crnt_dsl_rate)==false){
			if($dsl_rate < $crnt_dsl_rate){
				$inc_rate = intval($crnt_dsl_rate)-intval($dsl_rate);
				$new_rate = intval($inc_rate)*intval($dsl_ltr);
				$fnl_res_amount = intval($new_rate)+intval($fnl_res_amount);
			}
			elseif($dsl_rate > $crnt_dsl_rate){
				
				$dec_rate = intval($dsl_rate)-intval($crnt_dsl_rate);
				$new_rate = intval($dec_rate)*intval($dsl_ltr);
				$fnl_res_amount = intval($fnl_res_amount)-intval($new_rate);
			}
		}
		else{
			$fnl_res_amount=$fnl_res[0]->Driver_pay_rate_amount;
		}
		if(empty($crnt_dsl_rate)==true){
			$dis_status = "D";
		}
		else{
			$dis_status = "N";
		}
        $driver_tp = intval($fnl_res_amount)+intval($this->input->post('other_expenses'));  
        $this->input->post('rent'); 
        $profit= intval($this->input->post('rent'))-intval($driver_tp);
		if($this->input->post('transport_type')=="T"){ $vehicle = $this->input->post('vehicle_no'); }else{ $vehicle = $this->input->post('other_vehicle'); }
		$user_data = array(
			'Daily_mvnt_dtl_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('daily_movement_date')))),
			'Daily_mvnt_dtl_transport_type' => $this->input->post('transport_type'),	
			'Daily_mvnt_dtl_vehicle_no' => $vehicle,
			//'Daily_mvnt_dtl_other_vehicle_no'=>$this->input->post('other_vehicle'),
			'Daily_mvnt_dtl_container_type'=>$this->input->post('container_type'),
			'Daily_mvnt_dtl_container_no' => $this->input->post('container_no'),
			'Daily_mvnt_dtl_new_container_no'=>$this->input->post('new_con_no'),
			'Daily_mvnt_dtl_place' => $this->input->post('place_name'),
			'Daily_mvnt_dtl_pickup_place' => $this->input->post('pick_up'),
			'Daily_mvnt_dtl_drop_place' => $this->input->post('drop'),
			'Daily_mvnt_dtl_loading_status' => $this->input->post('loading_status'),
			'Daily_mvnt_dtl_party_name' => $this->input->post('party_name'),
			'Daily_mvnt_dtl_party_adv' => $this->input->post('party_advance'),
			'Daily_mvnt_dtl_driver_name' => $this->input->post('driver_name'),
			'Daily_mvnt_dtl_advance' => $this->input->post('driver_advance'),
			'Daily_mvnt_dtl_trp_name' => $this->input->post('transport_name'),
			'Daily_mvnt_dtl_trp_adv' => $this->input->post('transport_advance'),
			'Daily_mvnt_dtl_trp_rent' => $this->input->post('transport_rent'),
			'Daily_mvnt_dtl_driver_basic_pay' => $fnl_res_amount,
			'Daily_mvnt_dtl_driver_total_pay' => $driver_tp,
			'Daily_mvnt_dtl_diesel_rate' => $crnt_dsl_rate,
			'Daily_mvnt_dtl_diesel_rate_status' => $dis_status,
			'Daily_mvnt_dtl_party_mamul' => $this->input->post('party_mamul'),
			'Daily_mvnt_dtl_rent' => $this->input->post('rent'),
			'Daily_mvnt_dtl_profit' => $profit
		);
		$this->db->set('Daily_mvnt_dtl_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Daily_mvnt_dtl_id',$id);
		$this->db->update('daily_moment_details',$user_data);
	   //echo $this->db->last_query(); exit;
		return true;
	}
	function approve_daily_movement()
	{
		$data=array('Daily_mvnt_dtl_status'=>'A');
		$this->db->where('Daily_mvnt_dtl_id',$this->input->get('id'));
		$this->db->update('daily_moment_details',$data);
		return true;	 
	} 
	function deny_daily_movement()
	{
		$data=array('Daily_mvnt_dtl_status'=>'D');
		$this->db->where('Daily_mvnt_dtl_id',$this->input->get('id'));
		$this->db->update('daily_moment_details',$data);
		return true;	 
	}
	// start Party Payment paid and unpaid status
	function paid_daily_movement($daily_id)
	{
		$data=array('Daily_mvnt_dtl_party_pay_status'=>'P');
		$this->db->set('Daily_mvnt_dtl_party_pay_date', 'NOW()', FALSE);
		$this->db->where_in('Daily_mvnt_dtl_id',$daily_id);
		$this->db->update('daily_moment_details',$data);
		//echo $this->db->last_query(); exit;
		return true;	 
	} 
	function unpaid_daily_movement()
	{
	
		$data=array('Daily_mvnt_dtl_party_pay_status'=>'U');
		$this->db->where('Daily_mvnt_dtl_id',$this->input->get('id'));
		$this->db->update('daily_moment_details',$data);
		return true;	 
	}
	// End Party Payment paid and unpaid status
	
	// start driver_paid_daily_movement
	function driver_paid_daily_movement($daily_id)
	{
		$data=array('Daily_mvnt_dtl_driver_pay_status'=>'P');
		$this->db->set('Daily_mvnt_dtl_driver_pay_date', 'NOW()', FALSE);
		$this->db->where_in('Daily_mvnt_dtl_id',$daily_id);
		$this->db->update('daily_moment_details',$data);
		//echo $this->db->last_query(); exit;
		return true;	 
	} 
	
	// start Transport Payment paid and unpaid status
	function transport_paid_daily_movement($daily_id)
	{
		$data=array('Daily_mvnt_dtl_transport_pay_status'=>'P');
		$this->db->where_in('Daily_mvnt_dtl_id',$daily_id);
		$this->db->update('daily_moment_details',$data);
		//echo $this->db->last_query(); exit;
		return true;	 
	} 
	function transport_unpaid_daily_movement()
	{
	
		$data=array('Daily_mvnt_dtl_transport_pay_status'=>'U');
		$this->db->where('Daily_mvnt_dtl_id',$this->input->get('id'));
		$this->db->update('daily_moment_details',$data);
		return true;	 
	}
	// end Transport Payment paid and unpaid status
	function delete_daily_movement()
	{
	   $this->db->where('Daily_mvnt_dtl_id',$this->input->get('id'));
       $this->db->delete('daily_moment_details');
	   return true;
	}	
	function daily_movement_count()
	{
		$this->db->select('Daily_mvnt_dtl_id');
		$this->db->from('daily_moment_details');
		$query = $this->db->get();
		return $query->num_rows();
	}
	// start latest daily movement details for dashboard
	function latest_daily_movement_details()
	{
		$this->db->select('daily_moment_details.*, vehicle_details.Vehicle_dtl_number, vehicle_details.Vehicle_dtl_id, driver_pay_rate.Driver_pay_rate_place_name, party_details.Party_dtl_name, driver_details.Driver_dtl_name, container_details.Container_dtl_container_no,party_billing.Party_billing_container_no');
        $this->db->from('daily_moment_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = daily_moment_details.Daily_mvnt_dtl_vehicle_no', 'left'); 
        $this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = daily_moment_details.Daily_mvnt_dtl_place', 'left'); 
        $this->db->join('party_details', 'party_details.Party_dtl_id = daily_moment_details.Daily_mvnt_dtl_party_name', 'left'); 	
        $this->db->join('driver_details', 'driver_details.Driver_dtl_id = daily_moment_details.Daily_mvnt_dtl_driver_name', 'left');
        $this->db->join('container_details', 'container_details.Container_dtl_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left');
		$this->db->join('party_billing', 'party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no', 'left'); 
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_id", "DESC"); 
		$this->db->limit(10);			
        $query = $this->db->get();               
        return $query;	
	}
	// end latest daily movement details for dashboard
	// start search daily_movement list
	function search_daily_movement_list()
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
        if($this->input->post('daily_movement_date')||$this->input->post('vehicle_no')||$this->input->post('container_no')||$this->input->post('place_name')||$this->input->post('party_name')||$this->input->post('driver_name')||$this->input->post('party_pay_date')||$this->input->post('party_pay_status')||$this->input->post('driver_pay_date')||$this->input->post('driver_pay_status')||$this->input->post('rent')||$this->input->post('loading_status')||$this->input->post('tp_name'))
        {
			// start check daily_movement_date
        	if($this->input->post('daily_movement_date')!= null)
        	{	
        		$daily_movement_date = '(Daily_mvnt_dtl_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('daily_movement_date')))).'")';
				$fnl_where[]=$daily_movement_date;
        		
        	}
        	// end check daily_movement_date
			// start check vehicle number
        	if($this->input->post('vehicle_no')!= null)
        	{	        		
        		$vehicle_no = '(vehicle_details.Vehicle_dtl_number LIKE "%'.$this->input->post('vehicle_no').'%")';
        		$fnl_where[]=$vehicle_no;
        	}        	
        	// end check vehicle number
			// start check container number
        	if($this->input->post('container_no')!= null)
        	{	        		
        		$container_no = '(container_details.Container_dtl_container_no LIKE "%'.$this->input->post('container_no').'%")';
        		$fnl_where[]=$container_no;
        	}        	
        	// end check container number
			// start check place_name
        	if($this->input->post('place_name')!= null)
        	{	        		
        		$place_name = '(driver_pay_rate.Driver_pay_rate_place_name LIKE "%'.$this->input->post('place_name').'%")';
        		$fnl_where[]=$place_name;
        	}        	
        	// end check place_name
			// start check party name 
        	if($this->input->post('party_name')!= null)
        	{	        		
        		$party_name = '(party_details.Party_dtl_name LIKE "%'.$this->input->post('party_name').'%")';
        		$fnl_where[]=$party_name;
        	}        	
        	// end check party name
			// start check driver_name 
        	if($this->input->post('driver_name')!= null)
        	{	        		
        		$driver_name = '(driver_details.Driver_dtl_name LIKE "%'.$this->input->post('driver_name').'%")';
        		$fnl_where[]=$driver_name;
        	}        	
        	// end check driver_name
			// start check rent  
			if($this->input->post('rent')!= null)
        	{	        		
        		$rent = '(daily_moment_details.Daily_mvnt_dtl_rent LIKE "%'.$this->input->post('rent').'%")';
        		$fnl_where[]=$rent;
        	}        	
        	// end check rent 
			
		
        	// start check load status        	
        	if($this->input->post('loading_status')!= null)
        	{	
        		$daily_movement_date = '(daily_moment_details.Daily_mvnt_dtl_loading_status ="'.$this->input->post('loading_status').'")';
				$fnl_where[]=$daily_movement_date;
        		
        	} 
        	// end check load status
			// start check Transport Name         	
        	if($this->input->post('tp_name')!= null)
        	{	
        		$tp_name = '(daily_moment_details.Daily_mvnt_dtl_trp_name ="'.$this->input->post('tp_name').'")';
				$fnl_where[]=$tp_name;
        		
        	} 
        	// end check Transport Name        

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
      
        //$this->db->order_by('Daily_mvnt_dtl_id', 'DESC');
		$this->db->order_by("daily_moment_details.Daily_mvnt_dtl_date", "DESC");
		
		
        $query = $this->db->get();
        $this->db->last_query();            
        return $query;
	}
	// end daily_movement list
	function get_daily_movement_list($movement_id)
	{ 
	   //echo $movement_id; exit;
		$this->db->select('*');
        $this->db->from('daily_moment_details');
		$this->db->where('Daily_mvnt_dtl_id',$movement_id);
        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query;
	}
	function get_daily_movement_driver_list($driver_name)
	{ 
	   //echo $movement_id; exit;
		$this->db->select('*');
        $this->db->from('daily_moment_details');
		$this->db->where('Daily_mvnt_dtl_driver_name',$driver_name); 
        $query = $this->db->get();
		return $query;
	}
	function add_other_expenses($id)
	{
		$user_data = array(
			'Daily_mvnt_dtl_driver_remark' => $this->input->post('o_ex_remark'),
			'Daily_mvnt_dtl_other_expences' => $this->input->post('other_expences'),
		);
		$this->db->where('Daily_mvnt_dtl_id',$id);
		$this->db->update('daily_moment_details',$user_data);
		//$this->db->last_query();
		return true;
		
	}
	
	function add_transport_expenses($id)
	{
		$user_data = array(
			'Daily_mvnt_dtl_trp_sum' => $this->input->post('sum'),
			'Daily_mvnt_dtl_trp_expences' => $this->input->post('trans_expences'),
			'Daily_mvnt_dtl_trp_exp_remark' => $this->input->post('trans_ex_remark'),
		);
		$this->db->where('Daily_mvnt_dtl_id',$id);
		$this->db->update('daily_moment_details',$user_data);
		//$this->db->last_query();
		return true;
		
	}
	
}
?>