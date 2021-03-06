<?php

/**
*
* EntreeItem.php - Class that extends MenuItem with the information necessary to represent  
* entree items.
*
* @author Sophia Allen
**/

class EntreeItem extends MenuItem 
{
	protected static $IN_STOCK = 0;
	public $options;
	public $extras;

	/*
	*	Class constructor
	*	@param $options: array of the flavor/meat options available for this item type
	*	@param $extras: associative array of additional items that may be added, and their included costs. 
	*/
	public function __construct($name, $description, $price, $quantities, $options, $extras)
	{
		//give basic information to parent class (MenuItem). 
		parent::__construct($name, $description, $price, $quantities);


		//initialize properties unique to this class
		$this->options = $options;
		$this->extras = $extras;
	}

	public function toFormField()
	{
		$field = '<div class="menuItem">'; //intial wrapper for js & styling purposes
		$field .= parent::toFormField();  

		$field .= "<br/> Meat Options:";
		$field .= '<select name='.$this->name.'_protein>';

		foreach ($this->options as $option)
		{
			$field .= '<option value="'.$option.'">'.$option.'</option>';
		}
		$field .= '</select>';

		$field .= "<br/> Extras (25 &cent; each) : ";


		foreach ($this->extras as $extra)
		{
			$field .= '<input type="checkbox" name="'.$extra.'" value="'.$extra.'">'.$extra.'</input>';
		}
		
		$field .= '</select>';

		$field .= '</div><br/>';

		return $field;
	}

	//checks that item is available for sale, and decrements its inventory to reflect sale. 
	public function sell($quantity)
	{
		if (self::$IN_STOCK > 0)
		{
			self:$IN_STOCK -= $quantity;
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