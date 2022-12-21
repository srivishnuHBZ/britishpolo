<?php
session_start();

require 'connections/settings.php';
require 'connections/dbh.php';


$pdo = new mypdo();

$menus =  $pdo->get_menus("SELECT * FROM menus   ORDER BY class DESC LIMIT 3"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"></link>
		<link rel="stylesheet" type="text/css" href="wrapper.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>British Polo Malaysia</title>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
     	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
		<link rel="shortcut icon" type="image/jpg" href="image/logo.png"/>
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
        
        <br>    
                    
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
        <br></br><br></br>
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-btn" id="radio1"></input>
                <input type="radio" name="radio-btn" id="radio2"></input>
                <input type="radio" name="radio-btn" id="radio3"></input>
                <input type="radio" name="radio-btn" id="radio4"></input>
                
                <div class="slide first">
                    <img src="image/banner1.png" alt=""></img>
                </div>
                <div class="slide">
                    <img src="image/banner2.png" alt=""></img>
                </div>
                <div class="slide">
                    <img src="image/banner3.png" alt=""></img>                   
                </div>
                <div class="slide">
                    <img src="image/banner4.png" alt=""></img>                  
                </div>
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
            </div>
        
            <div class="navigation-manual" align="center">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
        </div>
        <br></br>
        <script type="text/javascript">
            var counter = 1;
            setInterval(function(){
                document.getElementById('radio' + counter).checked = true;
                counter++;
                if(counter > 4){
                    counter = 1;
                }
            }, 5000);
            </script>
        
        <br>
        <div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    NEW ARRIVALS</h2>
                <div class="border"></div>
            </div>
        </div>
        <section class="section-best">
            <div class="container-best"> 
                <main class="best">
                
                <?php foreach($menus as $menu){  ?>
                <div class="card" id="menu_<?php echo $menu['id']; ?>">
                    <img src="image/<?php echo $menu['image_url']; ?>"></img>                  
                    <div class="blogcontent"><br></br>
                        <h4><?php echo $menu['name']; ?></h4>
                        <p class="price">RM <?php echo $menu['price']; ?></p><br>
                        <p class="desc"><?php echo $menu['desc_n']; ?></p>
                        <?php if(isset($_SESSION['carts'][$menu["id"]])){ ?>
					 		<a href="cart.php" class="added"><small><?php echo $_SESSION['carts'][$menu["id"]]; ?> item(s) added.</small>  Checkout Now</a>
						 <?php } else{ ?>
                         	<form action="connections/main.php" method="post"><input type="hidden" name="ch" value="add_cart"><input type="hidden" name="link" value="index.php"><input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>"><button class="btn btn_n"> Add to cart</button></form>
                          <?php } ?>
                        
                        
                         
                    </div>
                </div>
                <?php }  ?>
                
                </main>
            </div>    
            </section>
			
        
            <section id="mission">
            <div class="container">
            <div class="row">
            <div class="col-md-6">
			<h2>ABOUT US</h2>
            <div class="border"></div><br>
				<div class="mission-content">Tracey Star Sdn. Bhd. (TSSB) was established in year 2008, a ladies handbag retailer in consignment business model with a household name of Tracey Star. Established licensed distributor of household names (British Polo, Lancaster Polo, Hilly, ect) in Malaysia since 2010.With Active operator of 90 handbag counters at Large Departmental Stores (Parkson, Sogo, Pacific Dept Store, The Store, Tangs etc.). Since then, Tracey Star, British Polo and Lancaster Polo quickly become a household name in the market, achieved a staggering of 1,500,000 handbags being sold in a span of 12 years.</div>
			</div>
			
                <br></br><br><br><br>
				
                <div class="col-md-6">
			<h2>CREATING HIGH-QUALITY FASHION HANDBAGS</h2>
                        <div class="border"></div><br><br>
			<div class="mission-content">A brand from UK and becomes Malaysia famous leading distributor of high-quality fashion and functional premium PU leather handbag that every ladu desires.</div>
		</div>
            </div>
            </div>
            </section>

<!-----wrapper------>
<div class="wrapper">
         <div class="carousel owl-carousel">
            <div class="card card-1" style="object-fit: cover; width: 100%; height: 300px;">
               <img src="image/menu_1627984933.png">
            </div>
            <div class="card card-2" style="object-fit: cover; width: 100%; height: 300px;">
               <img src="image/menu_1627984725.jpg">
            </div>
            <div class="card card-3" style="object-fit: cover; width: 100%; height: 300px;">
               <img src="image/menu_1627985071.jpg">
            </div>
            <div class="card card-4" style="object-fit: cover; width: 100%; height: 300px;">
               <img src="image/menu_1627983421.jpg">
            </div>
            <div class="card card-5" style="object-fit: cover; width: 100%; height: 300px;">
               <img src="image/menu_1627985239.jpg">
            </div>
         </div>
      </div>
            
<!-------------------------------footer---------------------------->            
		<footer style="font-family: Lucida Bright"> 
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
                <b>&copy; Copyrights British Polo 2021. All Rights Reserved.<br>Powered By <a href="admin/index.php">HackerBoyz</a></p></b>
        </footer>
		
<script>
         $(".carousel").owlCarousel({
           margin: 20,
           loop: true,
           autoplay: true,
           autoplayTimeout: 2000,
           autoplayHoverPause: true,
           responsive: {
             0:{
               items:1,
               nav: false
             },
             600:{
               items:2,
               nav: false
             },
             1000:{
               items:3,
               nav: false
             }
           }
         });
 </script>
 <script src="js/main.js"></script>

    </body>
</html>

