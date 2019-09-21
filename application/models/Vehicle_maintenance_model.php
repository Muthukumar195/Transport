<?php

class Vehicle_maintenance_model extends CI_Model {

        public function __construct() {
			$this->table = "vehicle_maintenance";
            parent::__construct();
                      
        }
	        
		public function get_all($fields =''){
				if($fields !=''){
					$this->db->select($fields);
				}
				$query = $this->db->get($this->table);
				if($query){			
					return $query->result(); 
				}
			return FALSE;
		}
		
		public function get_where($condition=array()){
				$query = $this->db->get_where($this->table, $condition);
				if($query){			
						return $query->result(); 
				}
			return FALSE;
		}
		
		public function getLastInserted(){
			return $this->db->insert_id();
		}
        
		public function insert($data) { 
				if($this->db->insert($this->table, $data)){
					return true; 
				}
			return FALSE;
		}
				
		public function update($data, $condition = array()) { 
				$this->db->where($condition);
				if($this->db->update($this->table, $data)){
					return true; 
				}
			return FALSE;
		}
		   
		public function check_exist($condition =array()) {
			
				$this->db->where($condition);
				$this->db->from($this->table);
				$num_res = $this->db->count_all_results();
				
				if ($num_res > 1) {
					return TRUE;
				} else {
					return FALSE;
				}
			return FALSE;
		}
		
		public function pagination_record_count($key, $like, $fix) {
				$this->db->like($key, $like, $fix);
				return $this->db->count_all_results($this->table);
		}
		
		public function pagination_limit($limit, $start) {
				$this->db->limit($limit, $start);
				return $this;
		}
		
		// Fetch data according to per_page limit.
		public function pagination_fetch_data($key, $like, $fix) {
				$this->db->like($key, $like, $fix);
				$query = $this->db->get($this->table);
				if ($query->num_rows() > 0) {
					return $query->result();
				}
			return false;
		}			
		 
		public function delete($condition=array(), $multi=false) {
				if($multi){					 
					$this->db->where_in('id', $condition);
				}else{
					$this->db->where($condition);
				}
				if($this->db->delete($this->table)){
					
					return true; 
				}
			return FALSE;
		}
		
		public function status_update($data, $ids=array()) { 			
				$this->db->where_in('id', $ids);
				if($this->db->update($this->table, $data)){
					return true; 
				}
			return FALSE;
		}
		
		public function get_json($data=array()) { 
				return $this->output
						->set_content_type('application/json')
						->set_status_header(500)
						->set_output(json_encode($data));
		}
   
}


?>