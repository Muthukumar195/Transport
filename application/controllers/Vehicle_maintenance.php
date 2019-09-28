<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vehicle_maintenance extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('vehicle_maintenance_model'); 	  		
    }
	
	public function index(){	 	
		$data = initial_data();	
		$this->load->view('vehicle_maintenance_list', $data);
	}
	
    public function vehicle_maintenance_ajax_list(){
		 
		// DB table to use
		$table = 'vehicle_maintenance';

		// Table's primary key
		$primaryKey = 'id';

		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$columns = array(
				 array( 'db' => 'vehicle_id',   'dt' => 0, 
				'formatter' => function($id, $row){
					return '<input type="checkbox" name="selected_list" class="selected_list" value="'.$row['id'].'" />';
				}),
				array( 'db' => 'spare_part', 'dt' => 1 ),
				array( 'db' => 'vehicle_id',   'dt' => 2, 
				'formatter' => function($id, $row){
					return vehicle_numbers($id);
				}),
				array( 'db' => 'amount',  'dt' => 3 ),
				array( 'db' => 'date',   'dt' => 4, 
				'formatter' => function($id, $row){
					return date('d-m-Y', strtotime($row['date']));
				}),
				array( 'db' => 'status_id',   'dt' => 5, 
				'formatter' => function($id, $row){
					$status = '<strong class="fa fa-check" style="color:green;"> Active</strong>';
					if($id == 2){
						$status = '<strong class="fa fa-times" style="color:red;"> Deny</strong>';
					}
					return $status;
				}),
			);

			$columns[] = array( 'db' => 'id',   'dt' => 6 , 'formatter' => function($id, $row){
			$content =  '<span style="color:red">&nbsp;&nbsp;&nbsp;';
					// if(has_access("client/client_edit")){
					$content .= '<a href="edit?id='.$id.'" class="Edit" tabindex="0" ><i  class="fa fa-pencil-square-o" aria-hidden="true" title="Edit" style="cursor:pointer" ></i></a>';
					// }
					 
					// $content .= '&nbsp;&nbsp;&nbsp;<a data-clientid="'.$id.'" class="clientDelete" href="#" tabindex="0"><i class="icon-Remove " aria-hidden="true" style="cursor:pointer" title="Delete" ></i></a>'
					// . '</span>';
				 
				return $content;
			 });
					 
					 
		echo json_encode(
				SSP::complex( $_GET, $this, $table, $primaryKey, $columns, "" )
			);
	} 
	
	public function add(){		
		$data = initial_data();
		$data['form'] = 'Add';			
		$data['vehicle_numbers'] = vehicle_numbers();	
		if($this->input->post()){
			vehicle_maintenance_validation();
			if($this->form_validation->run() == FALSE){
				$data['errors'] = $this->form_validation->error_array();
				$this->load->view('add_vehicle_maintenance', $data); 	
			}else{ 
				$form_data = array( 
					'vehicle_id' => $this->input->post('vehicle_id'),
					'spare_part' => $this->input->post('spare_part'), 
					'amount' => $this->input->post('amount'),
					'date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('maintenance_date')))),
					'notes' => $this->input->post('notes'),
					'status_id' => 1,
					'created_at' => get_date_time(), 
					'updated_at' => get_date_time()
				);
				if($this->vehicle_maintenance_model->insert($form_data)){
					$this->session->set_flashdata('success_msg', 'Vehicle maintenance details added successfully!');			
				}
				$this->load->view('add_vehicle_maintenance', $data); 	
			}
		}else{		
			$this->load->view('add_vehicle_maintenance', $data);
		}
	}
	
	public function edit(){		
		$data = initial_data();	
		$data['vehicle_numbers'] = vehicle_numbers();	
		$data['form'] = 'Edit';	
		if($this->input->post()){
			vehicle_maintenance_validation();
			if($this->form_validation->run() == FALSE){
				$data['errors'] = $this->form_validation->error_array();
				$this->load->view('add_vehicle_maintenance', $data); 	
			}else{ 
				$form_data = array( 
					//'vehicle_id' => $this->input->post('vehicle_id'),
					'vehicle_id' => $this->input->post('vehicle_id'),
					'spare_part' => $this->input->post('spare_part'), 
					'amount' => $this->input->post('amount'),
					'date' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('maintenance_date')))),
					'notes' => $this->input->post('notes'),
					'updated_at' => get_date_time()
				);
				 
				if($this->vehicle_maintenance_model->update($form_data, array('id'=>$this->input->post('id')))){ 
					$this->session->set_flashdata('success_msg', 'Vehicle maintenance details updated successfully!');			
				}
				redirect('vehicle_maintenance/list');	
			}
		}else{
			$data['vehicle_maintenance_detail'] = $this->vehicle_maintenance_model->get_where(array('id'=>$this->input->get('id')));
			$this->load->view('add_vehicle_maintenance', $data);
		}
	}
	
	public function delete(){
		$delete_ids = explode(',', $this->input->get('ids'));		 
		if($this->vehicle_maintenance_model->delete($delete_ids, TRUE)){
		   $this->session->set_flashdata('success_msg', 'Vehicle maintenance details deleted successfully!');	
			redirect('vehicle_maintenance/list');		   
		} 
	}

	public function status(){
		$ids = explode(',', $this->input->get('ids'));	
		$data['status_id'] = $this->input->get('status');
	 
		if($this->vehicle_maintenance_model->status_update($data, $ids)){
		   $this->session->set_flashdata('success_msg', 'Vehicle maintenance status updated successfully!');	
			redirect('vehicle_maintenance/list');		   
		} 
	}	
}
