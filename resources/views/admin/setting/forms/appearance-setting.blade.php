<div class="card border border-primary">
    <div class="card-body">
        <form action="{{ route('admin.color-setting-update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label>{{ __('admin.Site color') }}</label>
                <div class="input-group colorpickerinput">
                    <input type="text" class="form-control" name="site_color" value="{{ $setting['site_color'] }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-fill-drip"></i>
                        </div>
                    </div>
                </div>
                @error('site_color')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-primary">{{ __('admin.Save') }}</button>
        </form>
    </div>
</div>
