<?php
session_start();

if(!isset($_SESSION['aid']))header('Location: ./');

require '../connections/settings.php';
require '../connections/dbh.php';

$pdo = new mypdo();

if(isset($_POST['name']) && isset($_POST['price'])){
	$name = $_POST['name'];
	$price = $_POST['price'];
	$desc_n = $_POST['desc_n'];
	$class = $_POST['class'];
	$mid = $_POST['mid'];
	
	
	$menu = $pdo->get_one('SELECT * FROM menus WHERE id = ?', $mid);
	
	$image_url_n = $menu['image_url'];
	
	if(isset($_FILES['image']) && $_FILES['image']['size'] > 20){
	
		$image = $_FILES['image'];	
		
		$mime = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
		if(!in_array($mime, array("jpg", "jpeg", "png", "gif")))
			die(header('Location: add_menu_item.php?erro=not a valid image file'));
		
		if($image['size'] > 5206000)
			die(header('Location: add_menu_item.php?erro=Filesize is too much. Limit is 5000kb'));
		
		$image_url = 'menu_'.time().'.'.$mime;
		
		move_uploaded_file($image['tmp_name'], '../image/'.$image_url);
		
		unlink('../image/'.$image_url_n);
		
		$image_url_n = $image_url;
	}
	$pdo->update_menu($mid, $name, $desc_n, $price, $class, $image_url_n);
	
	die(header('Location: menu.php'));
	
}




if(!isset($_REQUEST['menu_id']))
	header('Location: menu.php');


$mid = $_REQUEST['menu_id'];

$menu = $pdo->get_one('SELECT * FROM menus WHERE id = ?', $mid);


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
        <title>Update Items | British Polo</title>
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    
	<style>
		.upload{
			padding: 10px;
			padding-bottom: 35px;
		}
	</style>

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
       
        <br></br><br></br><br><br>
        
        
        <div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    Update Items
                   </h2>
                <div class="border"></div>
            </div>
        </div>
        
        
        <section class="section-menu">
            <div class="container-menu"> 
            <p class="msg_error" style="padding:5px;"><?php echo @$_GET['erro']; ?></p>
                <form method="post" action="" enctype="multipart/form-data">
                <div class="my_form1">
                    <div>
                        <label>Handbag Name</label>
                        <input type="hidden" name="mid" value="<?php echo $menu['id']; ?>" />
                        <input required minlength="3" name="name"  value="<?php echo $menu['name']; ?>"/>
                    </div>
                    <div>
                        <label>Description</label>
                        <textarea required minlength="6" name="desc_n"><?php echo $menu['desc_n']; ?></textarea>
                    </div>
                    <div>
                        <label>Price</label>
                        <input type="number" step="0.01" required  name="price" value="<?php echo $menu['price']; ?>" />
                    </div>
                    <!--<div>
                        <label>Ranking (Popularity) <small> 0 - 10</small></label>
                        <select required  name="class"><option value=""></option><option selected="selected" value="<?php echo $menu['class']; ?>"><?php echo $menu['class']; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select>
                    </div>-->
					<div>
                        <label>Product Availability</label>
                        <select required  name="class"><option selected="selected" value="0">Available</option><option value="1">Out of Stock</option></select>
                    </div>
                    <div>
                        <label>Upload Photo </label>
                        <input class="upload" type="file"   name="image"/>
                    </div>
                    <div>
                        <button class="btn"> Update</button>
                    </div>
                </div>
                </form>
              
              </div>
        
        </section>
        
        <footer>
        		<p style=" font-style:italic; font-size:24px; padding:10px;">Admin Page</p>
                <p>&copy; Copyrights British Polo 2021. All Rights Reserved.</p>
        </footer>
    <script src="js/main.js"></script>
    </body>
</html>

