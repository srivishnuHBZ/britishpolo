<?php
session_start();
if(!isset($_SESSION['aid']))header('Location: ./');

		
require '../connections/settings.php';
require '../connections/dbh.php';


if(!isset($_REQUEST['order_id']))header('Location: ./orders.php');
$oid = $_REQUEST['order_id'];

	
$pdo = new mypdo();
$menus = $pdo->get_menus("SELECT a.*, b.* FROM order_items a LEFT JOIN menus b ON a.menu_id = b.id WHERE a.order_id = ".$oid);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="../style.css"></link>
        <script src="../script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Order (<?php echo $oid; ?>) | British Polo</title>
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    </head>
    <body>
        <header class="max-width">
            <br></br><br></br><br>
            <nav>
                <a href="index.php" class="logo"><img src="../image/logo.png" width="50" height="50"></img> </a>
                
            <ul>
               <li><a href="index.php">Home</a></li>
                <li><a href="contact_messages.php">Contact Messages</a></li>
                <li><a href="sales_report.php">Sales Report</a></li>
                <li><a href="menu.php">Items</a></li>
                <li><a class="user_name"> <?php echo $_SESSION['ausername']; ?></a></li>
                 <li><a href="logout.php">Logout</a></li>
                
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
                    <th>Menu</th>
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
                            <img src="../image/<?php echo $menu['image_url']; ?>">
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
                    <td>Total Amount</td>
                    <td><b>RM <?php echo number_format($all_total, 2); ?></b></td>
                </tr>
            </table>
        </div>
         
        <br></br><br></br><br></br>
       
        <footer>
        		<p style=" font-style:italic; font-size:24px; padding:10px;">Admin Page</p>
                <p>&copy; Copyrights British Polo 2021. All Rights Reserved.</p>
        </footer>
    <script src="../js/admin.js"></script>
    </body>
</html>

