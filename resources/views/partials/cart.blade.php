<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    Your Shopping Cart
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-image">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th></th>
                            <th scope="col">Qty</th>
                            <th></th>
                            <th scope="col">Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="list_items">
                        @if (session()->has('cart'))
                            @foreach (session()->get('cart')->items as $product)
                                <tr id="product-{{ $product->id }}">
                                    <td class="w-25">
                                        <img src="/storage/{{ $product->image }}"
                                            class="img-fluid img-thumbnail" alt="Sheep">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td class="pr-0">
                                        <a class="cursor btn-minus-product" data-product-id="{{ $product->id }}"><i class="fas fa-minus"></i></a>
                                    </td>
                                    <td class="qty">
                                        <input disabled type="text" class="form-control pl-1 pr-1" id="qty-{{ $product->id }}" value="{{ $product->quantity }}">
                                    </td>
                                    <td class="pl-0">
                                        <a class="cursor btn-plus-product" data-product-id="{{ $product->id }}""><i class="fas fa-plus"></i></a>
                                    </td>
                                    <td id="total-{{ $product->id }}">{{ $product->price * $product->quantity }}</td>
                                    <td>
                                        <a class="btn btn-danger cursor btn-remove-product" data-product-id="{{ $product->id }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <h5>Total: <span class="price text-success" id="total_price">{{ session()->get('cart')->totalPrice ?? '0' }}</span></h5>
                </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Checkout</button>
            </div>
        </div>
    </div>
</div>
