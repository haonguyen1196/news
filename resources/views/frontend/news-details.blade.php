@extends('frontend.layouts.master')

<!-- setting meta -->
@section('title', $news->title)
@section('meta_description', $news->meta_description)
@section('meta_og_title', $news->meta_title)
@section('meta_og_description', $news->meta_description)
@section('meta_og_image', asset($news->image))
@section('meta_tw_title', $news->meta_title)
@section('meta_tw_description', $news->meta_description)
@section('meta_tw_image', asset($news->image))
<!-- end setting meta -->

@section('content')
    <section class="pb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- breaddcrumb -->
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="{{ route('home') }}" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> {{ __('frontend.Home') }}</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="javascript:;" class="breadcrumbs__url">{{ __('frontend.News') }}</a>
                        </li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
                <div class="col-md-8">
                    <!-- content article detail -->
                    <!-- Article Detail -->
                    <div class="wrap__article-detail">
                        <div class="wrap__article-detail-title">
                            <h1>
                                {{ $news->title }}
                            </h1>
                        </div>
                        <hr>
                        <div class="wrap__article-detail-info">
                            <ul class="list-inline d-flex flex-wrap justify-content-start">
                                <li class="list-inline-item">
                                    {{ __('frontend.By') }}
                                    <a href="#">
                                        {{ $news->author->name }},
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1">
                                        {{ date('M d, Y', strtotime($news->created)) }}
                                    </span>
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize">
                                        {{ __('frontend.in') }}
                                    </span>
                                    <a href="#">
                                        {{ $news->category->name }}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="wrap__article-detail-image mt-4">
                            <figure>
                                <img src="{{ asset($news->image) }}" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="wrap__article-detail-content">
                            <div class="total-views">
                                <div class="total-views-read">
                                    {{ convertToKFormat($news->view) }}
                                    <span>
                                        {{ __('frontend.views') }}
                                    </span>
                                </div>

                                <!-- share bài viết tới các mxh-->
                                <ul class="list-inline">
                                    <span class="share">{{ __('frontend.share on') }}:</span>
                                    <li class="list-inline-item">
                                        <a target="blank" class="btn btn-social-o facebook"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}
">
                                            <i class="fa fa-facebook-f"></i>
                                            <span>facebook</span>
                                        </a>

                                    </li>
                                    <li class="list-inline-item">
                                        <a target="blank" class="btn btn-social-o twitter" href="https://twitter.com/intent/tweet?text={{ $news->title }}&url={{ url()->current() }}
">
                                            <i class="fa fa-twitter"></i>
                                            <span>twitter</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a target="blank" class="btn btn-social-o whatsapp" href="https://wa.me/?text={{ $news->title }}%20{{ url()->current() }}">
                                            <i class="fa fa-whatsapp"></i>
                                            <span>whatsapp</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a target="blank" class="btn btn-social-o telegram" href="https://t.me/share/url?url={{{ url()->current() }}}&text={{{ $news->title }}}">
                                            <i class="fa fa-telegram"></i>
                                            <span>telegram</span>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a target="blank" class="btn btn-linkedin-o linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $news->title }}">
                                            <i class="fa fa-linkedin"></i>
                                            <span>linkedin</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <p class="has-drop-cap-fluid">
                                {!! $news->content !!}
                            </p>

                            <!-- Blockquote  -->
                            {{-- <blockquote class="block-quote">
                                <p>
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at
                                    its layout.
                                </p>
                                <cite>
                                    Tom Cruise
                                </cite>
                            </blockquote> --}}
                            <!-- Blockquote -->

