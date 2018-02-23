<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Party_pay_rate extends CI_Controller {

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

	public function party_pay_rate_list()
	{	
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Pay rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}		
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('party_pay_rate_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['party_pay_rate_list'] = $this->party_pay_rate_model->party_pay_rate_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			$this->load->view('party_pay_rate_list', $data);
		}
	}	
	
	public function add_party_pay_rate()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Pay rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('party_pay_rate_model');
			$this->load->model('driver_pay_rate_model');
			$this->load->model('party_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();			
			$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
			$data['party_name_list'] = $this->party_details_model->party_name_list();
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('add_party_pay_rate', $data);
		}
	}
	public function validate_party_pay_rate()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Pay rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_pay_rate_model');
	   		$this->form_validation->set_rules('place_name', 'Place Name', 'trim|required|xss_clean');			
	   		$this->form_validation->set_rules('party_name', 'Party Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ot_rent', 'Other Transport Rent', 'trim|required|xss_clean'); 
	   		$this->form_validation->set_rules('rent', 'Rent', 'trim|required|xss_clean');
	   		$this->load->model('party_pay_rate_model');	
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();

			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('party_pay_rate_model');
				$this->load->model('driver_pay_rate_model');
				$this->load->model('party_details_model');
				$this->load->model('edit_admin_profile_model'); 
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();			
				$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
				$data['party_name_list'] = $this->party_details_model->party_name_list();
				// view upcoming due counts
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
				$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$this->load->view('add_party_pay_rate', $data);	
			}
			else
			{	
					if($query = $this->party_pay_rate_model->add_party_pay_rate($this->input->post('place_name')))
					{					
						$this->session->set_flashdata('success_msg', 'Party PayRate added successfully!');	
						$this->load->model('driver_pay_rate_model');
						$this->load->model('party_details_model');
						$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
						$data['party_name_list'] = $this->party_details_model->party_name_list();
						$this->session->set_flashdata('success_msg', 'Party PayRate added successfully!');
						redirect('party_pay_rate/add_party_pay_rate', $data);	
					}
			}
		}
	}
	// start edit party_pay_rate
	public function edit_party_pay_rate()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Pay rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_pay_rate_model');
			$this->load->model('party_details_model');
			$this->load->model('party_pay_rate_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
			$data['party_name_list'] = $this->party_details_model->party_name_list();
			$data['get_party_pay_rate'] = $this->party_pay_rate_model->get_party_pay_rate($this->input->get('id'));
			// view upcoming due counts
			$this->load->model('due_details_model');
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			$this->load->view('edit_party_pay_rate', $data);	
		}
	}
	// end edit party_pay_rate details
    public function validate_edit_party_pay_rate()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Pay rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_pay_rate_model');
	   		$this->form_validation->set_rules('place_name', 'Place Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ot_rent', 'Other Transport Rent', 'trim|required|xss_clean');			
	   		$this->form_validation->set_rules('party_name', 'Party Name', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('rent', 'Rent', 'trim|required|xss_clean');
	   		$this->load->model('party_pay_rate_model');
					
	   		// view upcoming due counts
			
			$this->load->model('due_details_model');
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();

			if($this->form_validation->run() == FALSE)
	   		{		   				
				$this->load->model('driver_pay_rate_model');
				$this->load->model('party_details_model');
				$this->load->model('party_pay_rate_model');
				$this->load->model('due_details_model');
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
				$data['party_name_list'] = $this->party_details_model->party_name_list();
				$data['get_party_pay_rate'] = $this->party_pay_rate_model->get_party_pay_rate($this->input->post('id')); 
				
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$this->load->view('edit_party_pay_rate', $data); 	
			}
			else
			{
				
					if($query = $this->party_pay_rate_model->edit_party_pay_rate($this->input->post('id')))
					{			
						$this->load->helper(array('form', 'url', 'text','captcha','html'));
						$this->load->helper('text');		
						$this->load->model('driver_pay_rate_model');
						$this->load->model('party_details_model');
						$this->load->model('party_pay_rate_model');
						$this->load->model('edit_admin_profile_model');
						$this->load->model('due_details_model');
						$data['place_name_list'] = $this->driver_pay_rate_model->place_name_list();
						$data['party_name_list'] = $this->party_details_model->party_name_list();
						$data['get_party_pay_rate'] = $this->party_pay_rate_model->get_party_pay_rate($this->input->post('id')); 		   
						$data['party_pay_rate_list'] = $this->party_pay_rate_model->party_pay_rate_list(); 
			            $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
						$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
						//view upcoming vehicle document count
						$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
						$this->session->set_flashdata('success_msg', 'Party PayRate edited successfully!');
						$this->load->view('party_pay_rate_list', $data); 
							
					}
			}
		}
    }
	// end validate edit Party PayRate

	
    // start approve Party PayRate
    function approve_party_pay_rate()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Pay rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_pay_rate_model');
			if($this->party_pay_rate_model->approve_party_pay_rate())
			{				
				$this->session->set_flashdata('success_msg', 'Party PayRate Status Changed successfully!');
			}
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['party_pay_rate_list'] = $this->party_pay_rate_model->party_pay_rate_list(); 
			$this->load->view('party_pay_rate_list', $data);						
		}
    }
	// end approver Party PayRate
	

	// start deny Party PayRate
    function deny_party_pay_rate()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Pay rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_pay_rate_model');
			if($this->party_pay_rate_model->deny_party_pay_rate())
			{				
				$this->session->set_flashdata('success_msg', 'Party PayRate Status Changed successfully!');
			}
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['party_pay_rate_list'] = $this->party_pay_rate_model->party_pay_rate_list(); 
			$this->load->view('party_pay_rate_list', $data);						
		}
    }
	// end deny Party PayRate
	 
	// start delete Party PayRate
    public function delete_party_pay_rate()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Party Pay rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('party_pay_rate_model');			
			if($this->party_pay_rate_model->delete_party_pay_rate())
			{				
				$this->session->set_flashdata('success_msg', 'Party PayRate Details Deleted Successfully!');
			}
			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['party_pay_rate_list'] = $this->party_pay_rate_model->party_pay_rate_list(); 
			$this->load->view('party_pay_rate_list', $data);						
		}
    }
	// end delete Party PayRate

	
	// end manage Party PayRate status

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
