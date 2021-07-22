<div class="modal fade" id="modalForgotPass" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalForgotPass">@lang('auth.login')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span class="alert alert success" role="alert" id="message">
                    <strong></strong>
                </span>
                <form method="POST" id="forgotPassForm">
                    @csrf

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">@lang('homepage.email-address')</label>

                        <div class="col-md-6">
                            <input id="emailInputForgot" type="email" class="form-control"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            <span class="invalid-feedback" role="alert" id="emailErrorForgot">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                @lang('auth.send-email')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
