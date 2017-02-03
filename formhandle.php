<?php
	echo '<pre>';
	$data = json_decode($_POST['order_data']);
	var_dump($data);
	echo '</pre>';


  /* Result: 
object(stdClass)#1 (3) {
  ["Taco"]=>
  object(stdClass)#2 (3) {
    ["quantity"]=>
    string(1) "1"
    ["protein"]=>
    string(4) "beef"
    ["extras"]=>
    string(4) "none"
  }
  ["Burrito"]=>
  object(stdClass)#3 (3) {
    ["quantity"]=>
    string(1) "2"
    ["protein"]=>
    string(4) "beef"
    ["extras"]=>
    string(4) "none"
  }
  ["Quesadilla"]=>
  object(stdClass)#4 (3) {
    ["quantity"]=>
    string(1) "3"
    ["protein"]=>
    string(4) "beef"
    ["extras"]=>
    string(4) "none"
  }
}
*/
 //Access special instructions: $_POST['special_instructions']

?>