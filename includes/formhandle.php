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
    
    $order .= '<div class="receiptItem">';

    //if it has something in $protein it is an entree
    if ($protein != '')
    {
        $order .= '<p> <strong>' . $quantity . ' ' . $itemName . ($quantity > 1 ? 's' : '') . '</strong> : ' . $protein . ' </p>' . '<span class="itemTotal"> $' . $itemTotal . '</span>'
        .'<p> Extras: '. $extras .'</p>';
    }
    
    //if it has something in $flavor it is a drink
    if ($flavor != '')
    {
        $order .= '<p><strong>' . $quantity . ' ' . $itemName . ($quantity > 1 ? 's' : '') . '</strong>' . ': '
        . $flavor.'</p>'
        . '<span class="itemTotal"> $' . $itemTotal . '</span>' 
        .'<p> Size: '. $size .'</p>'.'<p class="itemTotal" $'. $itemTotal .'</p>';
    }
    
    $order .= '</div>'; //end receiptItem div
    //Add up each item total to get the subtotal
    $subtotal += $itemTotal;
    
}//end loop over items

//calculate and format the numbers. Putting "2" as the second argument in number_format() rounds to 2 decimal places.
$subtotal = number_format($subtotal,2);
$totalTax = number_format($taxRate * $subtotal,2);
$total = number_format($totalTax + $subtotal,2);

//$_POST['special_instructions'] contains any special instruction entered into the special instructions text area in the form
$notes = $_POST['special_instructions'];

//TODO: Strip $notes of special chars. 

$order .= '<div class="notes">
            <p><strong> Notes: </strong></p>'
            . '<p>'. $notes . '</p> 
           </div>
           <p><strong> Subtotal: </strong> $' . $subtotal . '</p>'
         .'<p><strong> Tax: </strong>$'. $totalTax . '</p>'
         .' <p> <strong> Total: </strong>$'. $total .'</p>';

//Print the order/receipt
echo $order;

?>
