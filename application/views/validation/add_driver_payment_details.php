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
		
		jQuery("#driver_name").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please select Driver Name"
	});
	jQuery("#driver_name_list").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please select Movement Date"
	});
	jQuery("#pay_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select Pay Date "
	});
	jQuery("#driver_pay_status").validate({
	expression: "if (isChecked(SelfID)) return true; else return false;",
	message: "Please Select Driver Pay Status "
	});
	jQuery("#driver_advance").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select Daily Movement Date"
	});
	jQuery("#other_expences").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter Other Expences "
	});
	jQuery("#driver_total").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select Daily Movement Date"
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