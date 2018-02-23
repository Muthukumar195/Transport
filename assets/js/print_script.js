function printDiv(divID) {
	//Get the HTML of div
	var divElements = document.getElementById(divID).innerHTML;
	//Get the HTML of whole page
	var oldPage = document.body.innerHTML;

	//Reset the page's HTML with div's HTML only
	document.body.innerHTML = 
	  "<html><head><title></title></head><body>" + 
	  divElements + "</body>";

	//Print Page
	window.print();

	//Restore orignal HTML
	document.body.innerHTML = oldPage;

  
}



//start popup window
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=800,width=1200,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
// end popup window



