<?php
//DrinkItem.php

/*
    Models the behavior and properties of drinks for the menu. 
    @author Sean Gilliland
*/

class DrinkItem extends MenuItem
{
    
    protected static $in_stock = 0;
    public $flavors;
    public $sizes;
    
    public function __construct($name, $description, $price, $quantities, $flavors, $sizes)
    {
        
        
        parent::__construct($name, $description, $price, $quantities);
        
        $this->flavors = $flavors;
        $this->sizes = $sizes;
        
        
    }
    
    public function toFormField()
    {
        
        $drink_field = '<div class="menuItem drinkItem">'; //intial wrapper for styling purposes
		$drink_field .= parent::toFormField();
        
        $drink_field .= '<br> Beverage Flavor:';
        $drink_field .= '<select name='.$this->name.'_flavor>';
        
        foreach ($this->flavors as $flavor)
        {
            $drink_field .= '<option value='.$flavor.'>'.$flavor.'</option>';    
        }
        $drink_field .= '</select>';
        
        $drink_field .= '<br> Size: ';
        $drink_field .= '<select name='.$this->name.'_size>';
        
        foreach ($this->sizes as $size)
        {
            
            $drink_field .= '<option value='.$size.'>'.$size.'</option>';
            
        }
        
        $drink_field .= '</select>';
        $drink_field .= '</div><br>';
        
        return $drink_field;
        
        
    }
    
    
    
}

?>


//Revised MenuDisplay.php


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
		$standard_toppings = array('none','cheese','jalapenos','olives');

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
        
        $drink_flavors = array('Coke', 'Jarritos', 'Horchata', 'Coffee');
        $drink_sizes = array('Small', 'Medium', 'Large');
        
        $drinks = array(
        new DrinkItem('Beverage One', 'Please Choose a Beverage', 2.50, $standard_quantities, $drink_flavors, $drink_sizes),
        new DrinkItem('Beverage Two', 'Please Choose a Beverage', 2.50, $standard_quantities, $drink_flavors, $drink_sizes)
        
        );

		$menu = '';

		foreach ($entrees as $item){
			$menu .= $item->toFormField();
		}
        
        foreach ($drinks as $drink_item){
            $menu .= $drink_item->toFormField();
        }

		$this->form = $menu;
	}

	public function get_menu()
	{
		return $this->form;
	}
}

?>