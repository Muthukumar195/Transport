<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function common_status($id =""){
	$CI = get_instance();
	$CI->db->select('id,status');
	if($id !=""){
		$CI->db->where("id", $id);
		$query = $CI->db->get("common_status");
		$statuses = $query->result();
		return $statuses[0]->status;
	}
	$query = $CI->db->get("common_status");
	return $query->result();
}

function vehicle_numbers($id =""){
	$CI = get_instance();
	$CI->db->select('Vehicle_dtl_id,Vehicle_dtl_number');
	if($id !=""){
		$CI->db->where("Vehicle_dtl_id", $id);
		$query = $CI->db->get("vehicle_details");
		$vhl = $query->result();
		return $vhl[0]->Vehicle_dtl_number;
	}
	$CI->db->where("Vehicle_dtl_status", "A");
	$query = $CI->db->get("vehicle_details");
	return $query->result();
}

function initial_data(){
	$CI = get_instance();
	$CI->load->model('due_details_model'); 
	$CI->load->model('vehicle_document_details_model'); 
	$CI->load->model('vehicle_details_model');
	$CI->load->model('edit_admin_profile_model'); 	
	$data['get_admin_profile'] = $CI->edit_admin_profile_model->get_admin_profile();
	$data['vehicle_details_list'] = $CI->vehicle_details_model->vehicle_details_list();  
	$data['due_upcoming_count'] = $CI->due_details_model->upcoming_month_due_count(); 
	$data['upcoming_vehicle_doc_count'] = $CI->vehicle_document_details_model->upcoming_document_date_count();	 
	return $data;
}

function iso_initial_data(){
	$CI = get_instance();
	$CI->load->model('due_details_model'); 
	$CI->load->model('vehicle_document_details_model'); 
	$CI->load->model('vehicle_details_model');
	$CI->load->model('edit_admin_profile_model'); 
	$CI->load->model('transport_details_model');
	$CI->load->model('container_details_model');
	$CI->load->model('driver_details_model');	
	$data['get_admin_profile'] = $CI->edit_admin_profile_model->get_admin_profile();
	$data['vehicle_number_list'] = $CI->vehicle_details_model->vehicle_number_list();
	$data['vehicle_other_list'] = $CI->vehicle_details_model->vehicle_other_list();
	$data['due_upcoming_count'] = $CI->due_details_model->upcoming_month_due_count(); 
	$data['upcoming_vehicle_doc_count'] = $CI->vehicle_document_details_model->upcoming_document_date_count();
	$data['container_number_list'] = $CI->container_details_model->container_number_list();
	$data['driver_list'] = $CI->driver_details_model->driver_list();
	$data['transport_name_list'] = $CI->transport_details_model->transport_name_list();
	return $data;
} 

function get_date_time(){
	// get country formate
	date_default_timezone_set('Asia/Kolkata');
	return date ('Y-m-d H:i:s');

}

function is_admin(){
    $CI = get_instance();
    if($CI->session->userdata('role') == 1){
        return true;
    }
    return false;
}


function access_permission($module_id){
    $CI = get_instance();
	$module_ids = explode(',', $CI->session->userdata('access_permission'));	
    if(in_array($module_id, $module_ids)){
        return true;
    }
    return false;
}

function gaurd( ){
    $CI = get_instance();
	if($CI->session->userdata('username')){	 
        return true;
    }
    return false;
}

function vehicle_maintenance_ajax_filter(){
	    $CI = get_instance();	 
		$condition	= "";
		if($CI->input->get('vehicle_no') != ""){
			$condition .= ' vm.vehicle_id = '.$CI->input->get('vehicle_no');
		}
		
		if($CI->input->get('date_from') != "" && $CI->input->get('date_to') != ""){	
			if($condition != ""){
				$condition .= ' AND ';
			} 
			$condition .= 'vm.date BETWEEN "'.$CI->input->get('date_from').'" AND "'.$CI->input->get('date_to').'"';
		}
		
		return $condition;
}

function total_vehicle_maintance(){
	 $CI = get_instance();	 
	  $query = "SELECT SUM(vm.amount) as total FROM vehicle_maintenance as vm ";
	  $condition = vehicle_maintenance_ajax_filter();
	  if($condition != ""){
		 $query .= "WHERE ".$condition; 
	  }
	  
	  $query = $CI->db->query($query);
	  $total = $query->result_array()[0]['total'];
	  return $total;
	  
}

function user_rights_list(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->where("status_id", 1);
	$query = $CI->db->get("access_permission");
	return $query->result_array();
	  
}
 