{{--
                            <h5>How Tech Startup Survive Without Funding</h5>
                            <p>
                                Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the
                                blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics,
                                a large language
                                ocean. A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.
                            </p> --}}
                        </div>


                    </div>
                    <!-- end content article detail -->

                    <!-- tags -->
                    <!-- News Tags -->
                    <div class="blog-tags">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <i class="fa fa-tags">
                                </i>
                            </li>
                            @foreach ($news->tags as $tag)
                                <li class="list-inline-item">
                                    <a href="javascript:;">
                                        {{ $tag->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- end tags-->

                    <!-- authors-->
                    <!-- Profile author -->
                    <div class="wrap__profile">
                        <div class="wrap__profile-author" style="width: 100%">
                            <figure>
                                <img src="{{ asset($news->author->image) }}" alt=""
                                    class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover">
                            </figure>
                            <div class="wrap__profile-author-detail">
                                <div class="wrap__profile-author-detail-name">{{ __('frontend.author') }}</div>
                                <h4>{{ $news->author->name }}</h4>

                            </div>
                        </div>
                    </div>
                    <!-- end author-->

                    <!-- Comment  -->
                    @auth
                        <div id="comments" class="comments-area">
                            <h3 class="comments-title">{{ __('frontend.Comments') }}:</h3>

                            <ol class="comment-list">
                                @foreach ($news->comments->whereNull('parent_id') as $comment)
                                    <li class="comment">
                                        <aside class="comment-body">
                                            <div class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img src="{{ asset('frontend/assets/images/avatar.png') }}" class="avatar"
                                                        alt="image">
                                                    <b class="fn">{{ $comment->user->name }}</b>
                                                    <span class="says">{{ __('frontend.says') }}:</span>
                                                </div>

                                                <div class="comment-metadata">
                                                    <a href="#">
                                                        <span>
                                                            {{ date('M d, Y H:i A', strtotime($comment->created_at)) }}
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="comment-content">
                                                <p>
                                                    {{ $comment->comment }}
                                                </p>
                                            </div>

                                            <div class="reply">
                                                <a href="#" class="comment-reply-link" data-toggle="modal"
                                                    data-target="#exampleModal-{{ $comment->id }}">{{ __('frontend.Reply') }}</a>
                                                @if (auth()->id() == $comment->user_id)
                                                    <span class="delete-cmt" data-id="{{ $comment->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                @endif
                                            </div>
                                        </aside>
                                        @if ($comment->replays->count() > 0)
                                            <ol class="children">
                                                @foreach ($comment->replays as $replay)
                                                    <li class="comment">
                                                        <aside class="comment-body">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <img src="{{ asset('frontend/assets/images/avatar.png') }}"
                                                                        class="avatar" alt="image">
                                                                    <b class="fn">{{ $replay->user->name }}</b>
                                                                    <span class="says">{{ __('frontend.says') }}:</span>
                                                                </div>

                                                                <div class="comment-metadata">
                                                                    <a href="#">
                                                                        <span>
                                                                            {{ date('M d, Y H:i A', strtotime($comment->created_at)) }}
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="comment-content">
                                                                <p>
                                                                    {{ $replay->comment }}
                                                                </p>
                                                            </div>

                                                            <div class="reply">
                                                                <a href="#" class="comment-reply-link"
                                                                    data-toggle="modal"
                                                                    data-target="#exampleModal-{{ $comment->id }}">{{ __('frontend.Reply') }}</a>
                                                                @if (auth()->id() == 2)
                                                                    <span class="delete-cmt" data-id="{{ $replay->id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </aside>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    </li>

                                    <!-- Modal -->
                                    <div class="comment_modal">
                                        <div class="modal fade" id="exampleModal-{{ $comment->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ __('frontend.Write Your Comment') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('news-comment-replay') }}" method="POST">
                                                            @csrf
                                                            <textarea name="comment" cols="30" rows="7" placeholder="{{ __('frontend.Type') }}. . ."></textarea>
                                                            <input name="news_id" type="hidden"
                                                                value="{{ $news->id }}">
                                                            <input name="parent_id" type="hidden"
                                                                value="{{ $comment->id }}">
                                                            <button type="submit">{{ __('frontend.submit') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </ol>

                            <div class="comment-respond">
                                <h3 class="comment-reply-title">{{ __('frontend.Leave a Reply') }}</h3>

                                <form class="comment-form" action="{{ route('news-comment') }}" method="POST">
                                    @csrf
                                    <p class="comment-notes">
                                        <span id="email-notes">{{ __('frontend.Your email address will not be published.') }}</span>
                                        {{ __('frontend.Required fields are marked') }}
                                        <span class="required">*</span>
                                    </p>
                                    <p class="comment-form-comment">
                                        <label for="comment">{{ __('frontend.Comment') }}</label>
                                        <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                        <input name="news_id" type="hidden" value="{{ $news->id }}">
                                        <input name="parent_id" type="hidden" value="">
                                    </p>
                                    <p class="form-submit mb-0">
                                        <input type="submit" name="submit" id="submit" class="submit"
                                            value="{{ __('frontend.Post Comment') }}">
                                    </p>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="card my-5">
                            <div class="card-body">
                                <h4 class="p-0 m-0">{{ __('frontend.Please') }} <a
                                        href="{{ route('login') }}">{{ __('frontend.login') }}</a>
                                    {{ __('frontend.to comment in the post!') }}
                                </h4>
                            </div>
                        </div>
                    @endauth

                    <!-- end comment -->



                    <div class="row">
                        @if ($prevNews)
                            <div class="col-md-6">
                                <div class="single_navigation-prev">
                                    <a href="{{ route('news-details', $prevNews->slug) }}">
                                        <span>{{ __('frontend.previous post') }}</span>
                                        {{ truncateText($prevNews->title) }}
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if ($nextNews)
                            <div class="col-md-6">
                                <div class="single_navigation-next text-left text-md-right">
                                    <a href="{{ route('news-details', $nextNews->slug) }}">
                                        <span>{{ __('frontend.next post') }}</span>
                                        {{ truncateText($nextNews->title) }}
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>

                    @if ($ads->views_page_ad_status == 1)
                        <div class="small_add_banner mb-5 pb-4">
                            <div class="small_add_banner_img">
                                <a href="{{ $ads->views_page_ad_url }}" target="blank">
                                    <img src="{{ asset($ads->views_page_ad) }}" alt="adds" style="height: 250px !important; object-fit: contain">
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="clearfix"></div>

                    <div class="related-article">
                        <h4>
                            {{ __('frontend.you may also like') }}
                        </h4>

                        <div class="article__entry-carousel-three">
                            @if ($relatedNews->count() > 0)

                                @foreach ($relatedNews as $related)
                                    <div class="item">
                                        <!-- Post Article -->
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news-details', $related->slug) }}">
                                                    <img src="{{ asset($related->image) }}" alt=""
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{ __('frontend.by') }} {{ $related->author->name }}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span>
                                                            {{ date('M d, y', strtotime($related->created)) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news-details', $related->slug) }}">
                                                        {{ truncateText($related->title, 50) }}
                                                    </a>
                                                </h5>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article ">
                            <!-- <h4 class="border_section">Sidebar</h4> -->
                            <div class="mb-4">
                                <div class="widget__form-search-bar  ">
                                    <form action="{{ route('news') }}">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <input name="search" class="form-control border-secondary border-right-0 rounded-0"
                                                    value="" placeholder="{{ __('frontend.Search') }}">
                                            </div>
                                            <div class="col-auto">
                                                <button
                                                    class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="wrapper__list__article-small">
                                @foreach ($recentNews as $item)
                                    @if ($loop->index <= 2)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news-details', $item->slug) }}">
                                                        <img src="{{ asset($item->image) }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                </div>


                                                <div class="card__post__body ">
                                                    <div class="card__post__content">

                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary">
                                                                        {{ __('frontend.by') }} {{ $item->author->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize">
                                                                        {{ date('M d, Y', strtotime($item->created_at)) }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news-details', $item->slug) }}">
                                                                    {{ truncateText($item->title, 80) }}
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
                                                <a href="{{ route('news-details', $item->slug) }}">
                                                    <img src="{{ asset($item->image) }}" alt=""
                                                        class="img-fluid">
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
                                                            {{ date('M d, Y', strtotime($item->created_at)) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news-details', $item->slug) }}">
                                                        {{ truncateText($item->title, 160) }}
                                                    </a>
                                                </h5>
                                                <p>
                                                    {!! truncateText($item->content, 250) !!}
                                                </p>
                                                <a href="{{ route('news-details', $item->slug) }}"
                                                    class="btn btn-outline-primary mb-4 text-capitalize">
                                                    {{ __('frontend.read more') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </aside>

                        <!-- social media -->
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
                        <!-- End social media -->

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">tags</h4>
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

                        <aside class="wrapper__list__article">
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
            </div>
        </div>
    </section>
@endsection
