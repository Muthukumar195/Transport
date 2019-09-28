<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); 
class Vehicle_document_details extends CI_Controller {
  
	function __construct()
    {
        parent::__construct();
        $this->load->model('due_details_model'); 
		$this->load->model('vehicle_document_details_model');        
    }
	
	
	public function vehicle_document_details_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			
			$this->load->model('vehicle_document_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['vehicle_document_details_list'] = $this->vehicle_document_details_model->vehicle_document_details_list();    
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();		            
			$this->load->view('vehicle_document_details_list', $data);
		}
	}
	public function add_vehicle_document_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{			 
			$data = initial_data();
			$this->load->view('add_vehicle_document_details', $data);		
		}
	}
	// start add vehicle document details in table
    public function validate_vehicle_document_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{	
		   $this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library('javascript');
	   		$this->load->library('form_validation');	
			$this->load->model('vehicle_document_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
	   		$this->form_validation->set_rules('vehicle_number', 'Vehicle Number', 'trim|required|is_unique[vehicle_document_details.Vehicle_doc_dtl_vehicle_no]|xss_clean', array('is_unique'=>"Vehicle document details already exist"));
	   		$this->form_validation->set_rules('m_permit_from', 'M Permit From', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('m_permit_to', 'M Permit To', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('insurance_from', 'Insurance From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('insurance_to', 'Insurance To', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fc_from', 'FC From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fc_to', 'FC To', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tax_from', 'Tax From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tax_to', 'Tax To', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pc_from', 'P Certificate From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pc_to', 'P Certificate To', 'trim|required|xss_clean');
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			if($this->form_validation->run() == FALSE)
	   		{
			   $this->load->model('edit_admin_profile_model'); 
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();				
			   $this->load->model('vehicle_details_model');	
			   $data['vehicle_details_list'] = $this->vehicle_details_model->vehicle_details_list(); 	
			   $this->load->view('add_vehicle_document_details', $data);
		
			}
			else
			{
				$this->load->helper('inflector');
			
					if($query = $this->vehicle_document_details_model->add_vehicle_document_details())
					{
						$this->session->set_flashdata('success_msg', 'Vehicle Document details added successfully!');					
						redirect('vehicle_document_details/add_vehicle_document_details', $data);	
					}				
			}
		}
    }
	// end add vehicle document details in table
	// start edit vehicle_document_details
    public function edit_vehicle_document_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			
			$this->load->helper(array('form', 'url', 'text','captcha','html'));
			$this->load->helper('text');
			$this->load->model('vehicle_document_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['vehicle_document_details_data'] = $this->vehicle_document_details_model->get_vehicle_document_details($this->input->get('id')); 
			$this->load->model('vehicle_details_model');	
			$data['vehicle_details_list'] = $this->vehicle_details_model->vehicle_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('edit_vehicle_document_details', $data);
		}
    }
	// end edit vehicle document details

	// start validate_edit_ vehicle document details 
    public function validate_edit_vehicle_document_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library('javascript');
	   		$this->load->library('form_validation');	
			$this->load->model('vehicle_document_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
	   		$this->form_validation->set_rules('vehicle_number', 'Vehicle Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('m_permit_from', 'M Permit From', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('m_permit_to', 'M Permit To', 'trim|required|xss_clean');
			$this->form_validation->set_rules('insurance_from', 'Insurance From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('insurance_to', 'Insurance To', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fc_from', 'FC From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fc_to', 'FC To', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tax_from', 'Tax From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tax_to', 'Tax To', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pc_from', 'P Certificate From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pc_to', 'P Certificate To', 'trim|required|xss_clean');
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();

			if($this->form_validation->run() == FALSE)
	   		{
			    $this->load->model('edit_admin_profile_model'); 
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
				//view upcoming vehicle document count
			   $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			   $this->load->model('vehicle_details_model');	
			   $data['vehicle_details_list'] = $this->vehicle_details_model->vehicle_details_list();
			   $this->load->model('vehicle_document_details_model');
			   $data['vehicle_document_details_data'] = $this->vehicle_document_details_model->get_vehicle_document_details($this->input->post('id'));  	
			   $this->load->view('edit_vehicle_document_details', $data); 	
			}
			else
			{
				$this->load->helper('inflector');
				if($query = $this->vehicle_document_details_model->edit_vehicle_document_details($this->input->post('id')))
				{	
					$this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$data['vehicle_document_details_list'] = $this->vehicle_document_details_model->vehicle_document_details_list(); 
					$this->session->set_flashdata('success_msg', 'Vehicle Document details edited successfully!');	
					$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
					//view upcoming vehicle document count
					$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
					$this->load->view('vehicle_document_details_list', $data);					
				}
			}		
		}
    }
	// end validate_edit_ vehicle document details

	// start approve vehicle document details
    function approve_vehicle_document_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('vehicle_document_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			if($this->vehicle_document_details_model->approve_vehicle_document_details())
			{				
				$this->session->set_flashdata('success_msg', 'Vehicle Document Status Changed successfully!');
			}
			$data['vehicle_document_details_list'] = $this->vehicle_document_details_model->vehicle_document_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('vehicle_document_details/vehicle_document_details_list', $data);						
		}
    }
	// end approver vehicle document details

	// start deny vehicle document details
    function deny_vehicle_document_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('vehicle_document_details_model'); 
			if($this->vehicle_document_details_model->deny_vehicle_document_details())
			{				
				$this->session->set_flashdata('success_msg', 'Vehicle Document Status Changed successfully!');
			}
			$data['vehicle_document_details_list'] = $this->vehicle_document_details_model->vehicle_document_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('vehicle_document_details/vehicle_document_details_list', $data);						
		}
    }
	// end deny vehicle document details

	// start delete vehicle document details
	public function delete_message()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
		if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('vehicle_document_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			
			if($this->vehicle_document_details_model->delete_vehicle_document_details())
			{				
				$this->session->set_flashdata('success_msg', 'Vehicle Document Details Deleted Successfully!');
			}
			$data['vehicle_document_details_list'] = $this->vehicle_document_details_model->vehicle_document_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('vehicle_document_details/vehicle_document_details_list', $data);						
		}
	}
	// end delete Vehicle Document details 

