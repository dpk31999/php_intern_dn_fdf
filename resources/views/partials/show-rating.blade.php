<div class="row justify-content-around">
    <div class="col-sm-3">
        <div class="rating-block">
            <h4>@lang('products.avg_rate')</h4>
            <h2 class="bold padding-bottom-7"><span id="avg_rate">{{ $product->avg_rating }}</span> / 5 (<span id="count_rate">{{ $product->ratings->count() }}</span>)</h2>
        </div>
    </div>
    <div class="col-sm-6">
        <h4>@lang('homepage.rating_break')</h4>
        <div class="pull-left d-flex">
            <div class="pull-left pull-head">
                <div class="pull-in">5 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left pull-body">
                <div class="progress in-progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5"
                        aria-valuemin="0" aria-valuemax="5">
                    </div>
                </div>
            </div>
            <div class="pull-right">{{ $product->getNumbOfRating(5) }}</div>
        </div>
        <div class="pull-left d-flex">
            <div class="pull-left pull-head">
                <div class="pull-in">4 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left pull-body">
                <div class="progress in-progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4"
                        aria-valuemin="0" aria-valuemax="5">
                    </div>
                </div>
            </div>
            <div class="pull-right">{{ $product->getNumbOfRating(4) }}</div>
        </div>
        <div class="pull-left d-flex">
            <div class="pull-left pull-head">
                <div class="pull-in">3 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left pull-body">
                <div class="progress in-progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3"
                        aria-valuemin="0" aria-valuemax="5">
                    </div>
                </div>
            </div>
            <div class="pull-right">{{ $product->getNumbOfRating(3) }}</div>
        </div>
        <div class="pull-left d-flex">
            <div class="pull-left pull-head">
                <div class="pull-in">2 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left pull-body">
                <div class="progress in-progress">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2"
                        aria-valuemin="0" aria-valuemax="5">
                    </div>
                </div>
            </div>
            <div class="pull-right">{{ $product->getNumbOfRating(2) }}</div>
        </div>
        <div class="pull-left d-flex">
            <div class="pull-left pull-head">
                <div class="pull-in">1 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left pull-body">
                <div class="progress in-progress">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1"
                        aria-valuemin="0" aria-valuemax="5">
                    </div>
                </div>
            </div>
            <div class="pull-right">{{ $product->getNumbOfRating(1) }}</div>
        </div>
    </div>
</div>
