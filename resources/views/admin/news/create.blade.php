@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.News') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Create news') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ __('admin.Language') }}</label>
                        <select name="lang" class="form-control select2" id="language-select">
                            <option value="">--{{ __('admin.select') }}--</option>
                            @foreach ($langs as $lang)
                                <option value="{{ $lang->lang }}">{{ $lang->name }}</option>
                            @endforeach
                        </select>
                        @error('lang')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Category') }}</label>
                        <select name="category_id" class="form-control" id="category">
                            <option value="">--{{ __('admin.select') }}--</option>

                        </select>
                        @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Image') }}</label>
                        <div id="image-preview" class="image-preview mb-3">
                            <label for="image-upload" id="image-label">{{ __('admin.Choose File') }}</label>
                            <input type="file" name="image" id="image-upload">
                        </div>
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Title') }}</label>
                        <input name="title" type="text" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Content') }}</label>
                        <textarea name="content" class="summernote-simple"></textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('admin.Tags') }}</label>
                        <div class="">
                            <input type="text" class="form-control inputtags" name="tags">
                        </div>
                        @error('tags')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Meta title') }}</label>
                        <input name="meta_title" type="text" class="form-control">
                        @error('meta_title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Meta description') }}</label>
                        <textarea name="meta_description" class="form-control"></textarea>
                        @error('meta_description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <div class="control-label">Is breaking news</div> <label class="custom-switch mt-2"> <input
                                    value="1" type="checkbox" name="is_breaking_news" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span> <span
                                    class="custom-switch-description"></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <div class="control-label">Show at slider</div> <label class="custom-switch mt-2"> <input
                                    value="1" type="checkbox" name="show_at_slider" class="custom-switch-input"> <span
                                    class="custom-switch-indicator"></span> <span class="custom-switch-description"></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <div class="control-label">Show at popular</div> <label class="custom-switch mt-2"> <input
                                    value="1" type="checkbox" name="show_at_popular" class="custom-switch-input"> <span
                                    class="custom-switch-indicator"></span> <span class="custom-switch-description"></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <div class="control-label">Status</div> <label class="custom-switch mt-2"> <input value="1"
                                    type="checkbox" name="status" class="custom-switch-input"> <span
                                    class="custom-switch-indicator"></span> <span class="custom-switch-description"></span>
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('admin.Create') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#language-select').on('change', function() {
                $lang = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('admin.news-fetch-category') }}',
                    data: {
                        lang: $lang
                    },
                    success: function(data) {
                        console.log(data);
                        $('#category').html('');
                        $('#category').html(
                            `<option value="">--{{ __('admin.select') }}--</option>`);

                        data.forEach(function(item) {
                            $('#category').append(
                                `<option value="${item.id}">${item.name}</option`)
                        });

                    },
                    error: function(error) {
                        console.log(error);

                    }
                });
            })
        });
    </script>
@endpush
