<?php require 'MenuDisplay.php'; ?>
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

 	</style>
 </head>
 <body>
 	<h1>Menu</h1>
 	<form >
 		<h4>Entrees</h4><br/>
 		<?php 
 			$menu = new MenuDisplay();
 			echo $menu->$form;
 		 ?>
 	</form>

 </body>
 </html>