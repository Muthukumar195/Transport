<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Driver_payment extends CI_Controller {

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
	
	
	public function driver_payment_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_payment_model'); 
			$data['driver_payment_list'] = $this->driver_payment_model->driver_payment_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('driver_payment_list', $data);
			
		}
	}
	public function add_driver_payment_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_details_model');
			$this->load->model('edit_admin_profile_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['driver_list'] = $this->driver_details_model->driver_list();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('add_driver_payment_details', $data);
		}
	}
	// start add Driver_pay_rate_details in table
    public function validate_driver_payment_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_payment_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
	   		$this->form_validation->set_rules('pay_date', 'Pay Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('driver_pay_status', 'Driver Pay Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('driver_amount', 'Amount', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
	   		
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$this->load->model('driver_details_model');
				$data['driver_list'] = $this->driver_details_model->driver_list();
				$this->load->view('add_driver_payment_details',$data); 	
			}
			else
			{
				
				$this->load->helper('inflector');
					if($query = $this->driver_payment_model->add_driver_payment())
					{
						$this->session->set_flashdata('success_msg', 'Driver Payment details added successfully!');					
						redirect('driver_payment/add_driver_payment_details');	
					}				
			}
		}
    }
	// end add Driver_payment_details in table
	// start edit driver payment details
    public function edit_driver_payment()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_payment_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['driver_payment_data'] = $this->driver_payment_model->get_driver_payment($this->input->get('id')); 
			$this->load->model('daily_movement_details_model'); 
			$data['movement_date'] = $this->daily_movement_details_model->daily_movement_details_list();
			$this->load->model('driver_details_model');
			$data['driver_list'] = $this->driver_details_model->driver_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('edit_driver_payment', $data);
			
		}
    }
	// end edit Driver_payment_details

	// start validate_edit_driver_ payment details 
    public function validate_edit_driver_payment()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_payment_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
	   		$this->form_validation->set_rules('movement_date', 'Daily Movement Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('pay_date', 'Pay Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('driver_pay_status', 'Driver Pay Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('other_expences', 'Other Expences', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
	   		
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count(); 
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$this->load->model('daily_movement_details_model'); 
			    $data['movement_date'] = $this->daily_movement_details_model->daily_movement_details_list();
				$this->load->model('driver_payment_model');
				$data['driver_payment_data'] = $this->driver_payment_model->get_driver_payment($this->input->post('id')); 				
				$this->load->view('edit_driver_payment', $data); 	
			}
			else
			{
				$this->load->helper('inflector');
				if($query = $this->driver_payment_model->edit_driver_payment($this->input->post('id')))
				{	
					$this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$data['driver_payment_list'] = $this->driver_payment_model->driver_payment_list(); 
					$this->session->set_flashdata('success_msg', 'Driver Payment details edited successfully!');
					$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				   //view upcoming vehicle document count
				    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
					$this->load->view('driver_payment_list', $data);					
				}
			}		
		}
    }
	// end validate_edit_Driver_payment_details

	// start delete Driver payment details
	public function delete_message()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_payment_model');
			if($this->driver_payment_model->delete_driver_payment())
			{				
				$this->session->set_flashdata('success_msg', 'Driver Payment Details Deleted Successfully!');
			}
			$data['driver_payment_list'] = $this->driver_payment_model->driver_payment_list();
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('driver_payment/driver_payment_list', $data);						
		}
	}
	// end delete Driver_payment_details

	// start view driver payment details
	public function view_driver_payment()
	{
		// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
		if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('driver_payment_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['view_driver_payment'] = $this->driver_payment_model->get_driver_payment($this->input->get('id'));
			$data['view_movement_payments'] = $this->driver_payment_model->get_movement_payment_details($this->input->get('id'));
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_driver_payment', $data);	
		}
	}
	//  end view driver payment details
	// start view driver payment Print details
	public function view_driver_payment_print()
	{
		// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
		if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('driver_payment_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['view_driver_payment'] = $this->driver_payment_model->get_driver_payment($this->input->get('id'));
			$data['view_movement_payments'] = $this->driver_payment_model->get_movement_payment_details($this->input->get('id'));
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_driver_payment_print', $data);	
		}
	}
	//  end view driver payment Print details
	 // start report page
    public function driver_payment_report()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
					
			$this->load->model('driver_payment_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['driver_payment_list'] = $this->driver_payment_model->search_driver_payment_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();			
			$this->load->view('driver_payment_report', $data);	
		}
    }
    // end report page
	
	
	// start driver_paid_daily_movement
    function driver_paid_daily_movement()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$send_id = $this->input->post('driver_id');
			$send_name = $this->input->post('driver_name');
			$this->load->model('edit_admin_profile_model'); 
	   		$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('daily_movement_details_model');
			if($this->daily_movement_details_model->driver_paid_daily_movement($this->input->post('daily_id')))
			{				
				$this->session->set_flashdata('success_msg', 'Driver Status Changed successfully!');
			}
			redirect('driver_payment/view_driver_payment?id='.$send_id.'&&dr_name='.$send_name);
								
		}
    }
	// end approver daily movemnt
	
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
