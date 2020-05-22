function computePrice() {
  var qty = document.getElementById("qty").value;
  var initialPrice =   sessionStorage.getItem("price");
  var totalPrice = initialPrice*qty;
  document.getElementById("price").value =  totalPrice;
}
