<?php
Class Iso_movement_details_model extends CI_Model
{
 	function iso_movement_details_list()
	{
		$this->db->select('*,cod.Container_dtl_container_no as continer1,cod2.Container_dtl_container_no as continer2');
        $this->db->from('iso_movement_details');
        $this->db->join('vehicle_details','vehicle_details.Vehicle_dtl_id = iso_movement_details.Iso_mvnt_vehicle_no','left');
	    $this->db->join('container_details as cod','cod.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no','left');
		$this->db->join('container_details as cod2','cod2.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no2','left');
		
		$this->db->join('transport_details','transport_details.Transport_dtl_id = iso_movement_details.	Iso_mvnt_transport_name','left');
		$this->db->order_by("Iso_mvnt_id","DESC");
	    $query=$this->db->get();
	    return $query; 
	}
	
	function add_iso_movement_details()
	{
		if($this->input->post('transport_name')==""){ $transport = ""; }else{ $transport =$this->input->post('transport_name'); }
		$user_data = array(
			'Iso_mvnt_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('iso_date')))),
			'Iso_mvnt_vehicle_type' => $this->input->post('transport_type'),
			'Iso_mvnt_vehicle_no' => $this->input->post('vehicle_no'),
			'Iso_mvnt_other_vehicle_no'=>$this->input->post('other_vehicle'),
			'Iso_mvnt_container_type' => $this->input->post('container_feet'),
			'Iso_mvnt_container_no' =>$this->input->post('container_f'),
			'Iso_mvnt_container_no2' =>$this->input->post('container_t'),
			'Iso_mvnt_ey_lo' => $this->input->post('ey_lo'),
			'Iso_mvnt_im_ex' => $this->input->post('im_ex'),
			'Iso_mvnt_pickup_place' => $this->input->post('pick_up'),
			'Iso_mvnt_drop_place' => $this->input->post('drop'),
			'Iso_mvnt_loading_status' => $this->input->post('loading_status'),
			'Iso_mvnt_from' => $this->input->post('iso_from'),
			'Iso_mvnt_to' => $this->input->post('iso_to'),
			'Iso_mvnt_load_drop'=>$this->input->post('load_drop'),
			'Iso_mvnt_transport_name' => $transport,
			'Iso_mvnt_tp_amount' => $this->input->post('tp_amount'),
			'Iso_mvnt_amount' => $this->input->post('iso_amount')
		);	
		$this->db->set('Iso_mvnt_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('iso_movement_details', $user_data);			
		return true;		
	}  
	function get_iso_movement_details($id)
	{	
		$this->db->select('*');
        $this->db->from('iso_movement_details'); 		
		$this->db->where('Iso_mvnt_id',$id); 
        $query = $this->db->get(); 
        $this->db->last_query(); 
        return $query;		 
	}	
	function edit_iso_movement_details($id)
	{ 
			$data=array(
			'Iso_mvnt_date'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('iso_date')))),
		    'Iso_mvnt_vehicle_no'=>$this->input->post('vehicle_no'),
			'Iso_mvnt_container_type'=>$this->input->post('container_feet'),
			'Iso_mvnt_container_no'=>$this->input->post('container_f'),
		    'Iso_mvnt_container_no2'=>$this->input->post('container_t'),
		    'Iso_mvnt_ey_lo'=>$this->input->post('ey_lo'),
			'Iso_mvnt_im_ex' => $this->input->post('im_ex'),
			'Iso_mvnt_pickup_place' => $this->input->post('pick_up'),
			'Iso_mvnt_drop_place' => $this->input->post('drop'),
			'Iso_mvnt_loading_status' => $this->input->post('loading_status'),
			'Iso_mvnt_from'=>$this->input->post('iso_from'),
			'Iso_mvnt_to'=>$this->input->post('iso_to'),
			'Iso_mvnt_load_drop'=>$this->input->post('load_drop'),
			'Iso_mvnt_transport_name'=>$this->input->post('transport_name'),
			'Iso_mvnt_tp_amount' => $this->input->post('tp_amount'),
			'Iso_mvnt_amount'=>$this->input->post('iso_amount'),
			);
		$this->db->set('Iso_mvnt_created_dt_time', 'NOW()');	
		$this->db->where('Iso_mvnt_id',$id);
		$this->db->update('iso_movement_details',$data);
		return true;
	}
	function approve_iso_movement_details()
	{
		$data=array('Iso_mvnt_status'=>'A');
		$this->db->where('Iso_mvnt_id',$this->input->get('id'));
		$this->db->update('iso_movement_details',$data);
		return true;	 
	} 
	function deny_iso_movement_details()
	{
		$data=array('Iso_mvnt_status'=>'D');
		$this->db->where('Iso_mvnt_id',$this->input->get('id'));
		$this->db->update('iso_movement_details',$data);
		return true;	 
	}
	function delete_iso_movement_details()
	{
	   $this->db->where('Iso_mvnt_id', $this->input->get('id'));
       $this->db->delete('iso_movement_details');
	   return true;
	}
	function view_iso_movement_details_list($id)
	{
		$this->db->select('*,cod.Container_dtl_container_no as continer1,cod2.Container_dtl_container_no as continer2');
        $this->db->from('iso_movement_details');
        $this->db->join('vehicle_details','vehicle_details.Vehicle_dtl_id = iso_movement_details.Iso_mvnt_vehicle_no','left');
	    $this->db->join('container_details as cod','cod.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no','left');
		$this->db->join('container_details as cod2','cod2.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no2','left');
		
		$this->db->join('transport_details','transport_details.Transport_dtl_id = iso_movement_details.	Iso_mvnt_transport_name','left');
		$this->db->order_by("Iso_mvnt_id","DESC");
		$this->db->where('Iso_mvnt_id',$id); 
	    $query=$this->db->get();
	    return $query; 
	}
	function iso_movement_count()
	{
		$this->db->select('Iso_mvnt_id');
		$this->db->from('iso_movement_details');
		$query = $this->db->get();
		return $query->num_rows();
	}
	function latest_iso_movement_details()
	{
		$this->db->select('*,cod.Container_dtl_container_no as continer1,cod2.Container_dtl_container_no as continer2');
        $this->db->from('iso_movement_details');
        $this->db->join('vehicle_details','vehicle_details.Vehicle_dtl_id = iso_movement_details.Iso_mvnt_vehicle_no','left');
	    $this->db->join('container_details as cod','cod.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no','left');
		$this->db->join('container_details as cod2','cod2.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no2','left');
		
		$this->db->join('transport_details','transport_details.Transport_dtl_id = iso_movement_details.	Iso_mvnt_transport_name','left');
		$this->db->limit(10);
		$this->db->order_by("Iso_mvnt_id","DESC");
	    $query=$this->db->get();
	    return $query; 
	}
	function search_iso_movement_report()
	{
		$this->db->select('*,cod.Container_dtl_container_no as continer1,cod2.Container_dtl_container_no as continer2');
        $this->db->from('iso_movement_details');
        $this->db->join('vehicle_details','vehicle_details.Vehicle_dtl_id = iso_movement_details.Iso_mvnt_vehicle_no','left');
	    $this->db->join('container_details as cod','cod.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no','left');
		$this->db->join('container_details as cod2','cod2.Container_dtl_id  = iso_movement_details.Iso_mvnt_container_no2','left');
		
		$this->db->join('transport_details','transport_details.Transport_dtl_id = iso_movement_details.	Iso_mvnt_transport_name','left');
		$fnl_where=array();      
        if($this->input->post('iso_date')||$this->input->post('vehicle_no')||$this->input->post('container_size')||$this->input->post('container_no')||$this->input->post('from')||$this->input->post('to')||$this->input->post('ey_lo')||$this->input->post('transport_name')||$this->input->post('amount')||$this->input->post('im_ex')||$this->input->post('loading_status')||$this->input->post('tp_amount'))
        {
			// start check iso_date
        	if($this->input->post('iso_date')!= null)
        	{	
        		$iso_date = '(iso_movement_details.Iso_mvnt_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('iso_date')))).'")';
				$fnl_where[]=$iso_date;
        		
        	}
        	// end check iso_date
			// start check vehicle number
        	if($this->input->post('vehicle_no')!= null)
        	{	        		
        		$vehicle_no = '(vehicle_details.Vehicle_dtl_number LIKE "%'.$this->input->post('vehicle_no').'%")';
        		$fnl_where[]=$vehicle_no;
        	}        	
        	// end check vehicle number
			// start check container size
        	if($this->input->post('container_size')!= null)
        	{	        		
        		$container_size = '(iso_movement_details.Iso_mvnt_container_type LIKE "%'.$this->input->post('container_size').'%")';
        		$fnl_where[]=$container_size;
        	}        	
        	// end check container size
			// start check ey_lo'
			if($this->input->post('ey_lo')!= null)
        	{	        		
        		$ey_lo = '(iso_movement_details.Iso_mvnt_ey_lo LIKE "%'.$this->input->post('ey_lo').'%")';
        		$fnl_where[]=$ey_lo;
        	}        	
        	// end check ey_lo'
			// start check Import & Export'
			if($this->input->post('im_ex')!= null)
        	{	        		
        		$im_ex = '(iso_movement_details.Iso_mvnt_im_ex LIKE "%'.$this->input->post('im_ex').'%")';
        		$fnl_where[]=$im_ex;
        	}        	
        	// end check Import & Export'
			// start check container number
        	if($this->input->post('container_no')!= null)
        	{	        		
        		$container_no = '(cod.Container_dtl_container_no LIKE "%'.$this->input->post('container_no').'%")';
        		$fnl_where[]=$container_no;
        	}        	
        	// end check container number
			// start check from
        	if($this->input->post('from')!= null)
        	{	        		
        		$from = '(iso_movement_details.Iso_mvnt_from LIKE "%'.$this->input->post('from').'%")';
        		$fnl_where[]=$from;
        	}        	
        	// start check to'
			if($this->input->post('to')!= null)
        	{	        		
        		$to = '(iso_movement_details.Iso_mvnt_to LIKE "%'.$this->input->post('to').'%")';
        		$fnl_where[]=$to;
        	}        	
        	// end check to'
			
			
			// start check transport_name'
			if($this->input->post('transport_name')!= null)
        	{	        		
        		$transport_name = '(transport_details.Transport_dtl_name LIKE "%'.$this->input->post('transport_name').'%")';
        		$fnl_where[]=$transport_name;
        	}        	
        	// end check transport_name'
			
			// start Transport amount'
			if($this->input->post('tp_amount')!= null)
        	{	        		
        		$tp_amount = '(iso_movement_details.Iso_mvnt_tp_amount LIKE "%'.$this->input->post('tp_amount').'%")';
        		$fnl_where[]=$tp_amount;
        	}        	
        	// end Transport amount''
			// start check amount'
			if($this->input->post('amount')!= null)
        	{	        		
        		$amount = '(iso_movement_details.Iso_mvnt_amount LIKE "%'.$this->input->post('amount').'%")';
        		$fnl_where[]=$amount;
        	}        	
        	// end check amount'
			// start check paid_date'
			if($this->input->post('paid_date')!= null)
        	{	        		
        		$paid_date = '(iso_movement_details.Iso_mvnt_paid_date LIKE "%'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('paid_date')))).'")';
        		$fnl_where[]=$paid_date;
        	}        	
        	// end check paid_date'
			// start check Load status
        	if($this->input->post('loading_status')!= null)
        	{		
        		$loading_status =  '(iso_movement_details.Iso_mvnt_loading_status ="'.$this->input->post('loading_status').'")';
        		$fnl_where[]=$loading_status;
        	}        	
        	// end  check Load status
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
		$this->db->order_by("Iso_mvnt_id","DESC");
	    $query=$this->db->get();
	    return $query; 
	}
	//Transport Payment status change 
	function transport_paid_iso_movement($iso_id){
		
		$data=array('Iso_mvnt_paid_status'=>"P");
		$this->db->where_in('Iso_mvnt_id',$iso_id);
		$this->db->update('iso_movement_details',$data);
		//echo $this->db->last_query(); exit;
		return true;
		
	}
}
?>