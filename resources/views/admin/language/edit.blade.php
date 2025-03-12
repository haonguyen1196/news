@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Language') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Edit language') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.language.update', $language->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('admin.Language') }}</label>
                        <select name="lang" id="lang-select" class="form-control select2">
                            <option value="">--{{ __('admin.select') }}--</option>
                            @foreach (config('language') as $key => $item)
                                <option @selected($language->lang == $key) value="{{ $key }}">{{ $item['name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('lang')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Name') }}</label>
                        <input name="name" type="text" readonly class="form-control" id="name"
                            value="{{ $language->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Slug') }}</label>
                        <input name="slug" type="text" readonly class="form-control" id="slug"
                            value="{{ $language->slug }}">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Is it default?') }}</label>
                        <select name="default" id="" class="form-control">
                            <option @selected($language->default === 0) value="0">{{ __('admin.No') }}</option>
                            <option @selected($language->default === 1) value="1">{{ __('admin.Yes') }}</option>
                        </select>
                        @error('default')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Status') }}</label>
                        <select name="status" id="" class="form-control">
                            <option @selected($language->status === 1) value="1">{{ __('admin.Active') }}</option>
                            <option @selected($language->status === 0) value="0">{{ __('admin.Inactive') }}</option>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#lang-select').on('change', function() {
                $slug = $(this).val();
                $name = $(this).children(':selected').text();
                $('#slug').val($slug);
                $('#name').val($name);
            })
        })
    </script>
@endpush
