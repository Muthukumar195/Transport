<!-- start jquery validation -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery.validate.css" />
<script src="<?php echo base_url(); ?>/assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/assets/js/jquery.validate.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>/assets/js/jquery.validation.functions.js" type="text/javascript">
</script>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(function(){
	//add due details validation	
	jQuery("#vehicle_number").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please enter a Vehicle Number"
	});
	jQuery("#due_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please select Due date"
	});
	jQuery("#due_amount").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter Due Amount"
	});
	jQuery("#mutual_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please select Mutual date"
	});
	jQuery("#paid_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please select Pay date"
	});
	jQuery("#due_pay_status").validate({
	 expression: "if (isChecked(SelfID)) return true; else return false;",
	message: "Please select Pay Status"
	});			
});
            /* ]]> */		
			
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


</script>        
<!-- end jquery validation -->