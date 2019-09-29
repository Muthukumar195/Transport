<?php 
include('include/header.php');
 
?>

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Vehicle Maintenance Details</h1> 
                                </div>                           
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12">
						<div class="row"> 
							<div class="col-lg-4 col-md-4 col-sm-4" >
								<div class="form-group" >
								<label class="col-md-3 control-label">Vehicle No: </label>
								<div class="col-md-9" >              
								<select class="form-control" name="vehicle_id"  id="vehicle_no">
									<option value="">Select Vehicle</option>
									<?php  foreach($vehicle_numbers as $Vehicle) { ?>
									<option value="<?php echo $Vehicle->Vehicle_dtl_id ?>"><?php echo $Vehicle->Vehicle_dtl_number; ?></option>
									<?php } ?>
								 </select>
								</div>
							  </div> 
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4" >
								<div class="form-group" >
								<label class="col-md-4 control-label">Date From/To:</label>
								<div class="col-md-8" >              
								 <input type="text" id="daterange-1" name="date" class="form-control daterange">
								</div>
							  </div> 
							</div>		
							<div class="col-lg-4 col-md-4 col-sm-4" >
								<div class="form-group" >
								<div class="col-md-8" >              
								 <button class="btn btn-success filterApply">Filter</button>
								</div>
							  </div> 
							</div>						 						
						  </div>
					       <?php if($this->session->flashdata('success_msg')!=null){ ?>
							<div class="alert alert-success alert-dismissable">
							  <a class="panel-close close" data-dismiss="alert">×</a> 
							  <i class="fa fa-check-square"></i>
							  <?php echo $this->session->flashdata('success_msg'); ?>
							</div>  
							<?php } ?>    
                            <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Vehicle Maintenance List</h2>
                                <div class="actions panel_actions pull-right">
									<button class="btn btn-purple">Total Maintenance Amount: <b><?php echo $total_vehicle_maintance; ?></b></button> 
                                    <a href="add" class="btn btn-primary">Add</a>
									<button class="btn btn-secondary selectedAction" data-type="delete">Delete</button>
									<button class="btn btn-success selectedAction" data-type="1">Active</button>
									<button class="btn btn-danger selectedAction" data-type="2">Deny</button>
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="vehicle-maintenance" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>                                             
                                            <th></th>
                                            <th>Spare Part</th>
                                            <th>Vehicle Number</th>
                                            <th>Amount</th>
                                            <th>Maintenance Date</th>                                          
                                            <th>Status</th>                                          
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th></th>
											<th>Spare Part</th>
                                            <th>Vehicle Number</th>
                                            <th>Amount</th>
                                            <th>Maintenance Date</th>                                           
                                            <th>Status</th>                                           
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>

                                    </tbody>
                            </table>

                           </div>

                            </div>
                </section>
            </section>
            <!-- END CONTENT -->
                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->
<?php include('include/footer.php');?>

<script type="text/javascript">
/*List*/
$(document).ready(function() {
 var filter = "";
	if(window.location.search !=""){
		filter = 'vehicle_no='+urlParam('vehicle_no')+'&date_from='+urlParam('date_from')+'&date_to='+urlParam('date_to');	
		$('#vehicle_no').val(urlParam('vehicle_no'));
		 $('.daterange').val(moment(urlParam('date_from')).format('MM/DD/YYYY')+' - '+moment(urlParam('date_to')).format('MM/DD/YYYY')); 
		 
	}
	
		var  vehicleTable =  $('#vehicle-maintenance').DataTable({
			processing: true,
			serverSide: true,
			ajax: "vehicle_maintenance_ajax_list?"+filter,		 
			language: {
				search: "_INPUT_",
				searchPlaceholder: "Search",
				processing: "Loading...",
				emptyTable: "No records found"
				
			},			 
			sEmptyTable: "No records found",
			 columnDefs: [ {
				orderable: false,
				className: 'select-checkbox',
				targets:   0
			} ],
			select: {
				style:    'os',
				selector: 'td:first-child'
			},
			order: [[ 1, 'asc' ]]
		}); 
	
	$('.filterApply').click(function(){
	   var vehicle_no = $('#vehicle_no').val();	   
	   var date = $('.daterange').val().split('-');	   
	   var date_from = moment(date[0]).format('YYYY-MM-DD');
	   var date_to = moment(date[1]).format('YYYY-MM-DD');
	   console.log(date_from, date_to);
	   if(vehicle_no != "" || date !=""){		 
			window.location.href= 'list?vehicle_no='+vehicle_no+'&date_from='+date_from+'&date_to='+date_to;
	   }
  });
  
 
} );
</script>
        