<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Daily_movement extends CI_Controller {

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

	public function daily_movement_details_list()
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
			$data['daily_movement_details_list'] = $this->daily_movement_details_model->daily_movement_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			$this->load->view('daily_movement_details_list', $data);
		}
	}	
	// start read daily movemnt details
	public function read_daily_movement_details()
	{
		// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('daily_movement_details_model'); 
			$this->load->model('edit_admin_profile_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['read_daily_movement_details'] = $this->daily_movement_details_model->read_daily_movement_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('read_daily_movement_details', $data);
		}
	}
	// end read daily movement details
	// start read daily movemnt Print details
	public function read_daily_movement_details_print()
	{
		// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('daily_movement_details_model'); 
			$this->load->model('edit_admin_profile_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['read_daily_movement_details'] = $this->daily_movement_details_model->read_daily_movement_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('read_daily_movement_details_print', $data);
		}
	}
	// end read daily movement Print details
	public function add_daily_movement_details()
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
			$this->load->model('vehicle_details_model');	
			$this->load->model('container_details_model');	
			$this->load->model('driver_pay_rate_model');
			$this->load->model('party_details_model');
			$this->load->model('driver_details_model');
			$this->load->model('transport_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$this->load->model('party_pay_rate_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list();
			$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list();
			$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list();			
			$data['place_name_list'] = $this->party_pay_rate_model->place_name_list($this->input->post('party_name'));
			$data['party_name_list'] = $this->party_pay_rate_model->party_name_list();
			$data['transport_name_list'] = $this->transport_details_model->transport_name_list();
			$data['driver_list'] = $this->driver_details_model->driver_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('add_daily_movement_details', $data);
		}
	}
	public function validate_daily_movement_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
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
			$this->load->model('daily_movement_details_model');
	   		$this->form_validation->set_rules('daily_movement_date', 'Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('transport_type', 'Transport Type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('container_type', 'Container Type', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('place_name', 'Place Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pick_up', 'Pick up', 'trim|required|xss_clean');
			$this->form_validation->set_rules('drop', 'Drop', 'trim|required|xss_clean');
			$this->form_validation->set_rules('loading_status', 'Loding Status', 'trim|required|xss_clean');			
	   		$this->form_validation->set_rules('party_name', 'Party Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('party_advance', 'Party Advance', 'trim|required|xss_clean'); 
	   		
	   		$this->form_validation->set_rules('rent', 'Rent', 'trim|required|xss_clean');
	   		$this->load->model('daily_movement_details_model');	
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();

			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model');	   			
				$this->load->model('vehicle_details_model');	
				$this->load->model('container_details_model');	
				$this->load->model('driver_pay_rate_model');
				$this->load->model('party_details_model');
				$this->load->model('transport_details_model');
				$this->load->model('driver_details_model'); 
				$this->load->model('party_pay_rate_model');
				$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list(); 
				$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list();
				$data['container_number_list'] = $this->container_details_model->container_number_list();
				$data['place_name_list'] = $this->party_pay_rate_model->place_name_list();
				$data['party_name_list'] = $this->party_pay_rate_model->party_name_list();
				$data['transport_name_list'] = $this->transport_details_model->transport_name_list();
				$data['driver_list'] = $this->driver_details_model->driver_list();
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				// view upcoming due counts
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$this->load->view('add_daily_movement_details', $data); 	
			}
			else
			{	
					if($query = $this->daily_movement_details_model->add_daily_movement_details($this->input->post('place_name')))
					{					
						$this->session->set_flashdata('success_msg', 'Daily movement details added successfully!');	
						$this->load->model('vehicle_details_model');	
						$this->load->model('container_details_model');	
						$this->load->model('driver_pay_rate_model');
						$this->load->model('party_details_model');
						$this->load->model('transport_details_model');
						$this->load->model('driver_details_model'); 
						$this->load->model('party_pay_rate_model');
						$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list(); 
						$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list();
						$data['container_number_list'] = $this->container_details_model->container_number_list();
						$data['place_name_list'] = $this->party_pay_rate_model->place_name_list();
						$data['party_name_list'] = $this->party_pay_rate_model->party_name_list();
						$data['transport_name_list'] = $this->transport_details_model->transport_name_list();
						$data['driver_list'] = $this->driver_details_model->driver_list(); 
						$this->session->set_flashdata('success_msg', 'Daily movement details added successfully!');
						redirect('daily_movement/add_daily_movement_details', $data);	
					}
			}
		}
	}
	// start edit daily movemnt details
	public function edit_daily_movement_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('vehicle_details_model');	
			$this->load->model('container_details_model');	
			$this->load->model('driver_pay_rate_model');
			$this->load->model('party_details_model');
			$this->load->model('driver_details_model');
			$this->load->model('party_billing_model');
			$this->load->model('daily_movement_details_model');
			$this->load->model('transport_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list(); 
			$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list();
			$data['container_number_list'] = $this->party_billing_model->container_number_list();
			$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
			$data['party_name_list'] = $this->party_details_model->party_name_list();
			$data['transport_name_list'] = $this->transport_details_model->transport_name_list();
			$data['driver_list'] = $this->driver_details_model->driver_list(); 	
			$data['read_daily_movement_details'] = $this->daily_movement_details_model->read_daily_movement_details($this->input->get('id'));
			// view upcoming due counts
			$this->load->model('due_details_model');
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			$this->load->view('edit_daily_movement_details', $data);	
		}
	}
	// end edit daily movemnt details

	// start validate edit daily movement details
    public function validate_edit_daily_movement_details()
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
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library('javascript');
	   		$this->load->library('form_validation');	
			$this->load->model('daily_movement_details_model');
	   		$this->form_validation->set_rules('daily_movement_date', 'Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('transport_type', 'Transport Type', 'trim|required|xss_clean');
	   		//$this->form_validation->set_rules('container_no', 'container Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('place_name', 'Place Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pick_up', 'Pick up', 'trim|required|xss_clean');
			$this->form_validation->set_rules('drop', 'Drop', 'trim|required|xss_clean');
			$this->form_validation->set_rules('loading_status', 'Loding Status', 'trim|required|xss_clean');			
	   		$this->form_validation->set_rules('party_name', 'Party Name', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('party_advance', 'Party Advance', 'trim|required|xss_clean'); 
	   		//$this->form_validation->set_rules('driver_name', 'Driver Name', 'trim|required|xss_clean'); 
	   		$this->form_validation->set_rules('rent', 'Rent', 'trim|required|xss_clean');
	   		$this->load->model('daily_movement_details_model');
					
	   		// view upcoming due counts
			
			$this->load->model('due_details_model');
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();

			if($this->form_validation->run() == FALSE)
	   		{		   			
				$this->load->model('vehicle_details_model');	
				$this->load->model('container_details_model');	
				$this->load->model('driver_pay_rate_model');
				$this->load->model('party_details_model');
				$this->load->model('driver_details_model');
				$this->load->model('daily_movement_details_model');
				$this->load->model('transport_details_model');
				$this->load->model('due_details_model');
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list();
				$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list(); 
				$data['container_number_list'] = $this->container_details_model->container_number_list();
				$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
				$data['party_name_list'] = $this->party_details_model->party_name_list();
				$data['transport_name_list'] = $this->transport_details_model->transport_name_list();
				$data['driver_list'] = $this->driver_details_model->driver_list();
				$data['read_daily_movement_details'] = $this->daily_movement_details_model->read_daily_movement_details($this->input->post('id')); 
				
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$this->load->view('edit_daily_movement_details', $data); 	
			}
			else
			{
				
					if($query = $this->daily_movement_details_model->edit_daily_movement_details($this->input->post('id'), $this->input->post('place_name')))
					{	
												
							
						$this->load->model('vehicle_details_model');	
						$this->load->model('container_details_model');	
						$this->load->model('driver_pay_rate_model');
						$this->load->model('party_details_model');
						$this->load->model('driver_details_model');
						$this->load->model('daily_movement_details_model');
						$this->load->model('transport_details_model');
						$this->load->model('edit_admin_profile_model');
						$this->load->model('due_details_model');
						$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list();
						$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list(); 
						$data['container_number_list'] = $this->container_details_model->container_number_list();
						$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
						$data['party_name_list'] = $this->party_details_model->party_name_list();
						$data['driver_list'] = $this->driver_details_model->driver_list();
						$data['read_daily_movement_details'] = $this->daily_movement_details_model->read_daily_movement_details($this->input->post('id')); 		   
						$data['daily_movement_details_list'] = $this->daily_movement_details_model->daily_movement_details_list();
						$data['transport_name_list'] = $this->transport_details_model->transport_name_list();  
			            $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
						$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
						//view upcoming vehicle document count
						$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
						$this->session->set_flashdata('success_msg', 'Daily movement details edited successfully!');
						$this->load->view('daily_movement_details_list', $data); 
							
					}
			}
		}
    }
	// end validate edit daily movement details

	
    // start approve daily movemnt
    function approve_daily_movement()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('edit_admin_profile_model'); 
	   		$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('daily_movement_details_model');
			if($this->daily_movement_details_model->approve_daily_movement())
			{				
				$this->session->set_flashdata('success_msg', 'Daily movement Status Changed successfully!');
			}
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['daily_movement_details_list'] = $this->daily_movement_details_model->daily_movement_details_list(); 
			$this->load->view('daily_movement_details_list', $data);						
		}
    }
	// end approver daily movemnt
	

	// start deny daily movemnt
    function deny_daily_movement()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('edit_admin_profile_model'); 
	   		$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('daily_movement_details_model');
			if($this->daily_movement_details_model->deny_daily_movement())
			{				
				$this->session->set_flashdata('success_msg', 'Daily movement Status Changed successfully!');
			}
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['daily_movement_details_list'] = $this->daily_movement_details_model->daily_movement_details_list(); 
			$this->load->view('daily_movement_details_list', $data);						
		}
    }
	// end deny daily movemnt
	 
	// start delete daily movemnt details
    public function delete_daily_movement()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('daily_movement_details_model');			
			if($this->daily_movement_details_model->delete_daily_movement())
			{				
				$this->session->set_flashdata('success_msg', 'Daily movement Details Deleted Successfully!');
			}
			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['daily_movement_details_list'] = $this->daily_movement_details_model->daily_movement_details_list(); 
			$this->load->view('daily_movement_details_list', $data);						
		}
    }
	// end delete daily movemnt details

	
	// end manage daily movemnt status

	function check_isvalidated()
	{
        if(! $this->session->userdata('username'))
        {	
        	$this->session->set_flashdata('failear_msg', 'Login Required');		
			redirect('tranport_main');			
        }		
		
    }
	 // start daily_movement report page
    public function view_daily_movement_report()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
					
			$this->load->model('daily_movement_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['daily_movement_details_list'] = $this->daily_movement_details_model->search_daily_movement_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();			
			$this->load->view('view_daily_movement_report', $data);	
		}
    }
    // end daily_movement report page
	 // start daily_movement report Print page
    public function view_daily_movement_report_print()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
					
			$this->load->model('daily_movement_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['daily_movement_details_list'] = $this->daily_movement_details_model->search_daily_movement_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();			
			$this->load->view('view_daily_movement_report_print', $data);	
		}
    }
    // end daily_movement report Print page
   // start check date of advance
 public function check_driver_adv()
    {
    	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{		
			$this->load->model('daily_movement_details_model');
			$data = $this->daily_movement_details_model->get_daily_movement_list($this->input->get('movement_adv'));
			foreach($data->result() as $row)
			{ 
				echo $row->Daily_mvnt_dtl_advance;
			}
		}
			
}
    // end check date of advance
	// start check date of total
	public function check_driver_total()
		{
			
			if(! $this->session->userdata('username')){
				/*$this->index();*/
				$this->check_isvalidated();
			}
			else
			{		
				$this->load->model('daily_movement_details_model');
				$data = $this->daily_movement_details_model->get_daily_movement_list($this->input->get('driver_total'));
				foreach($data->result() as $row)
				{ 
					echo $row->Daily_mvnt_dtl_driver_total_pay;
				}
			}
				
	}
    // end check date of advance 
    

	// check_place_name
	public function check_place_name()
    {
    	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{		
			$this->load->model('party_pay_rate_model');
			$data = $this->party_pay_rate_model->place_name_list($this->input->get('party_name'));

			$select_size='  
			<option value="">Select Place Name</option>';
			foreach($data->result() as $row)
			{ 
				$select_size .='<option value="'.$row->party_pay_rate_id.'">'. $row->Driver_pay_rate_place_name.'</option>';
			}
			$select_size .='';
			echo $select_size;
		}
	}

	//ajax_change_rent
	public function ajax_change_rent()
    {
    	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{	
			$this->load->model('party_pay_rate_model');
			$data = $this->party_pay_rate_model->party_rent($this->input->get('place_id'),$this->input->get('party_id'));
            $result = $data->result();			
			$t_rent = $result[0]->party_pay_rate_rent;
			$o_rent = $result[0]->party_pay_rate_ot_rent;
			echo $t_rent.'^'.$o_rent;
		}
		
	}
   
