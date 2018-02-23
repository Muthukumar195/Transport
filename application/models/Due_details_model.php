<?php
Class Due_details_model extends CI_Model
{
 	function due_details_list()
	{
		$this->db->select('vehicle_due_details.*, vehicle_details.Vehicle_dtl_id, vehicle_details.Vehicle_dtl_number');
        $this->db->from('vehicle_due_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id=vehicle_due_details.Vehicle_due_dtl_vehicle_no', 'left');
		$this->db->order_by("vehicle_due_details.Vehicle_due_dtl_id", "DESC");
		$this->db->group_by("vehicle_due_details.Vehicle_due_dtl_vehicle_no");		
        $query = $this->db->get(); 
		              
        return $query;		 
	} 
	function add_due_details()
	{
		$start    = new DateTime($this->input->post('due_date'));
		$start->modify($this->input->post('due_date'));
		$end      = new DateTime($this->input->post('mutual_date'));
		$end->modify($this->input->post('mutual_date'));
		$interval = DateInterval::createFromDateString('30 DAY');
		$period   = new DatePeriod($start, $interval, $end);
									
		foreach ($period as $dt) {
		$all_date = $dt->format("Y-m-d");
		//$all_date .= ',';	
			
		$user_data = array(
			'Vehicle_due_dtl_vehicle_no' => $this->input->post('vehicle_number'),
			'Vehicle_due_dtl_due_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('due_date')))),
			'Vehicle_due_dtl_mutual_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('mutual_date')))),
			'Vehicle_due_dtl_amount' => $this->input->post('due_amount'),
			'Vehicle_due_dtl_pay_date' => $all_date
		);
			
		$this->db->set('Vehicle_due_dtl_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('vehicle_due_details', $user_data);
		}
		 //exit;
		return true;		
	}  
	function get_due_details($id)
	{		
		$this->db->select('*');
        $this->db->from('vehicle_due_details'); 		
		$this->db->where('Vehicle_due_dtl_id',$id); 
        $query = $this->db->get(); 
        //$this->db->last_query(); 
        return $query;		 
	}		
	function edit_due_details($id)
	{
		$start    = new DateTime($this->input->post('due_date'));
		$start->modify($this->input->post('due_date'));
		$end      = new DateTime($this->input->post('mutual_date'));
		$end->modify($this->input->post('mutual_date'));
		$interval = DateInterval::createFromDateString('30 DAY');
		$period   = new DatePeriod($start, $interval, $end);
									
		foreach ($period as $dt) {
		$all_date = $dt->format("Y-m-d");
		//$all_date .= ',';	
		
		$data=array('Vehicle_due_dtl_vehicle_no'=>$this->input->post('vehicle_number'), 'Vehicle_due_dtl_due_date'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('due_date')))),'Vehicle_due_dtl_mutual_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('mutual_date')))), 'Vehicle_due_dtl_amount'=>$this->input->post('due_amount'),'Vehicle_due_dtl_pay_date' => $all_date);
		$this->db->set('Vehicle_due_dtl_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Vehicle_due_dtl_id',$id);
		$this->db->update('vehicle_due_details',$data);
		echo $this->db->last_query(); exit();
		}
		return true;
		
	}
	// Start Due Paid Date
	function add_due_amount($id)
	{
		$data=array('Vehicle_due_pay_status'=>$this->input->post('paid_status'),'Vehicle_due_dtl_paid_date'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('paid_date')))));
		$this->db->set('Vehicle_due_dtl_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Vehicle_due_dtl_id',$id);
		$this->db->update('vehicle_due_details',$data);
		//echo $this->db->last_query(); exit();
		return true;
	}
	// Start End Paid Date
	function approve_due()
	{
		$data=array('Vehicle_due_dtl_status'=>'A');
		$this->db->where('Vehicle_due_dtl_vehicle_no',$this->input->get('id'));
		$this->db->update('vehicle_due_details',$data);
		return true;	 
	} 
	function deny_due()
	{
		$data=array('Vehicle_due_dtl_status'=>'D');
		$this->db->where('Vehicle_due_dtl_vehicle_no',$this->input->get('id'));
		$this->db->update('vehicle_due_details',$data);
		return true;	 
	}
	function delete_due($id)
	{ 	  
	  $this->db->where('Vehicle_due_dtl_vehicle_no',$id);  
      $this->db->delete('vehicle_due_details'); 
      return true;	   
	}
	
	

	// start search_due_report
	function search_due_report()
	{	
		$this->db->select('vehicle_due_details.*, vehicle_details.Vehicle_dtl_id, vehicle_details.Vehicle_dtl_number');
        $this->db->from('vehicle_due_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id=vehicle_due_details.Vehicle_due_dtl_vehicle_no', 'left');        
       $fnl_where=array();      
        if($this->input->post('vehicle_number')||$this->input->post('due_date')||$this->input->post('due_amount')||$this->input->post('mutual_date')||$this->input->post('up_coming_due'))
        {
			// start check vehicle number
        	if($this->input->post('vehicle_number')!= null)
        	{	        		
        		$vehicle_number = '(vehicle_details.Vehicle_dtl_number LIKE "%'.$this->input->post('vehicle_number').'%")';
        		$fnl_where[]=$vehicle_number;
        	}        	
        	// end check vehicle number
			// start check due_date
        	if($this->input->post('due_date')!= null)
        	{	
        		$due_date = '(vehicle_due_details.Vehicle_due_dtl_due_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('due_date')))).'")';
				$fnl_where[]=$due_date;
        		
        	}
        	// end check due_date
			// start check Due amount
        	if($this->input->post('due_amount')!= null)
        	{	        		
        		$due_amount = '(vehicle_due_details.Vehicle_due_dtl_amount LIKE "%'.$this->input->post('due_amount').'%")';
        		$fnl_where[]=$due_amount;
        	}        	
        	// end check Due amount
			// start check pay date
        	if($this->input->post('pay_date')!= null)
        	{	
        		$pay_date = '(vehicle_due_details.Vehicle_due_dtl_pay_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pay_date')))).'")';
				$fnl_where[]=$pay_date;
        		
        	}
        	// end check pay date
			// start check paid date
        	if($this->input->post('paid_date')!= null)
        	{	
        		$paid_date = '(vehicle_due_details.Vehicle_due_dtl_paid_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('paid_date')))).'")';
				$fnl_where[]=$paid_date;
        		
        	}
        	// end check paid date
			// start check upcoming month due
        	if($this->input->post('up_coming_due')==1)
        	{
				$up_coming_due = '(vehicle_due_details.Vehicle_due_dtl_pay_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY))';
        		$fnl_where[]=$up_coming_due;
        	}
        	// end check upcoming month due
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
		$this->db->where("vehicle_due_details.Vehicle_due_pay_status","U");
		$this->db->group_by("vehicle_due_details.Vehicle_due_dtl_vehicle_no");
        $this->db->order_by("vehicle_due_details.Vehicle_due_dtl_id", "DESC");		
        $query = $this->db->get();               
        return $query;
	}
	// end search due report
	function view_due_details($id)
	{		
		$this->db->select('*');
        $this->db->from('vehicle_due_details');
		$this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id=vehicle_due_details.Vehicle_due_dtl_vehicle_no', 'left');
		$this->db->where('vehicle_due_details.Vehicle_due_dtl_vehicle_no',$id); 
        $query = $this->db->get();
		//echo $this->db->last_query(); exit();
        //$this->db->last_query();		 
        return $query;		 
	}
	function paid_date_list($id)
	{
		$this->db->select('vehicle_due_details.*, vehicle_details.Vehicle_dtl_id, vehicle_details.Vehicle_dtl_number');
        $this->db->from('vehicle_due_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id=vehicle_due_details.Vehicle_due_dtl_vehicle_no', 'left');
		$this->db->where("vehicle_due_details.Vehicle_due_dtl_id", $id);
				
        $query = $this->db->get(); 
		              
        return $query;		 
	} 	

	// start upcoming month due count
	function upcoming_month_due_count()
	{
		$this->db->select('vehicle_due_details.Vehicle_due_dtl_id AS due_count,vehicle_due_details.Vehicle_due_dtl_due_date,vehicle_due_details.Vehicle_due_dtl_pay_date,vehicle_due_details.	Vehicle_due_pay_status');
        $this->db->from('vehicle_due_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id=vehicle_due_details.Vehicle_due_dtl_vehicle_no', 'left');        
		$this->db->where('(vehicle_due_details.Vehicle_due_dtl_pay_date BETWEEN NOW() - INTERVAL 15 DAY AND NOW())');
		$this->db->where("vehicle_due_details.Vehicle_due_pay_status", "U");
		$this->db->or_where('(vehicle_due_details.Vehicle_due_dtl_pay_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY))');		
		$query = $this->db->get(); //echo $this->db->last_query(); exit;
        return $query->num_rows();  
        
		               
	}
	// end upcoming month due count
	// start upcoming month due records
	function upcoming_due_report()
	{
		$this->db->select('*');
        $this->db->from('vehicle_due_details');
		$this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id=vehicle_due_details.Vehicle_due_dtl_vehicle_no', 'left');
		$this->db->where('(vehicle_due_details.Vehicle_due_dtl_pay_date BETWEEN NOW() - INTERVAL 15 DAY AND NOW())');
		$this->db->or_where('(vehicle_due_details.Vehicle_due_dtl_pay_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY))');
		$this->db->where("vehicle_due_details.Vehicle_due_pay_status","U");
		$this->db->order_by("vehicle_due_details.Vehicle_due_dtl_id", "ASC");
        $query = $this->db->get();
		
		//echo $this->db->last_query(); exit();
		
        return $query;    
	}
	
	
}
?>