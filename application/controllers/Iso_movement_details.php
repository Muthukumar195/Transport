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
		$this->load->model('iso_movement_details_model');
		$this->module_id = 11;	
    }
	
	public function iso_movement_details_list()
	{		
		if((access_permission($this->module_id) || is_admin()) && gaurd()){
			$data = iso_initial_data();
			$data['iso_movement_details_list'] = $this->iso_movement_details_model->iso_movement_details_list();			
			$this->load->view('iso_movement_details_list', $data);
		}else{
			$this->check_user_rights();
		}
	}

	public function iso_movement_ajax_list(){	 
	 
		$columns = array(				 
				array( 'db' => 'i.Iso_mvnt_id', 'dt' => 0, 
				'formatter' => function($id, $row){
					return '<input type="checkbox" name="selected_list" class="selected_list" value="'.$row['Iso_mvnt_id'].'" />';
				}),
				array( 'db' => 'i.Iso_mvnt_date', 'dt' => 1,  
				'formatter' => function($id, $row){				 
					return date('d-m-Y', strtotime($row['Iso_mvnt_date']));
				}),	 
				array( 'db' => 'i.Iso_mvnt_vehicle_type',   'dt' => 2, 
				'formatter' => function($id, $row){
					$transport_type = "Other Tansport";
					if($row['Iso_mvnt_vehicle_type'] == "T"){
						$transport_type = 'Thirumala Transport';
					}
					return $transport_type;
				}),
				array( 'db' => 'i.Iso_mvnt_other_vehicle_no',   'dt' => 3, 
				'formatter' => function($id, $row){
					$vehicle_no = "";					 
					if($row['Iso_mvnt_vehicle_type'] =='O'){												
						$vehicle_no = $row['Iso_mvnt_other_vehicle_no'];
					}else{
						$vehicle_no = $row['Vehicle_dtl_number'];
					}						
					return $vehicle_no;
				}),
				array( 'db' => 'i.Iso_mvnt_container_no',   'dt' => 4, 
				'formatter' => function($id, $row){
					$container =  $row['Iso_mvnt_container_no'];
					if($row['Iso_mvnt_container_no2']){
						$container .= '-'.$row['Iso_mvnt_container_no2'];
					}
					return $container;
				}),
				array( 'db' => 'i.Iso_mvnt_ey_lo',   'dt' => 5, 
				'formatter' => function($id, $row){
					$ey =  'Load';
					if($row['Iso_mvnt_ey_lo'] == "E"){
						$ey = 'Empty'; 
					} 
					return $ey;
				}),
				array( 'db' => 'i.Iso_mvnt_im_ex',   'dt' => 6, 
				'formatter' => function($id, $row){
					$ey =  'Export';
					if($row['Iso_mvnt_im_ex'] == "I"){
						$ey = 'Import'; 
					} 
					return $ey;
				}),
				array( 'db' => 'i.Iso_mvnt_pickup_place',   'dt' => 7),
				array( 'db' => 'i.Iso_mvnt_drop_place',   'dt' => 8),
				array( 'db' => 't.Transport_dtl_name',   'dt' => 9),
				array( 'db' => 'i.Iso_mvnt_tp_amount',   'dt' => 10, 
				'formatter' => function($id, $row){					 
					return '<span class="text-primary"><i class="fa fa-inr"></i>&nbsp;'. $row['Iso_mvnt_tp_amount'] .'</span>';
				}),
				array( 'db' => 'i.Iso_mvnt_amount',   'dt' => 11, 
				'formatter' => function($id, $row){					 
					return '<span class="text-primary"><i class="fa fa-inr"></i>&nbsp;'. $row['Iso_mvnt_amount'] .'</span>';
				}),				
				array( 'db' => 'i.Iso_mvnt_status',   'dt' => 12, 
				'formatter' => function($id, $row){
					$status = '<strong class="fa fa-check" style="color:green;"> Active</strong>';
					if($row['Iso_mvnt_status'] == "D"){
						$status = '<strong class="fa fa-times" style="color:red;"> Deny</strong>';
					}
					return $status;
				})
			);

			$columns[] = array( 'db' => 'i.Iso_mvnt_id',   'dt' => 13, 'formatter' => function($id, $row){
			$content =  '<span style="color:red">&nbsp;&nbsp;&nbsp;';
					
					 $content .= '<a href="view_iso_movement_details?id=' .$row['Iso_mvnt_id'] . '&tr_nme=' . $row['Transport_dtl_name'] .'"  alt="View" class="fa fa-search-plus" title="view"  > View </a>';
					
					if(is_admin()){
						   $content .= '<i class="fa fa-ellipsis-v"></i>&nbsp;<a href="edit_iso_movement_details?id=' . $row['Iso_mvnt_id'] .'" alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" > Edit </a>';
					 
						 
							if($row['Iso_mvnt_driver_amount'] == "0"){
								  $content .= '<a href="iso_driver_payment?id='.$row['Iso_mvnt_id'].'" alt="Edit"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Add Driver Payment Detail" data-placement="bottom"> <button type="button" class="btn btn-primary">Add Driver Payment</button> </a>';
							}else{
								    $content .= '<a href="iso_driver_payment?id='.$row['Iso_mvnt_id'].'" alt="Edit"  rel="tooltip" data-color-class = "purple" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Driver Payment Detail" data-placement="bottom"> <button type="button" class="btn btn-purple ">Edit Driver Payment</button> </a>';
							}
					}				 
				return $content;
			 });
					 
					 
		 $query = "SELECT
		 i.*,
		 v.Vehicle_dtl_number,
		 t.Transport_dtl_name
		 FROM  iso_movement_details as i
		 LEFT JOIN vehicle_details as v ON v.Vehicle_dtl_id = i.Iso_mvnt_vehicle_no
		 LEFT JOIN container_details as cod ON cod.Container_dtl_id = i.Iso_mvnt_container_no
		 LEFT JOIN container_details as cod2 ON cod2.Container_dtl_id = i.Iso_mvnt_container_no2
		 LEFT JOIN transport_details as t ON t.Transport_dtl_id = i.Iso_mvnt_transport_name   ";
		
        echo json_encode(SSP::complex_join($_GET, $this, $query, "", $columns, ""));
	}	
	
	public function add_iso_movement_details()
	{
		if((access_permission($this->module_id) || is_admin()) && gaurd()){
			$data = iso_initial_data();
			$this->load->view('add_iso_movement_details', $data);			
		}else{
			$this->check_user_rights();
		}
	}
	// start add iso_movement_details
	public function validate_iso_movement_details()
	{
		if((access_permission($this->module_id) || is_admin()) && gaurd()){
	   		$this->form_validation->set_rules('iso_date', 'IOS Date', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('transport_type', 'Transport Type', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('container_feet', 'Container Size', 'trim|required|xss_clean');
			$this->form_validation->set_rules('container_f', 'Container Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ey_lo', 'EY/LO Type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('im_ex', 'Load Type', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('tp_amount', 'Transport Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('iso_amount', 'Iso Amount', 'trim|required|xss_clean');			 
		    if($this->form_validation->run() == FALSE)
	   		{	
				$data = iso_initial_data();					
				$this->load->view('add_iso_movement_details', $data);
			}else{				
					if($query = $this->iso_movement_details_model->add_iso_movement_details())
					{							
						$this->session->set_flashdata('success_msg', 'Iso Movement details added successfully!');
						redirect('iso_movement_details/add_iso_movement_details');	
					}
			}
		}else{
			$this->check_user_rights();
		}
	}
	// end  add iso_movement_details
	// start edit ISO Movement details
	public function edit_iso_movement_details()
	{
		if((access_permission($this->module_id) || is_admin()) && gaurd()){			
			$data = iso_initial_data(); 
			$data['iso_movement_details_data'] = $this->iso_movement_details_model->get_iso_movement_details($this->input->get('id')); 
			$this->load->view('edit_iso_movement_details', $data);	
		}else{
			$this->check_user_rights();
		}
	}
	// end edit ISO Movement details
 
	// start validate edit vISO Movement
    public function validate_edit_iso_movement_details(){
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){
	   		$this->form_validation->set_rules('iso_date', 'IOS Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('transport_type', 'Transport Type', 'trim|required|xss_clean');
			if($this->input->post('transport_type') == "T"){
				$this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'trim|required|xss_clean');
			}else{
				$this->form_validation->set_rules('other_vehicle', 'Other Vehicle Number', 'trim|required|xss_clean');
			} 
	   		$this->form_validation->set_rules('container_feet', 'Container Size', 'trim|required|xss_clean');
			$this->form_validation->set_rules('container_f', 'Container Number', 'trim|required|xss_clean');
	   		$this->form_validation->set_rules('ey_lo', 'EY/LO', 'trim|required|xss_clean');
			$this->form_validation->set_rules('im_ex', 'Load Type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tp_amount', 'Transport Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('iso_amount', 'Iso Amount', 'trim|required|xss_clean');
			 
			
			if($this->form_validation->run() == FALSE)
	   		{
			    $data = iso_initial_data(); 
			    $data['iso_movement_details_data'] = $this->iso_movement_details_model->get_iso_movement_details($this->input->post('id'));
			    $this->load->view('edit_iso_movement_details', $data);
			}
			else{				
				if($query = $this->iso_movement_details_model->edit_iso_movement_details($this->input->post('id')))
				{
					$data = iso_initial_data(); 
				    $data['iso_movement_details_list'] = $this->iso_movement_details_model->iso_movement_details_list();
					$this->session->set_flashdata('success_msg', 'Iso Movement details edited successfully!'); 	
					$this->load->view('iso_movement_details_list', $data);
				}
			}
		}else{
			$this->check_user_rights();
		}
    }
	
	
	// end validate edit ISO Movement

	
   public function status(){
		$ids = explode(',', $this->input->get('ids'));	
		$data['Iso_mvnt_status'] = ($this->input->get('status') == 1)? "A" : "D";
	 
		if($this->iso_movement_details_model->status_update($data, $ids)){  	 
		   $this->session->set_flashdata('success_msg', 'ISO movement status updated successfully!');	
			redirect('iso_movement_details/iso_movement_details_list');	
		} 
	}
	
	// start delete ISO Movement details
    public function delete()
    {
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){
			$delete_ids = explode(',', $this->input->get('ids'));				
			if($this->iso_movement_details_model->delete_iso_movement_details($delete_ids))
			{				
				$this->session->set_flashdata('success_msg', 'ISO Movement Details Deleted Successfully!');
			} 
			redirect('iso_movement_details/iso_movement_details_list', $data);						
		}else{
			$this->check_user_rights();
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
	
	 public function iso_driver_payment()
    {
		 
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){			
			 
			$data = iso_initial_data(); 
			$data['iso_movement_details'] = $this->iso_movement_details_model->view_iso_movement_details_list($this->input->get('id'));
			 
			$this->load->view('iso_driver_payment', $data);	
		}else{
			$this->check_user_rights();
		}
    }
	// end edit ISO Movement details
 
	// start validate edit vISO Movement
    public function validate_iso_driver_payment(){
    	if((access_permission($this->module_id) || is_admin()) && gaurd()){
			if($query = $this->iso_movement_details_model->iso_driver_payment($this->input->post('id')))
			{	 
				$this->session->set_flashdata('success_msg', 'Iso Driver payment successfully!'); 	
				redirect('iso_movement_details/iso_movement_details_list', $data);						
			}
		}else{
			$this->check_user_rights();
		}
    }
	
	
	function check_user_rights()
    {
        $this->session->set_flashdata('failear_msg', 'Access Denied');		
		redirect('tranport_main');			
    }	

}

