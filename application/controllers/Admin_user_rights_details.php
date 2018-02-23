<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Admin_user_rights_details extends CI_Controller {
 
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
	/*public function index()
	{
		$this->load->view('login');
	} */
	function __construct()
    {
        parent::__construct();
        $this->load->model('due_details_model'); 
	    $this->load->model('vehicle_document_details_model');
    }	
    
	public function admin_user_rights_details_list()
	{	
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Admin User Rights", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}

		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('admin_user_rights_details_model');
			$this->load->model('edit_admin_profile_model');			
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['admin_user_rights_details_list'] = $this->admin_user_rights_details_model->admin_user_rights_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			$this->load->view('admin_user_rights_details_list', $data);
		}
	}
	public function add_admin_user_rights_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Admin User Rights", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->view('add_admin_user_rights_details',$data);
		}
	}
	// start add admin_user_rights_details in table
    public function validate_admin_user_rights_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Admin User Rights", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('admin_user_rights_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
	   		$this->form_validation->set_rules('user_type', 'User Type', 'trim|required|callback_ajax_check_user_type|xss_clean');
	   		$this->form_validation->set_rules('user_rights[]','User Rights','trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 	
				$this->load->view('add_admin_user_rights_details',$data); 	
			}
			else
			{ 
					if($query = $this->admin_user_rights_details_model->add_admin_user_rights_details())
					{
						$this->session->set_flashdata('success_msg', 'Admin User Rights details added successfully!');					
						redirect('admin_user_rights_details/add_admin_user_rights_details');	
					}
			}
		}
    }
	// end add admin_user_rights_details in table
	// start edit admin_user_rights_details
    public function edit_admin_user_rights_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Admin User Rights", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('admin_user_rights_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['admin_user_rights_details_data'] = $this->admin_user_rights_details_model->get_admin_user_rights_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			$this->load->view('edit_admin_user_rights_details', $data);	
		}
    }
	// end edit driver details

	// start admin_user_rights 
    public function validate_edit_admin_user_rights_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Admin User Rights", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('admin_user_rights_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
	   		$this->form_validation->set_rules('user_type', 'User Type', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('user_rights[]','User Rights','trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
				$this->load->model('admin_user_rights_details_model');
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
				$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
				$data['admin_user_rights_details_data'] = $this->admin_user_rights_details_model->get_admin_user_rights_details($this->input->post('id')); 
				$this->load->view('add_admin_user_rights_details', $data); 	
			}
			else
			{		
				if($query = $this->admin_user_rights_details_model->edit_admin_user_rights_details($this->input->post('id')))
				{					
					$this->session->set_flashdata('success_msg', 'Admin User Rights details edited successfully!');	
					redirect('admin_user_rights_details/admin_user_rights_details_list');					
				}
			}		
		}
    }
	// end admin_user_rights

	// start approve admin_user_rights
    function approve_user_rights()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Admin User Rights", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('admin_user_rights_details_model'); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			if($this->admin_user_rights_details_model->approve_user_rights())
			{				
				$this->session->set_flashdata('success_msg', 'Admin User Rights Status Changed successfully!');
			}
			$data['admin_user_rights_details_list'] = $this->admin_user_rights_details_model->admin_user_rights_details_list(); 
			redirect('admin_user_rights_details/admin_user_rights_details_list', $data);						
		}
    }
	// end approver admin_user_rights

	// start deny admin_user_rights
    function deny_user_rights()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Admin User Rights", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('admin_user_rights_details_model'); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			if($this->admin_user_rights_details_model->deny_user_rights())
			{				
				$this->session->set_flashdata('success_msg', 'Admin User Rights Status Changed successfully!');
			}
			$data['admin_user_rights_details_list'] = $this->admin_user_rights_details_model->admin_user_rights_details_list(); 
			redirect('admin_user_rights_details/admin_user_rights_details_list', $data);						
		}
    }
	// end deny admin_user_rights

	// start delete admin_user_rights details
	public function delete_message()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Admin User Rights", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('admin_user_rights_details_model');
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$data['upcoming_due_report'] = $this->due_details_model->upcoming_due_report();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			
			if($this->admin_user_rights_details_model->delete_user_rights($this->input->get('id')))
			{				
				$this->session->set_flashdata('success_msg', 'Admin User Rights Details Deleted Successfully!');
			}
			else
			{
				$this->session->set_flashdata('failear_msg', 'Admin User Name Is Used By Other Module');
			}
			$data['admin_user_rights_details_list'] = $this->admin_user_rights_details_model->admin_user_rights_details_list(); 
			redirect('admin_user_rights_details/admin_user_rights_details_list', $data);						
		}
	}
	// end delete admin_user_rights details

	function check_isvalidated()
	{
        if(! $this->session->userdata('username'))
        {	
        	$this->session->set_flashdata('failear_msg', 'Login Required');		
			redirect('tranport_main');			
        }		
		
    }

    // start check dmin_user_rightsexist
    function ajax_check_user_type($key)
    {    	 
		$this->load->model('admin_user_rights_details_model');        
        $is_exist = $this->admin_user_rights_details_model->ajax_check_user_type($key); 

        if ($is_exist==1) 
		{
        	$this->form_validation->set_message('ajax_check_user_type', 'User Type already exist');  
        	return false;
    	} 
		else 
		{
        	return true;
    	}

    }
    // end check admin_user_rights  exist

    // start view admin_user_rights details
    public function view_admin_user_rights_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Admin User Rights", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('admin_user_rights_details_model');
			$this->load->model('edit_admin_profile_model'); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_admin_user_rights'] = $this->admin_user_rights_details_model->get_admin_user_rights($this->input->get('id')); 
			$this->load->view('view_admin_user_rights_details', $data);	
		}
    } 
    // end view admin_user_rights details

    function check_user_rights()
    {
        $this->session->set_flashdata('failear_msg', 'Access Denied');		
		redirect('tranport_main');			
    }

}
