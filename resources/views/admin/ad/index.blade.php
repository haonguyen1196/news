@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Ads') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Update ads') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.ad.update', 1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h5 class="text-primary">{{ __('admin.Home page ads') }}</h5>
                    <div class="form-group">
                        <img src="{{ asset($ads->home_top_bar_ad) }}" style="width: 200px" alt="">
                        </br>
                        <label for="">{{ __('admin.Top bar ad') }}</label>
                        <input name="home_top_bar_ad" type="file" class="form-control">
                        @error('home_top_bar_ad')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="" class="mt-3">{{ __('admin.Top bar ad url') }}</label>
                        <input name="home_top_bar_ad_url" type="text" class="form-control"
                            value="{{ $ads->home_top_bar_ad_url }}">
                        @error('home_top_bar_ad_url')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label class="custom-switch mt-2">
                            <input @checked($ads->home_top_bar_ad_status == 1) name="home_top_bar_ad_status" value="1" type="checkbox"
                                class="custom-switch-input toggle-status">
                            <span class="custom-switch-indicator"></span> <span class="custom-switch-description"></span>
                        </label>
                    </div>

                    <div class="form-group">
                        <img src="{{ asset($ads->home_middle_bar_ad) }}" style="width: 200px" alt="">
                        </br>
                        <label for="">{{ __('admin.Middle ad') }}</label>
                        <input name="home_middle_bar_ad" type="file" class="form-control">
                        @error('home_middle_bar_ad')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="" class="mt-3">{{ __('admin.Middle ad url') }}</label>
                        <input name="home_middle_bar_ad_url" type="text" class="form-control"
                            value="{{ $ads->home_middle_bar_ad_url }}">
                        @error('home_middle_bar_ad_url')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label class="custom-switch mt-2">
                            <input @checked($ads->home_middle_bar_ad_status == 1) name="home_middle_bar_ad_status" value="1"
                                type="checkbox" class="custom-switch-input toggle-status">
                            <span class="custom-switch-indicator"></span> <span class="custom-switch-description"></span>
                        </label>
                    </div>

                    <h5 class="text-primary">{{ __('admin.News view page ads') }}</h5>
                    <div class="form-group">
                        <img src="{{ asset($ads->views_page_ad) }}" style="width: 200px" alt="">
                        </br>
                        <label for="">{{ __('admin.Bottom ad') }}</label>
                        <input name="views_page_ad" type="file" class="form-control">
                        @error('views_page_ad')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="" class="mt-3">{{ __('admin.Bottom ad url') }}</label>
                        <input name="views_page_ad_url" type="text" class="form-control"
                            value="{{ $ads->views_page_ad_url }}">
                        @error('views_page_ad_url')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label class="custom-switch mt-2">
                            <input @checked($ads->views_page_ad_status == 1) name="views_page_ad_status" value="1" type="checkbox"
                                class="custom-switch-input toggle-status">
                            <span class="custom-switch-indicator"></span> <span class="custom-switch-description"></span>
                        </label>
                    </div>

                    <h5 class="text-primary">{{ __('admin.News page ads') }}</h5>
                    <div class="form-group">
                        <img src="{{ asset($ads->news_page_ad) }}" style="width: 200px" alt="">
                        </br>
                        <label for="">{{ __('admin.Bottom ad') }}</label>
                        <input name="news_page_ad" type="file" class="form-control">
                        @error('news_page_ad')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="" class="mt-3">{{ __('admin.Bottom ad url') }}</label>
                        <input name="news_page_ad_url" type="text" class="form-control"
                            value="{{ $ads->news_page_ad_url }}">
                        @error('news_page_ad_url')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label class="custom-switch mt-2">
                            <input @checked($ads->news_page_ad_status == 1) name="news_page_ad_status" value="1" type="checkbox"
                                class="custom-switch-input toggle-status">
                            <span class="custom-switch-indicator"></span> <span class="custom-switch-description"></span>
                        </label>
                    </div>

                    <h5 class="text-primary">{{ __('admin.Sidebar ads') }}</h5>
                    <div class="form-group">
                        <img src="{{ asset($ads->side_bar_ad) }}" style="width: 200px" alt="">
                        </br>
                        <label for="">{{ __('admin.Sidebar ad') }}</label>
                        <input name="side_bar_ad" type="file" class="form-control">
                        @error('side_bar_ad')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="" class="mt-3">{{ __('admin.Sidebar ad url') }}</label>
                        <input name="side_bar_ad_url" type="text" class="form-control"
                            value="{{ $ads->side_bar_ad_url }}">
                        @error('side_bar_ad_url')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label class="custom-switch mt-2">
                            <input @checked($ads->side_bar_ad_status == 1) name="side_bar_ad_status" value="1" type="checkbox"
                                class="custom-switch-input toggle-status">
                            <span class="custom-switch-indicator"></span> <span class="custom-switch-description"></span>
                        </label>
                    </div>

                    <button class="btn btn-primary" type="submit">{{ __('admin.Update') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
