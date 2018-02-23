<?php 
include('include/header.php');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">View Party Billing Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                                
                                    <div class="mail_content">

                                            <div class="row">
                                                 <div class="col-md-11 col-sm-11 col-xs-11">
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php $party_name=$this->input->get('pr_nme');  echo $party_name; $party_id=$this->input->get('id');    ?></h3>
                                                </div>
												 
                                                <div class="col-md-1 col-sm-1 col-xs-1">
                                                    <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/party_billing/view_party_billing_print?id=<?php echo $party_id.'&pr_nme='.$party_name; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">  
                                                  <section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Party Remaining Bills Details</h2>
                                                            <div class="actions panel_actions pull-right">
                                                                <i class="box_toggle fa fa-chevron-down"></i>
                                                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                                                <i class="box_close fa fa-times"></i>
                                                            </div>
                                                        </header>
                                                        <div class="content-body">    <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                    	<th>Sno</th>
                                                                        <th>Date</th>
                                                                        <th>Container No</th>
                                                                        <th>INI No</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                       <th>Sno</th>
                                                                        <th>Date</th>
                                                                        <th>Container No</th>
                                                                        <th>INI No</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;                                                     
                                                                    foreach ($view_party_billing->result() as $row)
                                                                    {                                                               
                                                                ?>
                                                                    <tr>
                                                                    	  <td><?php  echo $sno ?></td>
                                                                          <td><?php echo date('d-M-Y', strtotime($row->Party_billing_date)); ?></td>
                                                                          
                                                                          <td><?php echo $row->Party_billing_container_no; ?></td>
                                                                          <td><?php echo $row->Party_billing_ini_no; ?></td>
                                                                          <td><?php echo $row->Party_billing_from; ?></td>
                                                                          <td><?php echo $row->Party_billing_to; ?></td>
                                                                          <td>
                                            	 <a href="read_party_billing_details?id=<?php echo $row->Party_billing_id; ?>" target="_blank"; alt="View" class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Party Detail" data-placement="bottom"> View </a>
                                               <i class="fa fa-ellipsis-v"></i>
                                                <?php if($this->session->userdata('username')=='admin'){ ?>
                                                 <a href="edit_party_billing?id=<?php echo $row->Party_billing_id; ?>"  alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Party Billing Detail" data-placement="bottom"> Edit </a> <i class="fa fa-ellipsis-v"></i>
                                                <?php 
                                               /* if($row->Party_billing_status=='A')
                                                {
                                                   echo '<a href="deny_party_billing?id='.$row->Party_billing_id.'" alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Party" data-placement="bottom"> Deny </a>';   
                                                }
                                                else
                                                {
                                                    echo '<a href="approve_party_billing?id='.$row->Party_billing_id.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a Party" data-placement="bottom"> Active </a>';
                                                }*/
                                                ?>   
                                                
                                                <a href="delete_message?id=<?php echo $row->Party_billing_id;?>" onclick="return confirm('Are you sure you want to delete?')"alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a Party" data-placement="bottom" > Delete </a>
                                                <?php } ?>
                                            </td>                                                                                         
                                                                      </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               
                                                        </table>
                                                        
                                                       </div>
                                                        </div>
                                                </section> 
                                                  
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">  
                                                  <section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Party Delivery Bills Details</h2>
                                                            <div class="actions panel_actions pull-right">
                                                                <i class="box_toggle fa fa-chevron-down"></i>
                                                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                                                <i class="box_close fa fa-times"></i>
                                                            </div>
                                                        </header>
                                                        <div class="content-body">    <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                    	<th>Sno</th>
                                                                        <th>Date</th>
                                                                        <th>Container No</th>
                                                                        <th>INI No</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                       <th>Sno</th>
                                                                        <th>Date</th>
                                                                        <th>Container No</th>
                                                                        <th>INI No</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;                                                     
                                                                    foreach ($view_movement_details->result() as $row)
                                                                    {                                                               
                                                                ?>
                                                                    <tr>
                                                                    	  <td><?php  echo $sno; ?></td>
                                                                          <td><?php echo date('d-M-Y', strtotime($row->Party_billing_date)); ?></td>
                                                                          
                                                                          <td><?php echo $row->Party_billing_container_no; ?></td>
                                                                          <td><?php echo $row->Party_billing_ini_no; ?></td>
                                                                          <td><?php echo $row->Party_billing_from; ?></td>
                                                                          <td><?php echo $row->Party_billing_to; ?></td>
                                                                          <td>
                                            	 <a href="read_party_billing_details?id=<?php echo $row->Party_billing_id; ?>" target="_blank"; alt="View" class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Party Detail" data-placement="bottom"> View </a>
                                               <i class="fa fa-ellipsis-v"></i>
                                                <?php if($this->session->userdata('username')=='admin'){ ?>
                                                 <a href="edit_party_billing?id=<?php echo $row->Party_billing_party_name; ?>"  alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Party Billing Detail" data-placement="bottom"> Edit </a> <i class="fa fa-ellipsis-v"></i>
                                                <?php 
                                               /* if($row->Party_billing_status=='A')
                                                {
                                                   echo '<a href="deny_party_billing?id='.$row->Party_billing_id.'" alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Party" data-placement="bottom"> Deny </a>';   
                                                }
                                                else
                                                {
                                                    echo '<a href="approve_party_billing?id='.$row->Party_billing_id.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a Party" data-placement="bottom"> Active </a>';
                                                }*/
                                                ?>   
                                                
                                                <a href="delete_message?id=<?php echo $row->Party_billing_id;?>" onclick="return confirm('Are you sure you want to delete?')"alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a Party" data-placement="bottom" > Delete </a>
                                                <?php } ?>
                                            </td>                                                                                         
                                                                      </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               
                                                        </table>
                                                        
                                                       </div>
                                                        </div>
                                                </section> 
                                                  
                                                </div>
                                            </div>

                                        </div>

                                    
                         <!-- end mail box for read daily movement details -->   
                     

                     </div>   
                            


                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        