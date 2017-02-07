<?php
/**
*   formhandle.php A formhandler for the food truck order form(index.php). 
*   Its purpose is to produce a receipt from the food truck customers order.
*   It must give an accurate report of the details of the order
*   and give an accurate subtotal, tax and total to display.
*
*   @author Joseph Wanderer, Sophia Allen
**/

//decode the json produced by Sophia's javascript. "true" makes it return an array rather than defaulting to a stdClass object.
    $data = json_decode($_POST['order_data'], 2);

//initialize variables
//$order holds the string that makes up the order/receipt that will be echoed at the end
$order = '';
//Price of all items without tax
$subtotal = 0;
//sales tax is 9.6% in Seattle
$taxRate = 0.096;


//loop through each item. Each item is stored as an array.
foreach ($data as $itemName => $itemDetailsArray)
{

    //variables to capture the values of each item detail to make formatting the text later easier
    //$itemTotal is to store $quantity * price. Prices are stored in the $prices array.
    $price = 0;
    $quantity = 0;
    $protein = '';
    $extras = array();
    $flavor = '';
    $size = '';
    $itemTotal = 0;
    
    // loop through each detail in the item
    foreach ($itemDetailsArray as $detail => $value)
    {
        
        //switch statement to assign each property to its respective variable
        switch ($detail)
        {
                
            case "price":
                $price = $value;
                break;
                
            case "quantity":
                $quantity = $value;
                break;
            
            case "protein":
                $protein = $value;
                break;
                
            case "extras":
                $extras = $value;
                break;
                
            case "flavor":
                $flavor = $value;
                break;
                
            case "size":
                $size = $value;
                break;
                
        }//end switch
       
        
    }//end loop over item details
    
    $itemTotal = number_format($quantity * $price,2);
    
  
    $extras = implode(", ",$extras);
    
    
    //if it has something in $protein it is an entree
    if ($protein != '')
    {
        $order .= "$quantity $itemName"  . ($quantity > 1 ? 's' : '') . " : $protein".'<br/>'."Extras: $extras <br /> \$$itemTotal <br /><br />";
    }
    
    //if it has something in $flavor it is a drink
    if ($flavor != '')
    {
        $order .= "$quantity $itemName"  . ($quantity > 1 ? 's' : '') . ": $flavor, Size: $size <br/> \$$itemTotal <br /><br/>";
    }
    
    //Add up each item total to get the subtotal
    $subtotal += $itemTotal;
    
}//end loop over items

//calculate and format the numbers. Putting "2" as the second argument in number_format() rounds to 2 decimal places.
$subtotal = number_format($subtotal,2);
$totalTax = number_format($taxRate * $subtotal,2);
$total = number_format($totalTax + $subtotal,2);

//$_POST['special_instructions'] contains any special instruction entered into the special instructions text area in the form
$notes = $_POST['special_instructions'];

$order .= "Notes: $notes ".'<br/>'." subtotal: \$$subtotal <br/> tax: \$$totalTax".' <br/> '."total: \$$total";

//Print the order/receipt
echo $order;

?>
