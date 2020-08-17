  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <img src="/img/logo/logo1.jpg" alt="_blank" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Admin Panel</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="/img/user/man-default.png" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">
                    @auth
                    {{auth()->user()->name}}
                    @endauth
                    </a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item">
                      <a href="{{route('Reports')}}" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Reports
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('brand.list')}}" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Marcas
                        </p>
                        <span class="right badge badge-success ">+</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('model.list')}}" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Modelos
                        </p>
                        <span class="right badge badge-success ">+</span>
                    </a>
                </li>
                  <li class="nav-item">
                    <a href="{{route('car.list')}}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Cars List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('car.calendar')}}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Calendar
                        </p>
                    </a>
                </li>
              </ul>
          </nav>
      </div>
  </aside>
