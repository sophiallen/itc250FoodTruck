<?php 
/**
*  index.php  - The main page of the app, controls whether the menu (form) or the reciept (form results) is displayed.
*  @author Team Two: S. Allen, J. Wanderer, S. Gilliland, B. Coats
**/


require 'includes/MenuDisplay.php';

//Renders the form by calling the get_menu method of a new MenuDisplay
function show_form()
{
	echo '<h2>Menu</h2>
 	<form action="index.php" method="post">';
	$menu = new MenuDisplay();
	echo $menu->get_menu();

 	echo '<label>Special Instructions: </label><br/>
 	<textarea name="special_instructions"></textarea>

 	<input type="hidden"  id="formData" name="order_data" value=""/>
 	</form>
 	<button id="sendOrder">Submit Order</button>';
}

//function to display receipt by executing the formhandler. 
function show_receipt()
{
	require 'includes/formhandle.php';
}

?>

<html>
 <head>
 	<title>Food Truck</title>
	<meta charset="utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	<meta name="description" content="A food Truck Menu/Ordering Application" />
	<link href='https://fonts.googleapis.com/css?family=Unkempt:400,700|Averia+Sans+Libre:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/foodtruck.css">
 </head>
 <body>
 	<div class="site-wrapper">
 	<h1>Equipo de Dos' Tacos</h1>
 	<?php 
 		//Sense whether to display menu or receipt based on request type. 
 		if ($_POST)
 		{
 			show_receipt();

 			//code for displaying raw order data:
 			// echo '<pre>';
 			// echo var_dump(json_decode($_POST['order_data']));
 			// echo '</pre>';
 		}
 		else 
 		{
 			show_form();
 		}
 	?>

 	<!-- JQuery -->
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	<!--js for submitting the form as a json object (makes parsing during formhandle.php easier)-->
 	<script src="js/submitForm.js"></script>
 	</div>
 </body>
 </html>