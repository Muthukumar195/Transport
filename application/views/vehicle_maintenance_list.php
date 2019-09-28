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
                                            <th>Vehicle NO</th>
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
    $('#vehicle-maintenance').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "vehicle_maintenance_ajax_list",
		"language": {
			"search": "_INPUT_",
			"searchPlaceholder": "Search",
			"processing": "Loading...",
			"emptyTable": "No records found"
			
		},
		"sEmptyTable": "No records found",
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
    } );
} );
</script>
        