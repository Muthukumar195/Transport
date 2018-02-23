<?php
Class Party_billing_model extends CI_Model
{
 	function party_billing_list()
	{
		$this->db->select('*');
        $this->db->from('party_billing');
		$this->db->join('party_details','party_details.Party_dtl_id = party_billing.Party_billing_party_name','left');
		$this->db->group_by('party_billing.Party_billing_party_name');
		$this->db->order_by("Party_billing_id", "DESC");
		//$this->db->limit(8);
        $query = $this->db->get();               
        return $query;		
	} 
	function add_party_billing()
	{
		$user_data = array(
			'Party_billing_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('billing_date')))),
			'Party_billing_party_name' => $this->input->post('party_name'),
			'Party_billing_container_no' => $this->input->post('container_no'),
			'Party_billing_consignee' => $this->input->post('consignee'),
			'Party_billing_consignor' => $this->input->post('consignor'),
			'Party_billing_material' => $this->input->post('material'),
			'Party_billing_ini_no' => $this->input->post('int_no'),
			'Party_billing_from' => $this->input->post('billing_from'),
			'Party_billing_to' => $this->input->post('billing_to'),
			'Party_billing_empty' => $this->input->post('empty'),
			'Party_billing_cni_no' => $this->input->post('cns_no'),
			'Party_billing_bill_recd_dt' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('bill_res_date')))),
			'Party_billing_train_no' => $this->input->post('train_no'),
			'Party_billing_ph_no' => $this->input->post('phone_no'),
			'Party_billing_ey_valid_dt' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ey_date')))),
			'Party_billing_ul_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ul_date')))),
			'Party_billing_last_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('last_date')))),
			'Party_billing_remark' => $this->input->post('billing_remark')
		);	
		$this->db->set('Party_billing_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('party_billing', $user_data);
		//echo $insert; exit;			
		return true;		
	}
	
	function get_party_billing($id)
	{		
		$this->db->select('*');
        $this->db->from('party_billing');
		$this->db->where('Party_billing_id',$id); 
        $query = $this->db->get();
		//echo $this->db->last_query(); exit();
        //$this->db->last_query();
		 
        return $query;		 
	}	
	function edit_party_billing($id)
	{
		$data=array('Party_billing_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('billing_date')))),			'Party_billing_party_name' => $this->input->post('party_name'),'Party_billing_container_no' => $this->input->post('container_no'),'Party_billing_consignee' => $this->input->post('consignee'),'Party_billing_consignor' => $this->input->post('consignor'),			'Party_billing_material' => $this->input->post('material'),'Party_billing_ini_no' => $this->input->post('int_no'),'Party_billing_from' => $this->input->post('billing_from'),'Party_billing_to' => $this->input->post('billing_to'),'Party_billing_empty' => $this->input->post('empty'),'Party_billing_cni_no' => $this->input->post('cns_no'),'Party_billing_bill_recd_dt' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('bill_res_date')))),'Party_billing_train_no' => $this->input->post('train_no'),			'Party_billing_ph_no' => $this->input->post('phone_no'),'Party_billing_ey_valid_dt' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ey_date')))),'Party_billing_ul_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ul_date')))),'Party_billing_last_date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('last_date')))),	'Party_billing_remark' => $this->input->post('billing_remark'));
		$this->db->set('Party_billing_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Party_billing_id',$id);
		$this->db->update('party_billing',$data);
		//echo $this->db->last_query(); exit;
		return true;
	}
	function approve_party_billing()
	{
		$data=array('Party_billing_status'=>'A');
		$this->db->where('Party_billing_id',$this->input->get('id'));
		$this->db->update('party_billing',$data);
		return true;	 
	} 
	function deny_party_billing()
	{
		$data=array('Party_billing_status'=>'D');
		$this->db->where('Party_billing_id',$this->input->get('id'));
		$this->db->update('party_billing',$data);
		return true;	 
	}
	function delete_party_billing()
	{
	    $this->db->where('Party_billing_id', $this->input->get('id'));
        $this->db->delete('party_billing');
	    return true;
	}
	function get_container_list($party_name)
	{
		$this->db->select('*');
			$this->db->from('daily_moment_details');
			$this->db->join('party_billing','party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no','left');
			$this->db->where('Party_billing_party_name',$party_name);
			$query = $this->db->get();
			$match_id="";
			foreach($query->result() as $row){
				
				$match_id.= $row->Daily_mvnt_dtl_container_no .","; 
			}
			  $final_match_id=trim(substr($match_id,0,-1));
			  $dj_genres_array = explode(",", $final_match_id);
			  
				$this->db->select('party_billing.*,daily_moment_details.Daily_mvnt_dtl_container_no,');
				$this->db->from('party_billing');
				$this->db->join('daily_moment_details','party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no','left');
				$this->db->where_not_in('party_billing.Party_billing_id', $dj_genres_array); 
				$this->db->where('Party_billing_party_name',$party_name);
				$query = $this->db->get();
				return $query;
	}
	function get_party_billing_details($id)
	{		
		//$this->db->select('daily_moment_details.Daily_mvnt_dtl_container_no,party_billing.Party_billing_id');
		//$this->db->from('party_billing');
		//$this->db->join('daily_moment_details','daily_moment_details.Daily_mvnt_dtl_container_no != party_billing.Party_billing_id');
		//$this->db->where('party_billing.Party_billing_party_name',$id);
		//$query = $this->db->get();
		//$numrow=$query->num_rows();
		//if($numrow>0)
		//{
			$this->db->select('*');
			$this->db->from('daily_moment_details');
			$this->db->join('party_billing','party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no','left');
			$this->db->where('Party_billing_party_name',$id);
			$query = $this->db->get();
			$match_id="";
			foreach($query->result() as $row){
				
				$match_id.= $row->Daily_mvnt_dtl_container_no .","; 
			}
			  $final_match_id=trim(substr($match_id,0,-1));
			  $dj_genres_array = explode(",", $final_match_id);
			  
				$this->db->select('party_billing.*,daily_moment_details.Daily_mvnt_dtl_container_no,');
				$this->db->from('party_billing');
				$this->db->join('daily_moment_details','party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no','left');
				$this->db->where_not_in('party_billing.Party_billing_id', $dj_genres_array); 
				$this->db->where('Party_billing_party_name',$id);
				$query = $this->db->get();
				return $query;
		//}
		/*else
		{	
			$this->db->select('*');
			$this->db->from('party_billing');
			$this->db->where('Party_billing_party_name',$id);
			$query = $this->db->get();
			return $query;
		} */
	}
	function get_movement_billing_details($id)
	{
		$this->db->select('*');
        $this->db->from('daily_moment_details');
		$this->db->join('party_billing','party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no','left');
		$this->db->where('Party_billing_party_name',$id);
        $query = $this->db->get();
        return $query;
	}
	
	function read_billing_details($id)
	{		
		$this->db->select('*');
        $this->db->from('party_billing');
		$this->db->join('party_details','party_details.Party_dtl_id = party_billing.Party_billing_party_name','left');
		$this->db->where('Party_billing_id',$id); 
        $query = $this->db->get();
		//echo $this->db->last_query(); exit();
        		 
        return $query;		 
	}
	//Start PArty Billing Report
	function Search_party_billing()
	{
		$this->db->select('*');
        $this->db->from('party_billing');
		$this->db->join('party_details','party_details.Party_dtl_id = party_billing.Party_billing_party_name','left');
		$fnl_where=array();   
        if($this->input->post('billing_date')||$this->input->post('party_name')||$this->input->post('container_no')||$this->input->post('material')||$this->input->post('consignee')||$this->input->post('consignor')||$this->input->post('int_no')||$this->input->post('billing_from')||$this->input->post('billing_to'))
        {
			// start check _date
        	if($this->input->post('billing_date')!= null)
        	{	
        		$billing_date = '(party_billing.Party_billing_date ="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('billing_date')))).'")';
				$fnl_where[]=$billing_date;
        		
        	}
        	// end check date
			// start check party name 
        	if($this->input->post('party_name')!= null)
        	{	        		
        		$party_name = '(party_billing.Party_billing_party_name LIKE "%'.$this->input->post('party_name').'%")';
        		$fnl_where[]=$party_name;
        	}        	
        	// end check party name
			// start check container number
        	if($this->input->post('container_no')!= null)
        	{	        		
        		$container_no = '(party_billing.Party_billing_container_no LIKE "%'.$this->input->post('container_no').'%")';
        		$fnl_where[]=$container_no;
        	}        	
        	// end check container number
			// start check material
        	if($this->input->post('material')!= null)
        	{	        		
        		$material = '(party_billing.Party_billing_material LIKE "%'.$this->input->post('material').'%")';
        		$fnl_where[]=$material;
        	}        	
        	// end check material
			
			// start check consignee 
        	if($this->input->post('consignee')!= null)
        	{	        		
        		$consignee = '(party_billing.Party_billing_consignee LIKE "%'.$this->input->post('consignee').'%")';
        		$fnl_where[]=$consignee;
        	}        	
        	// end check consignee
			// start check consignor  
			if($this->input->post('consignor')!= null)
        	{	        		
        		$consignor = '(party_billing.Party_billing_consignor LIKE "%'.$this->input->post('consignor').'%")';
        		$fnl_where[]=$consignor;
        	}        	
        	// end check consignor 
			
		
        	// start check int_no     	
        	if($this->input->post('int_no')!= null)
        	{	
        		$int_no = '(party_billing.Party_billing_ini_no LIKE "%'.$this->input->post('int_no').'%")';
				$fnl_where[]=$int_no;
        		
        	} 
        	// end check int_no
			// start check billing_from     	
        	if($this->input->post('billing_from')!= null)
        	{	
        		$billing_from = '(party_billing.Party_billing_from LIKE "%'.$this->input->post('billing_from').'%")';
				$fnl_where[]=$billing_from;
        		
        	} 
        	// end check billing_from 
			// start check billing to     	
        	if($this->input->post('billing_to')!= null)
        	{	
        		$billing_to = '(party_billing.Party_billing_to LIKE "%'.$this->input->post('billing_to').'%")';
				$fnl_where[]=$billing_to;
        		
        	} 
        	// end check billing_to 

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
      
        $this->db->order_by('Party_billing_id', 'DESC');
		
		
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;            
        return $query;		
	} 	
	//EndPArty Billing Report
	// start display party name list
	function party_name_list()
	{
		$this->db->select('Party_dtl_id, Party_dtl_name');
        $this->db->from('party_details'); 		
		$this->db->where("Party_dtl_status", "A"); 
		$this->db->order_by("Party_dtl_name", "ASC");
        $query = $this->db->get();
        return $query;
	}
	// end display party name list
	
	//start Party Container Number
	function container_number_list(){
		
		$this->db->select('Party_billing_id, Party_billing_container_no');
        $this->db->from('party_billing'); 
		$this->db->order_by("Party_billing_id", "ASC");
        $query = $this->db->get();
        return $query;
		
	}
	//End Party Container Number
	
	function party_billing_count()
	{
		/*$this->db->select('Party_billing_id');
		$this->db->from('party_billing');
		$query = $this->db->get();
		*/
		$this->db->select('*');
			$this->db->from('daily_moment_details');
			$this->db->join('party_billing','party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no','left');
			$query = $this->db->get();
			$match_id="";
			foreach($query->result() as $row){
				
				$match_id.= $row->Daily_mvnt_dtl_container_no .","; 
			}
			  $final_match_id=trim(substr($match_id,0,-1));
			  $dj_genres_array = explode(",", $final_match_id);
			  
				$this->db->select('party_billing.*,daily_moment_details.Daily_mvnt_dtl_container_no,');
				$this->db->from('party_billing');
				$this->db->join('daily_moment_details','party_billing.Party_billing_id = daily_moment_details.Daily_mvnt_dtl_container_no','left');
				$this->db->where_not_in('party_billing.Party_billing_id', $dj_genres_array); 
				$query = $this->db->get();
				return $query->num_rows();
	}
	
}
?>