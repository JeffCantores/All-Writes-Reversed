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
