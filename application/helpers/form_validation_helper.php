<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function vehicle_maintenance_validation(){
	$CI = get_instance();	
	$CI->form_validation->set_rules('vehicle_id', 'Vehicle No', 'required');	
	$CI->form_validation->set_rules('spare_part', 'Spare Part', 'required');		
	$CI->form_validation->set_rules('amount', 'Amount', 'required');		
	$CI->form_validation->set_rules('maintenance_date', 'Maintenance Date', 'required'); 	
}
 
 