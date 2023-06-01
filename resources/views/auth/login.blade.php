@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
                <div class="col-lg-6 mx-auto">
                    <div class="auto-form-wrapper">
                        <div class="card">
                            <div class="card-header">Account Login</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="label">Email</label>
                                        <div class="input-group">
                                            <input id="email" type="email" placeholder="E-mail Address"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label">Password</label>
                                        <div class="input-group">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="**********" required
                                                autocomplete="current-password">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary submit-btn btn-block">
                                            {{ __('Login') }}
                                        </button>

                                    </div>

                                    <div class="text-block text-center my-3">
                                        <span class="text-small font-weight-semibold">Don't Have an Account ?</span>
                                        <a href="{{ route('register') }}" class="text-black text-small">Create New
                                            Account</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@endsection