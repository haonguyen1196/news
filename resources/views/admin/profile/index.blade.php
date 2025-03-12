@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Profile') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">{{ __('admin.Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('admin.Profile') }}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{ __('admin.Hi') }}, {{ $user->name }}!</h2>
            <p class="section-lead">
                {{ __('admin.Change information about yourself on this page.') }}
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <form action="{{ route('admin.profile.update', $user->id) }}" method="post"
                            class="needs-validation" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="card-header">
                                <h4>{{ __('admin.Edit Profile') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="image-preview" class="image-preview mb-3">
                                            <label for="image-upload" id="image-label">{{ __('admin.Choose File') }}</label>
                                            <input type="file" name="image" id="image-upload">
                                            <input type="hidden" name="old_image" id="image-upload"
                                                value="{{ $user->image }}">
                                        </div>
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('admin.Name') }}</label>
                                        <input name="name" type="text" class="form-control"
                                            value="{{ $user->name }}">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('admin.Email') }}</label>
                                        <input name="email" type="text" class="form-control"
                                            value="{{ $user->email }}">
                                        {{-- <div class="invalid-feedback">
                                            {{ __('admin.Please fill in the email') }}
                                        </div> --}}
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">{{ __('admin.Save Changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <form action="{{ route('admin.profile-password.update', $user->id) }}" method="post"
                            class="needs-validation">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{ __('admin.Update Password') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('admin.Old password') }}</label>
                                        <input name="current_password" type="text" class="form-control" value="">
                                        @error('current_password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('admin.New Password') }}</label>
                                        <input name="password" type="text" class="form-control" value="">
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('admin.Comfirm Password') }}</label>
                                        <input name="password_confirmation" type="text" class="form-control"
                                            value="">
                                        @error('password_confirmation')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{ __('admin.Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.image-preview').css({
                'background-image': 'url("{{ asset($user->image) }}")',
                'background-size': 'cover',
                'background-position': 'center'
            });
        });
    </script>
@endpush
