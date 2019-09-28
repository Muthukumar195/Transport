<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Tranport_main extends CI_Controller {

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

	public function __construct() 
	{
		parent::__construct();
	} 

	
	public function index()
	{
		$this->load->view('include/login_header');
		$this->load->view('login');
	}
	public function validate_credentials()
	{
		//This method will have the credentials validation
	   $this->load->library('form_validation');
	 
	   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	 
	   if($this->form_validation->run() == FALSE)
	   { 
		 //Field validation failed.  User redirected to login page
		 $this->load->view('login');
	   }
	   else
	   {		
			$this->load->model('user_login');
			$query = $this->user_login->validate(); 
			$query_result=$query['1'];			
			   
			
			
			if($query['0']=='true') // if the user's credentials validated...
			{
				foreach ($query['1']->result() as $row)
				{
					$user_id=$row->Admin_id;					
					$user_full_name=$row->Admin_fullname;
					$email=$row->Admin_email;
					$phone=$row->Admin_phone;
					$username=$row->Admin_username;
					$user_type=$row->Admin_type;
					$user_role=$row->Admin_role;
					$user_rights_dtl=$row->User_rights_type_value; 
					$access_permission=$row->Admin_access_permission; 
				}				
				
				$data = array(
					'username' => $this->input->post('username'),
					'user_id'=>$user_id,
					'is_logged_in' => true,					
					'user_full_name' => $user_full_name,
					'email' => $email,
					'phone' => $phone,
					'role' => $user_role,
					'username' => $username,
					'user_type' => $user_type,
					'access_permission' => $access_permission,
					'user_rights_dtl' => $user_rights_dtl
				);
				
				$this->session->set_userdata($data);				
				redirect('tranport_main/dashboard');
			} 
			else // incorrect username or password
			{
				$this->session->set_flashdata('failear_msg', 'Invalid Username and Password');
				redirect('tranport_main');
			}
		}
	}	
	public function dashboard()
	{		
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
		}
		else
		{
			$this->load->model('driver_details_model');
			$this->load->model('driver_pay_rate_model');
			$this->load->model('vehicle_details_model');
			$this->load->model('daily_movement_details_model');
			$this->load->model('party_details_model');
			$this->load->model('party_billing_model');
			$this->load->model('iso_movement_details_model');
			$this->load->model('container_details_model');
			$this->load->model('transport_details_model');
            $this->load->model('edit_admin_profile_model');
            $this->load->model('due_details_model');
			$this->load->model('vehicle_document_details_model');
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$data['driver_count'] = $this->driver_details_model->driver_count();
			$data['driver_pay_rate_count'] = $this->driver_pay_rate_model->driver_pay_rate_count();
			$data['vehicle_count'] = $this->vehicle_details_model->vehicle_count();
			$data['daily_movement_count'] = $this->daily_movement_details_model->daily_movement_count();
			$data['party_count'] = $this->party_details_model->party_count();
			$data['party_billing_count'] = $this->party_billing_model->party_billing_count();
			$data['iso_movement_count'] = $this->iso_movement_details_model->iso_movement_count();
			$data['container_count'] = $this->container_details_model->container_count();
			$data['transport_count'] = $this->transport_details_model->transport_count();
			// view latest daily movement list
			$data['daily_movement_details_list'] = $this->daily_movement_details_model->latest_daily_movement_details();
			// view latest iso movement list
			$data['iso_movement_details_list'] = $this->iso_movement_details_model->latest_iso_movement_details();
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			
			$this->load->view('dashboard', $data);
			
		}
	}
	
	public function logout()
	{
		$this->load->helper('html');
	    $this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation');		 
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();				
		$data['success_msg']='Logout Successfully!';
		$this->load->view('include/login_header');
		$this->load->view('login',$data);
	}
	
	public function edit_admin_profile()
	{		
		if(! $this->session->userdata('username'))
		{
			$this->check_isvalidated();
			
		}
		else
		{
			$this->load->helper(array('form', 'url', 'text','captcha','html'));
			$this->load->helper('text');
			$this->load->model('edit_admin_profile_model'); 
			$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			$this->load->model('due_details_model');
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$this->load->model('vehicle_document_details_model');
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
			$this->load->view('edit_admin_profile', $data);
		}
	}
	 public function validate_edit_admin_profile()
    {
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
			$this->load->model('edit_admin_profile_model'); 
	   		$this->form_validation->set_rules('full_name', 'Fullname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|callback_ajax_check_password|xss_clean');
	   		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	   		$this->load->model('due_details_model');
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$this->load->model('vehicle_document_details_model');
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
            
			if($this->form_validation->run() == FALSE)
	   		{				
			   $this->load->helper(array('form', 'url', 'text','captcha','html'));
	    	   $this->load->helper('text');
		       $this->load->model('edit_admin_profile_model'); 
			   $data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
			   $this->load->view('edit_admin_profile', $data);	
			}
			else
			{  
			$this->load->helper('inflector');
				$config = array(
				/*'file_name'=>'ssssssssssss',*/
				'upload_path' => "./uploads/admin_profie/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
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
							$path="".base_url()."/uploads/admin_profie/".$this->input->post('file_name')."";
							//unlink($path);							
							//delete_files($path);
							@unlink(base_url().'uploads/admin_profie/'.$this->input->post('file_name'));
							$file_path     = $res['file_path'];
							$file         = $res['full_path'];
							$file_ext     = $res['file_ext'];
							$final_file_name = $this->edit_admin_profile_model->edit_upload_file($file_ext); 
							rename($file, $file_path . $final_file_name);  		
						}			
				}   
						
				if($query = $this->edit_admin_profile_model->edit_adminer_profile($this->input->post('id')))
				{ 
				 $this->load->helper(array('form', 'url', 'text','captcha','html'));
					$this->load->helper('text');
					$this->load->model('edit_admin_profile_model'); 
					$data['get_admin_profile'] = $this->edit_admin_profile_model->get_admin_profile();
					$this->load->model('due_details_model');
					// view upcoming due counts
					$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
					//view upcoming vehicle document count
			        $this->load->model('vehicle_document_details_model');
			        $data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();	
					$this->session->set_flashdata('success_msg', 'Admin details edited successfully!');	
					$this->load->view('edit_admin_profile', $data);				
				}
			}		
		}
    }
	// end validate_edit_driver_details
	 // start check driver fullname exist
    function ajax_check_password($key)
    {    	 
		$this->load->model('edit_admin_profile_model');        
        $is_exist = $this->edit_admin_profile_model->ajax_check_password($key); 

        if ($is_exist==0) 
		{
        	$this->form_validation->set_message('ajax_check_password', 'Old Password Not Match ');  
        	return false;
    	} 
		else 
		{
        	return true;
    	}

    }
    // end check driver fullname exist


	function check_isvalidated(){
        if(! $this->session->userdata('username')){	
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
