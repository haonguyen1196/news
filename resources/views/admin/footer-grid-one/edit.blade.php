@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Footer grid one') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Update footer grid one') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.footer-grid-one.update', $footerGridOne->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">{{ __('admin.Language') }}</label>
                        <select name="lang" class="form-control select2">
                            <option value="">--{{ __('admin.select') }}--</option>
                            @foreach ($langs as $lang)
                                <option @selected($footerGridOne->lang == $lang->lang) value="{{ $lang->lang }}">{{ $lang->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('lang')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Name') }}</label>
                        <input name="name" type="text" class="form-control" value="{{ $footerGridOne->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Url') }}</label>
                        <input name="url" type="text" class="form-control" value="{{ $footerGridOne->url }}">
                        @error('url')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Status') }}</label>
                        <select name="status" id="" class="form-control">
                            <option @selected($footerGridOne->status == 1) value="1">{{ __('admin.Active') }}</option>
                            <option @selected($footerGridOne->status == 0) value="0">{{ __('admin.Inactive') }}</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('admin.update') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
