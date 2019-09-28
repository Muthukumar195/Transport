
        <!-- CORE JS FRAMEWORK - START --> 
        <script src="<?php echo base_url(); ?>/assets/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/js/jquery.easing.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
        <script src="<?php echo base_url(); ?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
        <!-- CORE JS FRAMEWORK - END --> 
        
        <!-- Image POPUP - START --> 
         <script src="<?php echo base_url(); ?>/assets/plugins/prettyphoto/jquery.prettyPhoto.js" type="text/javascript"></script>
      <!--  Image POPUP - END --> 
      
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <script src="<?php echo base_url(); ?>/assets/plugins/autosize/autosize.min.js" type="text/javascript"></script>
        
        <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script> 
		<script src="assets/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/js/form-validation.js" type="text/javascript"></script>
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->
        
         <!-- OTHER SCRIPTS INCLUDED DATA TABLE ON THIS PAGE - START --> 
        <script src="<?php echo base_url(); ?>/assets/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>        
		<script src="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>        <!-- OTHER SCRIPTS INCLUDED DATA TABLE ON THIS PAGE - END --> 
 
        
        <!-- CORE TEMPLATE JS - START --> 
        <script src="<?php echo base_url(); ?>/assets/js/scripts.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/responsive-tables/js/rwd-table.min.js" type="text/javascript"></script>
        <!-- END CORE TEMPLATE JS - END --> 
        
         <!-- Date Picker --> 
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> 
		<script src="<?php echo base_url(); ?>/assets/js/moment.min.js" type="text/javascript"></script>
        <!-- END Date Picker - END -->
         
        <!-- END Multi select box - END -->
        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url(); ?>/assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/assets/js/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 
        <!-- Sidebar Graph - END --> 
		
		<script src="<?php echo base_url(); ?>/assets/js/common.js" type="text/javascript"></script>
		<script>
		$(document).on('click', '.selectedAction', function(){
			var type = $(this).data('type'); 
			var selected = [];
			$.each($("input[name='selected_list']:checked"), function(){            
				selected.push($(this).val());
			});
			
			
			if(selected == ""){
				alert('Please selete the list item');	
			}else{
				if(type == "delete"){
					window.location.href = "delete?ids="+selected;
				}else{			
					window.location.href = "status?status="+type+"&ids="+selected;
				}	
			}
		 
		});
		</script>
		
        
       
       
    </body>

</html>
