<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Profit extends CI_Controller {

	/** 
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.htmlzzxzxzx
	 */	
	function __construct()
    {
        parent::__construct();
        $this->load->model('due_details_model');
		$this->load->model('vehicle_document_details_model');
		$this->load->model('iso_movement_details_model');
		$this->load->model('driver_pay_rate_model');
		$this->load->model('party_details_model');
		$this->load->model('driver_details_model');
		$this->load->model('transport_details_model');
		$this->load->model('profit_model');
    }

	public function profit_details_list()
	{	
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}		
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('daily_movement_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['daily_movement_details_list'] = $this->profit_model->daily_movement_details_list(); 
			$data['iso_movement_details_list'] = $this->profit_model->iso_movement_details_list();
			$data['sm_transport_list'] = $this->profit_model->sm_transport_list();
			$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
			$data['party_name_list'] = $this->party_details_model->party_name_list();
			$data['transport_name_list'] = $this->transport_details_model->transport_name_list();
			$data['driver_list'] = $this->driver_details_model->driver_list();  
		
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			if($this->input->get('ac')=="PRINT"){
			$this->load->view('profit_payment_print', $data);
			}else{
			$this->load->view('profit_details_list', $data);     	
			}
		}
	}



	
	
	function check_isvalidated()
	{
        if(! $this->session->userdata('username'))
        {	
        	$this->session->set_flashdata('failear_msg', 'Login Required');		
			redirect('tranport_main');			
        }		
		
    }	
 
    function check_user_rights()
    {
        $this->session->set_flashdata('failear_msg', 'Access Denied');		
		redirect('tranport_main');			
    }
}
