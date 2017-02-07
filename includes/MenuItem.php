<?php 
/**
*   MenuItem.php A parent class for different types of menu items, to ensure all items have 
*   names, prices, descriptions, etc. This will make loading the items into our form easier. 
*
*	@author Sophia Allen
**/

	abstract class MenuItem 
	{
		public $name; 
		public $description;
		public $quantities;
		protected $ID;

		//static property to track total number of items in stock, and assist in generating IDs for menu items. 
		protected static $INVENTORY_SIZE = 0;

		/*
			Constructs a MenuItem
			@param $name: the name of the item to be displayed. 
			@param $description: a short description of the menu item. 
			@param $price: the price per single unit of the item. 
			@param $quantities: an array of quantity options for the item. Ex: [1,2,3,4,5]
		*/
		public function __construct($name, $description, $price, $quantities)
		{
			//increment number of items in inventory and generate ID
			self::$INVENTORY_SIZE += 1;
			$this->ID = self::$INVENTORY_SIZE;

			//initialize property values
			$this->name = $name;
			$this->description = $description;
			$this->price = $price;
			$this->quantities = $quantities;
		}

		//Function to return the necessary form inputs to display the 
		//item in the form. Child methods in EntreeItem, DrinkItem can add 
		//additional inputs to the base provided here. 
		public function toFormField()
		{
			$menu = '';

			//name and description
			$menu .= '<label> $'.$this->price.' |  <strong> '.$this->name.':</strong> '.$this->description.'</label><br/>';

			//quantity picker
			$menu .= 'Quantity: <select class="quantity" name="'.$this->name.'_quantity">';

			//purchase size options
			for ($i = 0; $i < sizeof($this->quantities); $i++)
			{
				$menu .= '<option value='.$i.'>'.$this->quantities[$i].'</option>';
			}
			$menu .= '</select>';

			return $menu;
		}

		//function to remove item from inventory upon purchase.
		public function sell()
		{
			//decrease inventory by one.
			self::$INVENTORY_SIZE--;
		}
	}

?>