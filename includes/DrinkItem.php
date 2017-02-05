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
