<?php 
include('include/header.php');
?>
<!-- <link rel="stylesheet" href="css/jquery.validate.css" />
<script src="js/jquery.js"></script> 
<script src="js/jquery.validate.js"></script>
<script src="js/jquery.validation.functions.js"></script> -->

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Add User Rights Details</h1>                            </div>


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
        <?php echo form_open_multipart('admin_user_rights_details/validate_admin_user_rights_details', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
          <div class="form-group">
            <label class="col-lg-3 control-label">User Category Name:</label>
            <div class="col-lg-8">              
              <?php
                  $data1 = array(
                        'name'        => 'user_type',
                        'id'          => 'user_type',
                        'value'       => set_value('user_type'),
                        'maxlength'   => '160',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter User Category Name'
                      ); 
                  echo form_input($data1);
              ?>              
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">User Rights:</label>
            <div class="col-lg-3"> 
              <?php
			  $options = [];
			  foreach($user_rights_list as $rights){
				  $options[$rights['module_name']] = $rights['module_name'];
			  }
                $class_nme = 'class="form-control selectmultiple" id="motherTongue" multiple="multiple"';       
                echo form_dropdown('user_righ[]', $options, set_value('user_righ'), $class_nme);
              ?>
              <span style="font-size:13px; color:#0f71ba;">Hold CTRL key for multiple select.</span>
            </div>
            <div class="col-lg-1">
            <a href="#" class="move-button selectlink" id="add" name="add"> <i class="fa fa-exchange"></i></a> <br><br>
	        <a href="#" class="move-button selectlink" id="remove" name="remove" ><i class="fa fa-exchange"></i> </a>
            </div>
            <div class="col-lg-3"> 
              <?php
                $options = array(
                                  
                );
				
                $class_nme = 'class="form-control selectmultiple" id="motherTongue1" multiple="multiple"';       
                echo form_dropdown('user_rights[]', $options, set_value('user_right'), $class_nme);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='admin_user_rights_details_list'" >
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
include('validation/admin_user_rights_details.php');

?>
<script type="text/javascript">
 $().ready(function() {
   $('#add').click(function() {
    return !$('#motherTongue option:selected').remove().appendTo('#motherTongue1');
   });
   $('#remove').click(function() {
    return !$('#motherTongue1 option:selected').remove().appendTo('#motherTongue');
   });
  }); 
</script>
