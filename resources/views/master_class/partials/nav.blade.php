<header>
  <div class="header-area ">
      <div id="sticky-header" class="main-header-area white-bg">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-xl-4 col-lg-4">
                      <div class="logo-img">
                          <a href="{{ URL('/') }}">
                              <img src="img/logo.png" alt="logo" style="width: auto !important; height: auto !important; max-width: 80%;">
                          </a>
                      </div>
                  </div>
                  <div class="col-xl-6 col-lg-6">
                      <div class="main-menu d-none d-lg-block">
                          <nav>
                              <ul id="navigation">
                                  <li><a class="active" href="{{ URL('/') }}">Inicio</a></li>
                                  <li><a href="#">Categorías <i class="ti-angle-down"></i></a>
                                      <ul class="submenu">
                                          <li><a href="{{ URL('/') }}">Maquillaje Profesional</a></li>
                                          <li><a href="{{ URL('/') }}">Imagen y Belleza</a></li>
                                          <li><a href="{{ URL('/') }}">Cursos de Uñas</a></li>
                                          <li><a href="{{ URL('/') }}">Body Paint</a></li>
                                          <li><a href="{{ URL('/') }}">Esthetic Body</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </nav>
                      </div>
                  </div>
                  <div class="col-xl-2 col-lg-2">
                      <div class="quote-area">
                          <div class="search-bar">
                              <a id="search_1" href="javascript:void(0)">
                                <i class="fa fa-search"></i>
                              </a>
                          </div>
                      </div>
                  </div>
                  <div class="col-12">
                      <div class="mobile_menu d-block d-lg-none"></div>
                  </div>
              </div>
              <div class="search_input" id="search_input_box">
                  <div class="container ">
                      <form class="d-flex justify-content-between search-inner">
                          <input type="text" class="form-control" id="search_input" placeholder="Busca cursos de maquillaje...">
                          <button type="submit" class="btn"></button>
                          <span class="fa fa-close" id="close_search" title="Cerrar Búsqueda"></span>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</header>
