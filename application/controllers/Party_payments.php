<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party_payments extends CI_Controller {

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
	
	public function party_payments_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_payment_model'); 
			$data['party_payments_list'] = $this->party_payment_model->party_payments_list();
			$data['movement_outstand_payment'] = $this->party_payment_model->movement_outstand_payment(); 	
			$data['party_outstand_payment'] = $this->party_payment_model->party_outstand_payment(); 
			$data['party_iso_payment_list'] = $this->party_payment_model->party_iso_payment_list();
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('party_payments_list', $data);
		}
	} 
	public function add_party_payment_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_details_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['party_name_list'] = $this->party_details_model->party_name_list();
			$this->load->view('add_party_payment_details', $data);
		}
	}
	// start add party_details in table
    public function validate_party_payment_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
	   		$this->form_validation->set_rules('party_name', 'Party Name', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('amount', 'Paid Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('party_pay_date', 'Party Pay Date', 'trim|required|xss_clean');
	   		//$this->form_validation->set_rules('party_pay_status', 'Party Pay Status', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('remarks', '', 'trim|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
	   		
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
				$this->load->model('party_details_model');
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$data['party_name_list'] = $this->party_details_model->party_name_list();			
				$this->load->view('add_party_payment_details',$data); 	
			}
			else
			{
				$this->load->helper('inflector');
				$this->load->model('party_payment_model');
					if($query = $this->party_payment_model->add_party_payment_details())
					{
						$this->session->set_flashdata('success_msg', 'Party payment detail added successfully!');					
						redirect('party_payments/add_party_payment_details');	
					}				
			}
		}
    }
	// end add party_details in table
	// start edit driver details
    public function edit_party_payment_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_payment_model');
			$data['party_payment_details_data'] = $this->party_payment_model->get_party_payment_details($this->input->get('id'));
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['party_name_list'] = $this->party_details_model->party_name_list();	
			$this->load->view('edit_party_payment_details', $data);
				
		}
    }
	// end edit party_details

	// start validate_edit_party_details 
    public function validate_edit_party_payment_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
	   		$this->form_validation->set_rules('party_name', 'Party Name', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('amount', 'Paid Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('party_pay_date', 'Party Pay Date', 'trim|required|xss_clean');
	   		//$this->form_validation->set_rules('party_pay_status', 'Party Pay Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remarks', '', 'trim|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
	   		$this->load->model('party_payment_model');
			
			if($this->form_validation->run() == FALSE)
	   		{  				
				$this->load->model('party_details_model'); 				
				$data['party_payment_details_data'] = $this->party_payment_model->get_party_payment_details($this->input->post('id'));				
				$data['party_name_list'] = $this->party_details_model->party_name_list();	
				$this->load->view('edit_party_payment_details',$data); 	
			}
			else
			{
				$this->load->helper('inflector');
					
				if($query = $this->party_payment_model->edit_party_payment_details($this->input->post('id')))
				{	
					$this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$data['party_payments_list'] = $this->party_payment_model->party_payments_list();
					$this->session->set_flashdata('success_msg', 'party payment detail edited successfully!');	
					$this->load->view('party_payments_list', $data);					
				}
			}		
		}
    }
	// end validate_edit_party_details	

	// start delete party_details
	public function delete_party_payment()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_payment_model');
			
			if($this->party_payment_model->delete_party_payment_details())
			{				
				$this->session->set_flashdata('success_msg', 'Party Payment Details Deleted Successfully!');
			}
			
			$data['party_payments_list'] = $this->party_payment_model->party_payments_list();
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('party_payments/party_payments_list', $data);					
		}
	}	
	 // start view party details
    public function view_party_payments()
    {
    	// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/
		//echo $this->input->get('id'); exit;	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('daily_movement_details_model');			
			$this->load->model('party_payment_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_party_payments'] = $this->party_payment_model->get_party_payment_details($this->input->get('id')); 	
			$data['view_movement_payments_unpaid'] = $this->party_payment_model->get_movement_payment_details_unpaid($this->input->get('id'));
			$data['view_movement_payments_paid'] = $this->party_payment_model->get_movement_payment_paid($this->input->get('id')); 
			$data['view_iso_movement_payments_unpaid'] = $this->party_payment_model->iso_movement_payment_unpaid($this->input->get('id')); 
			$data['view_iso_movement_payments_paid'] = $this->party_payment_model->iso_movement_payment_paid($this->input->get('id')); 	
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_party_payments', $data);	
		}
    } 
    // end view party details
	
	 // start view party Print details
    public function view_party_payments_print()
    {
    	// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('party_payment_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			
			$data['view_movement_payments_paid'] = $this->party_payment_model->get_movement_payment_paid($this->input->get('id'));		
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_party_payments_print', $data);	
		}
    } 
    // end view party Print details
	 // start view party Print Unpaid details
    public function view_party_payments_unpaid_print()
    {
    	// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('party_payment_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_movement_payments_unpaid'] = $this->party_payment_model->get_movement_payment_details_unpaid($this->input->get('id'));
					
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_party_payments_unpaid_print', $data);	
		}
    } 
    // end view party Print details
// start Paid Party daily movemnt
    function paid_daily_movement()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$send_id = $this->input->post('party_id');
			$this->load->model('edit_admin_profile_model'); 
	   		$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('daily_movement_details_model');
			if($this->daily_movement_details_model->paid_daily_movement($this->input->post('daily_id')))
			{				
				$this->session->set_flashdata('success_msg', 'Party Status Changed successfully!');
			}
			redirect('party_payments/view_party_payments?id='.$send_id);
								
		}
    }
	// end approver daily movemnt
	

	// start Unpaid daily movemnt
    function unpaid_daily_movement()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			if($this->daily_movement_details_model->unpaid_daily_movement())
			{				
				$this->session->set_flashdata('success_msg', 'Party Payment Status Changed successfully!');
			}
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->model('party_payment_model'); 
			$data['party_payments_list'] = $this->party_payment_model->party_payments_list();
			$data['movement_outstand_payment'] = $this->party_payment_model->movement_outstand_payment(); 	
			$data['party_outstand_payment'] = $this->party_payment_model->party_outstand_payment();  
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('party_payments_list', $data);
		}
    }
	// end deny daily movemnt
	
	// start Paid party Paymenrt Iso movemnt
    function paid_iso_movement()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{	$send_id = $this->input->post('party_id');
		     $send_name = $this->input->post('party_name');
			if($this->input->post('iso_id')!=""){
				$this->load->model('iso_movement_details_model');
				if($this->iso_movement_details_model->party_paid_iso_movement($this->input->post('iso_id')))
				{				
					$this->session->set_flashdata('success_msg', 'Transport Payment Changed successfully!');
					redirect('/party_payments/view_party_payments?id='.$send_id.'&pr_nme='.$send_name);
				}
			}
			else{
				redirect('/party_payments/view_party_payments?id='.$send_id.'&pr_nme='.$send_name);
			}
							
		}
    }
	// End Paid party Paymenrt Iso movemnt

	
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
