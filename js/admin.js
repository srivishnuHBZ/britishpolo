///My main functions


function remove_item(mid){
	
	var conf = confirm('Do you want to remove this menu Item.');
	if(!conf) return;
	
	var formData = new FormData(); 
    formData.append('ch', 'remove_item');
	formData.append('mid', mid);
	
	var cmain = document.querySelector("#menu_" + mid + " .btn_rw");
	var bfr_cont = cmain.innerHTML;
	cmain.innerHTML = '<img src="../image/spinner.gif" style="width:1.8rem">';
	/*********************************************************************************************
****************************  AJAX    *******************************************************/	
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
		{
			cmain.innerHTML = bfr_cont;
			if(xmlHttp.responseText.substr(0, 7) == 'success'){
					document.querySelector("#menu_" + mid).remove();
			}
			else{
				alert(xmlHttp.responseText)
			
			}
		}
	}
	xmlHttp.open("post", ""); 
	//xmlHttp.setRequestHeader);
	xmlHttp.send(formData); 
	
	

}

function remove_msg(mid){
	
	var conf = confirm('Do you want to remove this menu Item.');
	if(!conf) return;
	
	var formData = new FormData(); 
    formData.append('ch', 'remove_msg');
	formData.append('mid', mid);
	
	var cmain = document.querySelector("#msg_" + mid + " .btn_rw");
	var bfr_cont = cmain.innerHTML;
	cmain.innerHTML = '<img src="../image/spinner.gif" style="width:1.8rem">';
	/*********************************************************************************************
****************************  AJAX    *******************************************************/	
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
		{
			cmain.innerHTML = bfr_cont;
			if(xmlHttp.responseText.substr(0, 7) == 'success'){
					document.querySelector("#msg_" + mid).remove();
			}
			else{
				alert(xmlHttp.responseText)
			
			}
		}
	}
	xmlHttp.open("post", ""); 
	//xmlHttp.setRequestHeader);
	xmlHttp.send(formData); 
	
	

}

