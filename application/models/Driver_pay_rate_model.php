<?php
Class Driver_pay_rate_model extends CI_Model
{
 	function driver_pay_rate_list()
	{
		$this->db->select('*');
        $this->db->from('driver_pay_rate'); 		
		$this->db->order_by("Driver_pay_rate_id", "DESC");	 
		//$this->db->limit(8);
        $query = $this->db->get();               
        return $query;	
	}  
	function add_driver_pay_rate()
	{
		$user_data = array(
			'Driver_pay_rate_place_name' => $this->input->post('place_name'),
			'Driver_pay_rate_amount' => $this->input->post('driver_amount'),
			'Driver_pay_rate_diesel_ltr' => $this->input->post('diesel_ltr'),
			'Driver_pay_rate_diesel_rate' => $this->input->post('diesel_rate'),				
		);	
		$this->db->set('Driver_pay_rate_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('driver_pay_rate', $user_data);			
		return true;		
	}  
	function get_driver_pay_rate($id)
	{		
		$this->db->select('*');
        $this->db->from('driver_pay_rate'); 		
		$this->db->where('Driver_pay_rate_id',$id); 
        $query = $this->db->get(); 
        $this->db->last_query(); 
        return $query;		 
	}
	function edit_deriver_pay_rate($id)
	{
		//echo $id; exit;
		$data=array('Driver_pay_rate_place_name'=>$this->input->post('place_name'), 'Driver_pay_rate_amount'=>$this->input->post('driver_amount'),'Driver_pay_rate_diesel_ltr' => $this->input->post('diesel_ltr'), 'Driver_pay_rate_diesel_rate' => $this->input->post('diesel_rate'));
		$this->db->set('Driver_pay_rate_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Driver_pay_rate_id',$id);
		$this->db->update('driver_pay_rate',$data);
		//echo $this->db->last_query(); exit;
		return true;
	}
	function approve_driver_pay_rate()
	{
		$data=array('Driver_pay_rate_status'=>'A');
		$this->db->where('Driver_pay_rate_id',$this->input->get('id'));
		$this->db->update('driver_pay_rate',$data);
		return true;	 
	} 
	function deny_driver_pay_rate()
	{
		$data=array('Driver_pay_rate_status'=>'D');
		$this->db->where('Driver_pay_rate_id',$this->input->get('id'));
		$this->db->update('driver_pay_rate',$data);
		return true;	 
	}
	function delete_driver_pay_rate()
	{
		$this->db->select('Daily_mvnt_dtl_place');
	    $this->db->from('daily_moment_details');
	    $this->db->where('Daily_mvnt_dtl_place', $this->input->get('id'));
	    $query = $this->db->get();
	    $chk_exist='n';
	    if($query->num_rows()>0)
	    {
	  	  $chk_exist='y';
	    }

	    if($chk_exist!='y')
	    {
	      $this->db->where('Driver_pay_rate_id', $this->input->get('id'));
          $this->db->delete('driver_pay_rate');
	      return true;
	  	}
	  	else
	  	{
	  		return FALSE;
	  	}

	}	
	// start display place name list
	function place_name_list()
	{
		$this->db->select('Driver_pay_rate_id, Driver_pay_rate_place_name');
        $this->db->from('driver_pay_rate'); 		
		$this->db->where("Driver_pay_rate_status", "A"); 
		$this->db->order_by("Driver_pay_rate_place_name", "ASC");
        $query = $this->db->get();
        return $query;	
	}
	// end display place name list

	function driver_pay_rate_count()
	{
		$this->db->select('Driver_pay_rate_id');
		$this->db->from('driver_pay_rate');
		$query = $this->db->get();
		return $query->num_rows();	
	}
	function check_ajax_driver_place($place)
	{
		$this->db->select('Driver_pay_rate_id,Driver_pay_rate_place_name');
		$this->db->from('driver_pay_rate');
		$this->db->where('Driver_pay_rate_place_name',$place);
		$query=$this->db->get();
		if($query->num_rows() >0)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	
}
?>