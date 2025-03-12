@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Category') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Edit category') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('admin.Language') }}</label>
                        <select name="lang" class="form-control select2">
                            <option value="">--{{ __('admin.select') }}--</option>
                            @foreach ($langs as $lang)
                                <option @selected($category->lang === $lang->lang) value="{{ $lang->lang }}">{{ $lang->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('lang')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Name') }}</label>
                        <input value="{{ $category->name }}" name="name" type="text" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Show at navigate') }}</label>
                        <select name="show_at_nav" id="" class="form-control">
                            <option @selected($category->show_at_nav === 0) value="0">{{ __('admin.No') }}</option>
                            <option @selected($category->show_at_nav === 1) value="1">{{ __('admin.Yes') }}</option>
                        </select>
                        @error('show_at_nav')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Status') }}</label>
                        <select name="status" id="" class="form-control">
                            <option @selected($category->status === 1) value="1">{{ __('admin.Active') }}</option>
                            <option @selected($category->status === 0) value="0">{{ __('admin.Inactive') }}</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('admin.Update') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
