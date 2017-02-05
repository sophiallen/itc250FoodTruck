<?php 

/*
	Class for to generating menu items and displays them as form elements. 
	@author Sophia Allen
*/
require 'MenuItem.php';
require 'EntreeItem.php';
require 'DrinkItem.php';


class MenuDisplay
{
	private $entrees = [];
	private $drinks = [];
	private $sides = [];
	protected $form = '';
	//intializes menu display with standard menu items. 
	function __construct()
	{
		$standard_proteins = array('beef', 'chicken','pork','veggie crumble');
		$standard_toppings = array('cojita cheese','jalapenos','olives');

		$standard_quantities = array(0,1,2,3,4,5,6,7,8);
		//($name, $description, $price, $quantities, $options, $extras)
		$entrees = array(
			new EntreeItem('Taco', 'Your favorite meat with lettuce, cheese, and our special sauce.', 3.25, 
			 $standard_quantities,  $standard_proteins, $standard_toppings),
			new EntreeItem('Burrito', 'Tortilla filled with rice, beans, cheese, and your choice of protein.', 4, 
			 $standard_quantities,  $standard_proteins, $standard_toppings),
			new EntreeItem('Quesadilla', 'Cheese and your choice of meat grilled between two tortillas', 5.25, 
			 $standard_quantities,  $standard_proteins, $standard_toppings)
		);

		//$name, $description, $price, $quantities, $flavors, $sizes
		$standard_drink_sizes = array('small', 'medium', 'large');
		$drinks = array(
			new DrinkItem('Horchata', 'Sweetened rice milk with traditional spices', 2.5, $standard_quantities,
			 array('traditional', 'extra-sweet'), $standard_drink_sizes),
			new DrinkItem('Jarritos Soda', 'Refreshing soda with a wide variety of flavors', 1.25, $standard_quantities,
			 array('Cola', 'Jamaica', 'Lima-Limon', 'Guayaba', 'Limon'), array('12.5oz bottle')),
			new DrinkItem('Water Bottle', 'Chilled bottle of water', 1, $standard_quantities,
				array('Dasani', 'San Pellegrino'), array('12oz bottle', '20oz bottle'))
			);

		$menu = '<h3>Entrees</h4>';

		foreach ($entrees as $item){
			$menu .= $item->toFormField();
		}

		$menu .= '<h3> Drinks </h3>';
		foreach ($drinks as $drink){
			$menu .= $drink->toFormField();
		}

		$this->form = $menu;
		$this->entrees = $entrees;
		$this->drinks = $drinks;
	}

	public function get_menu()
	{
		return $this->form;
	}
}

?>