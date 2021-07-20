<div class="row justify-content-around">
    <div class="col-sm-3">
        <div class="rating-block">
            <h4>@lang('products.avg_rate')</h4>
            <h2 class="bold padding-bottom-7"><span id="avg_rate">{{ $product->avg_rating }}</span> / 5 (<span id="count_rate">{{ $product->ratings->count() }}</span>)</h2>
        </div>
    </div>
    <div class="col-sm-6">
        <h4>@lang('homepage.rating_break')</h4>
        @for ($i = 5; $i > 0; $i--)
            <div class="pull-left d-flex">
                <div class="pull-left star-style">
                    <div >{{ $i }} <span class="glyphicon glyphicon-star"></span></div>
                </div>
                <div class="pull-left star-header">
                    <div class="progress">
                        @switch($i)
                            @case(5)
                                <div class="progress-bar cursor progress-bar-success bg-success" role="progressbar" data-product-id="{{ $product->id }}" data-num-rate="{{ $i }}" aria-valuenow="{{ $i }} "aria-valuemin="0" aria-valuemax="5"></div>
                                @break
                            @case(4)
                                <div class="progress-bar cursor progress-bar-primary bg-primary" role="progressbar" data-product-id="{{ $product->id }}" data-num-rate="{{ $i }}" aria-valuenow="{{ $i }} "aria-valuemin="0" aria-valuemax="5"></div>
                                @break
                            @case(3)
                                <div class="progress-bar cursor progress-bar-info bg-info" role="progressbar" data-product-id="{{ $product->id }}" data-num-rate="{{ $i }}" aria-valuenow="{{ $i }} "aria-valuemin="0" aria-valuemax="5"></div>
                                @break
                            @case(2)
                                <div class="progress-bar cursor progress-bar-warning bg-warning" role="progressbar" data-product-id="{{ $product->id }}" data-num-rate="{{ $i }}" aria-valuenow="{{ $i }} "aria-valuemin="0" aria-valuemax="5"></div>
                                @break
                            @case(1)
                                <div class="progress-bar cursor progress-bar-danger bg-danger" role="progressbar" data-product-id="{{ $product->id }}" data-num-rate="{{ $i }}" aria-valuenow="{{ $i }} "aria-valuemin="0" aria-valuemax="5"></div>
                                @break
                        @endswitch
                    </div>
                </div>
                <div class="pull-right ml-2">{{ $product->getNumbOfRating($i) }}</div>
            </div>
        @endfor
    </div>
</div>
