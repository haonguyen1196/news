@extends('frontend.layouts.master')

@section('content')
    <section class="blog_pages">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="index.html" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> {{ __('frontend.Home') }}</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="index.html" class="breadcrumbs__url">{{ __('frontend.News') }}</a>
                        </li>
                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            World
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="blog_page_search">
                        <form action="{{ route('news') }}" method="get">
                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="text" placeholder="Type here" name="search"
                                        value="{{ request()->search }}">
                                </div>
                                <div class="col-lg-4">
                                    <select name="category">
                                        <option value="">{{ __('frontend.All') }}</option>
                                        @foreach ($categories as $category)
                                            <option @selected($category->slug == request()->category) value="{{ $category->slug }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit">{{ __('frontend.search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <aside class="wrapper__list__article ">
                        @if (request()->has('category'))
                            <h4 class="border_section">{{ __('frontend.Category') }}: {{ request()->category }}</h4>
                        @endif

                        <div class="row" style="width: 100%">
                            @if (count($news) === 0)
                                <h4 style="width: 100%; text-align: center">{{ __('frontend.No news found') }} :(</h4>
                            @else
                                @foreach ($news as $item)
                                    <div class="col-lg-6">
                                        <!-- Post Article -->
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news-details', $item->slug) }}">
                                                    <img src="{{ $item->image }}" alt="" class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <div class="article__category">
                                                    {{ $item->category->name }}
                                                </div>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{ __('frontend.by') }} {{ $item->author->name }}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            {{ date('M d,Y', strtotime($item->created_at)) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news-details', $item->slug) }}">
                                                        {{ truncateText($item->title) }}
                                                    </a>
                                                </h5>
                                                <p>
                                                    {!! truncateText($item->content) !!}
                                                </p>
                                                <a href="{{ route('news-details', $item->slug) }}"
                                                    class="btn btn-outline-primary mb-4 text-capitalize">
                                                    {{ __('frontend.read more') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <!-- Pagination -->
                            <div class="pagination-area"
                                style="width: 100%;
                                display: flex;
                                align-items: center;
                                justify-content: center;">
                                <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s"
                                    style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                                    {{ $news->appends(request()->query())->links() }}

                                </div>
                            </div>
                        </div>

                    </aside>

                </div>
                <div class="col-md-4">
                    <div class="sidebar-sticky">
                        <aside class="wrapper__list__article ">
                            <h4 class="border_section">{{ __('frontend.Sidebar') }}</h4>
                            <div class="wrapper__list__article-small">
                                @foreach ($recentNews as $news)
                                    @if ($loop->index < 3)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news-details', $news->slug) }}">
                                                        <img src="{{ asset($news->image) }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                </div>


                                                <div class="card__post__body ">
                                                    <div class="card__post__content">

                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary">
                                                                        {{ __('frontend.by') }} {{ $news->author->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize">
                                                                        {{ date('M d, Y', strtotime($news->created_at)) }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news-details', $news->slug) }}">
                                                                    {{ truncateText($news->title, 40) }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Post Article -->
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news-details', $news->slug) }}">
                                                    <img src="{{ asset($news->image) }}" alt="" class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <div class="article__category">
                                                    {{ $news->category->name }}
                                                </div>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{ __('frontend.by') }} {{ $news->author->name }}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            {{ date('M d,Y', strtotime($news->created_at)) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news-details', $news->slug) }}">
                                                        {{ truncateText($news->title, 40) }}
                                                    </a>
                                                </h5>
                                                <p>
                                                    {!! truncateText($news->content) !!}
                                                </p>
                                                <a href="{{ route('news-details', $news->slug) }}"
                                                    class="btn btn-outline-primary mb-4 text-capitalize">
                                                    {{ __('frontend.read more') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </aside>

                        <aside class="wrapper__list__article mb-4">
                            <h4 class="border_section">{{ __('frontend.tags') }}</h4>
                            <div class="blog-tags p-0">
                                <ul class="list-inline">
                                    @foreach ($mostCommonTag as $tag)
                                        <li class="list-inline-item">
                                            <a href="{{ route('news', ['tag' => $tag->name]) }}">
                                                #{{ $tag->name }}({{ $tag->news_count }})
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article  mb-4">
                            <h4 class="border_section">{{ __('frontend.newsletter') }}</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>
                                    {{ __('frontend.The most important world news and events of the day.') }}
                                </h6>
                                <p><small>{{ __('frontend.Get magzrenvi daily newsletter on your inbox.') }}</small></p>
                                <form class="news-letter-form">
                                    <div class="input-group ">
                                        <input type="text" class="form-control news-letter-input"
                                            placeholder="{{ __('frontend.Your email address') }}" name="email">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary news-letter-btn"
                                                type="submit">{{ __('frontend.sign up') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </aside>

                        @if ($ads->side_bar_ad_status == 1)
                            <aside class="wrapper__list__article">
                                <h4 class="border_section">{{ __('frontend.Advertise') }}</h4>
                                <a href="{{ $ads->side_bar_ad_url }}" target="blank">
                                    <figure>
                                        <img src="{{ asset($ads->side_bar_ad) }}" alt="" class="img-fluid">
                                    </figure>
                                </a>
                            </aside>
                        @endif
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        @if ($ads->news_page_ad_status == 1)
            <div class="large_add_banner mb-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="large_add_banner_img">
                                <a href="{{ $ads->news_page_ad_url }}" target="blank">
                                    <img src="{{ asset($ads->news_page_ad) }}" alt="adds"
                                        style="height: 350px !important; object-fit: contain">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
