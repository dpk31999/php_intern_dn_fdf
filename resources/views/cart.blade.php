<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
        <div class="col-md-12 ftco-animate">
            <div class="cart-list">
                <table class="table">
                    <thead class="thead-primary">
                    <tr class="text-center">
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="show-cart">
                        @if (session()->has('cart'))
                            @foreach (session()->get('cart')->items as $product)
                                <tr id="row-container-{{$product['id']}}">
                                    <td class="shoping__cart__item">
                                        <h5>{{ $product['product_name'] }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <input class="cart_price_key" disabled id="price-{{$product['id']}}" name="price" type="text"
                                            value="{{money_format('%.3n',$product['price'])}}">
                                    </td>
                                    <td>
                                        <img src="/storage/{{ $product['first_image'] }}" alt="">
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <span class="dec qtybtn"
                                                    onclick="onCartItemQuantityChanged('{{ $product['id']}}',false)">-</span>
                                                <input id="quantity-{{$product['id']}}" name="quantity" type="text"
                                                    value="{{ $product['quantity']}}">
                                                <span class="inc qtybtn" onclick="onCartItemQuantityChanged('{{$product['id']}}',true)">+</span>
                                            </div>
                                        </div>
                                    </td>"
                                    <td class="shoping__cart__total" id="show_total_quantity_for_each_items-{{$product['id']}}">
                                    {{money_format('%.3n',$product['price'] * $product['quantity'])}}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <button id="add_button_delete"
                                                onclick="removeProductCart({{$product['id']}})"
                                                class="btn btn-danger btn-sm ml-4 float-right">@lang('messages.cart.remove')
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
                <h3>Cart Totals</h3>
                <p class="d-flex">
                    <span>Subtotal</span>
                    <span class="total-cart"></span>
                </p>
                <p class="d-flex">
                    <span>Delivery</span>
                    <span>$0.00</span>
                </p>
                <p class="d-flex">
                    <span>Discount</span>
                    <span>$0.00</span>
                </p>
                <hr>
                <p class="d-flex total-price">
                    <span>Total</span>
                    <span class="total-cart"></span>
                </p>
            </div>
            <p class="text-center"><a href="{{route('checkout')}}" class="check-out btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
        </div>
    </div>
    </div>
</section>
