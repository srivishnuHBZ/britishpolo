<?php
session_start(); 



///##################################################
/////      ADD CART
///####################################################

if(isset($_POST['ch']) && $_POST['ch'] == 'add_cart') {
    
	$mid = (int)$_POST['menu_id'];
	
	$link = $_POST['link'];
	
	$_SESSION['carts'][$mid] = 1;
	
	header('Location: ../'.$link.'#menu_'.$mid);
	

}

///##################################################
/////      ADD CART
///####################################################

if(isset($_POST['ch']) && $_POST['ch'] == 'add_carts') {
    
	$mids =  json_decode($_POST['menus'], true);
	
	foreach($mids as $key => $val){
		$_SESSION['carts'][$key] = $val;
	}
	
	die('success');

}



///##################################################
/////      REMOVE CART
///####################################################

elseif(isset($_POST['ch']) && $_POST['ch'] == 'remove_cart') {
    
	unset($_SESSION['carts'][$_POST['menu_id']]);
	
	die('success');

}


