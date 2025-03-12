@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Social link') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Create social link') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.social-link.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="">{{ __('admin.Icon') }}</label>
                        </br>
                        <button class="btn btn-primary" name="icon" role="iconpicker"></button>
                        @error('icon')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Url') }}</label>
                        <input type="text" class="form-control" name="url">
                        @error('url')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Status') }}</label>
                        <select name="status" id="" class="form-control">
                            <option value="1">{{ __('admin.Active') }}</option>
                            <option value="0">{{ __('admin.Inactive') }}</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('admin.Create') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
