@extends('frontend.layouts.master')

@section('content')
    <!-- Tranding news  carousel-->
    @include('frontend.home-components.breaking-news')
    <!-- End Tranding news carousel -->

    <!-- hero slider news -->
    @include('frontend.home-components.hero-slider')
    <!-- End hero slider news -->

    @if ($ads->home_top_bar_ad_status == 1)
        <div class="large_add_banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="large_add_banner_img">
                            <a href="{{ $ads->home_top_bar_ad_url }}" target="blank">
                                <img src="{{ asset($ads->home_top_bar_ad) }}" alt="adds"
                                    style="object-fit: contain; height: 350px !important">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Popular news category -->
    @include('frontend.home-components.main-news')
    <!-- End Popular news category -->
@endsection
