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
                                <h1 class="title">Edit User Rights Details</h1>                            </div>


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
        <?php echo form_open_multipart('admin_user_rights_details/validate_edit_admin_user_rights_details', array('class'=>'form-horizontal'));        
        foreach ($admin_user_rights_details_data->result() as $row)
        {            
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
          <div class="form-group">
            <label class="col-lg-3 control-label">User Category Name:</label>
            <div class="col-lg-8">              
              <?php
                  $data1 = array(
                        'name'        => 'user_type',
                        'id'          => 'user_type',
                        'value'       => $row->User_rights_name,
                        'maxlength'   => '160',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter User Category Name'
                      ); 
                  echo form_input($data1);
              ?>              
            </div>
          </div>
         <input type="hidden" id="id" name="id" value="<?php echo $row->User_rights_id; ?>">
          <div class="form-group">
            <label class="col-lg-3 control-label">User Rights:</label>
            <div class="col-lg-3"> 
              <?php
                $option = array(
                  'Driver Details'            => 'Driver Details',
                  'Driver Pay Rate'           => 'Driver Pay Rate',
				  'Driver Payment'            => 'Driver Payment',
				  'Vehicle Details'           => 'Vehicle Details',
				  'Vehicle Document Details'  => 'Vehicle Document Details',
				  'Daily Movement'            => 'Daily Movement',
				  'Party Details'             => 'Party Details',
				  'Party Billing'             => 'Party Billing',
				  'Party Payment'             => 'Party Payment',
				  'ISO Movement'              => 'ISO Movement',
				  'Transport Details'         => 'Transport Details',
				  'Transport Payment'         => 'Transport Payment',
				  'Vehicle Due Details'       => 'Vehicle Due Details' ,
				  'Admin User Rights'         => 'Admin User Rights',
				  'User'                      => 'User'                
                );
				
                $class_nme = 'class="form-control selectmultiple" id="motherTongue" multiple="multiple"';       
                echo form_dropdown('user_righ[]', $option, set_value('user_righ'), $class_nme);
              ?>
              <span style="font-size:13px; color:#0f71ba;">Hold CTRL key for multiple select.</span>
            </div>
            <div class="col-lg-1">
            <a href="#" class="move-button selectlink" id="add" name="add"> <i class="fa fa-exchange"></i></a> <br><br>
	        <a href="#" class="move-button selectlink" id="remove" name="remove" ><i class="fa fa-exchange"></i> </a>
            </div>
            <div class="col-lg-3"> 
       <?php
			  $num=explode(",",$row->User_rights_type_value);			 
			  $options = array();

        $sel_user_rights ='<select name="user_rights[]" class="form-control selectmultiple" id="motherTongue1" multiple="multiple" >';

        foreach ($num as $num_typ) 
        {
          $options[$num_typ]=$num_typ;
          $sel_user_rights .= '<option value="'.$num_typ.'" selected >'.$num_typ.'</option>';
        }
        $sel_user_rights .= '</select>';
        //print_r($options); 
        echo $sel_user_rights;

                //$class_nme = 'class="form-control selectmultiple" id="motherTongue1" multiple="multiple"';       
                //echo form_dropdown('user_rights[]', $options, $options, $class_nme);
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

        