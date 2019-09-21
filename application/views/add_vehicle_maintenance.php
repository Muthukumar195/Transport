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
                                <h1 class="title"><?php echo $form; ?> Vehicle Maintenance</h1>                           
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
        
        
        <?php echo form_open_multipart('vehicle_maintenance/'.strtolower($form), array('class'=>'form-horizontal')); ?>
          	<div class="form-group"> 
					<label class="col-lg-3 control-label">Vehicle No:</label>
					<div class="col-lg-8"> 
					<input type="hidden" name="id" id="id">
					<select class="form-control" name="vehicle_id"  id="vehicle_id">
						<option value="">Select Vehicle</option>
						<?php  foreach($vehicle_numbers as $Vehicle) { ?>
						<option value="<?php echo $Vehicle->Vehicle_dtl_id ?>"><?php echo $Vehicle->Vehicle_dtl_number; ?></option>
						<?php } ?>
					 </select>
					  <span class="error"><?php echo isset($errors['vehicle_id'])? $errors['vehicle_id'] : ''; ?></span>					  
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-lg-3 control-label">Spare Part:</label>
					<div class="col-lg-8">              
					  <input type="text" name="spare_part" id="spare_part"  value="" class="form-control" placeholder="Enter Spare Part">
					  <span class="error"><?php echo isset($errors['spare_part'])? $errors['spare_part'] : ''; ?></span>							  
					</div>
				  </div>
				   <div class="form-group">
					<label class="col-lg-3 control-label">Amount:</label>
					<div class="col-lg-8">              
					  <input type="text" onkeyup="checkInt(this)" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
					   <span class="error"><?php echo isset($errors['amount'])? $errors['amount'] : ''; ?></span>	
					  
					</div>
				  </div>
				   <div class="form-group">
					<label class="col-lg-3 control-label">Maintenance Date:</label>
					<div class="col-lg-8">              
					  <input type="text" name="maintenance_date" id="date" class="form-control datepicker" data-format="dd MM yyyy" placeholder="Select Maintenance Date">
					   <span class="error"><?php echo isset($errors['maintenance_date'])? $errors['maintenance_date'] : ''; ?></span>	
					  
					</div>
				  </div>
				   <div class="form-group">
					<label class="col-lg-3 control-label">Notes:</label>
					<div class="col-lg-8">              
					  <textarea name="notes" class="form-control" id="notes" rows="5" placeholder="Enter Notes"></textarea>
					  <span class="amount_error"></span>
					  
					</div>
				  </div>				  
				  <div class="form-group">	
					<label class="col-md-3 control-label"></label>				  
					<div class="col-lg-8">              
					  <button type="submit" class="btn btn-primary">Save</button>
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

<?php include('include/footer.php');?>
<script>
	var formValue = <?php echo isset($vehicle_maintenance_detail)? json_encode($vehicle_maintenance_detail[0]) : '[]'; ?>;
	$.each(formValue, function(i, item) {
		if(i == 'date'){
			$('#'+i).val(moment(item).format('D MMMM YYYY'));
		}else{
			$('#'+i).val(item);
		}
		
	});	
	
</script>
        