/*
	submitForm.js 
	@author Sophia Allen

	This script creates an data object based on the items the customer ordered, 
	attaches it as the value of the form field "order_data", and then submits the
	form to send the data. 
*/
$(document).ready(function(){
	$('#sendOrder').click(function(e){
		setFormData();
		$('form').submit();
	});
});

function setFormData(){
	console.log("in formData");
	var items = $('.menuItem');

	console.log(items);
	var data = {};

	for (var i = 0; i < items.length; i++){
		var children = items[i].getElementsByTagName('select');
		var extras = items[i].getElementsByTagName('input');

		var quantity = children[0].value;

		if (quantity > 0){
			var itemName = children[0].name.split("_")[0];
			var itemObj = {};

			for (var j = 0; j < children.length; j++){
				var dataName = children[j].name.split("_")[1];
				itemObj[dataName] = children[j].value;
			}

			var addOns = [];
			for (var j =0; j < extras.length; j++){
				if (extras[j].checked){
					addOns.push(extras[j].name);
				}
			}
			itemObj['extras'] = addOns;
			data[itemName] = itemObj;
		}
	}
	data = JSON.stringify(data);
	$("#formData").val(data);
}