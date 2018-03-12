<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Transport_payment extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		 $this->load->model('due_details_model');
		$this->load->model('transport_payment_model');
		$this->load->model('edit_admin_profile_model'); 
		$this->load->model('vehicle_document_details_model');
		$this->load->model('transport_details_model'); 
	}

	function transport_payment_list(){

		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else{
	
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['transport_payment_list'] = $this->transport_payment_model->transport_payment_list();
            $data['transport_iso_payment_list'] = $this->transport_payment_model->transport_iso_payment_list();
			$data['daily_movement_payment'] = $this->transport_payment_model->daily_movement_payment();
			$data['iso_movement_payment'] = $this->transport_payment_model->iso_movement_payment();
			$data['transport_payment'] = $this->transport_payment_model->transport_payment();
			$this->load->view('transport_payment_list',$data);
		}
	}
	
	public function add_transport_payment()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['transport_name_list'] = $this->transport_details_model->transport_name_list();
			$this->load->view('add_transport_payment', $data);
		}
	}
	// start add validate_transport_payment in table
    public function validate_transport_payment()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
	   		$this->form_validation->set_rules('transport_name', 'Transport Name', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('amount', 'Paid Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('transport_pay_date', 'Transport Pay Date', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			if($this->form_validation->run() == FALSE)
	   		{
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();	
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$data['transport_name_list'] = $this->transport_details_model->transport_name_list();			
				$this->load->view('add_transport_payment',$data); 	//echo "sss"; exit;	
			}
			else
			{
				if($query = $this->transport_payment_model->add_transport_payment())
				{

					$this->session->set_flashdata('success_msg', 'Transport payment detail added successfully!');					
					redirect('transport_payment/add_transport_payment');	
				}				
			}
		}
    }
	// end add Transport_details in table

	// start delete_transport_payment
	public function delete_transport_payment()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Transport Payment", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			if($this->transport_payment_model->delete_transport_payment())
			{				
				$this->session->set_flashdata('success_msg', 'Transport Payment Details Deleted Successfully!');
			}
			redirect('transport_payment/transport_payment_list');					
		}
	}	
	 // start view party details
    public function view_transport_payments()
    {
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_transport_payments'] = $this->transport_payment_model->get_transport_payment_details($this->input->get('id')); 	
			$data['view_movement_payments_unpaid'] = $this->transport_payment_model->get_movement_payment_details_unpaid($this->input->get('id'));
			$data['view_movement_payments_paid'] = $this->transport_payment_model->get_movement_payment_paid($this->input->get('id'));
			$data['view_iso_movement_payments_unpaid'] = $this->transport_payment_model->iso_movement_payment_unpaid($this->input->get('id')); 
			$data['view_iso_movement_payments_paid'] = $this->transport_payment_model->iso_movement_payment_paid($this->input->get('id')); 			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_transport_payments', $data);	
		}
    } 
    // end view party details
	 // start view party Print details
    public function view_transport_payment_print()
    {	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['view_transport_payments'] = $this->transport_payment_model->get_transport_payment_details($this->input->get('id')); 
			$data['view_movement_payments_paid'] = $this->transport_payment_model->get_movement_payment_paid($this->input->get('id'));
			$data['view_iso_movement_payments_paid'] = $this->transport_payment_model->iso_movement_payment_paid($this->input->get('id'));		
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_transport_payment_print', $data);	
		}
    } 
    // end view party Print details
	 // start view party Print Unpaid details
    public function view_transport_payments_unpaid_print()
    {
    	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('party_payment_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_transport_payments'] = $this->transport_payment_model->get_transport_payment_details($this->input->get('id')); 
			$data['view_movement_payments_unpaid'] = $this->transport_payment_model->get_movement_payment_details_unpaid($this->input->get('id'));
			$data['view_iso_movement_payments_unpaid'] = $this->transport_payment_model->iso_movement_payment_unpaid($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_transport_payments_unpaid_print', $data);	
		}
    } 
    // end view party Print details
// start Paid Party daily movemnt
    function paid_daily_movement()
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
		{
			 $send_id = $this->input->post('trans_id');
		     $send_name = $this->input->post('trans_name');
			if($this->input->post('daily_id')!=""){
				$this->load->model('daily_movement_details_model');
				if($this->daily_movement_details_model->transport_paid_daily_movement($this->input->post('daily_id')))
				{				
					$this->session->set_flashdata('success_msg', 'Transport Payment Changed successfully!');
					redirect('/transport_payment/view_transport_payments?id='.$send_id.'&tr_nme='.$send_name);
				}
			}
			else{
				redirect('/transport_payment/view_transport_payments?id='.$send_id.'&tr_nme='.$send_name);
			}
		}
    }

	// start Unpaid daily movemnt
    function unpaid_daily_movement()
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
		{
			
			$this->load->model('daily_movement_details_model');
			if($this->daily_movement_details_model->unpaid_daily_movement())
			{				
				$this->session->set_flashdata('success_msg', 'Party Payment Status Changed successfully!');
				redirect('transport_payment/transport_payment_list');
			}
		}
    }
	// end deny daily movemnt
	
	// start Paid Transport Paymenrt Iso movemnt
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
		{	$send_id = $this->input->post('trans_id');
		     $send_name = $this->input->post('trans_name');
			if($this->input->post('iso_id')!=""){
				$this->load->model('iso_movement_details_model');
				if($this->iso_movement_details_model->transport_paid_iso_movement($this->input->post('iso_id')))
				{				
					$this->session->set_flashdata('success_msg', 'Transport Payment Changed successfully!');
					redirect('/transport_payment/view_transport_payments?id='.$send_id.'&tr_nme='.$send_name);
				}
			}
			else{
				redirect('/transport_payment/view_transport_payments?id='.$send_id.'&tr_nme='.$send_name);
			}
							
		}
    }
	// End Paid Transport Paymenrt Iso movemnt

	
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

?>