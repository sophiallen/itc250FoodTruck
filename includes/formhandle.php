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

//loop through each item. 
foreach ($data as $itemName => $itemDetails)
{

    $itemTotal = number_format($itemDetails["quantity"] * $itemDetails["price"], 2);

    $order .= '<div class="receiptItem">';
    $order .= '<p> <strong>' . $itemDetails['quantity'] . ' ' . $itemName 
                . ($itemDetails['quantity'] > 1 ? 's' : '') . '</strong> : ';

    //loop through each detail of each item
    foreach ($itemDetails as $detail=>$value)
    {
        //don't echo price or quantity
        if ($detail != "price" && $detail != "quantity")
        {
            //check for extras array (needs special printing)
            if (is_array($value) && sizeof($value) > 0)
            {
                $order .=  '<p> Extras: '. implode(", ", $value).'</p>';
                //add 25 cents for each extra ordered. 
                $extras_cost = (sizeof($value) * .25)*$itemDetails["quantity"];
                $subtotal += $extras_cost;
                $itemTotal += $extras_cost;
            } 
            else if (!is_array($value))  //not an array, print normally
            {
                $order .= '<p>'.$detail . ": ".$value.'</p>';
            }
        }
    }
    $subtotal += $itemTotal;

    $order .= '<span class="itemTotal"> $'.number_format($itemTotal,2).'</span>';
    $order .= '</div>';
    
}//end loop over items

//calculate and format the numbers. Putting "2" as the second argument in number_format() rounds to 2 decimal places.
$subtotal = number_format($subtotal,2);
$totalTax = number_format($taxRate * $subtotal,2);
$total = number_format($totalTax + $subtotal,2);

//special instruction entered into the special instructions text area in the form
$notes = htmlspecialchars($_POST['special_instructions']);

$order .= '<div class="notes">
            <p><strong> Notes: </strong></p>
            <p>'. $notes. '</p>
            </div>
            <div class="totals">
               <p><strong>Subtotal: </strong> $'.$subtotal.'<br/>
               <strong>Tax: </strong> $'.$totalTax.'<br/>
               <strong>Order Total: </strong> $'.$total.'</p>
            </div>'; 

//display order
echo $order;
?>
