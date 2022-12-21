<?php
session_start();

require 'connections/settings.php';
require 'connections/dbh.php';

$pdo = new mypdo();

$menus =  $pdo->get_menus("SELECT * FROM menus  ORDER BY id"); 

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html"
      xmlns:c="http://xmlns.jcp.org/jsp/jstl/core"
      xmlns:f="http://xmlns.jcp.org/jsf/core">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"></link>
        <script src="script.js" type="text/javascript"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Briitish Polo</title>
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
        
        
        <div class="title" id="title">
            <div class="max-width">
                <h1 class="title" style="color: #007aff; font-family: Roboto; font-weight: 800">
                   British Polo Handbags</h1>
				<p style="margin-top: -15px; color: slategrey"><i>It is designed for wonder women.</i></p>
                <div class="border"></div>
            </div>
        </div>
        <br></br>
        
        <section class="section-menu">
            <div class="container-menu"> 
                <main>
                
                <?php foreach($menus as $menu){  ?>
                <div class="card" id="menu_<?php echo $menu['id']; ?>">
                    <img src="image/<?php echo $menu['image_url']; ?>"></img>                  
                    <div class="blogcontent"><br></br>
                        <h3><?php echo $menu['name']; ?></h3>
                        <p class="price">RM <?php echo $menu['price']; ?></p><br>
                        <p class="desc"><?php echo $menu['desc_n']; ?></p>
                        <?php if(isset($_SESSION['carts'][$menu["id"]])){ ?>
					 		<a href="cart.php" class="added"><small><?php echo $_SESSION['carts'][$menu["id"]]; ?> item(s) added.</small>  Checkout Now</a>
						 <?php } else{ ?>
                         	<form action="connections/main.php" method="post"><input type="hidden" name="ch" value="add_cart"><input type="hidden" name="link" value="menu.php"><input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>"><button class="btn btn_n"> Add to Cart</button></form>
                          <?php } ?>
                        
                        
                         
                    </div>
                </div>
                <?php }  ?>
                
                </main>
            </div>
            </div>
        </section>
        
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

