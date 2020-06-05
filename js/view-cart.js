function showModal(){
			$("#loginModal").modal('show');
}




function ready(){

	var addToCartButtons = document.getElementsByClassName('store-item-button');

	for(var i = 0; i< addToCartButtons.length; i++){
		addToCartButtons[i].addEventListener('click', addToCartClicked);
		addToCartButtons[i].addEventListener('click', disableCliked);
	}

}



// remove item from cart button (not implemented yet)
function removeCartItem(buttons,image){
	var button = event.target;
	button.parentElement.parentElement.remove();

	buttons.disabled = false;
	image.style.opacity = "1.0";

	updateTotalPrice();

}



//Supposedly the add to cart function
function addItemToCartItems(title, price, image, button, image2){
	// Get the parent of all cart items
	var items = document.getElementsByClassName('cart-items')[0];

	// check if the item is already existing in the cart items
	var cartItemTitles = items.getElementsByClassName('cart-item-title');

	for(var i =0; i < cartItemTitles.length; i++){

		if(cartItemTitles[i].innerHTML == title){
			alert("This item is already added to cart.");

			return;
		}
	}

	// create new element -- row cart item
	var cartRow = document.createElement('div');
	cartRow.classList.add('cart-item');
	cartRow.classList.add('row'); // <div class = "cart-item row"> </div>


	var cartRowContents =

			`<div class="col">
				<input type="checkbox" class="select-store-item" aria-label="">
			</div>
			<div class="col">

				<img class="cart-item-image" src="${image}">
				<span class="cart-item-title">${title}</span>
			</div>
			<div class="col">
				<span class="cart-item-price">${price}</span>
				<span class="cart-item-price-base">${price}</span>
			</div>
			<div class="col">
				<input class="cart-item-quantity-input" type="number" name="" value="1">
				<br><br>
				<button class="btn btn-danger">REMOVE</button>
			</div>
			<br><br>`

			cartRow.innerHTML = cartRowContents;

			// Add event of buttons in cartRow
			cartRow.getElementsByClassName('cart-item-quantity-input')[0].addEventListener('change', quantityChange);
			cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', function(){removeCartItem(button,image2);});


			items.append(cartRow);

}
