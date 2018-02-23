<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Container_details extends CI_Controller {

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
    }
	
	
	public function container_details_list()
	{	
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('container_details_model'); 
			$data['container_details_list'] = $this->container_details_model->container_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$this->load->view('container_details_list', $data);
		}
	}
	public function add_container_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->view('add_container_details', $data);
			
		}
	}
	// start add Container details in table
    public function validate_container_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('container_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
	   	    $this->form_validation->set_rules('container_number','Container Number','trim|required|callback_ajax_check_con_num|xss_clean');
	   		$this->form_validation->set_rules('container_size', 'Container Size', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
	   		
			if($this->form_validation->run() == FALSE)
	   		{
	   			$this->load->model('edit_admin_profile_model'); 
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				// view upcoming due counts
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();			
				$this->load->view('add_container_details', $data); 	
			}
			else
			{
				$this->load->helper('inflector');
	
				if($query = $this->container_details_model->add_container_details())
				{
				$this->session->set_flashdata('success_msg', 'Container details added successfully!');					
				redirect('container_details/add_container_details');	
			    }				

			}
		}
    }
	// end add Container details in table
	// start edit Container details
    public function edit_container_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->model('container_details_model'); 
			$data['container_details_data'] = $this->container_details_model->get_container_details($this->input->get('id')); 
			$this->load->view('edit_container_details', $data);	
		}
    }
	// end edit container details

	// start validate_edit_container_details 
    public function validate_edit_container_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('container_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
	   		$this->form_validation->set_rules('container_number', 'Container Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('container_size', 'Container Size', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
	   		
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
				$this->load->model('container_details_model'); 
			    $data['container_details_data'] = $this->container_details_model->get_container_details($this->input->post('id'));  				
				$this->load->view('add_container_details', $data); 	
			}
			else
			{
				$this->load->helper('inflector');
					
				if($query = $this->container_details_model->edit_container_details($this->input->post('id')))
				{	
					$this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$data['container_details_list'] = $this->container_details_model->container_details_list(); 
					$this->session->set_flashdata('success_msg', 'Container details edited successfully!');	
					$this->load->view('container_details_list', $data);					
				}
			}		
		}
    }
	// end validate_edit_container_details

	// start approve container
    function approve_container()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('container_details_model'); 
			if($this->container_details_model->approve_container())
			{				
				$this->session->set_flashdata('success_msg', 'Container Status Changed successfully!');
			}
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$data['container_details_list'] = $this->container_details_model->container_details_list(); 
			redirect('container_details/container_details_list', $data);						
		}
    }
	// end approver container

	// start deny container
    function deny_container()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('container_details_model'); 
			if($this->container_details_model->deny_container())
			{				
				$this->session->set_flashdata('success_msg', 'Container Status Changed successfully!');
			}
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$data['container_details_list'] = $this->container_details_model->container_details_list(); 
			redirect('container_details/container_details_list', $data);						
		}
    }
	// end deny container

	// start delete container details
	public function delete_message()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('container_details_model');
			
			if($this->container_details_model->delete_container())
			{				
				$this->session->set_flashdata('success_msg', 'Container Details Deleted Successfully!');
			}
			else
			{
				$this->session->set_flashdata('failear_msg', 'Container Number Is Used By Other Module');
			}
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$data['container_details_list'] = $this->container_details_model->container_details_list(); 
			redirect('container_details/container_details_list', $data);						
		}
	}
	// end delete container details

	function check_isvalidated()
	{
        if(! $this->session->userdata('username'))
        {	
        	$this->session->set_flashdata('failear_msg', 'Login Required');		
			redirect('tranport_main');			
        }		
		
    }
	function check_type()
	{	  
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	  
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('container_details_model'); 
			$data = $this->container_details_model->get_container_list($this->input->get('container_type')); 
			$sel_bx='';
			foreach($data->result() as $row)
			{   
				$sel_bx .='<option value="'.$row->Container_dtl_id.'">'.$row->Container_dtl_container_no.'</option>';
				
			}
			$sel_bx .='
			     ';
			echo $sel_bx;
			}
	}
	function check_size()
	{	    
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('container_details_model'); 
			$data = $this->container_details_model->get_con_t_list($this->input->get('container_size')); 
			$select_size='  
			<option value="">Select Number</option>';
			foreach($data->result() as $row)
			{ 
				$select_size .='<option value="'.$row->Container_dtl_id.'">'.$row->Container_dtl_container_no.'</option>';
			}
			$select_size .='
			     ';
			echo $select_size;
			}
	}
	function check_value()
	{	    
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('container_details_model'); 
			$data = $this->container_details_model->get_con_value($this->input->get('container_value')); 
			
			$select_size='  
			<option value="">Select Number</option>';
			foreach($data->result() as $row)
			{ 
				$select_size .='<option value="'.$row->Container_dtl_id.'">'.$row->Container_dtl_container_no.'</option>';
			}
			$select_size .='
			     ';
			echo $select_size;
			}
	}

	// start view container details
	public function view_container_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('container_details_model'); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$data['view_container_details'] = $this->container_details_model->get_container_details($this->input->get('id')); 
			$this->load->view('view_container_details', $data);	
		}
	}
	// end view container details
	// start ajax check container number
	public function ajax_check_con_num($key)
	{
		$this->load->model('container_details_model');
		$is_exist = $this->container_details_model->ajax_check_con_num($key);
		if($is_exist==1){
			
			$this->form_validation->set_message('ajax_check_con_num', 'Container Number already exist');  
        	return false;
    	} 
		else 
		{
        	return true;
    	}

		
	}
	// end ajax check container number

	// start view report
	public function view_container_report()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Container Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('container_details_model'); 
			$data['container_details_list'] = $this->container_details_model->search_container_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();				
			$this->load->view('view_container_report', $data);	
		}
	}
	// start view report

	function check_user_rights()
    {
        $this->session->set_flashdata('failear_msg', 'Access Denied');		
		redirect('tranport_main');			
    }
	
}
