<?php
session_start();

if(isset($_SESSION['id'])) header('Location: ./');

require 'connections/settings.php';
require 'connections/dbh.php';


$signup_error = '';

if(isset($_POST['email']) && isset($_POST['password'])){
	
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);	
	$password2 = trim($_POST['password2']);	
	
	$pdo = new mypdo();
	$check1 = $pdo->get_one("SELECT * FROM  users WHERE email = ?", $email);
	
	if($password == "" || $password != $password2){
		$signup_error = "Password not match";
	}
	
	elseif($check1 != null){
			$signup_error =  'Email already taken';
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		 $signup_error = "Please provide a valid email address";
	}
	else{
		
		$pwd = password_hash($password, PASSWORD_DEFAULT);
		$status = $pdo->new_user($email, $pwd);
		if($status){
			header("Location: signup.php?success_reg");
		}
		else{
			
			$signup_error = "Registration not successful. Database Error";
			
			}	
		
	}
	
}

$pdo = new mypdo();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:h="http://xmlns.jcp.org/jsf/html">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"></link>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
        <title>Sign Up | British Polo</title>
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
       
        <br></br><br><br>
        
        <div class="signup">
         <?php if(isset($_GET['success_reg'])) echo '<p class="reg_success">Your account has been successfully created. <br><br><a href="./login.php">Login Here</a></p>'; ?>
             <p class="msg_error"><?php echo $signup_error; ?></p>
            
          <form class="modal-content" action="" method="post">
            <div class="container">
              <h1>Sign Up</h1>
              <p>Please fill in this form to create an account.</p>
              <p>&nbsp;</p>
              <hr>
              <label for="email"><b>Email</b></label>
              <input type="text" placeholder="Enter Email" name="email" value="<?php echo @$email; ?>" required=""></input>

              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required=""></input>

              <label for="psw-repeat"><b>Repeat Password</b></label>
              <input type="password" placeholder="Repeat Password" name="password2" required=""></input>

              <label>
                  <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px; "></input> Remember me
              </label>
              </hr>

              <div class="clearfix">
                <button type="submit" class="signupbtn">Sign Up</button>
              </div>
            </div>
          </form>
        </div>
        
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
                    
                    <br></br><p style="text-align:center"><i>You  are  logged  in</i></p><br></br><br></br></br><br></br>
                    
                <?php } ?>                   
                </div>                
            </div>
                <b>&copy; Copyrights British Polo 2021. All Rights Reserved.<br>Powered By HackerBoyz.</p></b>
        </footer>

        <script src="js/main.js"></script>
    </body>
</html>

