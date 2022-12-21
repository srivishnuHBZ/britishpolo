<?php
session_start();
if(!isset($_SESSION['aid']))header('Location: ./');

require '../connections/settings.php';
require '../connections/dbh.php';

$pdo = new mypdo();

if(isset($_POST['ch']) && $_POST['ch'] == 'remove_msg'){
	
	$mid = $_POST['mid'];
	$pdo->gen_qry_one('DELETE FROM contact WHERE id = ?', $mid);
	die('success');
	
}

$contacts =  $pdo->get_menus("SELECT * FROM contact  ORDER BY id DESC"); 

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
        <title>Contact Messages | British Polo</title>
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
       
        <br></br><br></br><br></br>
        
        
        <div class="title" id="title">
            <div class="max-width">
                <h2 class="title">
                    Contact Messages</h2>
            </div>
        </div>
        <section class="section-menu">
            <div class="container-menu" style=" min-height:370px;"> 
                <table class="table_m">
                	<thead>
                    	<tr>
                        	<th>Full Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($contacts as $contact){  ?>
                    	<tr id="msg_<?php echo $contact['id']; ?>">
                        	<td><?php echo $contact['fname']; ?></td>
                            <td><?php echo $contact['email']; ?></td>
                            <td><?php echo $contact['subject']; ?></td>
                            <td><?php echo $contact['message']; ?></td>
                            <td><?php echo date('D d, M Y', strtotime($contact['date_time'])); ?></td>
                            <td class="btn_rw" style="text-align: center;"><button onclick="remove_msg(<?php echo $contact['id']; ?>)"><i class="fa fa-ban" aria-hidden="true"></i> Delete</button></td>
                        </tr>
                    </tbody>
                	
                    <?php } ?>
                </table>
                
            </div>
            </div>
        </section>
        <br><br><br><br>
        <footer>
        		<p style=" font-style:italic; font-size:24px; padding:10px;">Admin Page</p>
                <p>&copy; Copyrights British Polo 2021. All Rights Reserved.</p>
        </footer>
    <script src="../js/admin.js"></script>
    </body>
</html>

