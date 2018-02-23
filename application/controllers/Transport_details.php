<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Transport_details extends CI_Controller {

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
	
	
	public function transport_details_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('transport_details_model'); 
			$data['transport_details_list'] = $this->transport_details_model->transport_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('transport_details_list', $data);
		}
	}
	public function add_transport_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->view('add_transport_details', $data);
		}
	}
	// start add transport_details in table
    public function validate_transport_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('transport_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
	   		$this->form_validation->set_rules('transport_name', 'Transport Name', 'trim|required|callback_ajax_check_transport_name|xss_clean');
	   		$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			    // view upcoming due counts
			    $data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();				
				$this->load->view('add_transport_details', $data); 	
			}
			else
			{
				$this->load->helper('inflector');
					if($query = $this->transport_details_model->add_transport_details())
					{
						
						$this->session->set_flashdata('success_msg', 'Transport details added successfully!');					
						redirect('transport_details/add_transport_details');	
				    }
			}
		}
    }
	// end add transport_details in table
	// start edit transport_details
    public function edit_transport_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->helper(array('form', 'url', 'text','captcha','html'));
			$this->load->helper('text');
			$this->load->model('transport_details_model'); 
			$data['transport_details_data'] = $this->transport_details_model->get_transport_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('edit_transport_details', $data);	
		}
    }
	// end edit transport_details

	// start validate_edit_transport_details 
    public function validate_edit_transport_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('transport_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
	   		$this->form_validation->set_rules('transport_name', 'Transport Name', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
	   	
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model');
				$this->load->model('transport_details_model');  
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			    // view upcoming due counts
			    $data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				
			    $data['transport_details_data'] = $this->transport_details_model->get_transport_details($this->input->post('id')); 				
				$this->load->view('edit_transport_details', $data); 	
			}
			else
			{
				$this->load->helper('inflector');
				
				if($query = $this->transport_details_model->edit_transport_details($this->input->post('id')))
				{	
					$this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$data['transport_details_list'] = $this->transport_details_model->transport_details_list(); 
					$this->session->set_flashdata('success_msg', 'Transport details edited successfully!');	
					// view upcoming due counts
					$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
					//view upcoming vehicle document count
					$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
					$this->load->view('transport_details_list', $data);					
				}
			}		
		}
    }
	// end validate_edit_transport_details

	// start approve transport details
    function approve_transport_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('transport_details_model'); 
			if($this->transport_details_model->approve_transport_details())
			{				
				$this->session->set_flashdata('success_msg', 'Transport Status Changed successfully!');
			}
			$data['transport_details_list'] = $this->transport_details_model->transport_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('transport_details/transport_details_list', $data);						
		}
    }
	// end approver transport details

	// start deny transport details
    function deny_transport_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('transport_details_model'); 
			if($this->transport_details_model->deny_transport_details())
			{				
				$this->session->set_flashdata('success_msg', 'Transport Status Changed successfully!');
			}
			$data['transport_details_list'] = $this->transport_details_model->transport_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('transport_details/transport_details_list', $data);						
		}
    }
	// end deny transport details

	// start delete transport details
	public function delete_message()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('transport_details_model');
			
			if($this->transport_details_model->delete_transport_details())
			{				
				$this->session->set_flashdata('success_msg', 'Transport Details Deleted Successfully!');
			}
			else
			{
				$this->session->set_flashdata('failear_msg', 'Transport Detail Is Used By Other Module');
			}
			$data['transport_details_list'] = $this->transport_details_model->transport_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			redirect('transport_details/transport_details_list', $data);						
		}
	}
	// end delete transport details
	// start view  transport details
    public function view_transport_details()
    {
    	// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
					
			$this->load->model('transport_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['view_transport_details'] = $this->transport_details_model->view_transport_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_transport_details', $data);	
		}
    }
    // end view transport details
	  function ajax_check_transport_name($key)
    {    	 
		$this->load->model('transport_details_model');        
        $is_exist = $this->transport_details_model->ajax_check_transport_name($key); 

        if ($is_exist==1) 
		{
        	$this->form_validation->set_message('ajax_check_transport_name', 'Transport name already exist');  
        	return false;
    	} 
		else 
		{
        	return true;
    	}

    }

    // start view report
    public function view_transport_report()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
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
			$this->load->model('transport_details_model'); 
			$data['transport_details_list'] = $this->transport_details_model->search_transport_list(); 			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_transport_report', $data);	
		}
    }
    // end view report

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
