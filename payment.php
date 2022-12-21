<?php
session_start();
if(!isset($_SESSION['id']))header('Location: ./login.php?extra="pm"');
$uid = $_SESSION['id'];
		
require 'connections/settings.php';
require 'connections/dbh.php';

if(isset($_POST['state']) && isset($_POST['fname'])){
	
	$fname = $_POST['fname'];
	$address = $_POST['address'];
	$city = trim($_POST['city']);
	$state = trim($_POST['state']);
	$zip = trim($_POST['zip']);	
	$email = $_POST['email'];
	
	$billing_address = $address.', '.$city.', '.$state.', '.$zip;
	
	$carts = $_SESSION['carts'];
	$m_ids = array();
	foreach($carts as $key => $vals)
		$m_ids[] = $key;
		
	$pdo = new mypdo();
	$menus = $pdo->get_menus("SELECT * FROM menus WHERE id IN (".implode(',', $m_ids). " )");
	
	$amount = 0;
	foreach($menus as $menu){
		$amount += ($menu['price'] *  $carts[$menu['id']]);
	}
	
	// Tax inclusion
	$amount = $amount + ($amount * 6/100); 
	
	$order_id = $pdo->new_order($uid, $fname, $email,  $billing_address,  $amount,  date('Y-m-d H:i:s'));
	
	foreach($carts as $key => $vals)
		$pdo->new_order_items($order_id, $key, $vals);
		
	unset($_SESSION['carts']);
	
	header('Location: completed_order.php');
	
}




if(isset($_SESSION['carts']))
	$carts = $_SESSION['carts'];
else
	$carts = array();
$m_ids = array();

foreach($carts as $key => $vals)
	$m_ids[] = $key;
	
