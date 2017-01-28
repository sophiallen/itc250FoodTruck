<?php

require 'MenuItem.php';
require 'ExampleItem.php';

$taco_extras = array();
$taco_extras['cojita cheese'] = '.50';
$taco_extras['jalapenos'] = '.25';
$standard_proteins = array('beef', 'chicken','pork','veggie crumble');


$item1 = new ExampleItem('Taco', 'Your favorite meat with lettuce, cheese, and our special sauce.', 
	3.25, array('2', '4','6', '8'), $standard_proteins, $taco_extras);

$item2 = new ExampleItem('Burrito', 'Tortilla filled with rice, beans, cheese, and your choice of protein.', 
	4, array('small', 'medium', 'huge!'), $standard_proteins, $taco_extras);

//sample array of items 
$inventory = array($item1, $item2);

function displayMenuItems($inventory)
{
	$menu = '';

	//loop over items in inventory and get its input fields. 
	foreach($inventory as $item) 
	{
		//add input fields to the menu
		$menu .= $item->toFormField();
	}

	//return the full menu
	return $menu;
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

 	</style>
 </head>
 <body>
 	<h1>Menu</h1>
 	<form >
 		<h4>Entrees</h4><br/>
 		<?php 
 			echo displayMenuItems($inventory);
 		 ?>
 	</form>

 </body>
 </html>