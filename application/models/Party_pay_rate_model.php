<?php
Class Party_pay_rate_model extends CI_Model
{ 
 	function party_pay_rate_list()
	{ 
		$this->db->select('party_pay_rate.*, driver_pay_rate.Driver_pay_rate_place_name, party_details.Party_dtl_name');
		$this->db->from('party_pay_rate');
		$this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = party_pay_rate.party_pay_rate_place', 'left');
		$this->db->join('party_details', 'party_details.Party_dtl_id = party_pay_rate.party_pay_rate_party', 'left');
		$this->db->order_by('party_pay_rate.party_pay_rate_id', 'desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query;
	}  
	function get_party_pay_rate($id)
	{
		$this->db->select('party_pay_rate.*, party_details.Party_dtl_name');
		$this->db->from('party_pay_rate');
		$this->db->where('party_pay_rate_id', $id);
		$this->db->join('party_details','party_details.Party_dtl_id  = party_pay_rate.party_pay_rate_party', 'left');
		$this->db->order_by('party_pay_rate.party_pay_rate_crt_date_time', 'desc');
		$query = $this->db->get();
		return $query;
			
	}
	function add_party_pay_rate()
	{  
		$user_data = array(
			'party_pay_rate_place' => $this->input->post('place_name'),
			'party_pay_rate_party' => $this->input->post('party_name'),
			'party_pay_rate_ot_rent' => $this->input->post('ot_rent'),
			'party_pay_rate_rent' => $this->input->post('rent'),
		);	
		$this->db->set('party_pay_rate_crt_date_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('party_pay_rate', $user_data);			
		return true;		
	}  	
	function edit_party_pay_rate($id)
	{
        //echo $this->db->last_query(); exit; 
		$user_data = array(
			//'Daily_mvnt_dtl_other_vehicle_no'=>$this->input->post('other_vehicle'),
			'party_pay_rate_place'=>$this->input->post('place_name'),
			'party_pay_rate_party'=>$this->input->post('party_name'),
			'party_pay_rate_ot_rent'=>$this->input->post('ot_rent'),
			'party_pay_rate_rent'=>$this->input->post('rent'),
		);
		$this->db->set('party_pay_rate_crt_date_time', 'NOW()', FALSE);	
		$this->db->where('party_pay_rate_id',$id);
		$this->db->update('party_pay_rate',$user_data);
	   //echo $this->db->last_query(); exit;
		return true;
	}
	function approve_party_pay_rate()
	{
		$data=array('party_pay_rate_status'=>'A');
		$this->db->where('party_pay_rate_id',$this->input->get('id'));
		$this->db->update('party_pay_rate',$data);
		return true;	 
	} 
	function deny_party_pay_rate()
	{
		$data=array('party_pay_rate_status'=>'D');
		$this->db->where('party_pay_rate_id',$this->input->get('id'));
		$this->db->update('party_pay_rate',$data);
		return true;	 
	}
	
	function delete_party_pay_rate()
	{
	   $this->db->where('party_pay_rate_id',$this->input->get('id'));
       $this->db->delete('party_pay_rate');
	   return true;
	}	
	function party_name_list(){
		$this->db->select('party_pay_rate.*, party_details.Party_dtl_name');
		$this->db->from('party_pay_rate');
		$this->db->join('party_details', 'party_details.Party_dtl_id = party_pay_rate.party_pay_rate_party', 'left');
		$this->db->where("party_pay_rate_status", "A");
		$this->db->order_by("party_pay_rate_party", "ASC");
		$query = $this->db->get();
		return $query;
	}
	// start display place name list
	function place_name_list($party_name)
	{
		$this->db->select('party_pay_rate.*, driver_pay_rate.Driver_pay_rate_place_name');
        $this->db->from('party_pay_rate');
		$this->db->join('driver_pay_rate', 'driver_pay_rate.Driver_pay_rate_id = party_pay_rate.party_pay_rate_place', 'left'); 
		$this->db->where('party_pay_rate_party',$party_name);
		$this->db->where("party_pay_rate_status", "A");
		$this->db->order_by("party_pay_rate_place", "ASC");
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query;	
	}
	// end display place name list

	// start ajax_check_rent
	function ajax_check_rent($place_name)
	{
		$this->db->select('party_pay_rate_rent');
        $this->db->from('party_pay_rate');
		$this->db->where('party_pay_rate_id',$place_name);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query;	
	}
	// end ajax_check_rent

	function party_pay_rate_count()
	{
		$this->db->select('party_pay_rate_id');
		$this->db->from('party_pay_rate');
		$query = $this->db->get();
		return $query->num_rows();
	}
	function party_rent($id,$party_id){
		
		$query = $this->db->get_where('party_pay_rate', array('party_pay_rate_place' => $id, 'party_pay_rate_party' => $party_id));
		//echo $this->db->last_query(); exit; 
		return $query;
	}
	function check_already_exits($place,$party){
	
		$query = $this->db->get_where('party_pay_rate', array('party_pay_rate_place' => $place, 'party_pay_rate_party' => $party));
		$row = $query->num_rows();
		if($row==1){
			return 1;
		}
		else{
			return 0;
		}
		
	}
	
	
}
?>