<div class="modal fade" id="favoriteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    @lang('homepage.favorite-product')
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
                            <th scope="col">@lang('products.products')</th>
                            <th scope="col">@lang('products.price')</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="list_favorite">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('checkout.close')</button>
            </div>
        </div>
    </div>
</div>
