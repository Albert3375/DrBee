@extends('web.partials.master')

@section('title', 'Login')

@section('content')
    <!-- END MAIN CONTENT -->
    <div class="main_content">
        <!-- START LOGIN SECTION -->
        <div class="login_register_wrap section" style="background-image: url('{{ asset("/backgrounds/one_bg.jpg") }}');  height: auto; background-position: center;
            background-repeat: no-repeat;
            background-size: cover;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6" align="center">
                        <div class="card" style="margin-top: 50px; border-radius: 28px;">
                            <div class="padding_eight_all bg-white"  style="border-radius: 28px;">
                                 <div class="col-md-12" align="center">
                                    <a href="{{ URL('/') }}">
                                        <img src="{{ asset('img/logo.png') }}" style="width: auto !important; height: auto !important; max-width: 75%; padding-bottom: 15px; padding-top: 5px">
                                    </a>
                                </div>
                                <div class="heading_s1">
                                    <h3 align="center">Iniciar Sesión</h3>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" required="" class="form-control @error('email') is-invalid @enderror" name="email" placeholder=@lang('login.email') required autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" class="form-control @error('password') is-invalid @enderror"  type="password"  required autocomplete="current-password" name="password" placeholder=@lang('login.password')>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="login_footer form-group text-center">
                                        <a href="{{ route('password.request')}}">¿Olvidaste tu contraseña?</a>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md btn-fill-out btn-block" name="login">Iniciar Sesión</button>
                                    </div>
                                </form>

                                <!-- <div class="form-note text-center">@lang('login.no_account')<a href="{{ url('register')}}">@lang('login.register_now')</a></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END LOGIN SECTION -->
    </div>

@push('script')
<script>

</script>
@endpush

@endsection
