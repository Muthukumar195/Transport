<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Iso_movement_details extends CI_Controller {

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
	
	public function iso_movement_details_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('iso_movement_details_model'); 
			$data['iso_movement_details_list'] = $this->iso_movement_details_model->iso_movement_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('iso_movement_details_list', $data);
		}
	}	
	
	public function add_iso_movement_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('vehicle_details_model');	
			$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list();
			$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list();
			$this->load->model('container_details_model');	
			$data['container_number_list'] = $this->container_details_model->container_number_list();
			$this->load->model('transport_details_model');	
			$data['transport_name_list'] = $this->transport_details_model->transport_name_list();
			$this->load->model('party_pay_rate_model');
			$data['party_name_list'] = $this->party_pay_rate_model->party_name_list();
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('add_iso_movement_details', $data);
			
		}
	}
	// start add iso_movement_details
	public function validate_iso_movement_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('iso_movement_details_model');
	   		$this->form_validation->set_rules('iso_date', 'IOS Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('transport_type', 'Transport Type', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('container_feet', 'Container Size', 'trim|required|xss_clean');
			$this->form_validation->set_rules('container_f', 'Container Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ey_lo', 'EY/LO Type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('im_ex', 'Load Type', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('pick_up', 'Pick up', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('drop', 'Drop', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('transport_name', 'Transport Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tp_amount', 'Transport Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('party_name', 'Party Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('party_amount', 'Party Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('iso_amount', 'Iso Amount', 'trim|required|xss_clean');
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
		    if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model');
			    $this->load->model('due_details_model');	
		        $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
		        $data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
		        $data['upcoming_due_report'] = $this->due_details_model->upcoming_due_report();
	   			$this->load->model('vehicle_details_model');	
			    $data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list();
				$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list();
			    $this->load->model('container_details_model');	
			    $data['container_number_list'] = $this->container_details_model->container_number_list();
				$this->load->model('transport_details_model');	
			    $data['transport_name_list'] = $this->transport_details_model->transport_name_list(); 
				$this->load->model('party_pay_rate_model');
				$data['party_name_list'] = $this->party_pay_rate_model->party_name_list();
					
				$this->load->view('add_iso_movement_details', $data);
			}else{
					if($query = $this->iso_movement_details_model->add_iso_movement_details())
					{
						$this->load->model('edit_admin_profile_model'); 
			            $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();						
						$this->session->set_flashdata('success_msg', 'Iso Movement details added successfully!');
						$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
						//view upcoming vehicle document count
						$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				
						redirect('iso_movement_details/add_iso_movement_details');	
					}
			}
		}
	}
	// end  add iso_movement_details
	// start edit ISO Movement details
	public function edit_iso_movement_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->model('vehicle_details_model');
			$data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list();
			$this->load->model('transport_details_model');
			$data['transport_name_list'] = $this->transport_details_model->transport_name_list();
			$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list();
			$this->load->model('party_pay_rate_model');
			$data['party_name_list'] = $this->party_pay_rate_model->party_name_list();
			$this->load->model('container_details_model');
			$data['container_number_list'] = $this->container_details_model->container_number_list();
			$this->load->model('iso_movement_details_model'); 
			$data['iso_movement_details_data'] = $this->iso_movement_details_model->get_iso_movement_details($this->input->get('id')); 
			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
		    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('edit_iso_movement_details', $data);	
		}
	}
	// end edit ISO Movement details
 
	// start validate edit vISO Movement
    public function validate_edit_iso_movement_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('iso_movement_details_model');
	   		$this->form_validation->set_rules('iso_date', 'IOS Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('container_feet', 'Container Size', 'trim|required|xss_clean');
			$this->form_validation->set_rules('container_f', 'Container Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('ey_lo', 'EY/LO', 'trim|required|xss_clean');
			$this->form_validation->set_rules('im_ex', 'Load Type', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('pick_up', 'Pick up', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('drop', 'Drop', 'trim|required|xss_clean');
		    //$this->form_validation->set_rules('transport_name', 'Transport Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tp_amount', 'Transport Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('iso_amount', 'Iso Amount', 'trim|required|xss_clean');
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			 $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			
			if($this->form_validation->run() == FALSE)
	   		{
			    $this->load->model('edit_admin_profile_model');
			    $this->load->model('due_details_model');	
		        $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
		        $data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
		        $data['upcoming_due_report'] = $this->due_details_model->upcoming_due_report();
	   			$this->load->model('vehicle_details_model');	
			    $data['vehicle_number_list'] = $this->vehicle_details_model->vehicle_number_list();
				$data['vehicle_other_list'] = $this->vehicle_details_model->vehicle_other_list();
			    $this->load->model('container_details_model');	
			    $data['container_number_list'] = $this->container_details_model->container_number_list();
				$this->load->model('transport_details_model');	
				$this->load->model('party_pay_rate_model');
				$data['party_name_list'] = $this->party_pay_rate_model->party_name_list();
			    $data['transport_name_list'] = $this->transport_details_model->transport_name_list(); 
			    $this->load->model('iso_movement_details_model'); 
			    $data['iso_movement_details_data'] = $this->iso_movement_details_model->get_iso_movement_details($this->input->post('id'));
			   // print_r($data); exit; 
			    $this->load->view('edit_iso_movement_details', $data);
			}
			else{
				
				if($query = $this->iso_movement_details_model->edit_iso_movement_details($this->input->post('id')))
				{
					$this->load->model('edit_admin_profile_model');
					$this->load->model('due_details_model');	
				    $data['iso_movement_details_list'] = $this->iso_movement_details_model->iso_movement_details_list();
					$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				    $data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
					//view upcoming vehicle document count
			        $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
					$this->session->set_flashdata('success_msg', 'Iso Movement details edited successfully!'); 	
					$this->load->view('iso_movement_details_list', $data);	
									
				}
			}
		}
    }
	// end validate edit ISO Movement

	
    // start approve ISO Movement
    function approve_iso_movement_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('iso_movement_details_model'); 
			if($this->iso_movement_details_model->approve_iso_movement_details())
			{				
				$this->session->set_flashdata('success_msg', 'ISO Movement Status Changed successfully!');
			}
			$data['iso_movement_details_list'] = $this->iso_movement_details_model->iso_movement_details_list(); 	
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('iso_movement_details_list', $data);						
		}
    }
	// end approver ISO Movement

	// start deny ISO Movement
    function deny_iso_movement_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('iso_movement_details_model'); 
			if($this->iso_movement_details_model->deny_iso_movement_details())
			{				
				$this->session->set_flashdata('success_msg', 'ISO Movement Status Changed successfully!');
			}
			$data['iso_movement_details_list'] = $this->iso_movement_details_model->iso_movement_details_list(); 
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('iso_movement_details_list', $data);						
		}
    }
	// end deny ISO Movement

	// start delete ISO Movement details
    public function delete_iso_movement_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('iso_movement_details_model');			
			if($this->iso_movement_details_model->delete_iso_movement_details())
			{				
				$this->session->set_flashdata('success_msg', 'ISO Movement Details Deleted Successfully!');
			}
			$data['iso_movement_details_list'] = $this->iso_movement_details_model->iso_movement_details_list(); 
			// view upcoming due counts
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('iso_movement_details/iso_movement_details_list', $data);						
		}
    }
	// end delete ISO Movement details

	// end manage ISO Movement status

	function check_isvalidated()
	{
        if(! $this->session->userdata('username'))
        {	
        	$this->session->set_flashdata('failear_msg', 'Login Required');		
			redirect('tranport_main');			
        }		
		
    }
	 // start view view_all_iso_movement_details
    public function view_all_iso_movement_details()
    {
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('iso_movement_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$this->load->model('transport_payment_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();  
			$data['iso_all_movement_details_list'] = $this->iso_movement_details_model->iso_all_movement_details_list($this->input->get('id')); 			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_iso_payments', $data);	
		}
    } 
    // end view view_all_iso_movement_details
	 // start view iso_movement_details
    public function view_iso_movement_details()
    {
    	// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
    	if(! $this->session->userdata('username')){
			
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('iso_movement_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_iso_movement_details'] = $this->iso_movement_details_model->view_iso_movement_details_list($this->input->get('id')); 
			// view upcoming due counts
			
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_iso_movement_details', $data);	
		}
    }
    // end view iso_movement_details
	 // Start view iso_movement_ Print details
	 public function view_iso_movement_details_print()
    {
    	// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
    	if(! $this->session->userdata('username')){
			
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('iso_movement_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_iso_movement_details'] = $this->iso_movement_details_model->view_iso_movement_details_list($this->input->get('id')); 
			// view upcoming due counts
			
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_iso_movement_details_print', $data);	
		}
    }
    // end view iso_movement_ Print details
	public function view_iso_movement_report()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('iso_movement_details_model'); 
			$data['view_iso_movement_report'] = $this->iso_movement_details_model->search_iso_movement_report(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_iso_movement_report', $data);
		}
	}
	// start iso movement Print details
	public function view_iso_movement_report_print()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("ISO Movement", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('iso_movement_details_model'); 
			$data['view_iso_movement_report'] = $this->iso_movement_details_model->search_iso_movement_report(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_iso_movement_report_print', $data);
		}
	}
	// end iso movement Print details
	function check_user_rights()
    {
        $this->session->set_flashdata('failear_msg', 'Access Denied');		
		redirect('tranport_main');			
    }	

}

