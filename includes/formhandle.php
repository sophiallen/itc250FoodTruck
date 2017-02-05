<?php
/**
*   formhandle.php A formhandler for the food truck order form(index.php). 
*   Its purpose is to produce a receipt from the food truck customers order.
*   It must give an accurate report of the details of the order
*   and give an accurate subtotal, tax and total to display.
*
*	@author Sophia Allen, Joseph Wanderer
*   @todo incorporate drink orders.
*   @todo improve aesthetics with html/css.
**/

//decode the json produced by Sophia's javascript. "true" makes it return an array rather than defaulting to a stdClass object.
$data = json_decode($_POST['order_data'], true);

//initialize variables
//$order holds the string that makes up the order/receipt that will be echoed at the end
$order = '';
//Price of all items without tax
$subtotal = 0;
//sales tax is 9.6% in Seattle
$taxRate = 0.096;
//This is a lookup array to get the price for each item
$prices = array
    ("Taco" => 3.25,
     "Burrito" => 4.00,
     "Quesadilla" => 5.25,
     "item4" => 5.25,
    );

//loop through each item. Each item is stored as an array.
foreach ($data as $itemName => $itemDetailsArray)
{

    //variables to capture the values of each item detail to make formatting the text later easier
    //$itemTotal is to store $quantity * price. Prices are stored in the $prices array.
    $quantity = 0;
    $protein = '';
    $flavor = '';
    $size = '';
    $itemTotal = 0;
    
    // loop through each detail in the item
    foreach ($itemDetailsArray as $detail => $value)
    {
        
        //switch statement to assign each property to its respective variable
        switch ($detail)
        {
            case "quantity":
                $quantity = $value;
                break;
            
            case "protein":
                $protein = $value;
                break;
                
            case "flavor":
                $flavor = $value;
                break;
                
            case "size":
                $sizes = $value;
                break;
                
        }//end switch
        
                
        
    }//end loop over item details
    
    $itemTotal = number_format($quantity * $prices[$itemName],2);
    
    $extras = '';
    if (isset($_POST[$itemName.'_extras']))
    {
    $extras = implode(", ",$_POST[$itemName.'_extras']);
    }
    
    //if it has something in $protein it is an entree
    if ($protein != '')
    {
        $order .= "$quantity $itemName"  . ($quantity > 1 ? 's' : '') . " : $protein, extras: $extras <br /> \$$itemTotal <br /><br />";
    }
    
    //if it has something in $flavor it is a drink
    if ($flavor != '')
    {
        $order .= "$quantity $itemName(s): $flavor, size: $size <br /> \$$itemTotal <br /><br />";
    }
    
    //Add up each item total to get the subtotal
    $subtotal += $itemTotal;
    
}//end loop over items

//calculate and format the numbers. Putting "2" as the second argument in number_format() rounds to 2 decimal places.
$subtotal = number_format($subtotal,2);
$totalTax = number_format($taxRate * $subtotal,2);
$total = number_format($totalTax + $subtotal,2);

//$_POST['special_instructions'] contains any special instruction entered into the special instructions text area in the form
//NOTE: currently newlines are not preserved
$notes = $_POST['special_instructions'];

$order .= "notes: $notes <br /> <br /> subtotal: \$$subtotal <br /> tax: \$$totalTax <br /> total: \$$total";

//Print the order/receipt
echo $order;


?>
