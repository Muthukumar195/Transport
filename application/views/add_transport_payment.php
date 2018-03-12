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
                                <h1 class="title">Add Transport Payment</h1>                            </div>


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
        <?php echo form_open_multipart('transport_payment/validate_transport_payment', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
          <div class="form-group">
            <label class="col-lg-3 control-label">Transport Name:</label>
            <div class="col-lg-8">                        
              <?php  
			   $id = $this->input->get('id');              
                $options_trans_nme['']='Select Transport Name';               
                foreach($transport_name_list->result() as $transport_nme)
                {                  
                  $options_trans_nme[$transport_nme->Transport_dtl_id] = $transport_nme->Transport_dtl_name;                   
                } 
                echo form_dropdown('transport_name', $options_trans_nme, $id, 'class="form-control" id="trans_name"');
              ?> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Amount ( <i class="fa fa-inr"></i> ):</label>
            <div class="col-lg-8">              
              <?php  
                $data2 = array(
                        'name'        => 'amount',
                        'id'          => 'amount',
                        'value'       => '',
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter amount',
						'onKeyUp'	 => 'checkInt(this)'
                      ); 
                  echo form_input($data2);?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Date of Transport Pay:</label>
            <div class="col-lg-8">              
              <?php  
                $data1 = array(
                        'name'        => 'transport_pay_date',
                        'id'          => 'transport_pay_date',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
                        'data-format' => 'dd MM yyyy',
                        'placeholder' => 'Select a Date',
						'readonly'    => 'readonly'
                      ); 
                echo form_input($data1);?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Remarks:</label>
            <div class="col-lg-8">              
              <?php  
                $data = array(
				  'name'        => 'remarks',
				  'id'          => 'remarks',
				  'value'       => '',
				  'rows'        => '5',
				  'cols'        => '10',
				  'style'       => '',
				  'class'	   => 'form-control'
				);
			
			  echo form_textarea($data); 
			?>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='transport_payments_list'" >
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
include('validation/add_transport_payment_details.php');
?>        