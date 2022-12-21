<?php
session_start();

require 'connections/settings.php';
require 'connections/dbh.php';


if(isset($_POST['fname']) && isset($_POST['email'])){
	
	$pdo = new mypdo();
	$fname = $_POST['fname'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	$pdo->add_contact($fname, $email, $subject, $message);
	
	die(header('Location: contact.php?msg=success'));
	
}




?>






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>British Polo</title>
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

        <br></br><br></br><br><br>
        <div class="title" id="title">
            <div class="max-width">
                <h2 style="font-family: Roboto; float: left; width: 100%; text-align: center; color: #007aff; font-size: 34px; font-weight: 800; position: relative;">
                    Contact Us</h2>
				<p style="margin-top: -15px; color: slategrey"><i>Feel free to contact us anytime, We will be right back soon.</i></p>
                <div class="border"></div>
            </div>
        </div>
       
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
       
        
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'){ ?>
                	<p style="padding:10px; text-align:center; font-size:24px; color:#0C9"> Thank You for contacting us. We will get back to you as soon as possible.</p>
                <?php } ?>
        
		<div class="contact-wrap">
            <div class="contact-in">
                <h1>Contact Us</h1><br><br>
                <h2><i class="fa fa-phone" aria-hidden="true"></i>Phone</h2>
                <p>013-5440903</p><br>
                <h2><i class="fa fa-envelope" aria-hidden="true"></i>Email</h2>
                <p>britishpolo.official@gmail.com</p><br>
                <h2><i class="fa fa-map-marker" aria-hidden="true"></i>Address</h2>
                <p>No.11, Jalan Permata 2/KS9,Taman Perindustrian,41200, Klang, Selangor,Malaysia.</p>
                <ul>
                    <li><a href="https://www.facebook.com/BritishPoloOfficial/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="https://www.instagram.com/britishpolomalaysia/?hl=en"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            
            <div class="contact-in">
            	<h1>Leave Your Message Here!</h1><br>
                <form method="post" action="">
                    <input type="text" placeholder="Full Name" name="fname" required minlength="3" class="contact-in-input"></input>
                    <input type="text" placeholder="E-mail" name="email"  minlength="6" class="contact-in-input"></input>
                    <input type="text" placeholder="Subject" name="subject" required minlength="3" class="contact-in-input"></input>
                    <textarea placeholder="Message" class="contact-in-textarea" required minlength="3" name="message"></textarea>
                    <input type="submit" value="SUBMIT" class="contact-in-btn"></input>
                </form>
            </div>
            <div class="contact-in">
                
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254992.48255374582!2d101.40483995352893!3d3.025376284837616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4c879f694a45%3A0xc7d2cd86ed8c35a0!2sPolo%20Haus!5e0!3m2!1sen!2smy!4v1627359341675!5m2!1sen!2smy" width="600" height="auto" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
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

