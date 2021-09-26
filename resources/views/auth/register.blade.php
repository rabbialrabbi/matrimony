@extends('admin.layouts.auth-layout')
@section('title','Register')

@push('style')
    <style>
        i {
            position: absolute;
            top: 10px;
            right: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="login-box m-auto">
        <div class="login-logo">
            <h4><b>Matrimony | Register</b> </h4>
        </div>
        <!-- /.login-logo -->
        <div class="card vCard">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Register here</p>

                <form method="POST" id="registerForm" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" autocomplete="current-password" placeholder="First Name">
                                <i class="fas fa-user formIcon" ></i>
                                @error('name')
                                <span class="text-danger float-right" role="alert">
                                        {{$errors->first('name')}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" autocomplete="current-password" placeholder="Email">
                                <i class="fas fa-envelope formIcon"></i>
                                @error('email')
                                <span class="text-danger float-right" role="alert">
                                        {{$errors->first('email')}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                <i class="fas fa-lock formIcon"></i>
                                @error('password')
                                <span class="text-danger float-right" role="alert">
                                        {{$errors->first('password')}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                <i class="fas fa-lock formIcon"></i>
                                @error('password_confirmation')
                                <span class="text-danger float-right" role="alert">
                                        {{$errors->first('password_confirmation')}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-check-label" for="remember">
                                <a href="{{ route('login') }}" class="btn-link">Log in</a>
                            </label>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-sm btn-block vBtn">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
