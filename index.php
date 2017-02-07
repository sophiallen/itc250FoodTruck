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
 </body>
 </html>