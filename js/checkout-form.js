function showDiv()
{
  var e = document.getElementById("modeofpayment");
  var strUser = e.options[e.selectedIndex].value;

  if(strUser == "cod"){
    document.getElementById("creditCardInfo").style.display = 'none'; //hides the div for creditCardInfo
    document.getElementById("cardNo").required = false; //sets cardNo to unrequired
    document.getElementById("expdate").required = false;//sets expdate to unrequired
    document.getElementById("cvv").required = false;    //sets cvv to unrequired
  }
  if(strUser == "cc"){
    document.getElementById("creditCardInfo").style.display = 'block'; //displays the div for creditCardInfo
    document.getElementById("cardNo").required = true; //sets cardNo to required
    document.getElementById("expdate").required = true;//sets expdate to required
    document.getElementById("cvv").required = true;    //sets cardNo to required
  }

}
