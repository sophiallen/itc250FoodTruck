<?php 

/*
	Class for to generating menu items and displays them as form elements. 
	@author Sophia Allen
*/
require 'MenuItem.php';
require 'EntreeItem.php';



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

		$menu = '';

		foreach ($entrees as $item){
			$menu .= $item->toFormField();
		}

		$this->form = $menu;
	}

	public function get_menu()
	{
		return $this->form;
	}
}

?>