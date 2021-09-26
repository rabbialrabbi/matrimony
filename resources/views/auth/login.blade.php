@extends('admin.layouts.auth-layout')
@section('content')
    @if(isset($msg))
        <div class="alert alert-danger" role="alert">

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{$msg}}
        </div>
    @endif
    <div class="login-logo ">
        <a href=""><b>Matrimony </b>| Login </a>
    </div>

    <div class="card vCard">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Log in Here</p>

            <form method="POST" id="loginForm" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="superadmin@mail.com" autocomplete="email" autofocus>
                            <i class="fas fa-envelope icon envelopIcon"></i>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <input id="password" type="password" value="12345678"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   autocomplete="current-password">
                            <i class="fa fa-eye passwordIconEye" id="loginPasswordEye"></i>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-4">

                        <button type="submit" class="btn btn-primary btn-sm btn-block">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <div class="col-12">
{{--                        @if (Route::has('password.request'))--}}
{{--                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                {{ __('Forgot Your Password?') }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
                            <a class="btn btn-link" href="{{ route('register') }}">
                                Or Register
                            </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('push-script')

    <script>
        //email validation check
        $.validator.addMethod("emailCheck",
            function (value, element) {
                return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
            },
        );


        $(document).ready(function () {
            $('#loginPasswordEye').click(function () {

                if($('#password').prop('type') == 'password'){
                    $('#password').prop('type', 'text');
                }else{
                    $('#password').prop('type', 'password');
                }
            });


            //Login Form Validation
            $('#loginForm').validate({
                rules: {
                    email: {
                        required: true,
                        emailCheck: true,

                    },
                    password: {
                        required: true,
                    },

                },
                messages: {

                    email: {
                        required: "Please enter email",
                        emailCheck: "Please enter valid email"
                    },
                    password: {
                        required: "Please enter your password",
                    },

                },

            });

        });
    </script>

@endpush
