<div class="row justify-content-around">
    <div class="col-sm-3">
        <div class="rating-block">
            <h4>@lang('products.avg-rate')</h4>
            <h2 class="bold padding-bottom-7"><span id="avg_rate">{{ $product->avg_rating }}</span> / 5 (<span id="count_rate">{{ $product->ratings->count() }}</span>)</h2>
        </div>
    </div>
    <div class="col-sm-6">
        <h4>@lang('homepage.rating-break')</h4>
        <div class="pull-left d-flex">
            <div class="pull-left" style="width:35px; line-height:1;">
                <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left" style="width:180px;">
                <div class="progress" style="height:9px; margin:8px 0;">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5"
                        aria-valuemin="0" aria-valuemax="5" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="pull-right" style="margin-left:10px;">{{ $product->getNumbOfRating(5) }}</div>
        </div>
        <div class="pull-left d-flex">
            <div class="pull-left" style="width:35px; line-height:1;">
                <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left" style="width:180px;">
                <div class="progress" style="height:9px; margin:8px 0;">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4"
                        aria-valuemin="0" aria-valuemax="5" style="width: 80%">
                    </div>
                </div>
            </div>
            <div class="pull-right" style="margin-left:10px;">{{ $product->getNumbOfRating(4) }}</div>
        </div>
        <div class="pull-left d-flex">
            <div class="pull-left" style="width:35px; line-height:1;">
                <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left" style="width:180px;">
                <div class="progress" style="height:9px; margin:8px 0;">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3"
                        aria-valuemin="0" aria-valuemax="5" style="width: 60%">
                    </div>
                </div>
            </div>
            <div class="pull-right" style="margin-left:10px;">{{ $product->getNumbOfRating(3) }}</div>
        </div>
        <div class="pull-left d-flex">
            <div class="pull-left" style="width:35px; line-height:1;">
                <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left" style="width:180px;">
                <div class="progress" style="height:9px; margin:8px 0;">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2"
                        aria-valuemin="0" aria-valuemax="5" style="width: 40%">
                    </div>
                </div>
            </div>
            <div class="pull-right" style="margin-left:10px;">{{ $product->getNumbOfRating(2) }}</div>
        </div>
        <div class="pull-left d-flex">
            <div class="pull-left" style="width:35px; line-height:1;">
                <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left" style="width:180px;">
                <div class="progress" style="height:9px; margin:8px 0;">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1"
                        aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                    </div>
                </div>
            </div>
            <div class="pull-right" style="margin-left:10px;">{{ $product->getNumbOfRating(1) }}</div>
        </div>
    </div>
</div>
