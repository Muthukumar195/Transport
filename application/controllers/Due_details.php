<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Due_details extends CI_Controller {
   
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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */	
	function __construct()
    {
        parent::__construct();
        $this->load->model('due_details_model');  
		$this->load->model('vehicle_document_details_model');         
    }
	
	public function due_details_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('due_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['due_details_list'] = $this->due_details_model->due_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('due_details_list', $data);
		}
	}	
	public function add_due_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{	
			$this->load->model('vehicle_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list();
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('add_due_details', $data);
		}
	}
	public function validate_due_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('vehicle_details_model'); 
	   		$this->form_validation->set_rules('vehicle_number', 'Vehicle Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('due_date', 'Due Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('due_amount', 'Due Amount', 'trim|required|xss_clean');
	   		//$this->form_validation->set_rules('paid_date', 'Paid Date', 'trim|required|xss_clean'); 
	   		
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('vehicle_details_model');
				$this->load->model('edit_admin_profile_model'); 
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
				$data['vehicle_list'] = $this->vehicle_details_model->vehicle_list();
				// view upcoming due counts
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
				$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
	   			$data['vehicle_list'] = $this->vehicle_details_model->vehicle_list();
				$this->load->view('add_due_details', $data);	
			}
			else
			{	
					$this->load->model('due_details_model');
					if($query = $this->due_details_model->add_due_details())
					{						
						$this->session->set_flashdata('success_msg', 'Due details added successfully!');	
						$data['vehicle_list'] = $this->vehicle_details_model->vehicle_list();			
						redirect('due_details/add_due_details', $data);	
					}
			}
		}
	}
	// start edit vehicle details
	public function edit_due_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username')){
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));
			$this->load->helper('text');			
			$this->load->model('edit_admin_profile_model'); 
			$this->load->model('vehicle_details_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list();	
			$this->load->model('due_details_model'); 
			$data['due_details_data'] = $this->due_details_model->get_due_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('edit_due_details', $data);	
		}
	}
	// end edit vehicle details

	// start validate edit vehicle details
    public function validate_edit_due_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('vehicle_details_model'); 
			$this->load->model('due_details_model'); 	   		
	   		$this->form_validation->set_rules('vehicle_number', 'Vehicle Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('due_date', 'Due Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('due_amount', 'Due Amount', 'trim|required|xss_clean');
	   		
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			if($this->form_validation->run() == FALSE)
	   		{
			    $this->load->model('edit_admin_profile_model'); 
				$this->load->model('due_details_model'); 
				$this->load->model('vehicle_details_model');				
				$data['vehicle_list'] = $this->vehicle_details_model->vehicle_list();
				$data['due_details_data'] = $this->due_details_model->get_due_details($this->input->post('id')); 
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				$this->load->view('edit_due_details', $data); 	
			}
			else
			{					
				if($query = $this->due_details_model->edit_due_details($this->input->post('id')))
				{				
					$this->session->set_flashdata('success_msg', 'Due details edited successfully!');
					$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
					//view upcoming vehicle document count
					$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
					$data['due_details_list'] = $this->due_details_model->due_details_list(); 
					redirect('due_details/due_details_list', $data);
					//$this->load->view('due_details_list', $data);					
				}
			}		
		}
    }
	// end validate edit vehicle details

	
    // start approve vehicle
    function approve_due()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));		
			$this->load->model('edit_admin_profile_model'); 
	   		$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
	   		$this->load->model('due_details_model');

			if($this->due_details_model->approve_due())
			{				
				$this->session->set_flashdata('success_msg', 'Due Status Changed successfully!');
			}
			$data['due_details_list'] = $this->due_details_model->due_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('due_details_list', $data);							
		}
    }
	// end approver vehicle

	// start deny vehicle
    function deny_due()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('due_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
	   		$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			if($this->due_details_model->deny_due())
			{				
				$this->session->set_flashdata('success_msg', 'Due Status Changed successfully!');
			}
			$data['due_details_list'] = $this->due_details_model->due_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('due_details_list', $data);							
		}
    }
	// end deny vehicle

	// start delete vehicle details
    public function delete_due()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('due_details_model');
			$this->load->model('edit_admin_profile_model'); 
	   		$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();				
			if($this->due_details_model->delete_due($this->input->get('id')))
			{				
				$this->session->set_flashdata('success_msg', 'Due Details Deleted Successfully!');
			}			
			$data['due_details_list'] = $this->due_details_model->due_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('due_details_list', $data);						
		}
    }
	// end delete vehicle details
	public function view_due_report()
	{		
			
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('due_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_due_report'] = $this->due_details_model->search_due_report(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_due_report', $data);
		}
	}
	// Start Due Print details
	public function view_due_report_print()
	{		
			
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('due_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_due_report'] = $this->due_details_model->search_due_report(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_due_report_print', $data);
		}
	}
	// end Due Print details
	// Start Due details
	 public function view_due_details()
    {
    		
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('due_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_due_details'] = $this->due_details_model->view_due_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_due_details', $data);	
		}
    }
	//End Due Details 
	// Start Due Print details
	 public function view_due_details_print()
    {
    		
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('due_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_due_details'] = $this->due_details_model->view_due_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_due_details_print', $data);	
		}
    }
	//End Due Print Details 
	public function upcoming_due_report()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('due_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_due_report'] = $this->due_details_model->upcoming_due_report(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_due_report', $data);
		}
	}
	// start add vehicle Due Date details
	public function add_due_amount()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username')){
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));
			$this->load->helper('text');			
			$this->load->model('edit_admin_profile_model'); 
			$this->load->model('vehicle_details_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			$data['vehicle_list'] = $this->vehicle_details_model->vehicle_list();
			$data['paid_date_list'] = $this->due_details_model->paid_date_list($this->input->get('id'));	
			$this->load->model('due_details_model'); 
			$data['due_details_data'] = $this->due_details_model->get_due_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('add_due_amount', $data);	
		}
	}
	// end edit vehicle details

	// start validate edit vehicle details
    public function validate_add_due_amount()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Due Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('vehicle_details_model'); 
			$this->load->model('due_details_model');
	   		$this->form_validation->set_rules('paid_status', 'Due Paid Statuss', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('paid_date', 'Paid Date', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			if($this->form_validation->run() == FALSE)
			{
				$this->load->model('edit_admin_profile_model'); 
				$this->load->model('vehicle_details_model');
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
				$data['vehicle_list'] = $this->vehicle_details_model->vehicle_list();
				$data['paid_date_list'] = $this->due_details_model->paid_date_list($this->input->get('id'));	
				$this->load->model('due_details_model'); 
				$data['due_details_data'] = $this->due_details_model->get_due_details($this->input->get('id')); 
				// view upcoming due counts
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
				$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$this->load->view('add_due_amount', $data); 	
			}
			else
			{					
				if($query = $this->due_details_model->add_due_amount($this->input->post('id')))
				{				
					$this->session->set_flashdata('success_msg', 'Due Paid details successfully!');
					$data['due_details_list'] = $this->due_details_model->due_details_list(); 
					redirect('due_details/due_details_list', $data);
					//$this->load->view('due_details_list', $data);					
				}
			}		
		}
    }
	// end validate edit vehicle details

	function check_user_rights()
    {
        $this->session->set_flashdata('failear_msg', 'Access Denied');		
		redirect('tranport_main');			
    }

}
