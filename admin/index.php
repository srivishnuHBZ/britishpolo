<?php
session_start();



require '../connections/settings.php';


$log_error = '';

$active_det = '';

if(isset($_POST['login'])){
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($password == 'admin123' && $username == 'Admin'){
		$_SESSION['aid'] = 1;
		$_SESSION['ausername'] = 'Admin';
		header('Location: index.php');
		exit();
	}
	else{
		
		$log_error = "Please enter a valid Login details";
		}

		
	 
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
        <title>Home | British Polo</title>
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
        
    </head>
    <body background="../image/cover.jpg">
        <header class="max-width">
			<br><br><br><br><br>
            <nav>
                <a href="../index.php" class="logo"><img src="../image/logo.png" width="50" height="50"></img> </a>
                
            <ul>
               <?php if(!isset($_SESSION['aid'])){ ?><li><a href="index.php"></a></li>
                
                <?php }else{ ?>
                
                 <li><a href="index.php">Home</a></li>
                <li><a href="contact_messages.php">Contact Messages</a></li>
                <li><a href="sales_report.php">Sales Report</a></li>
                <li><a href="menu.php">Items</a></li>
                <li><a class="user_name"> <?php echo $_SESSION['ausername']; ?></a></li>
                 <li><a href="logout.php">Logout</a></li>
                
				<?php } ?></ul>
        </nav>
        </header>
        <script type="text/javascript">
            window.addEventListener("scroll", function(){var header = document.querySelector("header");header.classList.toggle("sticky", window.scrollY > 0);})
        </script>
       
        <br></br><br></br><br>
        
        
        <div class="title" id="title">
           <?php if(!isset($_SESSION['aid'])){ ?>
           <div class="max-width">
                <h2 class="title" style="font-size: 40px; color: whitesmoke">
                   Admin Login
                </h2>
                <div class="border"></div>
            </div>
            <?php } ?>
        </div>
        <br>
        
        <section class="section-menu">
            <div class="container-menu"> 
            <?php
           if(!isset($_SESSION['aid'])){ ?>
            <p class="msg_error"><?php echo $log_error; ?></p>
                <form method="post" action="">
                <div class="my_form1">
                    <div>
                        <label style="color: whitesmoke; font-size: 17px;">Username</label><br><br>
                        <input type="hidden" name="login" value="m" />
                        <input required minlength="3" name="username" value="<?php echo @$username; ?>" />
                    </div>
                    <div>
                        <label style="color: whitesmoke; font-size: 17px;">Password</label><br><br>
                        <input type="password" required  name="password" />
                    </div>
                    <div>
                        <button class="btn" style="font-family: Lucida Bright; font-size: 20px; font-weight: bold; "> Login </button>
                    </div>
                </div>
                </form>
              
            <?php }
				else{
			?>
         		
				<p style="text-align:center; font-size:40px;; padding:140px; color:whitesmoke">WELCOME TO BRITISH POLO<br><br><small><small><i>You are logged in</i></small></small></p><br><br><br><br><br>       
            
            <?php 
				}
			?>
              
              </div>
                
                
                                
            </div>
            </div>
        </section>
        
        <footer>
        		<p style=" font-style:italic; font-size:24px; padding:10px;">Admin Page</p>
                <p>&copy; Copyrights British Polo 2021. All Rights Reserved.</p>
        </footer>
    <script src="js/main.js"></script>
    </body>
</html>

