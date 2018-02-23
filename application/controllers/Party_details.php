<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Party_details extends CI_Controller {

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
	
	public function party_details_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_details_model'); 
			$data['party_details_list'] = $this->party_details_model->party_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('party_details_list', $data);
		}
	} 
	public function add_party_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->view('add_party_details', $data);
		}
	}
	// start add party_details in table
    public function validate_party_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_details_model'); 
	   		$this->form_validation->set_rules('full_name', 'Party Name', 'trim|required|callback_ajax_check_party_name|xss_clean');
	   		$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
	   		
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();				
				$this->load->view('add_party_details',$data); 	
			}
			else
			{
				$this->load->helper('inflector');
				
					if($query = $this->party_details_model->add_party_details())
					{
						$this->session->set_flashdata('success_msg', 'Party details added successfully!');					
						redirect('party_details/add_party_details');	
					}				
			}
		}
    }
	// end add party_details in table
	// start edit driver details
    public function edit_party_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->model('party_details_model'); 
			$data['party_details_data'] = $this->party_details_model->get_party_details($this->input->get('id'));
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('edit_party_details', $data);
				
		}
    }
	// end edit party_details

	// start validate_edit_party_details 
    public function validate_edit_party_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
	   		$this->form_validation->set_rules('full_name', 'Party Name', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
	   	
			if($this->form_validation->run() == FALSE)
	   		{
				
				$this->load->model('edit_admin_profile_model');
				$this->load->model('party_details_model');  
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			   	// view upcoming due counts
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
				$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			    $data['party_details_data'] = $this->party_details_model->get_party_details($this->input->post('id'));			
				$this->load->view('edit_party_details',$data); 	
			}
			else
			{
				$this->load->helper('inflector');
					
				if($query = $this->party_details_model->edit_party_details($this->input->post('id')))
				{	
					$this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$data['party_details_list'] = $this->party_details_model->party_details_list(); 
					$this->session->set_flashdata('success_msg', 'party details edited successfully!');	
					$this->load->model('edit_admin_profile_model'); 
					$this->load->model('party_details_model');
					$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
					// view upcoming due counts
					$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
					//view upcoming vehicle document count
					$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
					$this->load->view('party_details_list', $data);					
				}
			}		
		}
    }
	// end validate_edit_party_details

	// start approve party_details
    function approve_party_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_details_model'); 
			if($this->party_details_model->approve_party_details())
			{				
				$this->session->set_flashdata('success_msg', 'Party Status Changed successfully!');
			}
			$data['party_details_list'] = $this->party_details_model->party_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('party_details/party_details_list', $data);						
		}
    }
	// end approver party_details

	// start deny party_details
    function deny_party_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_details_model'); 
			if($this->party_details_model->deny_party_details())
			{				
				$this->session->set_flashdata('success_msg', 'Party Status Changed successfully!');
			}
			$data['party_details_list'] = $this->party_details_model->party_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('party_details/party_details_list', $data);						
		}
    }
	// end deny party_details

	// start delete party_details
	public function delete_message()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_details_model');
			
			if($this->party_details_model->delete_party_details())
			{				
				$this->session->set_flashdata('success_msg', 'Party Details Deleted Successfully!');
			}
			else
			{
				$this->session->set_flashdata('failear_msg', 'Party Name Is Used By Other Module');
			}
			$data['party_details_list'] = $this->party_details_model->party_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('party_details/party_details_list', $data);						
		}
	}
	// end delete party_details
     function ajax_check_party_name($key)
    {    	 
		$this->load->model('party_details_model');        
        $is_exist = $this->party_details_model->ajax_check_party_name($key); 

        if ($is_exist==1) 
		{
        	$this->form_validation->set_message('ajax_check_party_name', 'Party name already exist');  
        	return false;
    	} 
		else 
		{
        	return true;
    	}

    }
	 // start view party details
    public function view_party_details()
    {
    	// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Party Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('party_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_party_details'] = $this->party_details_model->get_party_advance_details($this->input->get('id')); 
			$data['view_party_advance'] = $this->party_details_model->view_party_advance($this->input->get('id'));   
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_party_details', $data);	
		}
    } 
    // end view party details
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
