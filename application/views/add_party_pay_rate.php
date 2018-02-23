<?php 
include('include/header.php');
?>
 
<style type="text/css">
div#partyerror span.ValidationErrors {
	position:relative !important;
	left:15px !important;
	margin-bottom: -13px !important;
}
span.ErrorField {
    color: rgba(118, 118, 118, 1.0) !important;
}
</style>
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Add Party PayRate</h1> 
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
        <?php echo form_open_multipart('party_pay_rate/validate_party_pay_rate', array('class'=>'form-horizontal' ,'name'=>'daily_movement')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
        
          <div class="form-group">

            <label class="col-lg-2 control-label">Party Name:</label>
            <div class="col-lg-3">              
              <?php                
                $options_party_nme['']='Select Party Name';
                foreach($party_name_list->result() as $party_nme)
                {                  
                  $options_party_nme[$party_nme->Party_dtl_id] = $party_nme->Party_dtl_name;                   
                } 
                echo form_dropdown('party_name', $options_party_nme, '', 'class="form-control" id="party_name"');
              ?> 
            </div>
            
            <label class="col-lg-2 control-label">Place Name:</label>
            <div class="col-lg-3">              
              <?php                
                $options_place['']='Select Place Name';
                foreach($place_name_list->result() as $place)
                {                  
                  $options_place[$place->Driver_pay_rate_id] = $place->Driver_pay_rate_place_name;                   
                } 
                echo form_dropdown('place_name', $options_place, '', 'class="form-control" id="place_name"');
              ?> 
            </div>
            
          </div>
          
          
        
          <div class="form-group">
            <label class="col-lg-2 control-label">Party Rent:</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'rent',
                        'id'          => 'rent',
                        'value'       => '',
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
            'placeholder' => 'Enter Party Rent'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
            <label class="col-lg-2 control-label">Other Transport Rent:</label>
            <div class="col-lg-3"> 
               <?php 
                  $data2 = array(
                        'name'        => 'ot_rent',
                        'id'          => 'ot_rent',
                        'value'       => '',
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Party Other Transport Rent'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
           
            
          <div class="form-group">
            <label class="col-md-1 control-label"></label>
            <div class="col-md-3">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary" onclick="form_validation()"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='party_pay_rate_list'" >
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
include('validation/add_daily_movement_details.php');
?>
<script>
</script>
        