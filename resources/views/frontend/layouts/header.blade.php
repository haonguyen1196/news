<header class="bg-light">
    <!-- Navbar  Top-->
    <div class="topbar d-none d-sm-block">
        <div class="container ">
            <div class="row">
                <div class="col-sm-6 col-md-8">
                    <div class="topbar-left topbar-right d-flex">

                        <ul class="topbar-sosmed p-0">
                            @foreach ($socialLinks as $socialLink)
                                <li>
                                    <a href="{{ $socialLink->url }}" target="blank"><i
                                            class="{{ $socialLink->icon }}"></i></a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="topbar-text">
                            @php
                                use Carbon\Carbon;
                                Carbon::setLocale(config('app.locale'));
                                $date = Carbon::now();
                            @endphp
                            {{ $date->translatedFormat('l, F j, Y') }}
                        </div>
                    </div>
                </div>
                @php
                    $langs = \App\Models\Language::where('status', 1)->latest()->get();
                    $featureCategories = \App\Models\Category::where([
                        'status' => 1,
                        'show_at_nav' => 1,
                        'lang' => getLanguage(),
                    ])->get();
                    $categories = \App\Models\Category::where([
                        'status' => 1,
                        'show_at_nav' => 0,
                        'lang' => getLanguage(),
                    ])->get();
                @endphp
                <div class="col-sm-6 col-md-4">
                    <div class="list-unstyled topbar-right d-flex align-items-center justify-content-end">
                        <div class="topbar_language">
                            <select class="site_language">
                                @foreach ($langs as $lang)
                                    <option @selected(getLanguage() == $lang->lang) value="{{ $lang->lang }}">{{ $lang->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <ul class="topbar-link">
                            @if (!auth()->check())
                                <li><a href="{{ route('login') }}">{{ __('frontend.Login') }}</a></li>
                                <li><a href="{{ route('register') }}">{{ __('frontend.Register') }}</a></li>
                            @else
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <li style="cursor: pointer">
                                        <a
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            {{ __('frontend.Logout') }}
                                        </a>
                                    </li>
                                </form>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Top  -->


    <!-- Navbar  -->
    <!-- Navbar menu  -->
    <div class="navigation-wrap navigation-shadow bg-white">
        <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
            <div class="container">
                <div class="offcanvas-header">
                    <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                        <span class="navbar-toggler-icon"></span>
                    </div>
                </div>
                <figure class="mb-0 mx-auto">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset($setting['site_logo']) }}" alt="" class="img-fluid logo">
                    </a>
                </figure>

                <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
                    <ul class="navbar-nav ml-auto ">

                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">{{ __('frontend.home') }}</a>
                        </li>
                        @foreach ($featureCategories as $category)
                            <li class="nav-item">
                                <a class="nav-link active"
                                    href="{{ route('news', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach

                        @if (count($categories) > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    {{ __('frontend.More') }} </a>
                                <ul class="dropdown-menu animate fade-up">
                                    @foreach ($categories as $category)
                                        <li><a class="dropdown-item"
                                                href="{{ route('news', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                    @endforeach
                                </ul>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('about') }}"> {{ __('frontend.about') }} </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">
                                {{ __('frontend.contact') }}
                            </a>
                        </li>
                    </ul>


                    <!-- Search bar.// -->
                    <ul class="navbar-nav ">
                        <li class="nav-item search hidden-xs hidden-sm "> <a class="nav-link" href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Search content bar.// -->
                    <div class="top-search navigation-shadow">
                        <div class="container">
                            <div class="input-group ">
                                <form action="{{ route('news') }}" method="get">

                                    <div class="row no-gutters mt-3">
                                        <div class="col">
                                            <input class="form-control border-secondary border-right-0 rounded-0"
                                                type="search" value=""
                                                placeholder="{{ __('frontend.Search') }} " id="example-search-input4"
                                                name="search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit"
                                                class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Search content bar.// -->
                </div> <!-- navbar-collapse.// -->
            </div>
        </nav>
    </div>
    <!-- End Navbar menu  -->


    <!-- Navbar sidebar menu  -->
    <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="widget__form-search-bar  ">
                        <form action="{{ route('news') }}" method="get">
                            <div class="row no-gutters">
                                <div class="col">
                                    <input name="search" class="form-control border-secondary border-right-0 rounded-0"
                                        value="" placeholder="{{ __('frontend.Search') }}">
                                </div>
                                <div class="col-auto">
                                    <button type="submit"
                                        class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="list-group list-group-flush">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link active text-dark" href="{{ route('home') }}">
                                    {{ __('frontend.Home') }}</a>
                            </li>
                            @foreach ($featureCategories as $category)
                                <li class="nav-item">
                                    <a class="nav-link text-dark"
                                        href="{{ route('news', ['category' => $category->slug]) }}">{{ $category->name }}
                                    </a>
                                </li>
                            @endforeach

                            @if (count($categories) > 0)
                                <li class="nav-item">
                                    <a class="nav-link active dropdown-toggle  text-dark" href="#"
                                        data-toggle="dropdown">{{ __('frontend.More') }} </a>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        @foreach ($categories as $category)
                                            <li><a class="dropdown-item"
                                                    href="{{ route('news', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('about') }}">
                                    {{ __('frontend.About') }}
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link  text-dark" href="{{ route('contact') }}">
                                    {{ __('frontend.Contact') }} </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="modal-footer">
                    <p>© 2020 <a href="https://websolutionus.com/.com">WebSolutionUS</a>
                        -
                        Premium template news, blog & magazine &amp;
                        magazine theme by <a href="https://websolutionus.com/.com">websolutionus.com</a></p>
                </div>
            </div>
        </div>
    </div>
</header>
