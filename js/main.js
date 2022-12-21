///My main functions


function set_new_price(){
	var menus = {};
	var total_sub = 0;
	var m_items = document.querySelectorAll('.menu_item');
	for(var i = 0; i < m_items.length; i++){
		var id = m_items[i].getAttribute('data-id');
		
		var price = document.querySelector("#menu_"+id + " input").getAttribute('data-price');
		var quan =  document.querySelector("#menu_"+id + " input").value;
		var sub_val = parseInt(quan) * parseFloat(price);
		total_sub += sub_val;
		document.querySelector("#menu_"+id + " .sub_price").innerHTML = 'RM '+sub_val.toFixed(2);
		menus[id] = quan;
	}
	var total_tax = 5 * total_sub / 100;
	var all_total = total_tax + total_sub;
	document.querySelector("#sub_total").innerHTML = 'RM '+total_sub.toFixed(2);
	document.querySelector("#all_total").innerHTML = 'RM '+all_total.toFixed(2);
	document.querySelector("#total_tax").innerHTML = 'RM '+total_tax.toFixed(2);
	
	var formData = new FormData(); 
    formData.append('ch', 'add_carts');
	formData.append('menus', JSON.stringify(menus));
	
	var bfr_cont = document.getElementById("process_div").innerHTML;
	document.getElementById("process_div").innerHTML = '<img src="./image/spinner.gif" style="width:1.8rem">';
	/*********************************************************************************************
****************************  AJAX    *******************************************************/	
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
		{
			document.getElementById("process_div").innerHTML = bfr_cont;
			if(xmlHttp.responseText.substr(0, 7) == 'success'){
					//
			}
			else{
				alert(xmlHttp.responseText)
			
			}
		}
	}
	xmlHttp.open("post", "connections/main.php"); 
	//xmlHttp.setRequestHeader);
	xmlHttp.send(formData); 
	
	

}


function remove_cart(event, mid){
	
	event.preventDefault();
	
	var conf = confirm('Do you want to remove this menu from cart?');
	if(!conf) return;
	
	var formData = new FormData(); 
    formData.append('ch', 'remove_cart');
	formData.append('menu_id', mid);
	
	var bfr_cont = document.getElementById("process_div").innerHTML;
	document.getElementById("process_div").innerHTML = '<img src="./image/spinner.gif" style="width:1.8rem">';
	/*********************************************************************************************
****************************  AJAX    *******************************************************/	
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
		{
			document.getElementById("process_div").innerHTML = bfr_cont;
			if(xmlHttp.responseText.substr(0, 7) == 'success'){
					document.querySelector("#menu_" + mid).remove();
					set_new_price();
			}
			else{
				alert(xmlHttp.responseText)
			
			}
		}
	}
	xmlHttp.open("post", "connections/main.php"); 
	//xmlHttp.setRequestHeader);
	xmlHttp.send(formData); 
	
	

}

