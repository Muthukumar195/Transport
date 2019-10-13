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
	    $this->load->model('admin_user_rights_details_model');
		$this->module_id = 16;	
    }	
    
	public function admin_user_rights_details_list()
	{	
		if((access_permission($this->module_id) || is_admin()) && gaurd()){
			$data = initial_data();	
			$data['admin_user_rights_details_list'] = $this->admin_user_rights_details_model->admin_user_rights_details_list(); 
			$this->load->view('admin_user_rights_details_list', $data);
		}
	}
	public function add_admin_user_rights_details()
	{
		if((access_permission($this->module_id) || is_admin()) && gaurd()){
			$data = initial_data();		
			$data['user_rights_list'] = user_rights_list();
			$this->load->view('add_admin_user_rights_details',$data);
		}
	}
	// start add admin_user_rights_details in table
    public function validate_admin_user_rights_details()
    {
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){			
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library('javascript');
	   		$this->load->library('form_validation');
			$this->form_validation->set_rules('user_type', 'User Type', 'trim|required|callback_ajax_check_user_type|xss_clean');
	   		$this->form_validation->set_rules('user_rights[]','User Rights','trim|required|xss_clean');			
			if($this->form_validation->run() == FALSE)
	   		{ 
				$data = initial_data();	
				$data['user_rights_list'] = user_rights_list();				
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
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){
			$this->load->helper(array('form', 'url', 'text','captcha','html'));
			$this->load->helper('text');
			$data = initial_data();	
			$data['user_rights_list'] = user_rights_list();			
			$data['admin_user_rights_details_data'] = $this->admin_user_rights_details_model->get_admin_user_rights_details($this->input->get('id')); 			 
			$this->load->view('edit_admin_user_rights_details', $data);	
		}
    }
	// end edit driver details

	// start admin_user_rights 
    public function validate_edit_admin_user_rights_details()
    {
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){		
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library('javascript');
	   		$this->load->library('form_validation');	
	   		$this->form_validation->set_rules('user_type', 'User Type', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('user_rights[]','User Rights','trim|required|xss_clean');
			if($this->form_validation->run() == FALSE)
	   		{
				$data = initial_data();
		    	$data['user_rights_list'] = user_rights_list();						
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
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){		
			$this->load->helper(array('form', 'url', 'text','captcha','html'));		
			if($this->admin_user_rights_details_model->approve_user_rights())
			{				
				$this->session->set_flashdata('success_msg', 'Admin User Rights Status Changed successfully!');
			}			 
			redirect('admin_user_rights_details/admin_user_rights_details_list', $data);						
		}
    }
	// end approver admin_user_rights

	// start deny admin_user_rights
    function deny_user_rights()
    {
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){		
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			if($this->admin_user_rights_details_model->deny_user_rights())
			{				
				$this->session->set_flashdata('success_msg', 'Admin User Rights Status Changed successfully!');
			}		
			redirect('admin_user_rights_details/admin_user_rights_details_list', $data);						
		}
    }
	// end deny admin_user_rights

	// start delete admin_user_rights details
	public function delete_message()
	{
		if((access_permission($this->module_id) || is_admin()) && gaurd()){		
			$this->load->helper(array('form', 'url', 'text','captcha','html'));			
			if($this->admin_user_rights_details_model->delete_user_rights($this->input->get('id')))
			{				
				$this->session->set_flashdata('success_msg', 'Admin User Rights Details Deleted Successfully!');
			}
			else
			{
				$this->session->set_flashdata('failear_msg', 'Admin User Name Is Used By Other Module');
			}			 
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
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){	
			$data = initial_data();			
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
