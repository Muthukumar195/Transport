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
		$this->load->model('daily_movement_details_model');	
		$this->load->model('daily_movement_details_model');	
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

	public function daily_movement_ajax_list(){
	 
	 
		$columns = array(				 
				array( 'db' => 'd.Daily_mvnt_dtl_id', 'dt' => 0 , 
				'formatter' => function($id, $row){
					return '<input type="checkbox" name="selected_list" class="selected_list" value="'.$row['Daily_mvnt_dtl_id'].'" />';
				}),
				array( 'db' => 'd.Daily_mvnt_dtl_date', 'dt' => 1,  
				'formatter' => function($id, $row){				 
					return date('d-m-Y', strtotime($row['Daily_mvnt_dtl_date'])); 
				}),	 
				array( 'db' => 'd.Daily_mvnt_dtl_transport_type',   'dt' => 2, 
				'formatter' => function($id, $row){
					$transport_type = $row['Transport_dtl_name'];
					if($row['Daily_mvnt_dtl_transport_type'] == "T"){
						$transport_type = 'Thirumala Transport';
					}
					return $transport_type;
				}),
				array( 'db' => 'v.Vehicle_dtl_number',   'dt' => 3),
				array( 'db' => 'd.Daily_mvnt_dtl_container_type',   'dt' => 4, 
				'formatter' => function($id, $row){
					$container = "-";
					if($row['Daily_mvnt_dtl_container_type'] == "NC"){
						$container = $row['Daily_mvnt_dtl_new_container_no'];
					}elseif($row['Daily_mvnt_dtl_container_type'] == "BC"){
						$container = $row['Party_billing_container_no'];
					}					
					return $container;
				}),
				array( 'db' => 'dpr.Driver_pay_rate_place_name',   'dt' => 5),
				array( 'db' => 'pd.Party_dtl_name',   'dt' => 6),
				array( 'db' => 'd.Daily_mvnt_dtl_transport_type',   'dt' => 7, 
				'formatter' => function($id, $row){
					$transport_type = $row['Driver_dtl_name'];
					if($row['Daily_mvnt_dtl_transport_type'] == "0"){
						$transport_type = '--';
					}
					return $transport_type;
				}),
				array( 'db' => 'd.Daily_mvnt_dtl_status',   'dt' => 8, 
				'formatter' => function($id, $row){
					$status = '<strong class="fa fa-check" style="color:green;"> Active</strong>';
					if($row['Daily_mvnt_dtl_status'] == "D"){
						$status = '<strong class="fa fa-times" style="color:red;"> Deny</strong>';
					}
					return $status;
				}),
			);

			$columns[] = array( 'db' => 'd.Daily_mvnt_dtl_id',   'dt' => 9, 'formatter' => function($id, $row){
			$content =  '<span style="color:red">&nbsp;&nbsp;&nbsp;';
			
					$content .= '<a href="read_daily_movement_details?id='. $row['Daily_mvnt_dtl_id'] .'" alt="View" class="fa fa-search-plus"> View </a>';
					
					if(is_admin()){
						
						$content .= ' <i class="fa fa-ellipsis-v"></i>&nbsp;<a href="edit_daily_movement_details?id='. $row['Daily_mvnt_dtl_id'] .'" alt="Edit" class="fa fa-pencil-square-o"> Edit </a> ';
						
						if($row['Daily_mvnt_dtl_transport_type'] == "T"){
							if($row['Daily_mvnt_dtl_other_expences'] == "0"){
								  $content .= '<a href="add_other_expenses?id='.$row['Daily_mvnt_dtl_id'].'" alt="Edit"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Add Driver Payment Detail" data-placement="bottom"> <button type="button" class="btn btn-primary">Add Driver Oth.Ex</button> </a>';
							}else{
								    $content .= '<a href="add_other_expenses?id='.$row['Daily_mvnt_dtl_id'].'" alt="Edit"  rel="tooltip" data-color-class = "purple" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Driver Payment Detail" data-placement="bottom"> <button type="button" class="btn btn-purple ">Edit Driver Oth.Ex</button> </a>';
							}							
						}else{
							if($row['Daily_mvnt_dtl_trp_expences'] == "0"){
								  $content .= '<a href="add_transport_expenses?id='.$row['Daily_mvnt_dtl_id'].'" alt="Edit"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Add Transport Ex" data-placement="bottom"> <button type="button" class="btn btn-orange">Add Trans Oth.Ex</button> </a>'; 
							}else{
								 $content .= '<a href="add_transport_expenses?id='.$row['Daily_mvnt_dtl_id'].'" alt="Edit"  rel="tooltip" data-color-class = "purple" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Add Transport Ex" data-placement="bottom"> <button type="button" class="btn btn-info">Edit Trans Oth.Ex</button> ';
							}
						}
						
					}				 
				return $content;
			 });
					 
					 
		 $query = "SELECT d.Daily_mvnt_dtl_id,
		 d.Daily_mvnt_dtl_date,
		 d.Daily_mvnt_dtl_transport_type,
		 d.Daily_mvnt_dtl_container_type,
		 d.Daily_mvnt_dtl_new_container_no,
		 d.Daily_mvnt_dtl_other_expences,
		 d.Daily_mvnt_dtl_trp_expences,
		 d.Daily_mvnt_dtl_driver_name,
		 d.Daily_mvnt_dtl_status,
		 v.Vehicle_dtl_number,
		 v.Vehicle_dtl_id,
		 dpr.Driver_pay_rate_place_name,
		 pd.Party_dtl_name,
		 dd.Driver_dtl_name,
		 con.Container_dtl_container_no,
		 p.Party_billing_container_no,
		 t.Transport_dtl_id,
		 t.Transport_dtl_name
		 FROM daily_moment_details as d
		 LEFT JOIN vehicle_details as v ON v.Vehicle_dtl_id = d.Daily_mvnt_dtl_vehicle_no
		 LEFT JOIN driver_pay_rate as dpr ON dpr.Driver_pay_rate_id = d.Daily_mvnt_dtl_place
		 LEFT JOIN party_details as pd ON pd.Party_dtl_id = d.Daily_mvnt_dtl_party_name
		 LEFT JOIN driver_details as dd ON dd.Driver_dtl_id = d.Daily_mvnt_dtl_driver_name
		 LEFT JOIN container_details as con ON con.Container_dtl_id = d.Daily_mvnt_dtl_container_no
		 LEFT JOIN transport_details as t ON t.Transport_dtl_id = d.Daily_mvnt_dtl_trp_name
		 LEFT JOIN party_billing as p ON p.Party_billing_id = d.Daily_mvnt_dtl_container_no   ";
		
        echo json_encode(SSP::complex_join($_GET, $this, $query, "", $columns, ""));
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
    public function delete()
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
			$delete_ids = explode(',', $this->input->get('ids'));				
			if($this->daily_movement_details_model->delete_daily_movement($delete_ids))
			{				
				$this->session->set_flashdata('success_msg', 'Daily movement Details Deleted Successfully!');
			}
			
			// view upcoming due counts
			$data['due_upcoming_count'] = $this->due_details_model->upcoming_month_due_count();
			//view upcoming vehicle document count
			$data['upcoming_vehicle_doc_count'] = $this->vehicle_document_details_model->upcoming_document_date_count();
			$data['daily_movement_details_list'] = $this->daily_movement_details_model->daily_movement_details_list(); 
			redirect('daily_movement/daily_movement_details_list');		   			
		}
    }
	// end delete daily movemnt details
	
	public function status(){
		$ids = explode(',', $this->input->get('ids'));	
		$data['Daily_mvnt_dtl_status'] = ($this->input->get('status') == 1)? "A" : "D";
	 
		if($this->daily_movement_details_model->status_update($data, $ids)){  	 
		   $this->session->set_flashdata('success_msg', 'Daily movement status updated successfully!');	
			redirect('daily_movement/daily_movement_details_list');		   
		} 
	}

	
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
				$select_size .='<option value="'.$row->party_pay_rate_place.'">'. $row->Driver_pay_rate_place_name.'</option>';
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
