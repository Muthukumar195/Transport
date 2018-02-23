<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Vehicle_details extends CI_Controller {
 
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
		$this->load->model('Transport_details_model');        
    }
	
	public function vehicle_details_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$data['vehicle_details_list'] = $this->vehicle_details_model->vehicle_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('vehicle_details_list', $data);
		}
	}	
	public function add_vehicle_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{	
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			//Transport name list
			$data['transport_name'] = $this->Transport_details_model->transport_name_list();
			$this->load->view('add_vehicle_details', $data);
		}
	}
	public function validate_vehicle_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
	   		$this->form_validation->set_rules('vehicle_number', 'Vehicle Number','trim|required|callback_ajax_check_vehicle_number|xss_clean');
			if($this->input->post('transport_type')=="T"){
	   		$this->form_validation->set_rules('vehicle_make', 'Vehicle Make', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('vehicle_permit', 'Vehicle Permit', 'trim|required|xss_clean');
			}else{
			$this->form_validation->set_rules('trans_name', 'Transport name', 'trim|required|xss_clean');
			}
			$this->form_validation->set_rules('transport_type', 'Transport Type', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();


			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				//view upcoming vehicle document count
			     $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				 //Transport name list
			     $data['transport_name'] = $this->Transport_details_model->transport_name_list();
				$this->load->view('add_vehicle_details', $data); 	
			}
			else
			{	
					if($query = $this->vehicle_details_model->add_vehicle_details())
					{
						$this->load->model('edit_admin_profile_model'); 
			            $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				        $data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
						//view upcoming vehicle document count
			            $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();					
						$this->session->set_flashdata('success_msg', 'Vehicle details added successfully!');				
						redirect('vehicle_details/add_vehicle_details');	
					}
			}
		}
	}
	// start edit vehicle details
	public function edit_vehicle_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->model('vehicle_details_model'); 
			$data['vehicle_details_data'] = $this->vehicle_details_model->get_vehicle_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			//Transport name list
			$data['transport_name'] = $this->Transport_details_model->transport_name_list();
			$this->load->view('edit_vehicle_details', $data);	
		}
	}
	// end edit vehicle details

	// start validate edit vehicle details
    public function validate_edit_vehicle_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
	   		if($this->input->post('transport_type')=="T"){
	   		$this->form_validation->set_rules('vehicle_make', 'Vehicle Make', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('vehicle_permit', 'Vehicle Permit', 'trim|required|xss_clean');
			}else{
			$this->form_validation->set_rules('trans_name', 'Transport name', 'trim|required|xss_clean');
			}
			$this->form_validation->set_rules('transport_type', 'Transport Type', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();


			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
				//Transport name list
			    $data['transport_name'] = $this->Transport_details_model->transport_name_list();
				$this->load->model('vehicle_details_model'); 
			    $data['vehicle_details_data'] = $this->vehicle_details_model->get_vehicle_details($this->input->post('id')); 			
				$this->load->view('edit_vehicle_details', $data); 	
			}
			else
			{						
				if($query = $this->vehicle_details_model->edit_vehicle_details($this->input->post('id')))
				{
					$this->load->model('edit_admin_profile_model'); 
			        $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				    $data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
					//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();				
					$this->session->set_flashdata('success_msg', 'Vehicle details edited successfully!');
					$data['vehicle_details_list'] = $this->vehicle_details_model->vehicle_details_list(); 	
					$this->load->view('vehicle_details_list', $data);					
				}
			}		
		}
    }
	// end validate edit vehicle details

	
    // start approve vehicle
    function approve_vehicle()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('vehicle_details_model'); 
			if($this->vehicle_details_model->approve_vehicle())
			{				
				$this->session->set_flashdata('success_msg', 'Vehicle Status Changed successfully!');
			}
			$data['vehicle_details_list'] = $this->vehicle_details_model->vehicle_details_list(); 	
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('vehicle_details_list', $data);						
		}
    }
	// end approver vehicle

	// start deny vehicle
    function deny_vehicle()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('vehicle_details_model'); 
			if($this->vehicle_details_model->deny_vehicle())
			{				
				$this->session->set_flashdata('success_msg', 'Vehicle Status Changed successfully!');
			}
			$data['vehicle_details_list'] = $this->vehicle_details_model->vehicle_details_list(); 	
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('vehicle_details_list', $data);						
		}
    }
	// end deny vehicle

	// start delete vehicle details
    public function delete_vehicle()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('vehicle_details_model');			
			if($this->vehicle_details_model->delete_vehicle())
			{				
				$this->session->set_flashdata('success_msg', 'Vehicle Details Deleted Successfully!');
			}
			else
			{
				$this->session->set_flashdata('failear_msg', 'Vehicle Details Is Used By Other Module');
			}
			$data['vehicle_details_list'] = $this->vehicle_details_model->vehicle_details_list(); 
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			
			redirect('vehicle_details/vehicle_details_list', $data);						
		}
    }
	// end delete vehicle details

	// start view Vehicle details
    public function view_vehicle_details()
    {
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('vehicle_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_vehicle_details'] = $this->vehicle_details_model->view_vehicle_details($this->input->get('id')); 
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			
			$this->load->view('view_vehicle_details', $data);	
		}
    }
    // end view Vehicle details
    // Start check ajax vehicle number
	public function ajax_check_vehicle_number($key)
	{
		$this->load->model('vehicle_details_model');        
        $is_exist = $this->vehicle_details_model->ajax_check_vehicle_number($key); 

        if ($is_exist==1) 
		{
        	$this->form_validation->set_message('ajax_check_vehicle_number', 'Vehicle Number already exist');  
        	return false;
    	} 
		else 
		{
        	return true;
    	}

	}
  // End check ajax vehicle number
	function check_isvalidated()
	{
        if(! $this->session->userdata('username'))
        {	
        	$this->session->set_flashdata('failear_msg', 'Login Required');		
			redirect('tranport_main');			
        }		
		
    }

    // start report page
    public function view_vehicle_report()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('vehicle_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['vehicle_details_list'] = $this->vehicle_details_model->search_vehicle_details_list(); 	
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				
			$this->load->view('view_vehicle_report', $data);	
		}
    }
    // end report page
	 // start report Print page
    public function view_vehicle_report_print()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Vehicle Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('vehicle_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['vehicle_details_list'] = $this->vehicle_details_model->search_vehicle_details_list(); 	
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				
			$this->load->view('view_vehicle_report_print', $data);	
		}
    }
    // end report Print page

   
   // start check transport name
	public function ajax_check_transport_name()
		{
			
			if(! $this->session->userdata('username')){
				/*$this->index();*/
				$this->check_isvalidated();
			}
			else
			{		
				$this->load->model('vehicle_details_model');
				$data = $this->vehicle_details_model->get_transport_name($this->input->get('other_vehicle'));
				
				foreach($data->result() as $row)
				{ 
					$transport='<option value="'.$row->Vehicle_dtl_transport_name.'">'.$row->Transport_dtl_name.'</option>';
				}
				echo $transport;
			}
				
	}
   // end check transport name
	
    function check_user_rights()
    {
        $this->session->set_flashdata('failear_msg', 'Access Denied');		
		redirect('tranport_main');			
    }
}
