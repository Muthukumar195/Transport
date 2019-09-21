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

function get_date_time(){
	// get country formate
	date_default_timezone_set('Asia/Kolkata');
	return date ('Y-m-d H:i:s');

}
 