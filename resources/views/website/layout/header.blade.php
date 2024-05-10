<section class="h-top">
    <div class="container">
        <div class="row">
            <div class="top-content">
                <div class="col-lg-8">
                    <div class="wel-header">
                        <span>Welcome Visitor!</span>
                        <span>Contact with us</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="top-right">
                        <div class="dropdown top-dropdown">
                            <button class="btn dropdown-toggle tog-btn" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                English
                            </button>
                            <ul class="dropdown-menu top-dropdown-menu">
                                <li><a class="dropdown-item" href="#">Hindi</a></li>
                                <li><a class="dropdown-item" href="#">Hibru</a></li>
                            </ul>
                        </div>
                        <div class="top-media">
                            <span><i class="fa fa-instagram"></i></span>
                            <span><i class="fa fa-facebook-f"></i></span>
                            <span><i class="fa fa-twitter-square"></i></span>
                            <span><i class="fa fa-linkedin"></i></span>
                        </div>
                        <div class="log-sign">
                            @if (request()->segment(2) == 'home')
                                <a href="{{ route('users-login') }}" style="color:white">profile</a>
                            @else
                                <a href="{{ route('users-login') }}" style="color:white">Login</a>/Signup
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row py-2">
            <div class="col-lg-3">
                <img src="{{ asset('img/logo.png') }}" class="img-fluid logo" /><span class="title">Mj Creation</span>
            </div>
            <div class="col-lg-9 mt-3">
                <div class="m-item account">
                    <div class="mx-3 deliver-text">
                        <span>Deliver to <i class="fa fa-map-marker"></i>
                            <b>Noida, up</b></span>
                    </div>
                    <div class="search-container mx-3 search">
                        <input type="text" class="search-input" placeholder="Search..." />
                        <!-- <i class="fa fa-search"></i> -->
                    </div>
                    <div class="whish mx-3">
                        <i class="fa fa-heart-o mx-2"></i>
                        <i class="fa fa-shopping-cart mx-2"></i>
                        <span>Cart</span>
                        <span>
                            <div class="dropdown nav-dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    My Account
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Login</a></li>
                                    <li>
                                        <a class="dropdown-item" href="#">Refund & Exchange</a>
                                    </li>
                                </ul>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="menu-bg">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Category
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">BUY1 GET 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">POOJA SAMAGRI LIST</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">JADI BOOTI</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">GEMS STONE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">PERFUMES</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">MASALA & DESSERTS</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</section>
