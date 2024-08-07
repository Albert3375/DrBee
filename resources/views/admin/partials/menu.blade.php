<style>
  /* Estilo del menú */
  .sidebar {
    background-color: #002B4D;
    width: 250px;
    position: fixed;
    height: 100%;
    color: #fff;
    padding-top: 20px;
  }

  .sidebar ul.nav {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .sidebar li.nav-title {
    font-family: 'Century Gothic', cursive;
    font-size: 24px;
  }

  .sidebar li.nav-item {
    padding: 10px 0;
  }

  .sidebar a.nav-link {
    color: #fff;
    text-decoration: none;
    font-family: 'Century Gothic', cursive;
    font-size: 16px;
    transition: background-color 0.2s, color 0.2s; /* Transición de color de fondo y texto */
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 5px;
  }

  .sidebar a.nav-link:hover {
    background-color: #FFA500; /* Cambiar el fondo a naranja al pasar el mouse */
    color: #fff; /* Cambiar el color del texto a blanco al pasar el mouse */
  }

  .nav-icon {
    margin-right: 10px;
  }

  /* Estilo para elementos desplegables */
  .nav-dropdown-toggle::after {
    content: "\f107";
    float: right;
    margin-left: 10px;
  }

  .nav-dropdown-toggle.collapsed::after {
    content: "\f105";
  }


  .nav-dropdown-toggle.collapsed + ul.nav-dropdown-items {
    display: block;
  }

  /* Animaciones */
  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
      transform: translateY(0);
    }
    40% {
      transform: translateY(-20px);
    }
    60% {
      transform: translateY(-10px);
    }
  }
</style>

    
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
                        <a href="{{ route('admin.users.perfil', auth()->user()->id) }}" class="nav-link">
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

                @elseif(Auth::user()->hasRole('user'))

                    <li class="nav-item">
                        <a  href="{{ URL('/admin') }}" class="nav-link">
                          <i class="nav-icon icon-speedometer"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.users.perfil', auth()->user()->id) }}" class="nav-link">
                            <i class="nav-icon fas fa-user-edit"></i> @lang('menu.my_account')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ URL('admin/orders') }}" class="nav-link">
                            <i class="nav-icon fa fa-file"></i> @lang('menu.my_orders')
                        </a>
                    </li>

                @endif
            </ul>
        </nav>
    </div>
