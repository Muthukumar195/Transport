<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function vehicle_maintenance_validation(){
	$CI = get_instance();	
	$CI->form_validation->set_rules('vehicle_id', 'Vehicle No', 'required');	
	$CI->form_validation->set_rules('spare_part', 'Spare Part', 'required');		
	$CI->form_validation->set_rules('amount', 'Amount', 'required');		
	$CI->form_validation->set_rules('maintenance_date', 'Maintenance Date', 'required'); 	
}

function driver_validation(){
	$CI = get_instance();	
	$CI->form_validation->set_rules('full_name', 'Username', 'trim|required|callback_ajax_check_full_name|xss_clean');
	$CI->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
	$CI->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
	$CI->form_validation->set_rules('driver_type', 'Category Type', 'trim|required|xss_clean');
}
 
 