<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="text-decoration: none;">
      <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Ecommerce-Store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block" style="text-decoration: none">{{ ucfirst(\Auth::guard('admin')->user()->name) ?? '' }}</a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('adminDashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('getadminInfo') }}" class="nav-link {{ Request::segment(1) === 'owndetails' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Admin
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          @php
          $segment1 = Request::segment(1);
          $pages = array('userview', 'edituser');
          @endphp
          <li class="nav-item">
            <a href="{{ route('userview') }}" class="nav-link @if(in_array($segment1, $pages)) active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                User
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          @php
          $segment1 = Request::segment(1);
          $pages = array('categoryview', 'categorycreate','editcategory');
          @endphp
          <li class="nav-item">
            <a href="{{ route('categoryview') }}" class="nav-link @if(in_array($segment1, $pages)) active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Category
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('products') }}" class="nav-link {{ Request::segment(1) === 'products' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Products
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('coupons') }}" class="nav-link {{ Request::segment(1) === 'coupons' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Coupon
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          @php
          $segment1 = Request::segment(1);
          $pages = array('orders', 'orderdetails');
          @endphp
          <li class="nav-item">
            <a href="{{ route('orders') }}" class="nav-link @if(in_array($segment1, $pages)) active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Orders
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('settings.index') }}" class="nav-link {{ Request::segment(1) === 'settings' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Settings
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('adminLogout') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Logout
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
