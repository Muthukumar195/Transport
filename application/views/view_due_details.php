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
                                <h1 class="title">View Vehicle Due Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                                
                                    <div class="mail_content">
                                    <?php 
									$vehi_id=""; $vehi_make="";
										foreach ($view_due_details->result() as $row)
                                         {
											$vehi_id=$row->Vehicle_due_dtl_vehicle_no ;
											$vehi_make=$row->Vehicle_dtl_make ; 
										 }
										?>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h3 style="font-weight:bold;"><?php  $vehi_no=$this->input->get('vhl_no'); echo $vehi_no;  ?></h3>
                                                    <h4><strong>Make :</strong>&nbsp;&nbsp;<?php echo $vehi_make;  ?></h4>
                                                    
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">  
                                                  <section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Vehicle Due Details</h2>
                                                            <div class="actions panel_actions pull-right">
                                                                <i class="box_toggle fa fa-chevron-down"></i>
                                                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                                                <i class="box_close fa fa-times"></i>
                                                                 <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/due_details/view_due_details_print?id=<?php echo $vehi_id.'&vhl_no='.$vehi_no; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                                            </div>
                                                        </header>
                                                        <div class="content-body">    <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                    	<th>Sno</th>
                                                                        <th>Due Pay Dates</th> 
                                                                        <th>Paid Date</th> 
                                                                        <th>Paid Status</th>
                                                                        <th>Due Amount (<i class="fa fa-inr"></i>)</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Sno</th>
                                                                        <th>Due Pay Dates</th>
                                                                        <th>Paid Date</th>                  
                                                                        <th>Paid Status</th> 
                                                                        <th>Due Amount (<i class="fa fa-inr"></i>)</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;                                                     
                                                                    foreach ($view_due_details->result() as $row)
                                                                    {                                                               
                                                                ?>
                                                                    <tr>
                                                                    	  <td><?php  echo $sno; ?></td>
                                                                          <td><?php echo date('d-M-Y', strtotime($row->Vehicle_due_dtl_pay_date)); ?></td>         
                                                                         
                                                                          <td><?php if($row->Vehicle_due_dtl_paid_date=="0000-00-00"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_due_dtl_paid_date)); } ?></td>
                                                                          <td>
                                                                          <?php
                                                                            if($row->Vehicle_due_pay_status=='U')
                                                                            {
                                                                                echo '<strong style="color:red;">Unpaid</strong>';
                                                                            }
                                                                            else
                                                                            {
                                                                                echo '<strong style="color:green;">Paid</strong>';
                                                                            }									  	
                                                                          ?>
                                                                          </td>
                                                                          <td>
                                                                            
                                                                            <span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Vehicle_due_dtl_amount; ?></span>
                                                                          </td>
                                                                           
                                                                          <td>
                                                                          <?php if($row->Vehicle_due_pay_status=="U"){ ?>
                                                                          <a href="add_due_amount?id=<?php echo $row->Vehicle_due_dtl_id; ?>" alt="Edit"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Paid Due Amount Detail" data-placement="bottom"> <button type="button" class="btn btn-primary">Paid Due Date</button> </a>                                                     <?php } ?>
                                                                          </td>                                                                                          
                                                                      </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               	<tfoot>
                                                                 
                                                                </tfoot>
                                                        </table>
                                                       </div>
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
        