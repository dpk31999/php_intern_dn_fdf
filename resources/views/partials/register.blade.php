<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="registerModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegister">@lang('homepage.register')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="registerForm">
                    @csrf

                    <div class="form-group row">
                        <label for="nameInput" class="col-md-4 col-form-label text-md-right">@lang('auth.name')</label>

                        <div class="col-md-6">
                            <input id="nameInput" type="text" class="form-control" name="name"
                                value="{{ old('name') }}" autocomplete="name" autofocus>

                            <span class="invalid-feedback" role="alert" id="nameError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="emailInput"
                            class="col-md-4 col-form-label text-md-right">@lang('homepage.email-address')</label>

                        <div class="col-md-6">
                            <input id="emailInput" type="email" class="form-control" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            <span class="invalid-feedback" role="alert" id="emailError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="passwordInput"
                            class="col-md-4 col-form-label text-md-right">@lang('auth.password')</label>

                        <div class="col-md-6">
                            <input id="passwordInput" type="password" class="form-control" name="password" required
                                autocomplete="new-password">

                            <span class="invalid-feedback" role="alert" id="passwordError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">@lang('auth.password-confirm')</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                @lang('homepage.register')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
