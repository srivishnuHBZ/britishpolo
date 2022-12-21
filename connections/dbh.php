<?php


class mypdo{
	 public $pdc = null;
	 public function __construct(){
		 $host = dbhost;
		 $db   =  dbname;
		 $user  =  dbuser;
		 $pass  =   dbpass;
		 $charset = 'utf8mb4';
		 $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		 $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false,];
		 $this->pdc = new PDO($dsn, $user, $pass, $opt);
		}
	 
	
	public function gen_qry_one($qry, $id){
		 
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $id, PDO::PARAM_INT);
         $stmt->execute();		
	}
	
	public function get_one($qry, $id){
		 
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $id, PDO::PARAM_INT);
         $stmt->execute();
		 return $stmt->fetch();		
	}
	
	public function get_all($qry){
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->execute();
		 return $stmt->fetchAll();		
	}
	
	public function new_user($email, $pwd){
		
		$qry = "INSERT INTO users(email, password)VALUES(?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $email, PDO::PARAM_STR);
		$stmt->bindParam(2, $pwd, PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount() > 0) return true; else return false;
	}
	
	
	
	public function get_user($field, $val){
		
		 $qry = "SELECT * FROM users WHERE $field = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $val, PDO::PARAM_STR);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return $stmt->fetch(); else return null;
	}
	
	
	public function check_field($field, $val){
		
		 $qry = "SELECT $field FROM users WHERE $field = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $val, PDO::PARAM_STR);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return true; else return false;
	}
	
	
	
	
	
	
	
	public function get_menus($qry){
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->execute();
		 return $stmt->fetchAll();
	}
	
	public function new_order($user_id, $fname, $email,  $billing_details,  $amount,  $date){
		
		$qry = "INSERT INTO orders(user_id, fname, email, billing_details, amount, date)VALUES(?, ?, ?, ?, ?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
		$stmt->bindParam(2, $fname, PDO::PARAM_STR);
		$stmt->bindParam(3, $email, PDO::PARAM_STR);
		$stmt->bindParam(4, $billing_details, PDO::PARAM_STR);
		$stmt->bindParam(5, $amount, PDO::PARAM_STR);
		$stmt->bindParam(6, $date, PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount() > 0) return $this->pdc->lastInsertId(); else die('Erro');
	}
	
	public function new_order_items($order_id, $mid, $quant){
		
		$qry = "INSERT INTO order_items(order_id, menu_id, quantity)VALUES(?, ?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $order_id, PDO::PARAM_INT);
		$stmt->bindParam(2, $mid, PDO::PARAM_INT);
		$stmt->bindParam(3, $quant, PDO::PARAM_INT);
		$stmt->execute();
	}
	
	
	public function add_contact($fname, $email, $subject, $message){
		
		$qry = "INSERT INTO contact(fname, email, subject, message)VALUES(?, ?, ?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $fname, PDO::PARAM_STR);
		$stmt->bindParam(2, $email, PDO::PARAM_STR);
		$stmt->bindParam(3, $subject, PDO::PARAM_STR);
		$stmt->bindParam(4, $message, PDO::PARAM_STR);
		$stmt->execute();
	
	}
	
	public function add_menu($name, $desc_n, $price, $class, $image_url){
		
		$qry = "INSERT INTO menus(name, desc_n, price, class, image_url)VALUES(?, ?, ?, ?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $name, PDO::PARAM_STR);
		$stmt->bindParam(2, $desc_n, PDO::PARAM_STR);
		$stmt->bindParam(3, $price, PDO::PARAM_STR);
		$stmt->bindParam(4, $class, PDO::PARAM_STR);
		$stmt->bindParam(5, $image_url, PDO::PARAM_STR);
		$stmt->execute();
	
	}
	
	public function update_menu($mid, $name, $desc_n, $price, $class, $image_url){
		
		$qry = "UPDATE menus SET name = ?, desc_n = ?, price = ?, class = ?, image_url = ? WHERE id = ?";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $name, PDO::PARAM_STR);
		$stmt->bindParam(2, $desc_n, PDO::PARAM_STR);
		$stmt->bindParam(3, $price, PDO::PARAM_STR);
		$stmt->bindParam(4, $class, PDO::PARAM_STR);
		$stmt->bindParam(5, $image_url, PDO::PARAM_STR);
		$stmt->bindParam(6, $mid, PDO::PARAM_INT);
		$stmt->execute();
	
	}

	
	
	
	

}
