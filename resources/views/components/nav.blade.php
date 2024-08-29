<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">Agro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('welcome')}}">Home</a></li>
                @if(!Auth::check())
                <li class="nav-item"><a class="nav-link" href="#product">Produk</a></li>
                @endif
                @if (Auth::check() && Auth::user()->hasRole('user'))
                <li class="nav-item"><a class="nav-link" href="{{route('product.index')}}">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('order.index')}}">Riwayat</a></li>
                @endif
                @if (Auth::check() && Auth::user()->hasRole('seller'))
                    <li class="nav-item"><a class="nav-link" href="{{route('order.list')}}">Daftar Pesanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('product.index')}}">Produk Saya</a></li>
                @endif
                @if (Auth::check() && Auth::user()->hasRole('admin'))
                    <li class="nav-item"><a class="nav-link" href="{{route('admin.user')}}">Kelola Pengguna</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('admin.orderlist')}}">Daftar Pesanan</a></li>
                @endif

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">All Products</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                    </ul>
                </li> --}}
            </ul>
            <div class="d-flex">
                @if(Auth::check())
                    <div class="dropdown">
                        <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-person-circle me-1"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                   Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light">
                        <i class="bi-door-open-fill me-1"></i>
                        Login
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
