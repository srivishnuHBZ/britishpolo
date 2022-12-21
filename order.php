<?php
session_start();
if(!isset($_SESSION['id']))header('Location: ./login.php');
$uid = $_SESSION['id'];
		
require 'connections/settings.php';
require 'connections/dbh.php';


if(!isset($_REQUEST['order_id']))header('Location: ./orders.php');
$oid = $_REQUEST['order_id'];

	
$pdo = new mypdo();
$menus = $pdo->get_menus("SELECT a.*, b.* FROM order_items a LEFT JOIN menus b ON a.menu_id = b.id WHERE a.order_id = ".$oid);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Order (<?php echo $oid; ?>) - British Polo</title>
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
       
        <br></br><br></br><br></br><br>
        
        <!----------------------------------------------------------------- Page title------------------------------------------------------------------>
        <div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    ORDER - <?php echo $oid; ?>
                </h2>               
            </div>
        </div>
        
        <!----------------------------------------------------------------- Cart item------------------------------------------------------------------>
       
        <div class="small-container cart-page">
            <table>
                <tr>
                    <th>Item(s)</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php 
				$sub_total = 0.00;
				foreach($menus as $menu){ 
				 	
					$sub_price =  $menu['price'] * $menu['quantity'];
					$sub_total += $sub_price;
				?>
                <tr class="product_item">
                    <td>
                        <div class="cart-info">
                            <img src="image/<?php echo $menu['image_url']; ?>">
                            <div>
                            <p><?php echo $menu['name']; ?></p>
                            <small>Price: RM <?php echo $menu['price']; ?></small>
                            <br><br>
                            </div>
                        </div>
                    </td>
                    <td>RM <?php echo $menu['price']; ?></td>
                    <td><?php echo $menu['quantity']; ?></td>
                    <td>RM <?php echo number_format($sub_price, 2); ?></td>
                </tr>
                <?php } 
				
				$total_tax = $sub_total *  6 / 100;
				$all_total = $total_tax + $sub_total;
				?>
                
            </table>
        </div>
       
        <!----------------------------------------------------------------- Cart billing------------------------------------------------------------------>
        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>RM <?php echo  number_format($sub_total, 2); ?></td>
                </tr>
                <tr>
                    <td>Tax <small> (6 %) </small></td>
                    <td>RM <?php echo number_format($total_tax, 2); ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><b>RM <?php echo number_format($all_total, 2); ?></b></td>
                </tr>
            </table>
        </div>
         
        <br></br><br></br><br></br>
       
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

        <script src="js/main.js"></script>
    </body>
</html>

