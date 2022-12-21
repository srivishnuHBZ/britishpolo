<?php
session_start();

require 'connections/settings.php';
require 'connections/dbh.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"></link>
		<link rel="stylesheet" type="text/css" href="style_review.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <title>British Polo</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css"/>
   		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>

    </head>
    <body>
        
	<header class="max-width">
            <br></br><br></br><br>
            <nav>
                <a href="index.php" class="logo"><img src="image/logo.png" ></img> </a>
                
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
       
        <br><br><br><br><br><br>
        
		<section>
			<div class="container">
				<div class="section-title">
					<h2>Testimonials</h2>
					<!--<span class="section-separator"></span>--><br><br>
					<p><i>Honest Review From Our Beloved Customers</i></p>
				</div>
			</div>
			<div class="testimonials-carousel-wrap">
				<div class="listing-carousel-button listing-carousel-button-next"><i class="fa fa-caret-right" style="color: #fff"></i></div>
				<div class="listing-carousel-button listing-carousel-button-prev"><i class="fa fa-caret-left" style="color: #fff"></i></div>
				<div class="testimonials-carousel">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="testi-item">
									<div class="testi-avatar"><img src="image/marina.jpg"></div>
									<div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
									<div class="testimonials-text">
										<div class="listing-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<p>Such an adorable bag. Love it. The material is thick as well which is perfect and there’s a pocket inside to put your keys or phone in which is nice. I would definitely recommend this bag to my friends.</p><br>
										<a href="#" class="text-link"></a>
										<div class="testimonials-avatar">
											<h3>Ts. Marina Bt. Hassan</h3>
											<h4>Lecturer</h4>
										</div>
									</div>
									<div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div> 
								</div>
							</div>

							<!--second--->
							<div class="swiper-slide">
								<div class="testi-item">
									<div class="testi-avatar"><img src="image/rohaya.jpg"></div>
									<div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
									<div class="testimonials-text">
										<div class="listing-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<p>This is now the cutest bag I own! I saw how trendy they were and I knew I HAD to get it. It’s really good quality and has a lot of room for small towels, sunscreen, and anything else I take to the beach.</p><br>
										<a href="#" class="text-link"></a>
										<div class="testimonials-avatar">
											<h3>Rohaya Bt. Abu Hassan</h3>
											<h4>Lecturer</h4>
										</div>
									</div>
									<div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div> 
								</div>
							</div>
							<!--third-->

							<div class="swiper-slide">
								<div class="testi-item">
									<div class="testi-avatar"><img src="image/azaliza.jpg"></div>
									<div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
									<div class="testimonials-text">
										<div class="listing-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
										</div>
										<p>This purse from British Polo is gorgeous!!! It comes in a cloth sack. To my surprise, it also included a long strap to wear over the shoulder or even as a side bag across your chest. It’s pretty long and gives this bag so much more versatility.</p><br>
										<a href="#" class="text-link"></a>
										<div class="testimonials-avatar">
											<h3>Azaliza Bt Zainal</h3>
											<h4>Lecturer</h4>
										</div>
									</div>
									<div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div> 
								</div>
							</div>

							<!--fourth-->
							<div class="swiper-slide">
								<div class="testi-item">
									<div class="testi-avatar"><img src="image/kamsiah.jpg"></div>
									<div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
									<div class="testimonials-text">
										<div class="listing-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-half-o "></i>
										</div>
										<p>This Handbag is so bombed only thing I dislike is that when I received it, there is a small indention from the bag I guess being smooshed along the way. Other than that most definitely happy with this purchase!</p><br>
										<a href="#" class="text-link"></a>
										<div class="testimonials-avatar">
											<h3>Kamsiah Bt. Mohamed</h3>
											<h4>Lecturer</h4>
										</div>
									</div>
									<div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div> 
								</div>
							</div>
							
							<!--fifth-->
							<div class="swiper-slide">
								<div class="testi-item">
									<div class="testi-avatar"><img src="image/razia.jpg"></div>
									<div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
									<div class="testimonials-text">
										<div class="listing-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
										</div>
										<p>This purse is super cute. The stitching is great and the metal handle looks very expensive. The only downside is the clasp is a bit wiggly which lets the top flap of the bag appear slightly crooked at times.</p><br>
										<a href="#" class="text-link"></a>
										<div class="testimonials-avatar">
											<h3>Ts. Nur Razia Bt. Mohd Suradi</h3>
											<h4>Lecturer</h4>
										</div>
									</div>
									<div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div> 
								</div>
							</div>
							<!--testi end-->

						</div>
					</div>
				</div>

				<div class="tc-pagination"></div>
			</div>
		</section>



   		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
  		<script src="js/scripts.js"></script>
 
        

		
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

