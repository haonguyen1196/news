<div class="card border border-primary">
    <div class="card-body">
        <form action="{{ route('admin.microsoft-api-setting-update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="">{{ __('admin.Microsoft api host') }}</label>
                <input type="text" class="form-control" name="site_microsoft_api_host"
                    value="{{ $setting['site_microsoft_api_host'] }}">
                @error('site_microsoft_api_host')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">{{ __('admin.Microsoft api key') }}</label>
                <input type="text" class="form-control" name="site_microsoft_api_key"
                    value="{{ $setting['site_microsoft_api_key'] }}">
                @error('site_microsoft_api_key')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-primary">{{ __('admin.Save') }}</button>
        </form>
    </div>
</div>