if(count($m_ids) != 0){
	$pdo = new mypdo();
	$menus = $pdo->get_menus("SELECT * FROM menus WHERE id IN (".implode(',', $m_ids). " )");


}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Check Out | British Polo</title>
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    </head>
    <body>
       	
		<header class="max-width">
            <br></br><br></br><br>
            <nav>
                <a href="" class="logo"><img src="image/logo.png" ></img> </a>
                
            <ul>
                 <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Shop</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="aboutus.php">About</a></li>
                <li><a href="review.php">Review</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-cart" aria-hidden="true"></i> <?php echo (@count($_SESSION['carts']) != 0)? '<b class="cart_cnt">'. @count($_SESSION['carts']). '</b>' : ''; ?></a></li>
                 <?php 
				if(isset($_SESSION['id'])) { ?>
                 <li><a class="user_name" href="orders.php">  <?php echo $_SESSION['username']; ?>  | Orders</a></li>
                 <li><a href="logout.php">Logout</a></li>
				<?php } ?>
            </ul>
        </nav>
        </header>

        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
       
        <br></br><br></br><br><br><br>
        <!--<div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    CHECK OUT</h2>
                <div class="border"></div>
            </div>
        </div>-->
        
        <div class="row-checkout">
            <div class="col-75">
              <div class="container"><br>
                <form action="" method="post">

                  <div class="row-checkout">
                    <div class="col-50">
                      <h3>Billing Address</h3><br>
                      <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                      <input type="text" id="fname" name="fname" placeholder="Full Name" required pattern="[a-zA-Z0-9 ]{4,}">
                      <label for="email"><i class="fa fa-envelope"></i> Email</label>
                      <input type="text" id="email" name="email" placeholder="email@gmail.com">
                      <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                      <input type="text" id="adr" name="address" placeholder="Street Address" required>
                      <label for="city"><i class="fa fa-institution"></i> City</label>
                      <input type="text" id="city" name="city" placeholder="Shah Alam" required>

                      <div class="row-checkout">
                        <div class="col-50">
                          <label for="state">&nbsp;State</label>
                          <input type="text" id="state" name="state" placeholder="Selangor" required>
                        </div>
                        <div class="col-50">
                          <label for="zip">&nbsp;Zip Code</label>
                          <input type="text" id="zip" name="zip" placeholder="40400" required>
                        </div>
                      </div>
                    </div>

                    <div class="col-50">
                      <h3>Payment</h3><br>
                      <label for="fname">Accepted Cards</label>
                      <div class="icon-container">
                        <i class="fab fa-cc-visa" style="color:navy;"></i>
                        <i class="fab fa-cc-paypal" style="color:blue;"></i>
                        <i class="fab fa-cc-apple-pay" style="color:red;"></i>
                        <i class="fab fa-cc-amazon-pay" style="color:orange;"></i>
						<i class="fab fa-cc-mastercard" style="color:orange;"></i>
                      </div>
                      <label for="cname">Name on Card</label>
                      <input type="text" id="cname" name="cardname" placeholder="Sri Vishnu Parthipan" required pattern="[a-zA-Z0-9 ]{4,}">
                      <label for="ccnum">Credit card number</label>
                      <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required pattern="[0-9-]{12,}">
                      <div class="row-checkout">
                      <div class="col-30">
                       <label for="expmonth">&nbsp;Exp Month</label>
                      <select required style="width:100px; height:40px; ">
                          	<option></option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                          </select>
                        </div>
                        <div class="col-30" style="margin:0px 5px;">
                          <label for="expyear">&nbsp;Exp Year</label>
                          <select required style="width:100px; height:40px; ">
                          	<option></option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                          </select>
                        </div>
                        <div class="col-30">
                          <label for="cvv">&nbsp;&nbsp;&nbsp;CVV</label>
                          <input type="text" id="cvv" name="cvv" placeholder="***" required pattern="[0-9]{2,3}" style="max-width:100px">
                        </div>
                      </div>
                    </div>

                  </div>
                  <div style="text-align:center">
                  <input type="submit" value="Proceed Checkout" class="btn" style="max-width:250px;">
                 </div>
                </form>
              </div>
            </div>
            <div class="col-25">
              <div class="container">
				<center><h4>CART &nbsp;<i class="fa fa-shopping-cart"></i></h4><br></center>
                <table style="border-collapse:collapse">
                <tr>
                    <th>Items</th>
                    <th>Subtotal</th>
                </tr>
                <?php 
				$sub_total = 0.00;
				foreach($menus as $menu){ 
				 	
					$sub_price =  $menu['price'] * $carts[$menu['id']];
					$sub_total += $sub_price;
				?>
                <tr>
                    <td style="border:1px solid #FFF">
                 		<?php echo $menu['name']; ?>
                    </td>
                    <td style="border:1px solid #FFF" class="sub_price">RM <?php echo number_format($sub_price, 2); ?></td>
                </tr>
                <?php } 
				
				$total_tax = $sub_total *  6 / 100;
				$all_total = $total_tax + $sub_total;
				?>
                <tr>
                    <td style="border:1px solid #FFF">
                 		Tax (6 %):
                    </td>
                    <td style="border:1px solid #FFF">RM <?php echo number_format($total_tax, 2); ?></td>
                </tr>
                <tr>
                    <td style="border:2px solid #000; font-weight:bold; padding-top:15px;">
                 		TOTAL :
                    </td>
                    <td style="border:2px solid #000; font-weight:bold; padding-top:15px;">RM <?php echo number_format($all_total, 2); ?></td>
                </tr>
                
            </table>
                </hr>
              </div>
            </div>
          </div>
        <br></br><br>
        
		<footer>
            <div class="row">
                
              <div class="column">
                    <h2>Contact Us</h2><br>
                  <p><i class="fas fa-phone"></i>&nbsp;013-5440903</p><br>
                  <p><i class="fas fa-envelope"></i> &nbsp;britishpolo.official@gmail.com</p><br>
                  <p><i class="fas fa-map-marker-alt"></i> &nbsp;No.11, Jalan Permata 2/KS9,Taman Perindustrian,</p>
                  <p>&nbsp;&nbsp;&nbsp;41200, Klang, Selangor,Malaysia.</p>
                </div>
			  
              <div class="column3" style="text-align: center;">
                <p>
                  <?php 
				if(!isset($_SESSION['id'])) { ?>
                </p>
                <p>&nbsp; </p>
                    <h2 style="font-size: 18px">Login Account</h2><form action="./login.php" method="post">
                        <input type="text" placeholder="Username" name="username">
                        <input type="password" placeholder="Password" name="password"><input type="hidden"  name="login" value="n">&nbsp;
                        <button type="submit">Login</button>
                    </form>
                        
                     <h3>Not a member yet?</h3><br>
                    <div class="signup">
                        <a href="signup.php" style="width:auto; display: block;">Sign Up</a>
                    </div> <br>
                  <?php } else { ?>
                    
                    <br></br><p style="text-align:center"><i>You are  logged  in</i></p><br></br><br></br></br><br></br>
                    
                <?php } ?>                   
                </div>                
            </div>
                <b>&copy; Copyrights British Polo 2021. All Rights Reserved.<br>Powered By HackerBoyz.</p></b>
        </footer>

    </h:body>
</html>

