@if ($order->status == config('app.status_order.pending'))
    <h2>@lang('homepage.thank_mail')</h2>
    <p>Hi <b>{{ $order->user->fullname }}</b></p>
    <h5>@lang('homepage.your_product_bought') </h5>
    @foreach ($order->orderDetails as $product)
        <div>{{$product->name}} , @lang('products.price') {{$product->price}} x {{$product->pivot->quantity}}</div>
        <br>
    @endforeach
    <h3>@lang('checkout.total') : {{ $order->total_price }} $</h3>
@elseif ($order->status == config('app.status_order.done'))
    <h2>@lang('homepage.thank_mail')</h2>
    <h4>@lang('homepage.your_order_done')</h4>
@else
    <h2>@lang('homepage.thank_mail')</h2>
    <h4>@lang('homepage.your_order_cancel')</h4>
@endif
