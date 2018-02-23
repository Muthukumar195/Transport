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
                                <h1 class="title">Add Transport Details</h1>                           
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
                        <?php echo form_open_multipart('transport_details/validate_transport_details', array('class'=>'form-horizontal')); ?>
                          <span style="color:red; "><?php echo validation_errors(); ?></span>          
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Transport Name:</label>
                            <div class="col-lg-8">              
                              <?php
                                  $data1 = array(
                                        'name'        => 'transport_name',
                                        'id'          => 'transport_name',
                                        'value'       => '',
                                        'maxlength'   => '160',
                                        'class'       => 'form-control',
                                        'placeholder' => 'Enter Name'
                                      ); 
                                  echo form_input($data1);
                              ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Transport Mobile:</label>
                            <div class="col-lg-8">              
                              <?php 
                                  $data2 = array(
                                        'name'        => 'phone_no',
                                        'id'          => 'phone_no',
                                        'value'       => '',
                                        'maxlength'   => '20',
                                        'class'       => 'form-control',
                                        'onkeyup'     => 'checkInt(this)',
										'placeholder' => 'Enter Mobile Number'
                                      ); 
                                  echo form_input($data2);
                              ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Transport Address:</label>
                            <div class="col-lg-8">             
                              <?php echo form_textarea('address', '', 'class="form-control" id="area" cols="5" rows="5"'); ?>
                            </div>
                          </div> 
                          <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">              
                              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
                              <span></span>
                              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='transport_details_list'" >
                            </div>
                          </div> 
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
include('validation/add_transport_details.php');
?>
        