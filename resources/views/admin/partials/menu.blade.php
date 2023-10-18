    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">@lang('menu.menu')</li>
                @if (Auth::user()->hasRole('admin'))

                    <li class="nav-item">
                        <a href="{{ URL('/admin') }}" class="nav-link">
                            <i class="nav-icon icon-speedometer"></i> Dashboard
                        </a>
                    </li>

                      <li class="nav-item">
                        <a href="{{ route('admin.users.edit', auth()->user()->id) }}" class="nav-link">
                            <i class="nav-icon fas fa-user-edit"></i> @lang('menu.edit_profile')
                        </a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <!-- <i class="nav-icon fas fa-users"></i> @lang('menu.users')</a>  -->
                            <i class="nav-icon fas fa-users"></i> Clientes</a>
                        <ul class="nav-dropdown-items">
                           <!--  <li class="nav-item">
                                <a href="{{ route('admin.users.edit', auth()->user()->id) }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-edit"></i> @lang('menu.edit_profile')
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a href="{{ URL('admin/users') }}" class="nav-link">
                                    <i class="nav-icon fas fa-arrow-right"></i> @lang('menu.manage')
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="nav-item">
                        <a href="{{ route('admin.discount.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-percent"></i> @lang('menu.discount')
                        </a>
                    </li> -->

                    <li>
                        <a href="{{ URL('admin/products') }}" class="nav-link">
                            <i class="nav-icon fas fa-dolly-flatbed"></i> @lang('menu.products')
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ URL('admin/categories') }}" class="nav-link">
                            <i class="nav-icon fas fas fa-tag"></i> @lang('menu.categories')
                        </a>
                    </li>

                     <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="nav-icon fa fa-file"></i> @lang('menu.orders')</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{ URL('admin/orders') }}" class="nav-link">
                                    <i class="nav-icon fa fa-file"></i> @lang('menu.guests_orders')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/orders_users') }}" class="nav-link">
                                    <i class="nav-icon fa fa-file"></i> Pedidos de Clientes
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="nav-item">
                        <a href="{{ URL('admin/coupons') }}" class="nav-link">
                            <i class="nav-icon fa fa-gift"></i> Cupones
                        </a>
                    </li>
<!-- 
                     <li class="nav-item">
                        <a href="{{ URL('admin/users_report') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i> Usuarios
                        </a>
                    </li> -->

                  <!--   <li class="nav-item">
                        <a href="{{ URL('admin/filters') }}" class="nav-link">
                            <i class="nav-icon fa fa-filter"></i> Filtros
                        </a>
                    </li> -->

                  <!--  <li class="nav-item">
                        <a href="{{ URL('admin/promotions') }}" class="nav-link">
                            <i class="nav-icon fa fa-warning"></i> Promociones
                        </a>
                    </li> -->
<!-- 
                    <li class="nav-item">
                        <a href="{{ URL('admin/indexRules') }}" class="nav-link">
                            <i class="nav-icon fa fa-dollar"></i> @lang('menu.rules')
                        </a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="nav-icon fas fa-layer-group"></i> @lang('menu.accounts')</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{ route('admin.bank_accounts.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-university"></i> @lang('menu.banks')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.references.index') }}" class="nav-link">
                                    <i class="nav-icon fab fa-cc-visa"></i> @lang('menu.references')
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="nav-icon fa fa-warehouse"></i>@lang('menu.storage')</a>
                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a href="{{ URL('admin/warehouse_control') }}" class="nav-link">
                                        <i class="nav-icon fa fa-list"></i> @lang('menu.storage_control')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL('admin/warehouse_pendings') }}" class="nav-link">
                                        <i class="nav-icon fa fa-clock-o"></i> @lang('menu.pendings')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL('admin/warehouse_history') }}" class="nav-link">
                                        <i class="nav-icon fas fa-history"></i> @lang('menu.storage_history')
                                    </a>
                                </li>
                            </ul>
                    </li> -->

                   <!--  <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="nav-icon fa fa-bar-chart"></i>@lang('menu.reports')</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{ URL('admin/reports') }}" class="nav-link">
                                    <i class="nav-icon fa fa-dropbox"></i> Productos
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ URL('admin/users_report') }}" class="nav-link">
                                    <i class="nav-icon fa fa-users"></i> Usuarios
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ URL('admin/reporterPurchases') }}" class="nav-link">
                                    <i class="nav-icon fa fa-bar-chart"></i> @lang('menu.clients_purchases')
                                </a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a href="{{ URL('admin/reporterClientPurchases') }}" class="nav-link">
                                    <i class="nav-icon fa fa-bar-chart"></i> @lang('menu.by_client')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/reporterDaySales') }}" class="nav-link">
                                    <i class="nav-icon fa fa-bar-chart"></i> @lang('menu.close_day')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/reporterMonthSales') }}" class="nav-link">
                                    <i class="nav-icon fa fa-bar-chart"></i> @lang('menu.monthly_sales')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL('admin/reporterFilterSales') }}" class="nav-link">
                                    <i class="nav-icon fa fa-bar-chart"></i> @lang('menu.filter_sales')
                                </a>
                            </li> --}}
                        </ul>
                    </li> -->

                   <!--  <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                          <i class="nav-icon fas fa-book-open"></i> @lang('menu.guides')</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a  href="{{ URL('admin/guides') }}" class="nav-link">
                                  <i class="nav-icon fas fa-book-reader"></i> @lang('menu.guides_control')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{ URL('admin/estafeta') }}"  class="nav-link">
                                  <i class="nav-icon fas fa-history"></i> @lang('menu.guides_history')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a  href="#" class="nav-link">
                                  <i class="nav-icon fas fa-book-reader"></i> @lang('menu.orders_overweigth')
                                </a>
                            </li>
                        </ul>
                    </li> -->
<!-- 
                    {{-- <li class="nav-item">
                        <a href="{{ URL('admin/paypal') }}" class="nav-link">
                            <i class="nav-icon fab fa-paypal"></i>PayPal
                        </a>
                    </li> --}}
 -->
                @elseif(Auth::user()->hasRole('manager'))

                @elseif(Auth::user()->hasRole('warehouse'))

              <!--   <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="nav-icon fa fa-warehouse"></i>@lang('menu.storage')</a>
                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a href="{{ URL('admin/warehouse_control') }}" class="nav-link">
                                        <i class="nav-icon fa fa-list"></i> @lang('menu.storage_control')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL('admin/warehouse_pendings') }}" class="nav-link">
                                        <i class="nav-icon fa fa-clock-o"></i> @lang('menu.pendings')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL('admin/warehouse_history') }}" class="nav-link">
                                        <i class="nav-icon fas fa-history"></i> @lang('menu.storage_history')
                                    </a>
                                </li>
                            </ul>
                    </li> -->

                @elseif(Auth::user()->hasRole('user'))

                    <li class="nav-item">
                        <a  href="{{ URL('/admin') }}" class="nav-link">
                          <i class="nav-icon icon-speedometer"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.users.edit', auth()->user()->id) }}" class="nav-link">
                            <i class="nav-icon fas fa-user-edit"></i> @lang('menu.my_account')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ URL('admin/orders') }}" class="nav-link">
                            <i class="nav-icon fa fa-file"></i> @lang('menu.my_orders')
                        </a>
                    </li>

                  <!--  {{--  <li class="nav-item">
                        <a href="{{ route('admin.adresses.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-map-marker"></i> @lang('menu.addresses')
                        </a>
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a href="{{ route('admin.payments.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-credit-card"></i> @lang('menu.cards')
                        </a>
                    </li> --}} -->
                @endif
            </ul>
        </nav>
    </div>
