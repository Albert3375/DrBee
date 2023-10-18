<!-- START HEADER -->
<header class="header_wrap fixed-top dd_dark_skin transparent_header">
    <div class="light_skin main_menu_uppercase">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a href="{{ URL('/') }}">
                    <img src="{{ asset('img/logo.png') }}" style="width: 250px !important; height: auto !important; max-width: 100%; padding-bottom: 15px; padding-top: 5px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-expanded="false">
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse" style="justify-content: flex-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">

                        <li align="center"> <a class="nav-link active" href="{{ url('/') }}">
                            @lang('menu.home')
                        </a></li>

                       {{--  <li align="center"> <a class="nav-link" href="{{ URL('/express_purchase') }}">
                            @lang('menu.products')

                            @lang('menu.express')
                        </a></li> --}}

                       <li align="center"> <a class="nav-link" href="{{ URL('/products') }}">
                            @lang('menu.products')
                        </a></li> 

                        <!-- <li align="center" class="dropdown">
                            <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                             @lang('menu.products')
                            </a>
                            <div class="dropdown-menu dropdown-reverse">
                                <ul align="center">
                                    @php
                                        $filters = \App\Models\Filter::get();
                                    @endphp
                                    @foreach($filters as $filter)
                                    <li>
                                        <a class="dropdown-item nav-link nav_item" href="{{ route('category_products', $filter->id) }}">
                                           {{$filter->name}}
                                        </a>
                                    </li>
                                    @endforeach
                        
                                </ul>
                            </div>
                        </li> -->

                      <!--     <li align="center"> <a class="nav-link nav_item" href="{{ URL('outlet') }}">
                            Outlet
                        </a></li> -->

                        <li align="center"> <a class="nav-link nav_item" href="{{ URL('contact') }}">
                            @lang('menu.contact')
                        </a></li>


                        @if (Route::has('login'))
                            <li align="center">
                                @auth
                                    <a class="nav-link" href="{{ url('/admin') }}">
                                        @lang('menu.hello') {{ Auth::user()->name }}
                                        <span><i class="linearicons-user"> </i></span>
                                    </a>
                                @else
                                    <a class="nav-link" href="{{ route('login') }}">
                                        @lang('menu.login')
                                    </a>
                                </li>
                                <li align="center">
                                    <!-- @if (Route::has('register'))
                                        <a class="nav-link" href="{{ route('register') }}">
                                            @lang('menu.register')
                                        </a>
                                    @endif -->
                                @endauth
                            </li>
                        @endif
                        @if (isset($cart))
                            <li align="center" class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#"
                                    data-toggle="dropdown"><i style="color: #002b4c;" class="linearicons-cart"></i><span
                                        class="cart_count">{{ $cart->count() }}</span></a>
                                <div class="cart_box dropdown-menu dropdown-menu-right">
                                    <ul class="cart_list">
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($cart as $id => $product)
                                            <li align="center">
                                                @php
                                                    $subtotal = $product->quantity * $product->price;
                                                    $total = $subtotal + $total;
                                                @endphp
                                                <a href="{{ url('removeItemCart/' . $product->product_id) }}" class="item_remove"><i
                                                        class="ion-close"></i></a>
                                                <a href="#"><img src="{{ $product->img }}"
                                                        alt="cart_thumb1">{{ $product->name }}</a>
                                                <span class="cart_quantity">{{ $product->quantity }} x <span
                                                        class="cart_amount" id="subtotal-{{ $id }}"> <span
                                                            class="price_symbole">$</span></span>{{ $subtotal }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="cart_footer">
                                        <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span
                                                    class="price_symbole">$</span>{{ $total }}</span></p>
                                        <p class="cart_buttons"><a href="{{ url('checkout') }}"
                                            class="btn btn-fill-out checkout">@lang('menu.cart')</a></p>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li align="center" class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#"
                                    data-toggle="dropdown"><i class="linearicons-cart"></i><span
                                        class="cart_count">0</span></a>
                            </li>
                        @endif
                        
          <!--       <li align="center">
                        <a class="nav-link" style="font-size: 20px; margin-top: -5px" href="{{url('setLanguage/es')}}">&#127474;&#127485;</a>
                    </li>

                    <li align="center">
                        <a class="nav-link" style="font-size: 20px; margin-top: -5px" href="{{url('setLanguage/en')}}">&#x1F1FA;&#x1F1F8;</a>
                    </li> -->

                    @auth
                    <li align="center">
                         <a class="nav-link" style="font-size: 20px; margin-top: -5px;"href="{{ URL('logout') }}">
                            <i class="linearicons-exit-right"></i>
                          </a>
                    </li>
                    @endauth

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- END HEADER -->
@push('script')
    <script>

    </script>
@endpush
