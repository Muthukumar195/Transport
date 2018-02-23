<!-- start jquery validation -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery.validate.css" />
<script src="<?php echo base_url(); ?>/assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/assets/js/jquery.validate.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>/assets/js/jquery.validation.functions.js" type="text/javascript">
</script>
<script type="text/javascript">
/* <![CDATA[ */
//alert($('input[name=container_feet]:checked').val());
jQuery(function(){
	
	jQuery("#iso_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Choose a ISO Date"
	});
	jQuery("#transport_vehicle_type").validate({
	expression: "if (isChecked(SelfID)) return true; else return false;",
	message: "Please Select a Transport Type"
	});
    jQuery("#container_feet_size").validate({
    expression: "if (isChecked(SelfID)) return true; else return false;",
    message: "Please Click a Container Size"
	});
	jQuery("#ey_lo_type").validate({
    expression: "if (isChecked(SelfID)) return true; else return false;",
    message: "Please Click a Ey/Lo Type"
	});
	jQuery("#im_ex_type").validate({
    expression: "if (isChecked(SelfID)) return true; else return false;",
    message: "Please Click a Load Type"
	});
	jQuery("#container_f").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Container Number"
	});
	/*jQuery("#pick_up").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Pickup Place"
	});
	jQuery("#drop").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Drop Place"
	});*//*
	jQuery("#loading_status").validate({
    expression: "if (isChecked(SelfID)) return true; else return false;",
    message: "Please select loading status"
	});
	jQuery("#iso_from").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a ISO From"
	});
	jQuery("#iso_to").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a ISO To"
	});
	jQuery("#load_drop").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Drop"
	});*/
	
	jQuery("#tp_amount").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Transport Amount"
	});
	jQuery("#iso_amount").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Iso Amount"
	});
	jQuery("#paid_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Choose a Paid Date"
	});
	
	
				
});		

function checkInt(obj)
{
	if(obj.value*1 - obj.value*1!=0)
		{obj.value="";}
	
	if(obj.value.indexOf(" ",0)!=-1)
		{
		obj.value="";
		alert ("No Spaces Allowed");	
		obj.focus();
		obj.value="";
		}
}

	
// start fullname exist or not
/* $("#full_name").change(function() 
			{ //if theres a change in the username textbox
			if(document.getElementById('full_name').value=='')
			{
				$("#full_name_status").html('');
			}
			var full_name = $("#full_name").val();//Get the value in the email textbox
			if(full_name.length > 3)//if the lenght greater than 3 characters
			{ 
			$("#full_name_status").html('<img src="<?php //echo base_url(); ?>/assets/images/loader.gif" align="absmiddle">&nbsp;Checking availability...');
			//Add a loading image in the span id="availability_status"			
			
			
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "<?php //echo base_url(); ?>index.php/driver_details/ajax_check_full_name",  
				data: "full_name="+ full_name,  //data
				success: function(server_response1)
				{				    
				    $("#full_name_status").ajaxComplete(function(event, request)
				    { 			
						if(server_response1==0)//if ajax_check_username.php return value "0"
						{  
						$("#full_name_status").html('<img src="<?php  //echo base_url(); ?>/assets/images/available.png" align="absmiddle"> <font color="Green"> Available </font>  ');
						//add this image to the span with id "availability_status"
						}  
						else  if(server_response1==1)//if it returns "1"
						{   
						 $("#full_name_status").html('<img src="<?php //echo base_url(); ?>/assets/images/button_cancel.png" align="absmiddle"> <font color="red">Username Alreay Exists </font>');
						 return false;
						}  
				   
			   		});
			   } 
			   
			  }); 
			
			}			
			else
				{
					if(full_name_status == 1)
					{
						return false;
					}
					else	
					{
						return true;
					}
				}	
			
			return false;
			});
*/
// end fullname exist or not

</script>        
<!-- end jquery validation -->