// start view_vehicle_document_details
    public function view_vehicle_document_details()
    {
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('vehicle_document_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_vehicle_document_details'] = $this->vehicle_document_details_model->view_vehicle_document_details($this->input->get('id')); 
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			
			$this->load->view('view_vehicle_document_details', $data);	
		}
    }
    // end view Vehicle Document details
	// start view_vehicle_document_details Print
    public function view_vehicle_document_details_print()
    {
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('vehicle_document_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_vehicle_document_details'] = $this->vehicle_document_details_model->view_vehicle_document_details($this->input->get('id')); 
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			
			$this->load->view('view_vehicle_document_details_print', $data);	
		}
    }
    // end view Vehicle Document details
	
	
	// start report page
    public function view_vehicle_document_report()
    {
    	// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			// start admin profile name and picture  
			$this->load->model('edit_admin_profile_model'); 
		    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
		    // end admin profile name and picture	
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();		
			$this->load->model('vehicle_document_details_model'); 
			$data['vehicle_document_details_list'] = $this->vehicle_document_details_model->search_vehicle_document_list(); 	
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_vehicle_document_report', $data);	
		}
    }
    // end report page
	
	// start report Print page
    public function view_vehicle_document_report_print()
    {
    	// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			// start admin profile name and picture  
			$this->load->model('edit_admin_profile_model'); 
		    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
		    // end admin profile name and picture	
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();		
			$this->load->model('vehicle_document_details_model'); 
			$data['vehicle_document_details_list'] = $this->vehicle_document_details_model->search_vehicle_document_list(); 	
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_vehicle_document_report_print', $data);	
		}
    }
    // end report Print page

	
	public function upcoming_vehicle_doc_report()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Document Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('vehicle_document_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['vehicle_document_details_list'] = $this->vehicle_document_details_model->upcoming_vehicle_document_report(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_vehicle_document_report', $data);
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
