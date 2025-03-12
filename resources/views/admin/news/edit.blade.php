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
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('admin.Language') }}</label>
                        <select name="lang" class="form-control select2" id="language-select">
                            <option value="">--{{ __('admin.select') }}--</option>
                            @foreach ($langs as $lang)
                                <option @selected($news->lang == $lang->lang) value="{{ $lang->lang }}">{{ $lang->name }}
                                </option>
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
                            @foreach ($categories as $category)
                                <option @selected($news->category_id == $category->id) value="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach
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
                        <input name="title" type="text" class="form-control" value="{{ $news->title }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Content') }}</label>
                        <textarea name="content" class="summernote-simple">{{ $news->content }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('admin.Tags') }}</label>
                        <div class="">
                            <input type="text" class="form-control inputtags" name="tags"
                                value="{{ formatTags($news->tags()->pluck('name')->toArray()) }}">
                        </div>
                        @error('tags')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Meta title') }}</label>
                        <input name="meta_title" type="text" class="form-control" value="{{ $news->meta_title }}">
                        @error('meta_title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Meta description') }}</label>
                        <textarea name="meta_description" class="form-control">{{ $news->meta_description }}</textarea>
                        @error('meta_description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <div class="control-label">Is breaking news</div> <label class="custom-switch mt-2"> <input
                                    @checked($news->is_breaking_news == 1) value="1" type="checkbox" name="is_breaking_news"
                                    class="custom-switch-input">
                                <span class="custom-switch-indicator"></span> <span
                                    class="custom-switch-description"></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <div class="control-label">Show at slider</div> <label class="custom-switch mt-2"> <input
                                    @checked($news->show_at_slider == 1) value="1" type="checkbox" name="show_at_slider"
                                    class="custom-switch-input"> <span class="custom-switch-indicator"></span> <span
                                    class="custom-switch-description"></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <div class="control-label">Show at popular</div> <label class="custom-switch mt-2"> <input
                                    @checked($news->show_at_popular == 1) value="1" type="checkbox" name="show_at_popular"
                                    class="custom-switch-input"> <span class="custom-switch-indicator"></span> <span
                                    class="custom-switch-description"></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <div class="control-label">Status</div> <label class="custom-switch mt-2"> <input
                                    @checked($news->status == 1) value="1" type="checkbox" name="status"
                                    class="custom-switch-input"> <span class="custom-switch-indicator"></span> <span
                                    class="custom-switch-description"></span>
                            </label>
                        </div>
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

            $('.image-preview').css({
                'background-image': 'url("{{ asset($news->image) }}")',
                'background-size': 'cover',
                'background-position': 'center'
            });
        });
    </script>
@endpush
