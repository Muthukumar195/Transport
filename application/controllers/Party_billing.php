<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Party_billing extends CI_Controller {

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
	
	public function party_billing_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_billing_model');
			$data['party_billing_list'] = $this->party_billing_model->party_billing_list();
			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('party_billing_list', $data);
		}
	} 
	public function add_party_billing()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			// Party Name List
			$data['party_name_list'] = $this->party_details_model->party_name_list(); 
			$this->load->view('add_party_billing', $data);
		}
	}
	// start add party_details in table
    public function validate_party_billing()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_billing_model'); 
	   		$this->form_validation->set_rules('billing_date', 'Billing Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('party_name', 'Party Name', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('container_no', 'Container No', 'trim|required|xss_clean');
			$this->form_validation->set_rules('material', 'Material', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('consignee', 'Consignee', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('consignor', 'Consignor', 'trim|required|xss_clean');
			$this->form_validation->set_rules('int_no', 'INT No', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('billing_from', 'From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('billing_to', 'To', 'trim|required|xss_clean');
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
				// Party Name List
				$data['party_name_list'] = $this->party_details_model->party_name_list(); 
				$this->load->view('add_party_billing', $data); 	
			}
			else
			{
				$this->load->helper('inflector');
				
					if($query = $this->party_billing_model->add_party_billing())
					{
						$this->session->set_flashdata('success_msg', 'Party Billing details added successfully!');					
						redirect('party_billing/add_party_billing');	
					}				
			}
		}
    }
	// end add party_details in table
	// start edit driver billing details
    public function edit_party_billing()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_details_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->model('party_billing_model'); 
			$data['party_billing_data'] = $this->party_billing_model->get_party_billing($this->input->get('id'));
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			// Party Name List
				$data['party_name_list'] = $this->party_details_model->party_name_list(); 
			$this->load->view('edit_party_billing', $data);
				
		}
    }
	// end edit party_ billing details

	// start validate_edit_party_details 
    public function validate_edit_party_billing()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_billing_model'); 
	   		$this->form_validation->set_rules('billing_date', 'Billing Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('party_name', 'Party Name', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('container_no', 'Container No', 'trim|required|xss_clean');
			$this->form_validation->set_rules('material', 'Material', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('consignee', 'Consignee', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('consignor', 'Consignor', 'trim|required|xss_clean');
			$this->form_validation->set_rules('int_no', 'INT No', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('billing_from', 'From', 'trim|required|xss_clean');
			$this->form_validation->set_rules('billing_to', 'To', 'trim|required|xss_clean');
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
				// Party Name List
				$data['party_name_list'] = $this->party_details_model->party_name_list();
			    $data['party_billing_data'] = $this->party_billing_model->get_party_billing($this->input->post('id'));			
				$this->load->view('edit_party_billing',$data); 	
			}
			else
			{
				$this->load->helper('inflector');
					
				if($query = $this->party_billing_model->edit_party_billing($this->input->post('id')))
				{	
					$this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$data['party_billing_list'] = $this->party_billing_model->party_billing_list();
					$this->session->set_flashdata('success_msg', 'party Billing details edited successfully!');	
					$this->load->model('edit_admin_profile_model'); 
					$this->load->model('party_details_model');
					$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
					// view upcoming due counts
					$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
					//view upcoming vehicle document count
					$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
					$this->load->view('party_billing_list', $data);					
				}
			}		
		}
    }
	// end validate_edit_party billing _details

	// start approve party_ Billing details
    function approve_party_billing()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_billing_model'); 
			if($this->party_billing_model->approve_party_billing())
			{				
				$this->session->set_flashdata('success_msg', 'Party Billing Status Changed successfully!');
			}
			$data['party_billing_list'] = $this->party_billing_model->party_billing_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('party_billing/party_billing_list', $data);						
		}
    }
	// end approver party_details

	// start deny party_ Billing details
    function deny_party_billing()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_billing_model'); 
			if($this->party_billing_model->deny_party_billing())
			{				
				$this->session->set_flashdata('success_msg', 'Party Billing Status Changed successfully!');
			}
			$data['party_billing_list'] = $this->party_billing_model->party_billing_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('party_billing/party_billing_list', $data);						
		}
    }
	// end deny party_ Billing sdetails

	// start delete party_ Billing details
	public function delete_message()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_billing_model');
			
			if($this->party_billing_model->delete_party_billing())
			{				
				$this->session->set_flashdata('success_msg', 'Party Billing Details Deleted Successfully!');
			}
			$data['party_billing_list'] = $this->party_billing_model->party_billing_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('party_billing/party_billing_list', $data);						
		}
	}
	// end delete party_ Billing details
     
	 // start view party details
    public function view_party_billing()
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
						
			$this->load->model('party_billing_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_party_billing'] = $this->party_billing_model->get_party_billing_details($this->input->get('id')); 
			$data['view_movement_details'] = $this->party_billing_model->get_movement_billing_details($this->input->get('id'));   
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_party_billing', $data);	
		}
    } 
    // end view party details
	 // start view party details
    public function view_party_billing_print()
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
						
			$this->load->model('party_billing_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_party_billing'] = $this->party_billing_model->get_party_billing_details($this->input->get('id')); 
			$data['view_movement_details'] = $this->party_billing_model->get_movement_billing_details($this->input->get('id'));   
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_party_billing_print', $data);	
		}
    } 
    // end view party details
	// Start Read party details
	public function read_party_billing_details()
	{
		if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('party_billing_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['read_party_billing'] = $this->party_billing_model->read_billing_details($this->input->get('id')); 
			//$data['view_movement_details'] = $this->party_billing_model->get_movement_billing_details($this->input->get('id'));   
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('read_party_billing_details', $data);	
		}
	}
	
	// end Read party details
	// Start Read party Print details
	public function read_party_billing_details_print()
	{
		if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('party_billing_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['read_party_billing'] = $this->party_billing_model->read_billing_details($this->input->get('id')); 
			//$data['view_movement_details'] = $this->party_billing_model->get_movement_billing_details($this->input->get('id'));   
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('read_party_billing_details_print', $data);	
		}
	}
	
	// end Read party Print details
	//Start Party Container number check
	function check_container()
	{	    
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{	 		
			$this->load->model('party_billing_model'); 
			$data = $this->party_billing_model->get_container_list($this->input->get('party_name'));
			$select_no='<option value="">Select Container</option>';
			foreach($data->result() as $row)
			{ 
				$select_no .='<option value="'.$row->Party_billing_id.'">'.$row->Party_billing_container_no.'</option>';
			}
			$select_no .='';
			echo $select_no;
			}
	}
	//Start Party Report
	public function view_party_billing_report()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('party_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->model('party_billing_model');
			$data['party_billing_report'] = $this->party_billing_model->Search_party_billing();
			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['party_name_list'] = $this->party_details_model->party_name_list(); 
			$this->load->view('view_party_billing_Report', $data);
		}
	} 
	// End Report
	//Start Report Print
	public function view_party_billing_report_print()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Billing", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('party_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->model('party_billing_model');
			$data['party_billing_report'] = $this->party_billing_model->Search_party_billing();
			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['party_name_list'] = $this->party_details_model->party_name_list(); 
			$this->load->view('view_party_billing_Report_print', $data);
		}
	} 
	//End Report Print 
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
