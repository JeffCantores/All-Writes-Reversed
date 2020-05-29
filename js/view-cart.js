function ready(){


	var addToCartButtons = document.getElementsByClassName('store-item-button');

	for(var i = 0; i< addToCartButtons.length; i++){
		addToCartButtons[i].addEventListener('click', addToCartClicked);
		addToCartButtons[i].addEventListener('click', disableCliked);
	}


	var imageLinks = document.getElementsByClassName('store-item-image');

	for(var i = 0; i< addToCartButtons.length; i++){
		imageLinks[i].addEventListener('click', showDesc);
	}


	document.getElementById("check-out-button").disabled = true;
}

function disableCliked(event){
	var button = event.target;
	var storeItem = button.parentElement.parentElement;
	var image = storeItem.getElementsByClassName('store-item-image')[0];

	image.style.opacity = "0.5";

	disable(button);
}

function addToCartClicked(event){
	// alert("Show~!");
	var button = event.target;
	var storeItem = button.parentElement.parentElement;
	var title = storeItem.getElementsByClassName('store-item-title')[0].innerHTML;
	var price = storeItem.getElementsByClassName('store-item-price')[0].innerHTML;
	var image = storeItem.getElementsByClassName('store-item-image')[0].src;
	var image2 = storeItem.getElementsByClassName('store-item-image')[0];


	console.log(title);
	console.log(price);
	console.log(image);
	addItemToCartItems(title, price, image, button, image2);
	updateTotalPrice();

	document.getElementById("check-out-button").disabled = false;

}

function PurchaseFunction(){

	// Get the parent that holds all the cart-item (cart-items)
	var cartItems = document.getElementsByClassName("cart-items")[0];

	// Get all the cart-item inside the parent
	var cartItemList = cartItems.getElementsByClassName("cart-item");


	var itemList = [];
	var imageList = [];
	// loop through the cart-item and get the price and title
	for(var i=0; i<cartItemList.length; i++){

		var quantity = cartItemList[i].getElementsByClassName("cart-item-quantity-input")[0].value;
		var title = cartItemList[i].getElementsByClassName("cart-item-title")[0].innerHTML;
		var image = cartItemList[i].getElementsByClassName("cart-item-image")[0].src;
		var price = cartItemList[i].getElementsByClassName("cart-item-price")[0].innerHTML;
		var total = document.getElementsByClassName("cart-total-price")[0].innerHTML;

		itemList[i] = {quantityValue: quantity, imageValue: image, titleValue: title, priceValue: price, totalValue: total};
	}

	console.log(itemList);

	sessionStorage.setItem("itemList", JSON.stringify(itemList));
	localStorage.setItem("itemListPermanent", JSON.stringify(itemList));


	alert("Proceed?");
	window.location.href = "orderForm.html";

}
