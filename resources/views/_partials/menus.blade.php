@php
    $routeActive = Route::currentRouteName();
    $roleUser = Auth::user()->role;
@endphp

<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="ni ni-tv-2 text-primary"></i>
        <span class="nav-link-text">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
        <i class="fas fa-users text-warning"></i>
        <span class="nav-link-text">Users</span>
    </a>
</li>
@if ($roleUser != 'rnd')
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'products.index' ? 'active' : '' }}" href="{{ route('products.index') }}">
            <i class="fas fa-building text-danger"></i>
            <span class="nav-link-text">Data Produk</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'colors.index' ? 'active' : '' }}" href="{{ route('colors.index') }}">
            <i class="fas fa-building text-dark"></i>
            <span class="nav-link-text">Data Warna Produk</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'vendors.index' ? 'active' : '' }}" href="{{ route('vendors.index') }}">
            <i class="fas fa-users text-primary"></i>
            <span class="nav-link-text">Data Vendors</span>
        </a>
    </li>
@endif
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'stocks.index' ? 'active' : '' }}" href="{{ route('stocks.index') }}">
        <i class="fas fa-building text-danger"></i>
        <span class="nav-link-text">Data Stok Produk</span>
    </a>
</li>
@if ($roleUser != 'rnd')
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'stocks-in.index' ? 'active' : '' }}"
            href="{{ route('stocks-in.index') }}">
            <i class="fas fa-building text-primary"></i>
            <span class="nav-link-text">Data Produk Masuk</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'stocks-out.index' ? 'active' : '' }}"
            href="{{ route('stocks-out.index') }}">
            <i class="fas fa-building text-danger"></i>
            <span class="nav-link-text">Data Produk Keluar</span>
        </a>
    </li>
@endif
@if ($roleUser == 'admin')
    <li class="nav-item">
        <a class="nav-link" target="_blank"
            href="https://drive.google.com/file/d/1NVd0psbuQX0aEKxCiCt7lBsWH9rJJ5hj/view?usp=drive_link">
            <i class="fas fa-file text-danger"></i>
            <span class="nav-link-text">Manual Book Admin</span>
        </a>
    </li>
@elseif ($roleUser == 'gudang')
    <li class="nav-item">
        <a class="nav-link" target="_blank"
            href="https://drive.google.com/file/d/1aVFaCtJs6ilWGrjYgwAdEYWTRYazBWpl/view?usp=drive_link">
            <i class="fas fa-file text-danger"></i>
            <span class="nav-link-text">Manual Book Gudang</span>
        </a>
    </li>
@elseif ($roleUser == 'rnd')
    <li class="nav-item">
        <a class="nav-link" target="_blank"
            href="https://drive.google.com/file/d/1IECvEWIP1iGRdNLW7zZYAHjGDvKpea8O/view?usp=drive_link">
            <i class="fas fa-file text-danger"></i>
            <span class="nav-link-text">Manual Book R&D</span>
        </a>
    </li>
@elseif ($roleUser == 'ceo')
    <li class="nav-item">
        <a class="nav-link" target="_blank"
            href="https://drive.google.com/file/d/1MeCiiIoSLdtujXxxYltTjDKudK2doczc/view?usp=drive_link">
            <i class="fas fa-file text-danger"></i>
            <span class="nav-link-text">Manual Book CEO</span>
        </a>
    </li>
@endif
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
        <i class="fas fa-user-tie text-success"></i>
        <span class="nav-link-text">Profile</span>
    </a>
</li>
