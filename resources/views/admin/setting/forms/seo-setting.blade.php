<div class="card border border-primary">
    <div class="card-body">
        <form action="{{ route('admin.seo-setting-update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="">{{ __('admin.Site SEO title') }}</label>
                <input type="text" class="form-control" name="site_seo_title" value="{{ $setting['site_seo_title'] }}">
                @error('site_seo_title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">{{ __('admin.Site SEO description') }}</label>
                <textarea class="form-control" name="site_seo_description">{{ $setting['site_seo_description'] }}</textarea>
                @error('site_seo_description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">{{ __('admin.Site SEO keywords') }}</label>
                <input type="text" class="form-control inputtags" name="site_seo_keywords"
                    value="{{ $setting['site_seo_keywords'] }}">
                @error('site_seo_keywords')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-primary">{{ __('admin.Save') }}</button>
        </form>
    </div>
</div>
