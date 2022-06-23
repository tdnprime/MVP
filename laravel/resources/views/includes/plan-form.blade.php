<form class="form-plan" action="/cart" method="post">

    <select class="select-plan margin-top-zero" name="quantity">
        <option invalid>Select quantity</option>
        <option selected value="1">Qty: 1</option>
        <option value="2">Qty: 2</option>
        <option value="3">Qty: 3</option>
        <option value="4">Qty: 4</option>
        <option value="5">Qty: 5</option>
        <option value="6">Qty: 6</option>
        <option value="7">Qty: 7</option>
    </select>
    <select class="select-plan margin-top-zero">
        <option invalid>Select Subscription</option>
        <option selected>${{ $product[0]->price }} - Every month</option>
    </select>

</form>
<button data-plan="1" data-img="{{ $product[0]->img }}" data-id="{{ $product[0]->id }}" data-price="{{$product[0]->price }}" class="cart-add" class="button">SUBSCRIBE NOW</button>
