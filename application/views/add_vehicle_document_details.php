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
                                <h1 class="title">Add Vehicle Document Details</h1>                           
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
        <?php echo form_open_multipart('vehicle_document_details/validate_vehicle_document_details', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>
          <div class="form-group">
            <label class="col-lg-3 control-label">Vehicle Number:</label>
            <div class="col-lg-8">              
              <?php
                $options_driver['']='Select Vehicle Number';
                foreach($vehicle_details_list->result() as $driver)
                {                  
                  $options_driver[$driver->Vehicle_dtl_id] = $driver->Vehicle_dtl_number;
				                  
                } 
                echo form_dropdown('vehicle_number', $options_driver, '', 'class="form-control" id="vehicle_number"');
              ?>
            </div>
          </div>          
          <div class="form-group">
          <label class="col-lg-3 control-label">M permit:</label>
            <div class="col-lg-3" id="sandbox-container">              
             <?php  $data1 = array(
                        'name'        => 'm_permit_from',
                        'id'          => 'm_permit_from',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'From'
                      ); 
                  echo form_input($data1);?>
            </div>
            &nbsp;
            <div class="col-lg-3">              
             <?php  $data1 = array(
                        'name'        => 'm_permit_to',
                        'id'          => 'm_permit_to',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'To'
                      ); 
                  echo form_input($data1);?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">N permit:</label>
            <div class="col-lg-3">              
             <?php  $data1 = array(
                        'name'        => 'n_permit_from',
                        'id'          => 'n_permit_from',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'From'
                      ); 
                  echo form_input($data1);?>
            </div>
            &nbsp;
            <div class="col-lg-3">              
              <?php  $data1 = array(
                        'name'        => 'n_permit_to',
                        'id'          => 'n_permit_to',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'To'
                      ); 
                  echo form_input($data1);?>
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">AP permit:</label>
            <div class="col-lg-3">              
             <?php  $data1 = array(
                        'name'        => 'ap_permit_from',
                        'id'          => 'ap_permit_from',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'From'
                      ); 
                  echo form_input($data1);?>
            </div>
            &nbsp;
            <div class="col-lg-3">              
              <?php  $data1 = array(
                        'name'        => 'ap_permit_to',
                        'id'          => 'ap_permit_to',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'To'
                      ); 
                  echo form_input($data1);?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Insurance:</label>
            <div class="col-lg-3">              
               <?php  $data1 = array(
                        'name'        => 'insurance_from',
                        'id'          => 'insurance_from',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'From'
                      ); 
                  echo form_input($data1);?>
            </div>
          &nbsp;
            <div class="col-lg-3">              
             <?php  $data1 = array(
                        'name'        => 'insurance_to',
                        'id'          => 'insurance_to',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'data-format' => 'dd MM yyyy',
						'readonly'    =>'true',
                        'placeholder' => 'To'
                      ); 
                  echo form_input($data1);?>
            </div>
          </div> 
           <div class="form-group">
            <label class="col-lg-3 control-label">FC:</label>
            <div class="col-lg-3">              
             <?php  $data1 = array(
                        'name'        => 'fc_from',
                        'id'          => 'fc_from',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'From'
                      ); 
                  echo form_input($data1);?>
            </div>
            &nbsp;
            <div class="col-lg-3">              
              <?php  $data1 = array(
                        'name'        => 'fc_to',
                        'id'          => 'fc_to',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'To'
                      ); 
                  echo form_input($data1);?>
            </div>
          </div>
         
           <div class="form-group">
            <label class="col-lg-3 control-label">Tax:</label>
            <div class="col-lg-3">              
              <?php  $data1 = array(
                        'name'        => 'tax_from',
                        'id'          => 'tax_from',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'From'
                      ); 
                  echo form_input($data1);?>
            </div>
            &nbsp;
            <div class="col-lg-3">              
              <?php  $data1 = array(
                        'name'        => 'tax_to',
                        'id'          => 'tax_to',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'To'
                      ); 
                  echo form_input($data1);?>
            </div>
          </div> 
            <div class="form-group">
            <label class="col-lg-3 control-label">P Certificate:</label>
            <div class="col-lg-3">              
             <?php  $data1 = array(
                        'name'        => 'pc_from',
                        'id'          => 'pc_from',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'From'
                      ); 
                  echo form_input($data1);?>
            </div>
            &nbsp;
            <div class="col-lg-3">              
              <?php  $data1 = array(
                        'name'        => 'pc_to',
                        'id'          => 'pc_to',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
                        'placeholder' => 'To'
                      ); 
                  echo form_input($data1);?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='vehicle_document_details_list'" >
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
include('validation/add_vehicle_document_details.php');
?>
        