public function check_driver_name()
    {
    	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{		
			$this->load->model('daily_movement_details_model');
			$data = $this->daily_movement_details_model->get_daily_movement_driver_list($this->input->get('driver_name'));
			$select_size='  
			<option value="">Select Movement Date</option>';
			foreach($data->result() as $row)
			{ 
				$select_size .='<option value="'.$row->Daily_mvnt_dtl_id.'">'. date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)).'</option>';
			}
			$select_size .='';
			echo $select_size;
			}
		
			
}
// end check date of advance
	public function add_other_expenses()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('daily_movement_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			
			$data['read_daily_movement_details'] = $this->daily_movement_details_model->read_daily_movement_details($this->input->get('id'));
			// view upcoming due counts
			$this->load->model('due_details_model');
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('add_other_expenses', $data);	
		}
	}
	// end edit daily movemnt details

	// start validate_add_other_expenses
    public function validate_add_other_expenses()
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
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library('javascript');
	   		$this->load->library('form_validation');	
			$this->load->model('daily_movement_details_model');
	   		$this->form_validation->set_rules('other_expences', 'Other Expenses', 'trim|required|xss_clean'); 
	   		$this->load->model('daily_movement_details_model');
	   		// view upcoming due counts
			$this->load->model('due_details_model');
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$this->load->model('vehicle_document_details_model');
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();

			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('daily_movement_details_model');
				$this->load->model('due_details_model');
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['read_daily_movement_details'] = $this->daily_movement_details_model->read_daily_movement_details($this->input->post('id')); 
				
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$this->load->view('edit_daily_movement_details', $data); 	
			}
			else
			{
				
				if($query = $this->daily_movement_details_model->add_other_expenses($this->input->post('id')))
				{
					$this->load->model('daily_movement_details_model');
					$this->load->model('edit_admin_profile_model');
					$this->load->model('due_details_model');
					$data['daily_movement_details_list'] = $this->daily_movement_details_model->daily_movement_details_list();  
					$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
					$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
					$this->session->set_flashdata('success_msg', 'Add Driver Other Expenses successfully!');
					$this->load->view('daily_movement_details_list', $data); 
				}
			}
		}
    }
	// end validate_add_other_expenses


