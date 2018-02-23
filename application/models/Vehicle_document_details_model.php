<?php
Class Vehicle_document_details_model extends CI_Model
{
 	function vehicle_document_details_list()
	{		
		$this->db->select('vehicle_document_details.*, vehicle_details.Vehicle_dtl_id, vehicle_details.Vehicle_dtl_number');
        $this->db->from('vehicle_document_details');
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = vehicle_document_details.Vehicle_doc_dtl_vehicle_no','left'); 
	   $this->db->order_by("Vehicle_doc_dtl_id", "DESC");
       $query = $this->db->get();
	   return $query;
	}
	
	function add_vehicle_document_details()
	{   
		$user_data = array(
			'Vehicle_doc_dtl_vehicle_no' => $this->input->post('vehicle_number'),
			'Vehicle_doc_dtl_m_permit_from' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from')))),
			'Vehicle_doc_dtl_m_permit_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_to')))),
			'Vehicle_doc_dtl_n_permit_from' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('n_permit_from')))),
			'Vehicle_doc_dtl_n_permit_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('n_permit_to')))),
			'Vehicle_doc_dtl_ap_permit_from' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ap_permit_from')))),
			'Vehicle_doc_dtl_ap_permit_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ap_permit_to')))),
			'Vehicle_doc_dtl_insurance_from' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('insurance_from')))),
			'Vehicle_doc_dtl_insurance_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('insurance_to')))),
			'Vehicle_doc_dtl_fc_from' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('fc_from')))),
			'Vehicle_doc_dtl_fc_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('fc_to')))),
			'Vehicle_doc_dtl_tax_from' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('tax_from')))),
			'Vehicle_doc_dtl_tax_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('tax_to')))),
			'Vehicle_doc_dtl_pc_from' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pc_from')))),
			'Vehicle_doc_dtl_pc_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pc_to'))))			
		);	
		$this->db->set('Vehicle_doc_dtl_created_dt_time', 'NOW()', FALSE);	
		$insert=$this->db->insert('vehicle_document_details', $user_data);			
		return true;		
	}  
	function get_vehicle_document_details($id)
	{		
		$this->db->select('*');
        $this->db->from('vehicle_document_details'); 		
		$this->db->where('Vehicle_doc_dtl_id',$id); 
        $query = $this->db->get(); 
        $this->db->last_query(); 
        return $query;		 
	}
	
	function edit_vehicle_document_details($id)
	{
		$data=array(
		'Vehicle_doc_dtl_vehicle_no'=>$this->input->post('vehicle_number'),
	    'Vehicle_doc_dtl_m_permit_from'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from')))),
	    'Vehicle_doc_dtl_m_permit_to'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_to')))),
	    'Vehicle_doc_dtl_n_permit_from'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('n_permit_from')))),
	    'Vehicle_doc_dtl_n_permit_to'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('n_permit_to')))),
		'Vehicle_doc_dtl_ap_permit_from' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ap_permit_from')))),
	    'Vehicle_doc_dtl_ap_permit_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ap_permit_to')))), 
		'Vehicle_doc_dtl_insurance_from'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('insurance_from')))),
	    'Vehicle_doc_dtl_insurance_to'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('insurance_to')))),
		'Vehicle_doc_dtl_fc_from' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('fc_from')))),
	    'Vehicle_doc_dtl_fc_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('fc_to')))),
		'Vehicle_doc_dtl_tax_from'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('tax_from')))),
		'Vehicle_doc_dtl_tax_to'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('tax_to')))),
		'Vehicle_doc_dtl_pc_from' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pc_from')))),
		'Vehicle_doc_dtl_pc_to' =>  date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pc_to'))))
		);
		$this->db->set('Vehicle_doc_dtl_created_dt_time', 'NOW()', FALSE);	
		$this->db->where('Vehicle_doc_dtl_id',$id);
		$this->db->update('vehicle_document_details',$data);
		return true;
	}
	function approve_vehicle_document_details()
	{
		$data=array('Vehicle_doc_dtl_status'=>'A');
		$this->db->where('Vehicle_doc_dtl_id',$this->input->get('id'));
		$this->db->update('vehicle_document_details',$data);
		return true;	 
	} 
	function deny_vehicle_document_details()
	{
		$data=array('Vehicle_doc_dtl_status'=>'D');
		$this->db->where('Vehicle_doc_dtl_id',$this->input->get('id'));
		$this->db->update('vehicle_document_details',$data);
		return true;	 
	}
	function delete_vehicle_document_details()
	{
	   $this->db->where('Vehicle_doc_dtl_id', $this->input->get('id'));
       $this->db->delete('vehicle_document_details');
	   return true;
	}
	
	// start upcoming  Vehicle Document Date count
	function upcoming_document_date_count()
	{
		$this->db->select('vehicle_document_details.*,vehicle_document_details.Vehicle_doc_dtl_id AS vehicle_date_count');
        $this->db->from('vehicle_document_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id=vehicle_document_details.Vehicle_doc_dtl_vehicle_no', 'left');
        $this->db->where('(vehicle_document_details.Vehicle_doc_dtl_m_permit_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW()) OR(vehicle_document_details.Vehicle_doc_dtl_n_permit_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW())  OR                 (vehicle_document_details.Vehicle_doc_dtl_ap_permit_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW())  OR (vehicle_document_details.Vehicle_doc_dtl_insurance_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW()) OR(vehicle_document_details.Vehicle_doc_dtl_fc_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW()) OR (vehicle_document_details.Vehicle_doc_dtl_tax_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW()) OR (vehicle_document_details.Vehicle_doc_dtl_pc_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW())OR (vehicle_document_details.Vehicle_doc_dtl_m_permit_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY)) OR(vehicle_document_details.Vehicle_doc_dtl_n_permit_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY))  OR (vehicle_document_details.Vehicle_doc_dtl_ap_permit_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY))  OR (vehicle_document_details.Vehicle_doc_dtl_insurance_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY)) OR(vehicle_document_details.Vehicle_doc_dtl_fc_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY)) OR (vehicle_document_details.Vehicle_doc_dtl_tax_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY)) OR (vehicle_document_details.Vehicle_doc_dtl_pc_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY))');
//SELECT * FROM vehicle_document_details WHERE Vehicle_doc_dtl_m_permit_to BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
//SELECT * FROM vehicle_document_details WHERE Vehicle_doc_dtl_m_permit_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW()
	
        $query = $this->db->get();  //echo $this->db->last_query(); exit();
        return $query->num_rows();      
	}
	// end upcoming  Vehicle Document Date count
	// start upcoming Vehicle Document records
	function upcoming_vehicle_document_report()
	{
	    $this->db->select('*');
        $this->db->from('vehicle_document_details'); 
        $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id=vehicle_document_details.Vehicle_doc_dtl_vehicle_no', 'left');
        $this->db->where('(vehicle_document_details.Vehicle_doc_dtl_m_permit_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW()) OR(vehicle_document_details.Vehicle_doc_dtl_n_permit_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW())  OR                 (vehicle_document_details.Vehicle_doc_dtl_ap_permit_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW())  OR (vehicle_document_details.Vehicle_doc_dtl_insurance_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW()) OR(vehicle_document_details.Vehicle_doc_dtl_fc_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW()) OR (vehicle_document_details.Vehicle_doc_dtl_tax_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW()) OR (vehicle_document_details.Vehicle_doc_dtl_pc_to BETWEEN NOW() - INTERVAL 15 DAY AND NOW())OR (vehicle_document_details.Vehicle_doc_dtl_m_permit_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY)) OR(vehicle_document_details.Vehicle_doc_dtl_n_permit_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY))  OR (vehicle_document_details.Vehicle_doc_dtl_ap_permit_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY))  OR (vehicle_document_details.Vehicle_doc_dtl_insurance_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY)) OR(vehicle_document_details.Vehicle_doc_dtl_fc_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY)) OR (vehicle_document_details.Vehicle_doc_dtl_tax_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY)) OR (vehicle_document_details.Vehicle_doc_dtl_pc_to BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY))');

        $query = $this->db->get();  //echo $this->db->last_query(); exit();
		//echo $this->db->last_query(); exit();
        return $query;    
	}
	// end upcoming Vehicle Document records
	// start view Vehicle Document details
	function view_vehicle_document_details($id)
	{
		$this->db->select('vehicle_document_details.*,vehicle_details.Vehicle_dtl_number,vehicle_details.Vehicle_dtl_make');
        $this->db->from('vehicle_document_details');
		$this->db->join('vehicle_details','vehicle_details.Vehicle_dtl_id = vehicle_document_details.Vehicle_doc_dtl_vehicle_no');
		$this->db->where('vehicle_document_details.Vehicle_doc_dtl_id',$id);
		$this->db->limit(1);
        $query = $this->db->get();
        return $query;		 
	}
	// end view Vehicle Document details
	function search_vehicle_document_list()
	{
	   $this->db->select('vehicle_document_details.*, vehicle_details.Vehicle_dtl_id, vehicle_details.Vehicle_dtl_number');
       $this->db->from('vehicle_document_details');
       $this->db->join('vehicle_details', 'vehicle_details.Vehicle_dtl_id = vehicle_document_details.Vehicle_doc_dtl_vehicle_no','left');

       //echo date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from'))));
       //echo $this->input->post('m_permit_from');
       $m_permit=''; $fnl_where=array();
        if($this->input->post('m_permit_from')||$this->input->post('m_permit_to')||$this->input->post('n_permit_from')||$this->input->post('n_permit_to')||$this->input->post('ap_permit_from')||$this->input->post('ap_permit_to')||$this->input->post('insurance_from')||$this->input->post('insurance_to')||$this->input->post('fc_from')||$this->input->post('fc_to')||$this->input->post('tax_from')||$this->input->post('tax_to')||$this->input->post('pc_from')||$this->input->post('pc_from')||($this->input->post('Vehicle_number')))
        {
        	// start check m permit
        	if(($this->input->post('m_permit_from')!= null) && ($this->input->post('m_permit_to')==null))
        	{	
        		//$this->db->where('vehicle_document_details.Vehicle_doc_dtl_m_permit_from="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from')))).'"');
        		$m_permit = '(vehicle_document_details.Vehicle_doc_dtl_m_permit_from >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from')))).'")';
        		$fnl_where[]=$m_permit;
        	}
        	if(($this->input->post('m_permit_from')== null) && ($this->input->post('m_permit_to')!=null))
        	{        		
        		$m_permit = '(vehicle_document_details.Vehicle_doc_dtl_m_permit_to <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_to')))).'")';
        		$fnl_where[]=$m_permit;
        	}
        	if(($this->input->post('m_permit_from')!= null) && ($this->input->post('m_permit_to')!=null))
        	{	
        		$m_permit = '(vehicle_document_details.Vehicle_doc_dtl_m_permit_from >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_from')))).'" AND Vehicle_doc_dtl_m_permit_to <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('m_permit_to')))).'")';
        		$fnl_where[]=$m_permit;
        	}
        	// end check m permit

        	// start check n permit
        	if(($this->input->post('n_permit_from')!= null) && ($this->input->post('n_permit_to')==null))
        	{	        		
        		$n_permit = '(vehicle_document_details.Vehicle_doc_dtl_n_permit_from >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('n_permit_from')))).'")';
        		$fnl_where[]=$n_permit;
        	}
        	if(($this->input->post('n_permit_from')== null) && ($this->input->post('n_permit_to')!=null))
        	{        		
        		$n_permit = '(vehicle_document_details.Vehicle_doc_dtl_n_permit_to <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('n_permit_to')))).'")';
        		$fnl_where[]=$n_permit;
        	}
        	if(($this->input->post('n_permit_from')!= null) && ($this->input->post('n_permit_to')!=null))
        	{	
        		$n_permit = '(vehicle_document_details.Vehicle_doc_dtl_n_permit_from >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('n_permit_from')))).'" AND Vehicle_doc_dtl_n_permit_to <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('n_permit_to')))).'")';
        		$fnl_where[]=$n_permit;
        	}
        	// end check n permit
			// start check Ap permit
        	if(($this->input->post('ap_permit_from')!= null) && ($this->input->post('ap_permit_to')==null))
        	{	        		
        		$ap_permit = '(vehicle_document_details.Vehicle_doc_dtl_ap_permit_from >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ap_permit_from')))).'")';
        		$fnl_where[]=$ap_permit;
        	}
        	if(($this->input->post('ap_permit_from')== null) && ($this->input->post('ap_permit_to')!=null))
        	{        		
        		$ap_permit = '(vehicle_document_details.Vehicle_doc_dtl_ap_permit_to <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ap_permit_to')))).'")';
        		$fnl_where[]=$ap_permit;
        	}
        	if(($this->input->post('ap_permit_from')!= null) && ($this->input->post('ap_permit_to')!=null))
        	{	
        		$ap_permit = '(vehicle_document_details.Vehicle_doc_dtl_ap_permit_from >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ap_permit_from')))).'" AND Vehicle_doc_dtl_ap_permit_to <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('ap_permit_to')))).'")';
        		$fnl_where[]=$ap_permit;
        	}
        	// end check AP permit

        	// start check insurance
        	if(($this->input->post('insurance_from')!= null) && ($this->input->post('insurance_to')==null))
        	{	        		
        		$insur = '(vehicle_document_details.Vehicle_doc_dtl_insurance_from >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('insurance_from')))).'")';
        		$fnl_where[]=$insur;
        	}
        	if(($this->input->post('insurance_from')== null) && ($this->input->post('insurance_to')!=null))
        	{        		
        		$insur = '(vehicle_document_details.Vehicle_doc_dtl_insurance_to <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('insurance_to')))).'")';
        		$fnl_where[]=$insur;
        	}
        	if(($this->input->post('insurance_from')!= null) && ($this->input->post('insurance_to')!=null))
        	{	
        		$insur = '(vehicle_document_details.Vehicle_doc_dtl_insurance_from >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('insurance_from')))).'" AND Vehicle_doc_dtl_insurance_to <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('insurance_to')))).'")';
        		$fnl_where[]=$insur;
        	}
        	// end check insurance

        	// start check tax
        	if(($this->input->post('tax_from')!= null) && ($this->input->post('tax_to')==null))
        	{	        		
        		$tax = '(vehicle_document_details.Vehicle_doc_dtl_insurance_from >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('tax_from')))).'")';
        		$fnl_where[]=$tax;
        	}
        	if(($this->input->post('tax_from')== null) && ($this->input->post('tax_to')!=null))
        	{        		
        		$tax = '(vehicle_document_details.Vehicle_doc_dtl_insurance_to <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('tax_to')))).'")';
        		$fnl_where[]=$tax;
        	}
        	if(($this->input->post('tax_from')!= null) && ($this->input->post('tax_to')!=null))
        	{	
        		$tax = '(vehicle_document_details.Vehicle_doc_dtl_insurance_from >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('tax_from')))).'" AND Vehicle_doc_dtl_insurance_to <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('tax_to')))).'")';
        		$fnl_where[]=$fc;
        	}
        	// end check tax
			// start check fc
        	if(($this->input->post('fc_from')!= null) && ($this->input->post('fc_to')==null))
        	{	        		
        		$fc = '(vehicle_document_details.Vehicle_doc_dtl_fc_from >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('fc_from')))).'")';
        		$fnl_where[]=$fc;
        	}
        	if(($this->input->post('fc_from')== null) && ($this->input->post('fc_to')!=null))
        	{        		
        		$fc = '(vehicle_document_details.Vehicle_doc_dtl_fc_to <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('fc_to')))).'")';
        		$fnl_where[]=$fc;
        	}
        	if(($this->input->post('fc_from')!= null) && ($this->input->post('fc_to')!=null))
        	{	
        		$fc = '(vehicle_document_details.Vehicle_doc_dtl_fc_from >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('fc_from')))).'" AND Vehicle_doc_dtl_fc_to <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('fc_to')))).'")';
        		$fnl_where[]=$fc;
        	}
        	// end check fc
            
			// start check pc
        	if(($this->input->post('pc_from')!= null) && ($this->input->post('pc_to')==null))
        	{	        		
        		$pc = '(vehicle_document_details.Vehicle_doc_dtl_pc_from >="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pc_from')))).'")';
        		$fnl_where[]=$pc;
        	}
        	if(($this->input->post('pc_from')== null) && ($this->input->post('pc_to')!=null))
        	{        		
        		$pc = '(vehicle_document_details.Vehicle_doc_dtl_pc_to <="'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pc_to')))).'")';
        		$fnl_where[]=$pc;
        	}
        	if(($this->input->post('pc_from')!= null) && ($this->input->post('pc_to')!=null))
        	{	
        		$pc = '(vehicle_document_details.Vehicle_doc_dtl_pc_from >= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pc_from')))).'" AND Vehicle_doc_dtl_pc_to <= "'.date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('pc_to')))).'")';
        		$fnl_where[]=$pc;
        	}
        	// end check pc
            
        	// start check vehicle number
        	if($this->input->post('Vehicle_number')!= null)
        	{	        		
        		$veh_no = '(vehicle_details.Vehicle_dtl_number LIKE "%'.$this->input->post('Vehicle_number').'%")';                
        		$fnl_where[]=$veh_no;
        	}        	
        	// end check vehicle number

        

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
	   $this->db->order_by("vehicle_document_details.Vehicle_doc_dtl_id");
       $query = $this->db->get(); //exit();
       // 
	   return $query;
	}
}
?>