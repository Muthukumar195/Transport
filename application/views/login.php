
    <!-- BEGIN BODY -->
    <body class=" login_page">


        <div class="login-wrapper">
            <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
                <h1><a href="#" title="Login Page" tabindex="-1">Sri Thirumala Transport</a></h1>                
                
                <?php echo form_open('tranport_main/validate_credentials'); ?>
                <?php if(validation_errors()){ ?>
                 <span style="color:red; "><?php echo validation_errors(); ?></span>
                <?php } ?>
                <?php if($this->session->flashdata('failear_msg')){ ?>
                    <div class="alert alert-error alert-dismissible fade in">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <strong><?php echo $this->session->flashdata('failear_msg'); ?></strong>
                                </div>
                <?php } ?>
                 <?php echo $this->session->flashdata('success_msg'); ?>
                 <?php if(isset($success_msg)){ 
				 echo '<div class="alert alert-success alert-dismissible fade in">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>';
				 echo $success_msg; 
				 echo '</strong></div>'; 
				 } 
				 ?>
                    <p>
                        <label for="user_login">Username<br />
                            <?php 
                                $data = array(
                                          'name'        => 'username',
                                          'id'          => 'username',
                                          'value'       => '',
                                          'maxlength'   => '150',
                                          'size'        => '50',
                                          'class'       => 'input',
                                          'placeholder' => 'Enter Username/Email'
                                        );                      
                                //echo form_input('username', '', 'class="form-control"', 'placeholder="User ID"');
                                echo form_input($data);
                             ?>


                            </label>
                    </p>
                    <p>
                        <label for="user_pass">Password<br />
                            
                            <?php 
                                $data2 = array(
                                          'name'        => 'password',
                                          'id'          => 'password',
                                          'value'       => '',
                                          'maxlength'   => '100',
                                          'size'        => '50',
                                          'class'       => 'input',
                                          'placeholder' => 'Enter Password'
                                        );
                                 echo form_password($data2); 
                            ?>


                            </label>
                    </p>                    
                    <p class="submit">                                               
                        <?php echo form_submit('submit', 'Login', 'class="btn btn-orange btn-block"', 'value="Sign In"'); ?>
                    </p>
                </form>

                <p id="nav">
                    <!--<a class="pull-left" href="#" title="Password Lost and Found">Forgot password?</a>-->
                    <!-- <a class="pull-right" href="ui-register.html" title="Sign Up">Sign Up</a> -->
                </p>


            </div>
        </div>


        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


        <!-- CORE JS FRAMEWORK - START --> 
        <script src="<?php echo base_url(); ?>/assets/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/js/jquery.easing.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
        <script src="<?php echo base_url(); ?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
        <!-- CORE JS FRAMEWORK - END --> 


        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <script src="<?php echo base_url(); ?>/assets/plugins/icheck/icheck.min.js" type="text/javascript"></script>
        
        <!--<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script> 
		<script src="assets/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/js/form-validation.js" type="text/javascript"></script>-->
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE TEMPLATE JS - START --> 
        <script src="<?php echo base_url(); ?>/assets/js/scripts.js" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS - END --> 

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url(); ?>/assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/assets/js/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 



        <!-- General section box modal start -->
        <div class="modal" id="section-settings" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
            <div class="modal-dialog animated bounceInDown">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Section Settings</h4>
                    </div>
                    <div class="modal-body">

                        Body goes here...

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-success" type="button">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->
    </body>

</html>
<?php
//include("include/footer.php");
?>