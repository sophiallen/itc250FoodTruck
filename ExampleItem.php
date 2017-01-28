<?php

/**
*
* An example of a menu item class that can be customized to fit 
* multiple types of menu items
*
* @author Sophia Allen
**/

class ExampleItem extends MenuItem 
{
	protected static $IN_STOCK = 0;
	public $options;
	public $extras;

	/*
	*	Class constructor
	*	@param $options: array of the flavor/meat options available for this item type
	*	@param $extras: associative array of additional items that may be added, and their included costs. 
	*/
	public function __construct($name, $description, $price, $purchase_sizes, $options, $extras)
	{
		//give basic information to parent class (MenuItem). 
		parent::__construct($name, $description, $price, $purchase_sizes);

		//initialize properties unique to this class
		$this->options = $options;
		$this->extras = $extras;
	}

	public function toFormField()
	{
		$field = '<div class="menuItem">'; //intial wrapper for styling purposes
		$field .= parent::toFormField();  

		$field .= "<br/> Meat Options:";
		$field .= '<select name='.$this->name.'_protein>';

		foreach ($this->options as $option)
		{
			$field .= '<option value='.$option.'>'.$option.'</option>';
		}
		 $field .= '</select>';

		$field .= "<br/> Extras: ";
		$field .= '<select name='.$this->name.'_extras>';

		foreach ($this->extras as $extra=>$price)
		{
			$field .= '<option value='.$extra.'>'.$extra.'  +'.$price.'</option>';
		}
		 $field .= '</select>';

		$field .= '</div><br/>';

		return $field;
	}


	//checks that item is available for sale, and decrements its inventory to reflect sale. 
	public function sell()
	{
		if (self::$IN_STOCK > 0)
		{
			self:$IN_STOCK--;
			parent::sell();
			return true;
		} 
		else 
		{
			return false;
		}
	}


}





?>