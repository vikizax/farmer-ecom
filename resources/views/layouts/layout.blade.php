<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Welcome</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- custom css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- fontawsome icons -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}"/>

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
          rel="stylesheet"/>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.css">


    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/main.js') }}" defer></script>

</head>
<script type="text/javascript">
    $(document).ready(function () {
        $(".wish-icon i").click(function () {
            $(this).toggleClass("fa-heart fa-heart-o");
        });
    });

    $(document).ready(function () {
        $("#customer-slider").owlCarousel({
            items: 1,
            itemsDesktop: [1000, 2],
            itemsDesktopSmall: [979, 1],
            itemsTablet: [768, 1],
            pagination: false,
            navigation: true,

            slideSpeed: 1000,
            singleItem: true,
            transitionStyle: "goDown",
            navigationText: ["", ""],
            autoPlay: false
        });
    });
    $(document).ready(function () {

        // Define the menu we are working with
        var menu = $('.navbar.navapply');

        // Get the menus current offset
        var origOffsetY = menu.offset().top;

        /**
         * scroll
         * Perform our menu mod
         */
        function scroll() {

            // Check the menus offset.
            if ($(window).scrollTop() >= origOffsetY) {

                //If it is indeed beyond the offset, affix it to the top.
                $(menu).addClass('fixed-top');

            }
            if ($(window).scrollTop() == origOffsetY) {

                // Otherwise, un affix it.
                $(menu).removeClass('fixed-top');

            }
        }

        // Anytime the document is scrolled act on it
        document.onscroll = scroll;

    });
</script>

<body class={{ Request::is('login', 'register') ? 'signupBody' : ''  }}>
<div class={{ Request::is('account') ? '' : 'wrapper'  }}>
    @unless (Request::is('login', 'register'))
        <header>
            <nav
                class="navbar navbar-expand-lg navbar-light p-3 bg-nav bg-light shadow-sm navapply">
                <div class="container">
                    <a class="navbar-brand text-success" href="{{route('home')}}"><strong>VEG&FRUITS</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <div class="search d-flex justify-content-center">
                                    <input type="text" placeholder="Search.."
                                           class="form-control my-2 my-md-2 my-lg-0" id="searchInput"/>
                                    <button class="btn btn-outline-success my-2 my-md-2 my-lg-0" id="searchInputButton">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="nav-item mr-4">
                                <a class="nav-link" href="{{url('/')}}">Home</a>
                            </li>

                            @guest
                                <li class="nav-item mr-4 dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Shop
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                        <a class="dropdown-item" href="{{route('product.index', 'All')}}">Products</a>
                                    </div>
                                </li>
                                {{--                            <li class="nav-item mr-4">--}}
                                {{--                                <a class="nav-link" href="#">Contact</a>--}}
                                {{--                            </li>--}}
                                <li class="nav-item mr-4">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>

                                @if (Route::has('register'))
                                    <li class="nav-item mr-4">
                                        <a class="nav-link" href="{{ route('register') }}">Signup</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item mr-4 dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Shop
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                        <a class="dropdown-item" href="{{route('product.index', 'All')}}">Products</a>
                                        <a class="dropdown-item" href="{{route('cart.index')}}">Cart</a>
                                        <a class="dropdown-item" href="{{route('wishlist.index')}}">Wishlist</a>
                                    </div>
                                </li>
                                <li class="nav-item mr-4 dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Account
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                        <a class="dropdown-item"
                                           href="{{ route('setting.index', 'account') }}">Settings</a>
                                        @if (Auth::user() && Auth::user()->isAdmin())
                                            <a class="dropdown-item" href="{{ route('admin.index', 'approveSeller') }}">Admin
                                                Dashboard</a>
                                        @endif
                                        @if (Auth::user() && Auth::user()->isSeller())
                                            <a class="dropdown-item"
                                               href="{{ route('sellerDash.index' , 'productAnalysis') }}">Seller
                                                Dashboard</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        @if (Auth::user() && Auth::user()->isUser())
                                            <a class="dropdown-item" href="{{ route('seller.index') }}">
                                                Register as Seller
                                            </a>
                                        @endif
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>

                            @endguest


                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    @endunless
    <main>
        @include('flash-message')
        {{-- main content --}}
        @yield('content')
    </main>
</div>

@unless (Request::is('login', 'register', 'setting/account', 'setting/orderHistory'))
    {{--    <footer>--}}
    {{--        Copyrigth 2020 Pizza House--}}
    {{--    </footer>--}}

@endunless

@if(Request::is('/'))
    <footer class="footer">
        <!-- Footer Top -->
        <div class="footer-top section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">

                            <p class="text1">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, magna
                                eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor,
                                facilisis luctus, metus.</p>
                            <p class="call">Got Question? Call us 24/7<span><a
                                        href="tel:123456789">+0123 456 789</a></span></p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Faq</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Customer Service</h4>
                            <ul>
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="#">Money-back</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer social">
                            <h4>Get In Tuch</h4>
                            <!-- Single Widget -->
                            <div class="contact">
                                <ul>
                                    <li>NO. 342 - London Oxford Street.</li>
                                    <li>012 United Kingdom.</li>
                                    <li>info@eshop.com</li>
                                    <li>+032 3456 7890</li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-flickr"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <div class="copyright">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            @copyRight
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="right">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endif

</body>

</html>
