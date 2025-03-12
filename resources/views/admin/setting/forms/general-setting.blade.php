<div class="card border border-primary">
    <div class="card-body">
        <form action="{{ route('admin.general-setting-update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="">{{ __('admin.Site name') }}</label>
                <input type="text" class="form-control" name="site_name" value="{{ $setting['site_name'] }}">
                @error('site_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <img src="{{ asset($setting['site_logo']) }}" alt="logo" width="150px">
                </br>
                <label for="">{{ __('admin.Site logo') }}</label>
                <input type="file" class="form-control" name="site_logo">
                @error('site_logo')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <img src="{{ asset($setting['site_favicon']) }}" alt="logo" width="150px">
                </br>
                <label for="">{{ __('admin.Site favicon') }}</label>
                <input type="file" class="form-control" name="site_favicon">
                @error('site_favicon')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-primary">{{ __('admin.Save') }}</button>
        </form>
    </div>
</div>
