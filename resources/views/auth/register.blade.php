@extends('web.partials.master')

@section('title', 'Regístrate')

@section('content')
    <!-- END MAIN CONTENT -->
    <div class="main_content"><br><br><br>
        <!-- START LOGIN SECTION -->
        <div class="login_register_wrap section" style="background-image: url('{{ asset("images/login-bg.jpg") }}');height: 100%;background-position: center;
            background-repeat: no-repeat;
            background-size: cover;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-md-10">
                        <div class="login_wrap">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                   <center> <h3>@lang('login.register')</h3></center>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('login.name')</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">@lang('login.email')</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">Teléfono</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">@lang('login.password')</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" maxlength="6" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('login.confirm')</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" maxlength="6" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-fill-out btn-block">
                                                @lang('login.register_button')
                                            </button>
                                        </div>
                                    </div>
                                </form>


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
