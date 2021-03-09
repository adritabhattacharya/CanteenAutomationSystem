
var removeCartitembuttons=document.getElementsByClassName('b');
for(var i=0;i<removeCartitembuttons.length;i++){
    var button=removeCartitembuttons[i]
    button.addEventListener('click',removeCartItem)
}

var quantityInputs=document.getElementsByClassName("quantity")
for(var i=0;i<quantityInputs.length;i++){
    var input=quantityInputs[i]
    input.addEventListener('change',quantitychanged)
}

var addToCartbuttons=document.getElementsByClassName("a")
for(var i=0;i<addToCartbuttons.length;i++){
    var button=addToCartbuttons[i]
    button.addEventListener('click', addToCartclicked)
}
document.getElementsByClassName("c")[0].addEventListener('click',array)
document.getElementsByClassName("c")[0].addEventListener('click',purchaseClicked)


function array(){
    title=document.getElementsByClassName("cafe")[1];
    alternate_title=`<br>
    <center><h1>Order Summary</h1></center>
    <br>`
    title.innerHTML=alternate_title;
    name=document.getElementsByClassName("cus_name")[0].textContent;
    console.log(name);
    order=[];
    var cartRows=document.getElementsByClassName('cart-items')
    for(var i=0;i<cartRows.length;i++){
        var cartRow=cartRows[i];
        var nameElement=cartRow.getElementsByClassName("item-name")[0];
        var name=nameElement.textContent;
        var quantityElement=cartRow.getElementsByClassName("quantity")[0];
        var quantity=parseFloat(quantityElement.value);
        var priceElement=cartRow.getElementsByClassName("item-price")[0];
        var price=parseFloat(priceElement.textContent.replace('Rs.',''));
        item=[name,quantity,price];
        order.push(item);
    }
    var contents=`<form method="post"><div class="centered">`
    for(var i=0;i<order.length;i++){
        contents=contents+`<div class="cart-items" style="display: flex;">
        <div style="width:2em;">${i+1}.</div>
        <div><input readonly type="text" value="${order[i][0]}" name="pdt_name[]" class="order"></div>
        <div><input readonly type="number" value="${order[i][1]}" name="pdt_qty[]" class="order"></div>
        <div><input readonly type="number" value="${order[i][2]}" name="pdt_prc[]" class="order"></div>
        <input name="token" type="hidden" value="$_SESSION["buy_token"]">
        <div></div>
    </div><br>`;
    }
    var textFields=document.getElementsByClassName("order");
    for(var i=0;i<textFields.length;i++){
        var tF=textFields[i];
        tF.readOnly=true;
    }
    contents=contents+`<br><center><input type="submit" name="ORDER" class="a" value="Order"></center></div></form>`;
    var half=document.getElementsByClassName("bill")[0];
    half.innerHTML=contents;
    
    document.getElementsByClassName("e")[0].addEventListener("click", goBack) ;
    function goBack(){
        title=document.getElementsByClassName("cafe")[1];
        alternate_title=`<br>
        <center><h1>Cart</h1></center>
        <br>`
        title.innerHTML=alternate_title;
        contents=`<div class="bg">
                
        <div class="all-items">
    
        </div>
    
        <hr>
    </div>
    <div class="eh"><h2><center>Total: <span class="total">Rs. 0</span></center></h2></div>
    <br>
    <center><input type="submit" value="Purchase" class="c"></center>
    </div>`
    var half=document.getElementsByClassName("bill")[0];
    half.innerHTML=contents;
    } 
}





function purchaseClicked(){
    alert('Thank You for your purchase')
    var cartItems=document.getElementsByClassName("all-items")[0]
    
    while(cartItems.hasChildNodes()){
      
        cartItems.removeChild(cartItems.firstChild)
    }
    
    updateCartTotal();
    
}

function quantitychanged(event){
    var input=event.target
    if(isNaN(input.value) || input.value<=0){
        input.value=1;
    }
    updateCartTotal();
}
function addToCartclicked(event){
    var button=event.target
    var shopitem=button.parentElement.parentElement.parentElement
    var title=shopitem.getElementsByClassName("name")[0].textContent
    var price=shopitem.getElementsByClassName("price")[0].textContent
    var imageSrc=shopitem.getElementsByClassName("image")[0].src
    addItemtoCart(title,price,imageSrc)
    updateCartTotal();
   
}
function addItemtoCart(title,price,imageSrc){
    var cartRow=document.createElement("div")
    var cartItems=document.getElementsByClassName("all-items")[0];
    var cartItemNames=cartItems.getElementsByClassName("item-name")
    for(var i=0;i<cartItemNames.length;i++){
        if(cartItemNames[i].textContent==title){
            alert('You have already added this item')
            return
        }
    }
    var cartRowcontents=`<div class="cart-items" style="display: flex;">
    <div class="Srno"><img src="${imageSrc}" style="width:50px;height:50px;"></div>
    <div class="item-name">${title}</div>
    <div class="item-price" value="${price}" >${price}</div>
    <div class="items-quantity"><form method="GET"><input type="number" value=1 style="width: 3em;" class="quantity"></form></div>
    <div class="remove"><button class="b">X</button></div>
</div>`
cartRow.innerHTML=cartRowcontents
cartItems.append(cartRow)
cartRow.getElementsByClassName("b")[0].addEventListener('click',removeCartItem)
cartRow.getElementsByClassName("quantity")[0].addEventListener('change',quantitychanged)
}
function removeCartItem(event){
    var buttonClicked=event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal();
}
function updateCartTotal(){
    var cartRows=document.getElementsByClassName("cart-items")
    var total=0;
    for(var i=0;i<cartRows.length;i++)
    {
        var cartRow=cartRows[i]
        var priceElement=cartRow.getElementsByClassName("item-price")[0];
        var quantityElement=cartRow.getElementsByClassName("quantity")[0];
        var price=parseFloat(priceElement.textContent.replace('Rs.',''));
        var quantity=parseFloat(quantityElement.value);
        total=total+(price*quantity);
    }
    document.getElementsByClassName("total")[0].textContent='Rs.'+total;
    
}

