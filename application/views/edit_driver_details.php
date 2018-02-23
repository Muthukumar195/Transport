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
                                <h1 class="title">Edit Driver Details</h1>                            </div>


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
        <?php echo form_open_multipart('driver_details/validate_edit_driver_details', array('class'=>'form-horizontal'));        
        foreach ($driver_details_data->result() as $row)
        {            
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
          <div class="form-group">
            <label class="col-lg-3 control-label">Driver Name:</label>
            <div class="col-lg-8">              
              <?php
                  $data1 = array(
                        'name'        => 'full_name',
                        'id'          => 'full_name',
                        'value'       => $row->Driver_dtl_name,
                        'maxlength'   => '160',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Name',
                        'readonly'    => 'readonly'
                      ); 
                  echo form_input($data1);
              ?>
              <input type="hidden" id="id" name="id" value="<?php echo $row->Driver_dtl_id; ?>">
              <input type="hidden" id="file_name" name="file_name" value="<?php echo $row->Driver_dtl_license_file; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Driver Mobile:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'phone_no',
                        'id'          => 'phone_no',
                        'value'       => $row->Driver_dtl_phone,
                        'maxlength'   => '20',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Mobile Number'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Driver Address:</label>
            <div class="col-lg-8">             
              <?php echo form_textarea('address', $row->Driver_dtl_address, 'class="form-control" id="address" cols="5" rows="5"'); ?>
            </div>
          </div> 
          <div class="form-group">
            <label class="col-lg-3 control-label">Driver Category Type:</label>
            <div class="col-lg-8">              
              <?php
                $options = array(
                  ''  => '-- Select Type --',
                  'P'    => 'Permanent',
                  'A'   => 'Acting'                  
                );     
                $class_nme = 'class="form-control" id="driver_type"';       
                echo form_dropdown('driver_type', $options, $row->Driver_dtl_type, $class_nme);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">License File:</label>
            <div class="col-lg-8">              
              <input type="file" name="userfile" id="userfile" size="20"/><br>
              <a href="<?php echo base_url(); ?>/uploads/license/<?php echo $row->Driver_dtl_license_file; ?>" target="_blank"><img src="<?php echo base_url(); ?>/uploads/license/<?php echo $row->Driver_dtl_license_file; ?>" title="Driver License Copy" alt="<?php echo $row->Driver_dtl_license_file; ?>" class="img-rounded" width="15%" /></a>
            </div>
          </div> 
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='driver_details_list'" >
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
include('validation/edit_driver_details.php');
?>
        