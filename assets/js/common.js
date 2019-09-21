 function sendGetRequest(url, callback){
	$.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        cache:false,
        success: function(response) {
			if(response.key == 'reload'){
				$("#early_logout").append(response.message);
				$("#early_logout").remove(response.status);
			}
            callback(response);
        }
    });
}


function sendFormPostRequest(e, url, data, callback){
        // var btn_text = e.target.textContent;
	// e.target.textContent = "Please wait...";
	
	// console.log(data);
	
	e.target.disabled = true;
       
	$(".err").text("");
	$.ajax({
		type: 'POST',
        url: url,
        data: data,
        cache: false,
        contentType: false,
        // processData: false,
        dataType: 'text',
//        contentType: "application/json",
        success: function(response) {
            if(response.status == false){
                $(".err").show();
                if(response.errors){
                    $.each(response.errors,function(key,message){
                        $(e.target).closest("form").find("#"+key+"_error").text(message);
                        
                        if(key.indexOf("]") != -1){
                                    
                            $(e.target).closest("form").find("span[data-error_id='"+key+"_error']").text(message);
                        }
                        
                    })
                }else{
				showMessage("failed",response.message);
                }
            }
            e.target.disabled = false;	
            callback(response);  
        }
    });
}

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