<?php
session_start();

if(!isset($_SESSION['aid']))header('Location: ./');

require '../connections/settings.php';
require '../connections/dbh.php';

$pdo = new mypdo();

if(isset($_POST['ch']) && $_POST['ch'] == 'remove_item'){
	
	$mid = $_POST['mid'];
	$pdo->gen_qry_one('DELETE FROM menus WHERE id = ?', $mid);
	die('success');
	
}

$menus =  $pdo->get_menus("SELECT * FROM menus  ORDER BY id ASC"); 

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
        <title>Items | British Polo</title>
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
            <div class="max-width"><br>
                <h2 class="title">
                    LIST OF HANDBAGS</h2>
            </div>
        </div>
        <section class="section-menu">
            <div class="container-menu"> 
                <div style="text-align:center; margin-bottom:20px;"> 
					<a href="add_menu_item.php"><button class="button_menuadmin"><b>Add Handbags</b></button></a>
				</div>

                <table class="table_m">
                	<thead >
                    	<tr>
                        	<th>Menu Item</th>
                            <th>Description</th>
                            <th>Price</th>
                            <!--<th>Rank</th>-->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($menus as $menu){  ?>
                    	<tr id="menu_<?php echo $menu['id']; ?>">
                        	<td>
                                <b><?php echo $menu['id']; ?></b><br />
                                <center><img src="../image/<?php echo $menu['image_url']; ?>"></center>
                                <h4><?php echo $menu['name']; ?></h4>
                            </td>
                            <td><?php echo $menu['desc_n']; ?></td>
                            <td style="white-space:nowrap">RM <?php echo $menu['price']; ?></td>
                            <!--<td><?php echo $menu['class']; ?></td>-->
                            <td class="btn_rw">
								<a href="update_menu_item.php?menu_id=<?php echo $menu['id']; ?>" style="font-size: 15px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Update</a> || <button onclick="remove_item(<?php echo $menu['id']; ?>)" style="font-size: 14px;"><i class="fa fa-ban" aria-hidden="true"></i> Delete</button></td>
                        </tr>
                    </tbody>
                	
                    <?php } ?>
                </table>
                
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

