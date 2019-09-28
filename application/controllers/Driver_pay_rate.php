<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Driver_pay_rate extends CI_Controller {

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
		$this->load->model('driver_pay_rate_model');
		$this->module_id = 2;
    }
	
	
	public function driver_pay_rate_list()
	{		
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Pay Rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_pay_rate_model'); 
			$data['driver_pay_rate_list'] = $this->driver_pay_rate_model->driver_pay_rate_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('driver_pay_rate_list', $data);
			
		}
	}
	
	
	public function driver_pay_rate_ajax_list(){
		 
		// DB table to use
		$table = 'driver_pay_rate';

		// Table's primary key
		$primaryKey = 'Driver_pay_rate_id';
	 
		$columns = array(				 
				array( 'db' => 'Driver_pay_rate_id', 'dt' => 0 , 
				'formatter' => function($id, $row){
					return '<input type="checkbox" name="selected_list" class="selected_list" value="'.$row['Driver_pay_rate_id'].'" />';
				}),
				array( 'db' => 'Driver_pay_rate_place_name', 'dt' => 1 ),
				array( 'db' => 'Driver_pay_rate_amount',   'dt' => 2),
				array( 'db' => 'Driver_pay_rate_diesel_ltr',   'dt' => 3), 			 
				array( 'db' => 'Driver_pay_rate_diesel_rate',   'dt' => 4),
				array( 'db' => 'Driver_pay_rate_status',   'dt' => 5, 
				'formatter' => function($id, $row){
					$status = '<strong class="fa fa-check" style="color:green;"> Active</strong>';
					if($row['Driver_pay_rate_status'] == "D"){
						$status = '<strong class="fa fa-times" style="color:red;"> Deny</strong>';
					}
					return $status;
				}),
			);

			$columns[] = array( 'db' => 'Driver_pay_rate_id',   'dt' => 6, 'formatter' => function($id, $row){
			$content =  '<span style="color:red">&nbsp;&nbsp;&nbsp;';
				if(is_admin()){
					$content .= ' <i class="fa fa-ellipsis-v"></i>&nbsp;<a href="edit_driver_pay_rate?id='. $row['Driver_pay_rate_id'] .'" alt="Edit" class="fa fa-pencil-square-o"> Edit </a> ';
					
				}				 
				return $content;
			 });
					 
					 
		echo json_encode(
				SSP::complex( $_GET, $this, $table, $primaryKey, $columns, "" )
			);
	} 
	
	public function add_driver_pay_rate()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Pay Rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->view('add_driver_pay_rate', $data);
		}
	}
	// start add Driver_pay_rate_details in table
    public function validate_driver_pay_rate()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Pay Rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_pay_rate_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
	   		$this->form_validation->set_rules('place_name', 'Place Name', 'trim|required|callback_check_ajax_driver_place|xss_clean');
	   		$this->form_validation->set_rules('driver_amount', 'Driver Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('diesel_ltr', 'Diesel liter', 'trim|required|xss_clean');
			$this->form_validation->set_rules('diesel_rate', 'Diesel rate', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
	   		
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count(); 
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();			
				$this->load->view('add_driver_pay_rate',$data); 	
			}
			else
			{
				
				$this->load->helper('inflector');
					if($query = $this->driver_pay_rate_model->add_driver_pay_rate())
					{
						$this->session->set_flashdata('success_msg', 'Driver Pay Rate details added successfully!');					
						redirect('driver_pay_rate/add_driver_pay_rate');	
					}				
			}
		}
    }
	// end add Driver_pay_rate_details in table
	// start edit driver details
    public function edit_driver_pay_rate()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Pay Rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_pay_rate_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['driver_pay_rate_data'] = $this->driver_pay_rate_model->get_driver_pay_rate($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('edit_driver_pay_rate', $data);
			
		}
    }
	// end edit Driver_pay_rate_details

	// start validate_edit_driver_details 
    public function validate_edit_driver_pay_rate()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Pay Rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_pay_rate_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
	   		$this->form_validation->set_rules('place_name', 'Place Name', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('driver_amount', 'Driver Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('diesel_ltr', 'Diesel liter', 'trim|required|xss_clean');
			$this->form_validation->set_rules('diesel_rate', 'Diesel rate', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
	   		
			if($this->form_validation->run() == FALSE)
	   		{
				$this->load->model('edit_admin_profile_model'); 
			    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
			    $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count(); 
				$this->load->model('driver_pay_rate_model');
				$data['driver_pay_rate_data'] = $this->driver_pay_rate_model->get_driver_pay_rate($this->input->post('id')); 				
				$this->load->view('edit_driver_pay_rate', $data); 	
			}
			else
			{
				$this->load->helper('inflector');
				if($query = $this->driver_pay_rate_model->edit_deriver_pay_rate($this->input->post('id')))
				{	
					$this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$data['driver_pay_rate_list'] = $this->driver_pay_rate_model->driver_pay_rate_list(); 
					// view upcoming due counts
					$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
					//view upcoming vehicle document count
					$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
					$this->session->set_flashdata('success_msg', 'Driver Pay Rate details edited successfully!');	
					$this->load->view('driver_pay_rate_list', $data);					
				}
			}		
		}
    }
	// end validate_edit_Driver_pay_rate_details

	// start approve Driver_pay_rate_details
    function approve_driver_pay_rate()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Pay Rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_pay_rate_model'); 
			if($this->driver_pay_rate_model->approve_driver_pay_rate())
			{				
				$this->session->set_flashdata('success_msg', 'Driver Pay Rate Status Changed successfully!');
			}
			$data['driver_pay_rate_list'] = $this->driver_pay_rate_model->driver_pay_rate_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('driver_pay_rate/driver_pay_rate_list', $data);						
		}
    }
	// end approver Driver_pay_rate_details

	// start deny Driver_pay_rate_details
    function deny_driver_pay_rate()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Pay Rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){
			$this->check_isvalidated();
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));	
			$this->load->model('driver_pay_rate_model'); 
			if($this->driver_pay_rate_model->deny_driver_pay_rate())
			{				
				$this->session->set_flashdata('success_msg', 'Driver Pay Rate Status Changed successfully!');
			}
			$data['driver_pay_rate_list'] = $this->driver_pay_rate_model->driver_pay_rate_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('driver_pay_rate/driver_pay_rate_list', $data);						
		}
    }
	// end deny Driver_pay_rate_details

	// start delete Driver_pay_rate_details
	public function delete()
	{
		if((access_permission($this->module_id) || is_admin()) && gaurd()){
			$delete_ids = explode(',', $this->input->get('ids'));		 	
			if($this->driver_pay_rate_model->delete_driver_pay_rate($delete_ids))
			{				
				$this->session->set_flashdata('success_msg', 'Driver Pay Rate Details Deleted Successfully!');
			}
			else
			{
				$this->session->set_flashdata('failear_msg', 'Driver Pay Rate Is Used By Other Module');
			} 
			redirect('driver_pay_rate/driver_pay_rate_list');						
		}else{
			$this->check_user_rights();
		}
	}
	// end delete Driver_pay_rate_details

	// start view driver pay rate details
	public function view_driver_pay_details()
	{
		// start for check user rights
        	//$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		/*if((in_array("Driver Pay Rate", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}*/	
		if(! $this->session->userdata('username')){			
			$this->check_isvalidated();
		}
		else
		{			
			$this->load->model('driver_pay_rate_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['view_driver_pay_details'] = $this->driver_pay_rate_model->get_driver_pay_rate($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_driver_pay_details', $data);	
		}
	}
	//  end view driver pay rate details
	//start check ajax driver place name
	public function check_ajax_driver_place($key)
	{
		$this->load->model('driver_pay_rate_model');
		$is_exist = $this->driver_pay_rate_model->check_ajax_driver_place($key);
		 if ($is_exist==1) 
		{
        	$this->form_validation->set_message('check_ajax_driver_place', 'Driver name already exist');  
        	return false;
    	} 
		else 
		{
        	return true;
    	}
	}
	// end check ajax driver place name
	
	
	public function status(){
		$ids = explode(',', $this->input->get('ids'));	
		$data['Driver_pay_rate_status'] = ($this->input->get('status') == 1)? "A" : "D";
	 
		if($this->driver_pay_rate_model->status_update($data, $ids)){
		   $this->session->set_flashdata('success_msg', 'Driver pay rate status updated successfully!');	
			redirect('driver_pay_rate/driver_pay_rate_list');						   
		} 
	}
	
	
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
