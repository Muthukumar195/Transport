<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Driver_details extends CI_Controller {
 
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
	
	
	public function driver_details_list()
	{	
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights        	        	
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{			
			$this->check_user_rights();
		}		
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('driver_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$this->load->model('vehicle_document_details_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['driver_details_list'] = $this->driver_details_model->driver_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('driver_details_list', $data);
		}
	}
	
	public function add_driver_details()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->view('add_driver_details',$data);
		}
	}
	// start add driver details in table
    public function validate_driver_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
	   		$this->form_validation->set_rules('full_name', 'Username', 'trim|required|callback_ajax_check_full_name|xss_clean');
	   		$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('driver_type', 'Category Type', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();

			if($this->form_validation->run() == FALSE)
	   		{
	   		    $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			    $data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();				
				$this->load->view('add_driver_details', $data); 	
			}
			else
			{ 
				$this->load->helper('inflector');
				$config = array(
				/*'file_name'=>'ssssssssssss',*/
				'upload_path' => "./uploads/license/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => FALSE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'create_thumb' => TRUE,
				'thumb_marker' => '_thumb'
				/*'max_height' => "768",
				'max_width' => "1024"*/
				);
				$this->load->library('upload', $config); 	
				if($this->upload->do_upload())
				{
					if($query = $this->driver_details_model->add_deriver_details())
					{
						$res = $this->upload->data();
						$file_path     = $res['file_path'];
						$file         = $res['full_path'];
						$file_ext     = $res['file_ext'];
						$final_file_name = $this->driver_details_model->upload_file($file_ext); 

						/* $data = array(
								'img_file_name' => $final_file_name,
								'file_name_typ' => 'I'					
							);	*/				  
						rename($file, $file_path . $final_file_name); 
						//$data = array('upload_data' => $this->upload->data());
						
						$this->session->set_flashdata('success_msg', 'Driver details added successfully!');					
						redirect('driver_details/add_driver_details');	
					}				

				}
			}
		}
    }
	// end add driver details in table
	// start edit driver details
    public function edit_driver_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['driver_details_data'] = $this->driver_details_model->get_driver_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('edit_driver_details', $data);	
		}
    }
	// end edit driver details

		// start validate_edit_driver_details 
    public function validate_edit_driver_details()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
	   		$this->form_validation->set_rules('full_name', 'Username', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('driver_type', 'Category Type', 'trim|required|xss_clean');
	   		// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();

			if($this->form_validation->run() == FALSE)
	   		{				
				$this->load->model('driver_details_model');
				$this->load->model('edit_admin_profile_model'); 
				$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
				$data['driver_details_data'] = $this->driver_details_model->get_driver_details($this->input->get('id')); 
				// view upcoming due counts
				$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
				//view upcoming vehicle document count
				$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
				$this->load->view('edit_driver_details', $data);	 	
			}
			else
			{
				$this->load->helper('inflector');
				$config = array(
				/*'file_name'=>'ssssssssssss',*/
				'upload_path' => "./uploads/license/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => FALSE,
				'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
				/*'max_height' => "768",
				'max_width' => "1024"*/
				);
				$this->load->library('upload', $config); 


				if($this->upload->do_upload())
				{					    
						$res = $this->upload->data();
						if(($file_ext     = $res['file_ext'])!="")
						{  
							$path="".base_url()."/uploads/license/".$this->input->post('file_name')."";
							//unlink($path);							
							//delete_files($path);
							@unlink(base_url().'uploads/license/'.$this->input->post('file_name'));
							$file_path     = $res['file_path'];
							$file         = $res['full_path'];
							$file_ext     = $res['file_ext'];
							$final_file_name = $this->driver_details_model->edit_upload_file($file_ext); 
							rename($file, $file_path . $final_file_name);  		
						}			
				}
						
				if($query = $this->driver_details_model->edit_deriver_details($this->input->post('id')))
				{	
					$this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$data['driver_details_list'] = $this->driver_details_model->driver_details_list(); 
					$this->session->set_flashdata('success_msg', 'Driver details edited successfully!');
					$this->load->view('driver_details_list', $data);					
				}
			}		
		}
    }
	// end validate_edit_driver_details

	// start approve driver
    function approve_driver()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_details_model'); 
			if($this->driver_details_model->approve_driver())
			{				
				$this->session->set_flashdata('success_msg', 'Driver Status Changed successfully!');
			}
			$data['driver_details_list'] = $this->driver_details_model->driver_details_list(); 
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('driver_details/driver_details_list', $data);						
		}
    }
	// end approver driver

	// start deny driver
    function deny_driver()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_details_model'); 
			if($this->driver_details_model->deny_driver())
			{				
				$this->session->set_flashdata('success_msg', 'Driver Status Changed successfully!');
			}
			$data['driver_details_list'] = $this->driver_details_model->driver_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('driver_details/driver_details_list', $data);						
		}
    }
	// end deny driver

	// start delete driver details
	public function delete_message()
	{
		// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
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
			$this->load->model('driver_details_model');
			// start delete file			
			@unlink(base_url().'uploads/license/'.$this->input->get('file_name'));
			// end delete file 
			if($this->driver_details_model->delete_driver($this->input->get('id')))
			{				
				$this->session->set_flashdata('success_msg', 'Driver Details Deleted Successfully!');
			}
			else
			{
				$this->session->set_flashdata('failear_msg', 'Driver Name Is Used By Other Module');
			}
			
			$data['driver_details_list'] = $this->driver_details_model->driver_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			redirect('driver_details/driver_details_list', $data);						
		}
	}
	// end delete driver details

	function check_isvalidated()
	{
        if(! $this->session->userdata('username'))
        {	
        	$this->session->set_flashdata('failear_msg', 'Login Required');		
			redirect('tranport_main');			
        }		
		
    }

    // start check driver fullname exist
    function ajax_check_full_name($key)
    {    	 
		$this->load->model('driver_details_model');        
        $is_exist = $this->driver_details_model->ajax_check_full_name($key); 

        if ($is_exist==1) 
		{
        	$this->form_validation->set_message('ajax_check_full_name', 'Driver name already exist');  
        	return false;
    	} 
		else 
		{
        	return true;
    	}

    }
    // end check driver fullname exist

    // start view driver details
    public function view_driver_details()
    {
    		
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('driver_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_driver_details'] = $this->driver_details_model->get_driver_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			// view driver pay amount details
			$data['view_driver_pay_amount'] = $this->driver_details_model->view_driver_pay_amount($this->input->get('id')); 
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_driver_details', $data);	
		}
    } 
    // end view driver details
	 // start view driver details Print
    public function view_driver_details_print()
    {
    		
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
						
			$this->load->model('driver_details_model');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile(); 
			$data['view_driver_details'] = $this->driver_details_model->get_driver_details($this->input->get('id')); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			// view driver pay amount details
			$data['view_driver_pay_amount'] = $this->driver_details_model->view_driver_pay_amount($this->input->get('id')); 
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$this->load->view('view_driver_details_print', $data);	
		}
    } 
    // end view driver details Print

    // start report page
    public function view_report()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
					
			$this->load->model('driver_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['driver_details_list'] = $this->driver_details_model->search_driver_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();		
			$this->load->view('view_report', $data);	
		}
    }
    // end report page
	  // start report Print page
    public function view_report_print()
    {
    	// start for check user rights
        	$user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
        // end for check user rights
		if((in_array("Driver Details", $user_typ_ary)==false)&&($this->session->userdata('username')!='admin'))
		{
			$this->check_user_rights();
		}	
    	if(! $this->session->userdata('username')){
			/*$this->index();*/
			$this->check_isvalidated();
		}
		else
		{
					
			$this->load->model('driver_details_model'); 
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['driver_details_list'] = $this->driver_details_model->search_driver_details_list(); 
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();	
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();		
			$this->load->view('view_report_print', $data);	
		}
    }
    // end report Print page

    function check_user_rights()
    {
        $this->session->set_flashdata('failear_msg', 'Access Denied');		
		redirect('tranport_main');			
    }

}
