/*
	submitForm.js 
	@author Sophia Allen

	This script preserves the object-oriented abilities of the menu  
	items by packaging items ordred as js objects, then storing them as 
	the value of the hidden form field "order_data", before finally 
	submitting the form to send the data via POST. 
*/
$(document).ready(function(){
	//listen for click on submit order button
	$('#sendOrder').click(function(e){
		//call method to package the data as a json object
		setFormData();
		//trigger form submission
		$('form').submit();
	});
});

//function to package order data as json
function setFormData(){
	//get all items from the form, grouped together by divs. 
	var items = $('.menuItem');

	//initialize object to populate with data. 
	var data = {};

	//loop over all items on the menu
	for (var i = 0; i < items.length; i++){
		var children = items[i].getElementsByTagName('select');
		var extras = items[i].getElementsByTagName('input');

		var quantity = children[0].value;

		//if at least one of that item type has been ordered, get and package its data. 
		if (quantity > 0){
			var itemName = children[0].name.split("_")[0];
			var itemObj = {};
			
			var itemPrice = items[i].firstChild.innerText.split(" |")[0];
			itemPrice = parseFloat(itemPrice.substr(1));
			itemObj["price"] = itemPrice;

			//parse any sub-fields (flavors, sizes, etc) and save to item object. 
			for (var j = 0; j < children.length; j++){
				var dataName = children[j].name.split("_")[1];
				itemObj[dataName] = children[j].value;
			}

			//if there are extras, save them as an array in the item object. 
			var addOns = [];
			for (var j =0; j < extras.length; j++){
				if (extras[j].checked){
					addOns.push(extras[j].name);
				}
			}
			itemObj['extras'] = addOns;

			//save the item to the order data object. 
			data[itemName] = itemObj;
		}
	}

	//convert json into a string for sending via POST 
	data = JSON.stringify(data);

	//attach json string as the value of the hidden formdata input field. 
	$("#formData").val(data);
}