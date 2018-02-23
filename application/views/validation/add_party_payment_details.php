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
	
	jQuery("#party_name").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Party Name"
	});			
	jQuery("#amount").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a amount"
	});	
	jQuery("#party_pay_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Date of Party Pay"
	});
	jQuery("#party_payment_status").validate({
	expression: "if (isChecked(SelfID)) return true; else return false;",
	message: "Please Select Driver Pay Status "
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
</script>        
<!-- end jquery validation -->