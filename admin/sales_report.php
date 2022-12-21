<?php
session_start();

if(!isset($_SESSION['aid']))header('Location: ./');

require '../connections/settings.php';
require '../connections/dbh.php';




$pdo = new mypdo();

$fdate = '';
$tdate = '';

if(isset($_GET['fdate']) && $_GET['fdate'] != '') 
	$fdate = date('Y-m-d', strtotime($_GET['fdate']));

if(isset($_GET['tdate']) && $_GET['tdate'] != '') 
	$tdate = date('Y-m-d', strtotime($_GET['tdate']));


if($fdate != '' && $tdate == ''){
	$orders = $pdo->get_all("SELECT a.*, b.email as cemail FROM orders a LEFT JOIN users b ON a.user_id = b.user_id WHERE DATE(`date`) = '$fdate' ORDER BY order_id DESC");
}
elseif($tdate != '' && $fdate == ''){
	$orders = $pdo->get_all("SELECT a.*, b.email as cemail FROM orders a LEFT JOIN users b ON a.user_id = b.user_id WHERE DATE(`date`) = '$tdate' ORDER BY order_id DESC");

}
elseif($fdate != '' && $tdate != ''){
	
	if($fdate > $tdate){
		$fdate_x = $fdate;
		$fdate = $tdate;
		$tdate = $fdate_x;	
	}
	$orders = $pdo->get_all("SELECT a.*, b.email as cemail FROM orders a LEFT JOIN users b ON a.user_id = b.user_id WHERE DATE(`date`) between '$fdate' AND '$tdate' ORDER BY order_id DESC");
}
else{
	$orders = $pdo->get_all("SELECT a.*, b.email as cemail FROM orders a LEFT JOIN users b ON a.user_id = b.user_id ORDER BY order_id DESC");
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html"
      xmlns:c="http://xmlns.jcp.org/jsp/jstl/core"
      xmlns:f="http://xmlns.jcp.org/jsf/core">
    <head>
        <link rel="stylesheet" type="text/css" href="../style.css"></link>
        <script src="../script.js" type="text/javascript"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Sales Report | British Polo</title>
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
       
        <br></br><br></br><br>
        
        
        <div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    Sales Report</h2>
                <div class="searc_area"><form method="get" action=""><b>From Date: </b><input type="date" name="fdate" value="<?php echo @$fdate; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;   <b>To Date:</b> <input type="date" name="tdate" value="<?php echo @$tdate; ?>" /> &nbsp;&nbsp; <button class="submit_admin"><b> Submit</b></button></form></div>
            </div>
        </div><br>
        <section class="section-menu">
            <div class="container-menu" style="min-height:370px"> 
                
                
            <?php if(count($orders) > 0){ ?>
            <table class="table_m">
                <tr>
                    <th>Order ID</th>
                    <th>Customer Email</th>
                    <th>Full Name</th>
                    <!--<th>Email</th>-->
                    <th>Billing address</th>
                    <th>Sub Total</th>
                    <th>Tax (6%)</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                </tr>
                <?php 
				
				$all_total = 0;
				$all_subtotal = 0;
				$all_tax = 0;
					
				foreach($orders as $order){
					
					$subtotal =  $order['amount'] * 100 / 105;
					$tax = 5 * $subtotal / 100;
					
					$all_total += $order['amount'];
					$all_subtotal += $subtotal;
					$all_tax += $tax;
				?>
                <tr>
                    <td style="white-space: nowrap;">
                    <?php echo $order['order_id']; ?><br><br>
                    <a  style="background-color:#007aff; color:#FFF; padding:5px; display:inline-block" href="order.php?order_id=<?php echo $order['order_id']; ?>">View Menu items</a></td>
                    <td><?php echo $order['cemail']; ?></td>
                    <td><?php echo $order['fname']; ?></td>
                    <!--<td><?php echo $order['email']; ?></td>-->
                    <td>
                    <?php echo $order['billing_details']; ?>
                    </td>
                    <td style="white-space: nowrap">RM <?php echo(round($subtotal,2)); ?></td>
                    <td style="white-space: nowrap">RM <?php echo (round($tax,2)); ?></td>
                    <td style="white-space: nowrap">RM <?php echo $order['amount']; ?></td>
                    <td align="center"><?php echo $order['date']; ?></td>
                </tr>
                <?php } 
				?>
                <tr style="font-weight:bold; background-color:#F9F9F9">
                	<td colspan="4"> Total: </td>
                    <td style="white-space: nowrap; padding-top:20px;">RM <?php echo (round($all_subtotal,2)); ?></td>
                    <td style="white-space: nowrap; padding-top:20px;">RM <?php echo (round($all_tax,2)); ?></td>
                    <td style="white-space: nowrap; padding-top:20px;">RM <?php echo $all_total; ?></td>
                    <td></td>
                
                </tr>
                
            </table>
        
         <?php } else{?>
         
         <p style="text-align:center; padding:100px 40px; font-size:24px;"> Unfortunately there is no orders to show &nbsp;<i class="fas fa-heart-broken"></i></p>
         
         <?php } ?>
                
            </div>
            </div>
        </section>
        
		<br><br><br>
        
		<footer>
        		<p style=" font-style:italic; font-size:24px; padding:10px;">Admin Page</p>
                <p>&copy; Copyrights British Polo 2021. All Rights Reserved.</p>
        </footer>
    <script src="../js/admin.js"></script>
    </body>
</html>

