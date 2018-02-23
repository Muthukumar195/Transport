<?php
Class Container_details_model extends CI_Model
{ 
	function container_details_list()
	{
		$this->db->select('*');
        $this->db->from('container_details'); 		
		$this->db->order_by("Container_dtl_id", "DESC");	 
		//$this->db->limit(8);
        $query = $this->db->get();               
        return $query;		
	}  

	
	function add_container_details()
	{
		$user_data = array(
			'Container_dtl_container_no' => $this->input->post('container_number'),
			'Container_dtl_size' => $this->input->post('container_size'),
						
		);	
		$this->db->set('Container_dtl_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('container_details', $user_data);			
		return true;		
	}  
	function get_container_details($id)
	{  
		$this->db->select('*');
        $this->db->from('container_details');
		$this->db->where('Container_dtl_id',$id);
        $query = $this->db->get(); 
        $this->db->last_query(); 
        return $query;
	}

	function edit_container_details($id)
	{
		$data=array('Container_dtl_container_no'=>$this->input->post('container_number'), 'Container_dtl_size'=>$this->input->post('container_size'));
		$this->db->set('Container_dtl_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Container_dtl_id',$id);
		$this->db->update('container_details',$data);
		return true;
	}
	function approve_container()
	{
		$data=array('Container_dtl_status'=>'A');
		$this->db->where('Container_dtl_id',$this->input->get('id'));
		$this->db->update('container_details',$data);
		return true;	 
	} 
	function deny_container()
	{
		$data=array('Container_dtl_status'=>'D');
		$this->db->where('Container_dtl_id',$this->input->get('id'));
		$this->db->update('container_details',$data);
		return true;	 
	}
	function delete_container()
	{
	  $this->db->select('Daily_mvnt_dtl_container_no');
	  $this->db->from('daily_moment_details');
	  $this->db->where('Daily_mvnt_dtl_container_no', $this->input->get('id'));
	  $query = $this->db->get();
	  if($query->num_rows()>0)
	  {
	  	$chk_exist='y';
	  }
	  $where = '(Iso_mvnt_container_no="'.$this->input->get('id').'" OR Iso_mvnt_container_no2="'.$this->input->get('id').'")';
	  $this->db->select('Iso_mvnt_container_no');
	  $this->db->from('iso_movement_details');
	  $this->db->where($where);
	  $query = $this->db->get();
	  if($query->num_rows()>0)
	  {
	  	$chk_exist='y';
	  }

	  if($chk_exist!='y')
	  {
	    $this->db->where('Container_dtl_id', $this->input->get('id'));
        $this->db->delete('container_details');
	    return true;
	  }
	  else
	  {
	  	return FALSE;
	  }

	}
	
	
	// start display container number list
 	function container_number_list()
	{		
        $this->db->select('Container_dtl_id, Container_dtl_container_no,Container_dtl_size');
        $this->db->from('container_details'); 		
		$this->db->where("Container_dtl_status", "A"); 
		$this->db->order_by("Container_dtl_container_no", "ASC");
        $query = $this->db->get();
        return $query;	
	}
	// end display container number list
	
	// start ajax check container number
	function ajax_check_con_num($con_num)
	{
		$this->db->select('Container_dtl_container_no');
		$this->db->from('container_details');
		$this->db->where('Container_dtl_container_no',$con_num);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	// end ajax check container number
	function container_count()
	{
		$this->db->select('Container_dtl_id');
		$this->db->from('container_details');
		$query = $this->db->get();
		return $query->num_rows();
	}
	function search_container_list()
	{
		$this->db->select('*');
		$this->db->from('container_details');         
        if($this->input->post('container_number')||$this->input->post('container_type'))
        {
        	if(($this->input->post('container_number')!= null) && ($this->input->post('container_type')==null))
        	{        		
        		$this->db->where('Container_dtl_container_no LIKE "%'.$this->input->post('container_number').'%"');
        	}
        	if(($this->input->post('container_number')== null) && ($this->input->post('container_type')!=null))
        	{        		
        		$this->db->where('Container_dtl_size', $this->input->post('container_type'));
        	}
        	if(($this->input->post('container_number')!= null) && ($this->input->post('container_type')!=null))
        	{        		
        		$this->db->where('Container_dtl_container_no LIKE "%'.$this->input->post('container_number').'%" AND Container_dtl_size="'.$this->input->post('container_type').'"');
        	}       	
        }    
        $this->db->order_by('Container_dtl_id', 'DESC');
		
		//$this->db->query("SELECT * FROM driver_details ".$whr_cntn." ORDER BY Driver_dtl_id DESC");
        $query = $this->db->get();
        $this->db->last_query();                
        return $query;
	}
	
		
}
?>