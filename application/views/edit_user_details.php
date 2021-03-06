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
                                <h1 class="title">Edit User Details</h1>
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
        <?php echo form_open_multipart('user_details/validate_edit_user_details', array('class'=>'form-horizontal'));        
        foreach ($user_details_data->result() as $row)
        {            
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
          <div class="form-group">
            <label class="col-lg-3 control-label">Full Name:</label>
            <div class="col-lg-8">              
              <?php
                  $data1 = array(
                        'name'        => 'full_name',
                        'id'          => 'full_name',
                        'value'       => $row->Admin_fullname,
                        'maxlength'   => '160',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Full Name',
                      ); 
                  echo form_input($data1);
              ?>
              <input type="hidden" id="id" name="id" value="<?php echo $row->Admin_id; ?>">
              <input type="hidden" id="file_name" name="file_name" value="<?php echo $row->Admin_profile; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">              
              <?php
                  $data1 = array(
                        'name'        => 'email',
                        'id'          => 'email',
                        'value'       => $row->Admin_email,
                        'maxlength'   => '160',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Email'
                      ); 
                  echo form_input($data1);
              ?>              
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Mobile:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'phone_no',
                        'id'          => 'phone_no',
                        'value'       => $row->Admin_phone,
                        'maxlength'   => '20',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Mobile Number'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">User Name:</label>
            <div class="col-lg-8">              
              <?php
                  $data1 = array(
                        'name'        => 'user_name',
                        'id'          => 'user_name',
                        'value'       => $row->Admin_username,
                        'maxlength'   => '160',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter User Name'
                      ); 
                  echo form_input($data1);
              ?>              
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Old Password:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'old_password',
                        'id'          => 'old_password',
						'type'        => 'password',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Password'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Password:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'password',
                        'id'          => 'password',
						'type'        => 'password',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Password'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Confirm Password:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'con_password',
                        'id'          => 'con_password',
						'type'        => 'password',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Confirm Password'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Profile:</label>
            <div class="col-lg-8">              
              <input type="file" name="userfile" id="userfile" size="20"/><br>
              <a href="<?php echo base_url(); ?>/uploads/admin_profie/<?php echo $row->Admin_profile; ?>" target="_blank"><img src="<?php echo base_url(); ?>/uploads/admin_profie/<?php echo $row->Admin_profile; ?>" title="Profile Photo" alt="<?php echo $row->Admin_profile; ?>" class="img-rounded" width="15%" /></a>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">User Rights Type:</label>
            <div class="col-lg-8">              
              <?php
                $options_user['']='Select User Rights';
                foreach($admin_user_rights_details_list->result() as $user_rights)
                {                  
                  $options_user[$user_rights->User_rights_id] = $user_rights->User_rights_name;
				                  
                } 
                echo form_dropdown('user_rights', $options_user, $row->Admin_user_rights, 'class="form-control" id="user_rights"');
              ?>
            </div>
          </div> 
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='user_details_list'" >
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
include('validation/edit_user_details.php');
?>
        