//start transport expenses
public function add_transport_expenses()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Daily Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			
			$this->load->model('daily_movement_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['read_daily_movement_details'] = $this->daily_movement_details_model->read_daily_movement_details($this->input->get('id'));
			// view upcoming due counts
			$this->load->model('due_details_model');
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('add_transport_expenses', $data);	
		}
	}
	// end transport expenses

	// start validate_add_transport expenses
    public function validate_add_transport_expenses()
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
			// view upcoming due counts
			$this->load->model('due_details_model');
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$this->load->model('vehicle_document_details_model');
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			$this->load->library('session');
			$this->load->model('daily_movement_details_model');
			if($query = $this->daily_movement_details_model->add_transport_expenses($this->input->post('id')))
			{
				$this->load->model('daily_movement_details_model');
				$this->load->model('edit_admin_profile_model');
				$this->load->model('due_details_model');
				$data['daily_movement_details_list'] = $this->daily_movement_details_model->daily_movement_details_list();  
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			    $this->session->set_flashdata('success_msg', 'Add Transport Expenses successfully!');
				$this->load->view('daily_movement_details_list', $data); 
					
			}
			
		}
    }
	// end validate_add_transport expences
 

    function check_user_rights()
    {
        $this->session->set_flashdata('failear_msg', 'Access Denied');		
		redirect('tranport_main');			
    }
}
