<?php 
include('include/header.php');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />

        <!-- START CONTAINER -->
        <div class="page-container row-fluid"  >

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">View Iso Payment Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">
                    <?php 
					$id = $this->input->get('id'); 
                    $tr_nme = $this->input->get('tr_nme');
                    ?>
                    <div class="col-lg-12">
                     <?php echo form_open_multipart('iso_movement_details/view_all_iso_movement_details?id='.$id.'&tr_nme='.$tr_nme.'', array('class'=>'form-horizontal')); ?>
                  <span style="color:red; "><?php echo validation_errors(); ?></span> 
					<div class="row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Movement Date From:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'm_date_from',
                                'id'          => 'm_date_from',
                                'value'       => set_value('m_date_from'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    => 'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'From'
                              ); 
                          echo form_input($data1);?>
                        </div>
                      </div> 
                    </div>           
                    <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Movement Date To:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'm_date_to',
                                'id'          => 'm_date_to',
                                'value'       => set_value('m_date_to'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    => 'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'To'
                              ); 
                          echo form_input($data1);?>
                        </div>
                      </div> 
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <div class="form-group" >
                        <?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>
                        
                      </div> 
                    </div>           
                  </div>
                  </form> 
                         <!-- start mail box for read daily movement details -->
                                    <div class="mail_content">

                                            <div class="row">
                                                 <div class="col-md-11 col-sm-11 col-xs-11">
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php echo $tr_nme;  ?></h3> 
                                                </div>
                                                <div class="col-md-1 col-sm-1 col-xs-1">
                                                   
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">  
                                                  <section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Transport Paid Amount Detail</h2>
															
                                                            <div class="actions panel_actions pull-right">
                                                            <a href="add_transport_payment?id=<?php echo $id; ?>" target="_blank" alt="add Transport payment">
                                                            <button class="btn btn-success">Add Transport Payment</button></a>
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
                                                                        <th>Transport Type</th>
                                                                        <th>Vehical No</th>  
                                                                        <th>Load Type</th> 
                                                                        <th>Transport Amount (<i class="fa fa-inr"></i>)</th>
                                                                        <th>Iso Amount (<i class="fa fa-inr"></i>)</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Sno</th>
                                                                        <th>Date</th>
                                                                        <th>Transport Type</th>
                                                                        <th>Vehical No</th>  
                                                                        <th>Load Type</th> 
                                                                        <th>Transport Amount (<i class="fa fa-inr"></i>)</th>
                                                                        <th>Iso Amount (<i class="fa fa-inr"></i>)</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;  $tt_rent = 0;$iso_amt = 0;                                                   
                                                                    foreach ($iso_all_movement_details_list->result() as $row)
                                                                    { 
																	                                                             
                                                                ?>
                                                                    <tr>
                                                                    	  <td><?php  echo $sno; ?></td>
                                                                        <td><a href="view_iso_movement_details?id=<?php echo $row->Iso_mvnt_id; ?>" target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View ISO Movement Detail" data-placement="bottom"><?php echo date('d-m-Y', strtotime($row->Iso_mvnt_date)); ?></a>
                                                                        </td>
                                                                        <td>
                                                                        <?php 
                                                                          if($row->Iso_mvnt_vehicle_type=="T"){
                                                                            echo 'Thirumala Tansport';
                                                                          }
                                                                          else{
                                                                            
                                                                            echo 'Other Tansport';
                                                                          }
                                                                          ?>
                                                                                                </td>
                                                                                                <td> <?php 
                                                                          if($row->Iso_mvnt_vehicle_type=='O'){
                                                                            
                                                                            echo $row->Iso_mvnt_other_vehicle_no;
                                                                            }
                                                                          else{
                                                                                echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
                                                                               }
                                                                             ?>  
                                                                             </td>
                                                                             <td><?php if($row->Iso_mvnt_im_ex=="I"){ echo 'Import'; } else { echo 'Export'; }  ?></td>

                                                                          <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Iso_mvnt_tp_amount; ?></span></td>
                                                                          <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Iso_mvnt_amount; ?></span></td>
                                                                          
                                                                          <?php if($this->session->userdata('username')=='admin'){ ?>
                                                                          <td>
                                                                              <?php 
                                                                              if($row->Iso_mvnt_status=='A')
                                                                              {
                                                                                 echo '<strong class="fa fa-check" style="color:green;"> Active</strong>';   
                                                                              }
                                                                              else
                                                                              {
                                                                                  echo '<strong class="fa fa-times" style="color:red;"> Deny</strong>';
                                                                              }
                                                                              ?>                                               
                                                                              
                                                                          </td>
                                                                          <?php } ?>
                                                                          <td>
                                                                           <a href="view_iso_movement_details?id=<?php echo $row->Iso_mvnt_id; ?>" target="_blank"  alt="View" class="fa fa-search-plus" title="view" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View ISO Movement Detail" data-placement="bottom"> View </a>
                                                                           <i class="fa fa-ellipsis-v"></i>
                                                                              
                                                                              <?php if($this->session->userdata('username')=='admin'){ ?>
                                                                              <a href="edit_iso_movement_details?id=<?php  echo $row->Iso_mvnt_id; ?>" alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Driver Detail" data-placement="bottom"> Edit </a> <i class="fa fa-ellipsis-v"></i>
                                                                              <?php 
                                                                             if($row->Iso_mvnt_status=='A')
                                                                              {
                                                                                 echo '<a href="deny_iso_movement_details?id='.$row->Iso_mvnt_id.'" alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a ISO Movement" data-placement="bottom" > Deny </a>';   
                                                                              }
                                                                              else
                                                                              {
                                                                                  echo '<a href="approve_iso_movement_details?id='.$row->Iso_mvnt_id.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a ISO Movement" data-placement="bottom" > Active </a>';
                                                                              }
                                                                              ?>   
                                                                              <i class="fa fa-ellipsis-v"></i>
                                                                              <a href="delete_iso_movement_details?id=<?php echo $row->Iso_mvnt_id;?>" onclick="return confirm('Are you sure you want to delete?')" alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a ISO Movement" data-placement="bottom" > Delete </a>
                                                                              <?php } ?>
                                                                          </td>                                                                                         
                                                                      </tr>

                                                                     <?php 
                                                                     
                                                                     $tt_rent = intval($tt_rent)+intval($row->Iso_mvnt_tp_amount); 
                                                                     
                                                                     $iso_amt = intval($iso_amt)+intval($row->Iso_mvnt_amount); ?>
                                                                <?php $sno++; } ?>
                                                                <th></th>
                                                                <th></th>
                                                                </tbody>
                                                               	<tfoot>
                                                                  <tr>
                                                                      <th colspan="5"><span style="float:right;">Total</span></th>  
                                                                      <th><?php echo '<span class="text-primary"><i class="fa fa-inr"></i> '.$tt_rent.'</span>'; ?></th>
                                                                      <th><?php echo '<span class="text-primary"><i class="fa fa-inr"></i> '.$iso_amt.'</span>'; ?></th>                                                                                         
                                                                  </tr>
                                                                </tfoot>
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
        