<?php require 'includes/MenuDisplay.php'; ?>

<html>
 <head>
 	<title>Food Truck</title>
 	<style type="text/css">
 		html {
 			background-color: gainsboro;
 		}

 		body {
 			width: 75%;
 			margin: 2em auto;
 			background-color: white;
 			padding: 1.5em;
 			font-family: 'calibri';
 		}
 		textarea {
 			width: 50%;
 		}

 	</style>
 </head>
 <body>
 	<h1>Menu</h1>
 	<form action="formhandle.php" method="post">
 		<h4>Entrees</h4><br/>
 		<?php 
 			$menu = new MenuDisplay();
 			echo $menu->get_menu();
 		 ?>
 		 <label>Special Instructions: </label><br/>
 		 <textarea name="special_instructions"></textarea>

 		 <input type="hidden"  id="formData" name="order_data" value=""/>
 	</form>
 	<button id="sendOrder">Submit Order</button>
 	<!-- JQuery -->
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	<!--Js for submitting the form as a json object (makes parsing during formhandle.php easier)-->
 	<script src="js/submitForm.js"></script>
 </body>
 </html>