<?php

class MenuItem {
	public $name;
	public $description;
	public $price;

	function __construct($name, $description)
	{
		$this->name = $name;
		$this->description = $description;
	}
}

//example items 
$item1 = new MenuItem('Apple', 'a red apple');
$item2 = new MenuItem('Corn', 'a cob of corn');


//sample array of items 
$inventory = array($item1, $item2);


//function that turns items into form inputs
function displayMenuItems($inventory)
{
	$menu = '';

	//for each item in the inventory, add the following: 
	foreach ($inventory as $item){
		//quantity picker
		$menu .= '<select name="'.$item->name.'._quantity">';
		for ($i = 0; $i <= 10; $i++)
		{
			$menu .= '<option value='.$i.'>'.$i.'</option>';
		}
		$menu .= '</select>';

		//name and description
		$menu .= '<label>'.$item->name.': '.$item->description.'</label><br/>';
	}

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
 		<label>Entrees</label><br/>
 		<?php 
 			echo displayMenuItems($inventory);
 		 ?>
 	</form>

 </body>
 </html>