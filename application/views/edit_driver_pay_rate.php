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
                                <h1 class="title">Edit Driver Pay Rate</h1>                            
                             </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body">

                    <div class="row">
                       
                       <!-- edit form column -->
                       <div class="col-md-12 col-sm-12 col-lg-12 personal-info">
                       <?php if($this->session->flashdata('success_msg')!=null){ ?>
                        <div class="alert alert-success alert-dismissable">
                          <a class="panel-close close" data-dismiss="alert">×</a> 
                          <i class="fa fa-check-square"></i>
                          <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>  
                        <?php } ?>    
                        
                        <!-- <form class="form-horizontal" role="form"> -->        
                        <?php echo form_open_multipart('driver_pay_rate/validate_edit_driver_pay_rate', array('class'=>'form-horizontal'));        
                        foreach ($driver_pay_rate_data->result() as $row)
                        {            
                        ?>
                          <span style="color:red; "><?php echo validation_errors(); ?></span>          
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Place:</label>
                            <div class="col-lg-4">              
                              <?php
                                  $data1 = array(
                                        'name'        => 'place_name',
                                        'id'          => 'place_name',
                                        'value'       => $row->Driver_pay_rate_place_name,
                                        'maxlength'   => '160',
                                        'class'       => 'form-control',
                                        'placeholder' => 'Enter Place Name'
                                      ); 
                                  echo form_input($data1);
                              ?>
                              <input type="hidden" id="id" name="id" value="<?php echo $row->Driver_pay_rate_id; ?>">
                             
                            </div>
                          
                            <label class="col-lg-2 control-label">Place Amount:</label>
                            <div class="col-lg-4">              
                              <?php 
                                  $data2 = array(
                                        'name'        => 'driver_amount',
                                        'id'          => 'driver_amount',
                                        'value'       => $row->Driver_pay_rate_amount,
                                        'maxlength'   => '10',
                                        'class'       => 'form-control',
                                        'onkeyup'       => 'checkInt(this)',
                        				'placeholder' => 'Enter Amount'
                                      ); 
                                  echo form_input($data2);
                              ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Diesel liter:</label>
                            <div class="col-lg-4">              
                              <?php 
                                  $data2 = array(
                                        'name'        => 'diesel_ltr',
                                        'id'          => 'diesel_ltr',
                                        'value'       => $row->Driver_pay_rate_diesel_ltr,
                                        'maxlength'   => '10',
                                        'class'       => 'form-control',
                                        'onkeyup'     => 'checkInt(this)',
                                        'placeholder' => 'Enter liter'
                                      ); 
                                  echo form_input($data2);
                              ?>
                              <span style="color:#09F;">How many liter</span>
                            </div>
                            <label class="col-lg-2 control-label">Diesel rate :</label>
                            
                            <div class="col-lg-4">              
                              <?php 
                                  $data2 = array(
                                        'name'        => 'diesel_rate',
                                        'id'          => 'diesel_rate',
                                        'value'       => $row->Driver_pay_rate_diesel_rate,
                                        'maxlength'   => '10',
                                        'class'       => 'form-control',
                                        'onkeyup'     => 'checkInt(this)',
                                        'placeholder' => 'Enter Diesel rate'
                                      ); 
                                  echo form_input($data2);
                              ?>
                               <span style="color:#09F;">One liter rate</span>
                            </div>
                           
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">              
                              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
                              <span></span>
                              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='driver_pay_rate_list'" >
                            </div>
                          </div> 
                          <?php } ?>
                      </form>
                       
                      </div>
                  </div>
                  <!-- End .row -->
                
                            </div>
                        </section></div>

                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');
include('validation/add_driver_pay_rate.php');
?>
        