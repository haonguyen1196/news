<section class="pt-0 mt-5">
    <div class="popular__section-news">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="wrapper__list__article">
                        <h4 class="border_section">{{ __('frontend.recent post') }}</h4>
                    </div>
                    <div class="row ">
                        @foreach ($recentNews as $recent)
                            @if ($loop->index <= 1)
                                <div class="col-sm-12 col-md-6 mb-4">
                                    <!-- Post Article -->
                                    <div class="card__post ">
                                        <div class="card__post__body card__post__transition">
                                            <a href="{{ route('news-details', $recent->slug) }}">
                                                <img src="{{ asset($recent->image) }}" class="img-fluid" alt="">
                                            </a>
                                            <div class="card__post__content bg__post-cover">
                                                <div class="card__post__category">
                                                    {{ $recent->category->name }}
                                                </div>
                                                <div class="card__post__title">
                                                    <h5>
                                                        <a href="{{ route('news-details', $recent->slug) }}">
                                                            {{ truncateText($recent->title) }}
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div class="card__post__author-info">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('news-details', $recent->slug) }}">
                                                                {{ __('frontend.by') }} {{ $recent->author->name }}
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                {{ date('M d, Y', strtotime($recent->created_at)) }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row ">
                        <div class="col-sm-12 col-md-6">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentNews as $recent)
                                    @if ($loop->index > 1 && $loop->index <= 3)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news-details', $recent->slug) }}">
                                                        <img src="{{ asset($recent->image) }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                </div>


                                                <div class="card__post__body ">
                                                    <div class="card__post__content">

                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary">
                                                                        {{ __('frontend.by') }}
                                                                        {{ $recent->author->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize">
                                                                        {{ date('M d, Y', strtotime($recent->created)) }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news-details', $recent->slug) }}">
                                                                    {{ truncateText($recent->title) }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 ">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentNews as $recent)
                                    @if ($loop->index > 3 && $loop->index <= 5)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news-details', $recent->slug) }}">
                                                        <img src="{{ asset($recent->image) }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                </div>

                                                <div class="card__post__body ">
                                                    <div class="card__post__content">

                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary">
                                                                        {{ __('frontend.by') }}
                                                                        {{ $recent->author->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize">
                                                                        {{ date('M d, Y', $recent->created) }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news-details', $recent->slug) }}">
                                                                    {{ truncateText($recent->title, 50) }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 col-lg-4">
                    <aside class="wrapper__list__article">
                        <h4 class="border_section">{{ __('frontend.popular post') }}</h4>
                        <div class="wrapper__list-number">

                            <!-- List Article -->
                            @foreach ($popularNews as $popular)
                                <div class="card__post__list">
                                    <div class="list-number">
                                        <span>
                                            {{ ++$loop->index }}
                                        </span>
                                    </div>
                                    <a href="#" class="category">
                                        {{ $popular->category->name }}
                                    </a>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <h5>
                                                <a href="{{ route('news-details', $popular->slug) }}">
                                                    {{ truncateText($popular->title, 40) }}
                                                </a>
                                            </h5>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach


                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- Post news carousel -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{ @$categorySectionOnes->first()->category->name }}</h4>
                </aside>
            </div>
            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @foreach ($categorySectionOnes as $news)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{ route('news-details', $news->slug) }}">
                                        <img src="{{ asset($news->image) }}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="article__content">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary">
                                                {{ __('frontend.by') }} {{ $news->author->name }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>
                                                {{ date('M d, Y', strtotime($news->created_at)) }}
                                            </span>
                                        </li>

                                    </ul>
                                    <h5>
                                        <a href="{{ route('news-details', $news->slug) }}">
                                            {{ truncateText($news->title, 30) }}
                                        </a>
                                    </h5>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End Popular news category -->

    <!-- Post news carousel -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{ @$categorySectionTwos->first()->category->name }}</h4>
                </aside>
            </div>
            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @foreach ($categorySectionTwos as $news)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{ route('news-details', $news->slug) }}">
                                        <img src="{{ asset($news->image) }}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="article__content">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary">
                                                {{ __('frontend.by') }} {{ $news->author->name }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>
                                                {{ date('M d, Y', strtotime($news->created_at)) }}
                                            </span>
                                        </li>

                                    </ul>
                                    <h5>
                                        <a href="{{ route('news-details', $news->slug) }}">
                                            {{ truncateText($news->title, 30) }}
                                        </a>
                                    </h5>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End Popular news category -->


    <!-- Popular news category -->
    <div class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <aside class="wrapper__list__article mb-0">
                        <h4 class="border_section">{{ @$categorySectionThrees->first()->category->name }}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                @foreach (@$categorySectionThrees as $news)
                                    @if ($loop->index <= 2)
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="{{ route('news-details', $news->slug) }}">
                                                        <img src="{{ asset($news->image) }}" alt=""
                                                            class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                {{ __('frontend.by') }} {{ $news->author->name }}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                {{ date('M d, Y', strtotime($news->created_at)) }}
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="{{ route('news-details', $news->slug) }}">
                                                            {{ truncateText($news->title) }}
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <div class="col-md-6">
                                @foreach (@$categorySectionThrees as $news)
                                    @if ($loop->index > 2 && $loop->index <= 5)
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="{{ route('news-details', $news->slug) }}">
                                                        <img src="{{ asset($news->image) }}" alt=""
                                                            class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                {{ __('frontend.by') }} {{ $news->author->name }}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                {{ date('M d, Y', strtotime($news->created_at)) }}
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="{{ route('news-details', $news->slug) }}">
                                                            {{ truncateText($news->title) }}
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </aside>

                    @if ($ads->home_middle_bar_ad_status == 1)
                        <div class="small_add_banner">
                            <div class="small_add_banner_img">
                                <a href="{{ $ads->home_middle_bar_ad_url }}" target="blank">
                                    <img src="{{ asset($ads->home_middle_bar_ad) }}" alt="adds"
                                        style="height: 250px !important; object-fit: contain">
                                </a>
                            </div>
                        </div>
                    @endif

                    <aside class="wrapper__list__article mt-5">
                        <h4 class="border_section">{{ $categorySectionFours->first()->category->name }}</h4>

                        <div class="wrapp__list__article-responsive">
                            @foreach ($categorySectionFours as $news)
                                <!-- Post Article List -->
                                <div class="card__post card__post-list card__post__transition mt-30">
                                    <div class="row ">
                                        <div class="col-md-5">
                                            <div class="card__post__transition">
                                                <a href="{{ route('news-details', $news->slug) }}">
                                                    <img src="{{ asset($news->image) }}" class="img-fluid w-100"
                                                        alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 my-auto pl-0">
                                            <div class="card__post__body ">
                                                <div class="card__post__content  ">
                                                    <div class="card__post__category ">
                                                        {{ $news->category->name }}
                                                    </div>
                                                    <div class="card__post__author-info mb-2">
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
                                                    </div>
                                                    <div class="card__post__title">
                                                        <h5>
                                                            <a href="{{ route('news-details', $news->slug) }}">
                                                                {{ truncateText($news->title) }}
                                                            </a>
                                                        </h5>
                                                        <p class="d-none d-lg-block d-xl-block mb-0">
                                                            {!! truncateText($news->content, 160) !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                </div>

                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">
                                {{ __('frontend.Most Viewed') }}
                            </h4>
                            <div class="wrapper__list__article-small">

                                <!-- Post Article -->
                                @foreach ($mostViewed as $news)
                                    @if ($loop->index === 0)
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news-details', $news->slug) }}">
                                                    <img src="{{ asset($news->image) }}" alt=""
                                                        class="img-fluid">
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
                                                            {{ date('M d, Y', strtotime($news->created_at)) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news-details', $news->slug) }}">
                                                        {{ truncateText($news->title) }}
                                                    </a>
                                                </h5>
                                                <p>
                                                    {!! truncateText($news->content, 160) !!}
                                                </p>
                                                <a href="{{ route('news-details', $news->slug) }}"
                                                    class="btn btn-outline-primary mb-4 text-capitalize">
                                                    {{ __('frontend.read more') }}
                                                </a>
                                            </div>
                                        </div>
                                    @else
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
                                                                        {{ __('frontend.by') }}
                                                                        {{ $news->author->name }}
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
                                                                    {{ truncateText($news->title) }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('frontend.stay conected') }}</h4>
                            <!-- widget Social media -->
                            <div class="wrap__social__media">
                                @foreach ($socialCounts as $social)
                                    <a href="{{ $social->url }}" target="_blank">
                                        <div class="social__media__widget"
                                            style="background-color: {{ $social->color }}">
                                            <span class="social__media__widget-icon" style="text-align: center">
                                                <i class="{{ $social->icon }}" style="line-height: 32px"></i>
                                            </span>
                                            <span class="social__media__widget-counter" style="line-height: 32px">
                                                {{ $social->fan_count }} {{ $social->fan_type }}
                                            </span>
                                            <span class="social__media__widget-name">
                                                {{ $social->button_text }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
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

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('frontend.newsletter') }}</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>
                                    {{ __('frontend.The most important world news and events of the day.') }}
                                </h6>
                                <p><small>{{ __('frontend.Get magzrenvi daily newsletter on your inbox.') }}</small>
                                </p>
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
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
