@extends('web.partials.master')

@section('title', 'Seleccionar Pago')



@section('content')

    <section class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/13.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Seleccionar Pago</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seleccionar Pago</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="site-section" style="padding-top: 80px; padding-bottom: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    @if (Auth::check())

                        @php
                            $id = Auth::user()->id;
                            $cards = DB::table('user_cards')
                                ->where('user_id', $id)
                                ->latest()
                                ->get();
                        @endphp

                        @if (count($cards) > 0)
                        <div class="table-responsive">
                            <table id="table-cards" class="display">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>Tipo de Tarjeta</th>
                                        <th>Últimos 4 Dígitos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cards as $card)
                                        <tr align="center">
                                            <td>{{ $card->id }}</td>
                                            @if ($card->brand == 'visa')
                                                <td><i class="fa fa-cc-visa"></i> Visa</td>
                                            @elseif($card->brand == 'mastercard')
                                                <td><i class="fa fa-cc-mastercard"></i> Mastercard</td>
                                            @endif
                                            <td>{{ $card->last4 }} </td>
                                            <td>
                                                <ul class="list-inline" style="margin: 0px;">
                                                    <li class="list-inline-item">
                                                        <a style="color:#fff" ; class="btn btn-success btn-sm"
                                                            href="{{ route('card.select_card', $card->id) }}"
                                                            title="{{ trans('Selecccionar Tarjeta') }}">
                                                            Seleccionar Tarjeta <i class="fa fa-check"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @else

                        <div class="form-group row">
                            @include('web.add_card_form')
                        </div>
                        @endif

                    @else

                        <div class="container">
                            <div class="row justify-content-center">

                                <div class="col-md-12" style="margin-top: -60px;">
                                    <h2 class="section-title mb-5" align="center">
                                        Antes de continuar, debes crear una cuenta.
                                    </h2>
                                </div>

                                <div class="col-md-3"></div>

                                <div class="col-md-6">
                                    <div class="card" style="border-radius: 18px; margin-top: 20px;">
                                        <div class="card-header" align="center"
                                            style="background-color: #fff; border-radius: 18px;">
                                            <a href="{{ URL('/') }}">
                                                <img src="{{ asset('img/logo.png') }}" alt="Ladymoon"
                                                    style="width: auto !important; height: auto !important; max-width: 80%;">
                                            </a>
                                            <h4>Crear Cuenta</h4>
                                        </div>

                                        <div class="card-body">
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="name"
                                                        class="col-md-6 col-form-label text-md-center">{{ __('Nombre') }}</label>

                                                    <div class="col-md-6" align="center">
                                                        <input id="name" type="name" class="form-control" name="name"
                                                            required autocomplete="current-name">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="lastname"
                                                        class="col-md-6 col-form-label text-md-center">{{ __('Apellidos') }}</label>

                                                    <div class="col-md-6" align="center">
                                                        <input id="lastname" type="lastname" class="form-control"
                                                            name="lastname" required autocomplete="current-lastname">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="phone"
                                                        class="col-md-6 col-form-label text-md-center">{{ __('Teléfono') }}</label>

                                                    <div class="col-md-6" align="center">
                                                        <input id="phone" type="phone" class="form-control" name="phone"
                                                            required autocomplete="current-phone">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email"
                                                        class="col-md-6 col-form-label text-md-center">{{ __('Correo electrónico') }}</label>

                                                    <div class="col-md-6" align="center">
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email" autofocus>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password"
                                                        class="col-md-6 col-form-label text-md-center">{{ __('Contraseña') }}</label>

                                                    <div class="col-md-6" align="center">
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required autocomplete="current-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="repeatpass"
                                                        class="col-md-6 col-form-label text-md-center">{{ __(' Reptir Contraseña') }}</label>

                                                    <div class="col-md-6" align="center">
                                                        <input id="repeatpass" type="password" class="form-control "
                                                            name="password_confirmation" required
                                                            autocomplete="current-password">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12 offset-md-12" align="center">
                                                        <button type="submit" class="btn btn-md btn-danger">
                                                            Registrarse
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3"></div>

                                <div class="col-md-12" style="margin-top: 30px; margin-bottom: 30px;">
                                    <h2 class="section-title mb-5" align="center">
                                        O si ya tienes una cuenta, inicia sesión.
                                    </h2>
                                </div>

                                <div class="col-md-3"></div>

                                <div class="container" style="margin-top: 160px;">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="card" style="border-radius: 18px;">
                                                <div class="card-header" align="center"
                                                    style="background-color: #fff; border-radius: 18px;">
                                                    <a href="{{ URL('/') }}">
                                                        <img src="{{ asset('img/logo.png') }}" alt="Ladymoon"
                                                            style="width: auto !important; height: auto !important; max-width: 80%;">
                                                    </a>
                                                    <h4>Iniciar Sesión</h4>
                                                </div>

                                                <div class="card-body">
                                                    <form method="POST" action="{{ route('login') }}">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="email"
                                                                class="col-md-6 col-form-label text-md-center">{{ __('Correo electrónico') }}</label>

                                                            <div class="col-md-6" align="center">
                                                                <input id="email" type="email"
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    name="email" value="{{ old('email') }}" required
                                                                    autocomplete="email" autofocus>

                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="password"
                                                                class="col-md-6 col-form-label text-md-center">{{ __('Contraseña') }}</label>

                                                            <div class="col-md-6" align="center">
                                                                <input id="password" type="password"
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    name="password" required
                                                                    autocomplete="current-password">

                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-12 offset-md-12" align="center">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="remember" id="remember"
                                                                        {{ old('remember') ? 'checked' : '' }}>

                                                                    <label class="form-check-label" for="remember">
                                                                        {{ __('Recordarme') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-12 offset-md-12" align="center">
                                                                <button type="submit" class="btn btn-md btn-danger">
                                                                    Iniciar Sesión
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3"></div>

                                <div class="col-md-12"></div>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js">
        </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"> </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"> </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"> </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"> </script>
        <script>
            @if (App::isLocale('es'))
                $('#table-cards').DataTable({
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                "responsive": false,
                "bSort": false
                });
            @else
                $('#table-cards').DataTable({
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                },
                "responsive": false,
                "bSort": false
                });
            @endif
        </script>

        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
    @endpush

@endsection
