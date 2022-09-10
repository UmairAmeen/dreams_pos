<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <li>
          <a href="{{route('home')}}">
            <img src="{{asset('theme/assets/img/icons/dashboard.svg')}}" alt="img">
            <span> Dashboard </span>
          </a>
        </li>

        @can('view-product', User::class)
        <li class="submenu">
          <a href="javascript:void(0);">
            <img src="{{asset('theme/assets/img/icons/product.svg')}}" alt="img">
            <span> Product</span>
            <span class="menu-arrow"></span>
          </a>
          <ul>
            <li>
              <a href="{{route('product.index')}}">Product List</a>
            </li>
            <li>
              <a href="{{route('product.create')}}">Add Product</a>
            </li>
          </ul>
        </li>
        @endcan

        <li class="submenu">
          <a href="javascript:void(0);">
            <img src="{{asset('theme/assets/img/icons/sales1.svg')}}" alt="img">
            <span> Orders </span>
            <span class="menu-arrow"></span>
          </a>
          <ul>
            <li>
              <a href="{{route('order.index')}}">View</a>
            </li>
            <li>
              <a href="{{route('order.create')}}">Create</a>
            </li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);">
            <img src="{{asset('theme/assets/img/icons/purchase1.svg')}}" alt="img">
            <span> Customer </span>
            <span class="menu-arrow"></span>
          </a>
          <ul>
            <li>
              <a href="{{route('customer.index')}}">View</a>
            </li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);">
            <img src="{{asset('theme/assets/img/icons/expense1.svg')}}" alt="img">
            <span> User </span>
            <span class="menu-arrow"></span>
          </a>
          <ul>
            <li>
              <a href="{{route('user.index')}}">View</a>
            </li>
            <li>
              <a href="{{route('user.create')}}">Create</a>
            </li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);">
            <img src="{{asset('theme/assets/img/icons/quotation1.svg')}}" alt="img">
            <span> Roles </span>
            <span class="menu-arrow"></span>
          </a>
          <ul>
            <li>
              <a href="{{route('role.index')}}">View</a>
            </li>
            <li>
              <a href="{{route('role.create')}}">Create</a>
            </li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);">
            <img src="{{asset('theme/assets/img/icons/transfer1.svg')}}" alt="img">
            <span> Permissions </span>
            <span class="menu-arrow"></span>
          </a>
          <ul>
            <li>
              <a href="{{route('permission.index')}}">Create</a>
            </li>
            <li>
              <a href="{{route('permission.create')}}">View</a>
            </li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);">
            <img src="{{asset('theme/assets/img/icons/return1.svg')}}" alt="img">
            <span>Category</span>
            <span class="menu-arrow"></span>
          </a>
          <ul>
            <li>
              <a href="{{route('category.index')}}">View</a>
            </li>
            <li>
              <a href="{{route('category.create')}}">Create</a>
            </li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);">
            <img src="{{asset('theme/assets/img/icons/users1.svg')}}" alt="img">
            <span> Brands </span>
            <span class="menu-arrow"></span>
          </a>
          <ul>
            <li>
              <a href="{{route('brand.index')}}">View</a>
            </li>
            <li>
              <a href="{{route('brand.create')}}">Create</a>
            </li>
          </ul>
        </li>
    </ul>
    </div>
  </div>
</div>
