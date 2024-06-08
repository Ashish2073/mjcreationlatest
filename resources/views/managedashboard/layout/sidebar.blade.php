<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/customer/customer.html">
                <i class="ti-pie-chart menu-icon"></i>
                <span class="menu-title">Customers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/vendors/vendor.html">
                <i class="ti-star menu-icon"></i>
                <span class="menu-title">Vendors</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ Route::is('vendors-addproduct') ? 'active' : '' }}"
                @if (!Route::is('vendors-addproduct')) wire:navigate  href="{{ route('vendors-addproduct') }}" @else href="javascript:void(0)" @endif>
                <i class="ti-star menu-icon"></i>
                <span class="menu-title">Products</span>
            </a>
        </li> --}}
        <li class="nav-item">

            <a class="nav-link {{ Route::is('bulk.import') ? 'active' : '' }}"
                @if (!Route::is('bulk.import')) wire:navigate  href="{{ route('bulk.import') }}" @else href="javascript:void(0)" @endif>
                <i class="ti-star menu-icon"></i>
                <span class="menu-title">Bulk import Data</span>
            </a>
        </li>

        <li class="nav-item">

            <a class="nav-link {{ Route::is('vendors.productlist') ? 'active' : '' }}"
                @if (!Route::is('vendors.productlist')) wire:navigate  href="{{ route('vendors.productlist') }}" @else href="javascript:void(0)" @endif>
                <i class="ti-package menu-icon"></i>
                <span class="menu-title">Product List</span>
            </a>
        </li>
        {{-- vendors/productlist --}}
        {{-- <li class="nav-item">

            <a class="nav-link {{ Route::is('product.discount') ? 'active' : '' }}"
                @if (!Route::is('product.discount')) wire:navigate  href="{{ route('product.discount') }}" @else href="javascript:void(0)" @endif>
                <i class="ti-star menu-icon"></i>
                <span class="menu-title">Products Discount</span>
            </a>
        </li> --}}

        <li class="nav-item">

            <a class="nav-link {{ Route::is('product.discountlist') ? 'active' : '' }}"
                @if (!Route::is('product.discountlist')) wire:navigate  href="{{ route('product.discountlist') }}" @else href="javascript:void(0)" @endif>
                <i class="ti-gift menu-icon"></i>
                <span class="menu-title"> Discount </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <i class="ti-pie-chart menu-icon"></i>
                <span class="menu-title">Charts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <i class="ti-view-list-alt menu-icon"></i>
                <span class="menu-title">Tables</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/icons/themify.html">
                <i class="ti-star menu-icon"></i>
                <span class="menu-title">Icons</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                {{-- <i class="ti-user menu-icon"></i> vendorlist --}}
                <i class="menu-icon"><img src="{{ asset('fontawesome/vendor.png') }}" width="30px" height="20px"
                        style="filter:opacity(0.5)" alt="vendorimage" /></i>
                <span class="menu-title">Vendors</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">


                        <a class="nav-link {{ Route::is('vendors.list') ? 'active' : '' }}"
                            @if (!Route::is('vendors.list')) wire:navigate  href="{{ route('vendors.list') }}" @else href="javascript:void(0)" @endif>
                            <i class="ti-user menu-icon"></i>
                            <span class="menu-title"> Vendors </span>
                        </a>





                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('vendors.commision') ? 'active' : '' }}"
                            @if (!Route::is('vendors.commision')) wire:navigate  href="{{ route('vendors.commision') }}" @else href="javascript:void(0)" @endif>
                            <i class="ti-hand-drag menu-icon"></i>
                            <span class="menu-title">Commison </span>
                        </a>





                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('vendors.orderlist') ? 'active' : '' }}"
                            @if (!Route::is('vendors.orderlist')) wire:navigate  href="{{ route('vendors.orderlist') }}" @else href="javascript:void(0)" @endif>
                            <i class="ti-list menu-icon"></i>
                            <span class="menu-title">Orders List</span>
                        </a>





                    </li>


                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
                <i class="ti-write menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>
