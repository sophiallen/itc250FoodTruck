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
		public $purchase_sizes;
		protected $ID;

		//static property to track total number of items in stock, and assist in generating IDs for menu items. 
		protected static $INVENTORY_SIZE = 0;


		/*
			Constructs a 
			@param $name: the name of the item to be displayed. 
			@param $description: a short description of the menu item. 
			@param $price: the price per single unit of the item. 
			@param $purchase_sizes: an array of purchase size options for the item. Ex: ['small', 'medium', 'large']
		*/
		public function __construct($name, $description, $price, $purchase_sizes)
		{
			self::$INVENTORY_SIZE += 1;
			$this->ID = self::$INVENTORY_SIZE;

			$this->name = $name;
			$this->description = $description;
			$this->price = $price;
			$this->purchase_sizes = $purchase_sizes;

			//increment number of items in inventory and generate ID

		}

		//Function to return the necessary form inputs to display the 
		//item in the form. Child methods can add additional inputs to the base
		//provided here. 
		public function toFormField()
		{
			$menu = '';

			//name and description
			$menu .= '<label> $'.$this->price.' |  <strong> '.$this->name.':</strong> '.$this->description.'</label><br/>';

			//quantity picker
			$menu .= 'Quantity: <select name="'.$this->name.'_quantity">';

			//purchase size options
			for ($i = 0; $i < sizeof($this->purchase_sizes); $i++)
			{
				$menu .= '<option value='.$i.'>'.$this->purchase_sizes[$i].'</option>';
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


