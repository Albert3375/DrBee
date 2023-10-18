@extends('web.partials.master')

@section('title', 'reset')

@section('content')
    <!-- END MAIN CONTENT -->
    <div class="main_content">
        <!-- START LOGIN SECTION -->
        <div class="login_register_wrap section" style="background-image: url('{{ asset("images/login-bg.jpg") }}');height: 100%;background-position: center;
            background-repeat: no-repeat;
            background-size: cover;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-md-10">
                        <div class="login_wrap">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                   <center> <h3>@lang('login.reset')</h3></center>
                                </div>
                                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('login.email')</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-fill-out btn-block">
                                {{ __('Envíar Correo ') }}
                            </button>
                        </div>
                    </form>


                                <div class="form-note text-center">@lang('login.no_account') <a href="{{ url('register')}}">@lang('login.register_now')</a></div>
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
