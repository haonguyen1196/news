@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Categories') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All categories') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('admin.Create new') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    @foreach ($langs as $lang)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="home-tab2" data-toggle="tab"
                                href="#home-lang-{{ $lang->lang }}" role="tab" aria-controls="home"
                                aria-selected="true">{{ $lang->name }}</a>
                        </li>
                    @endforeach

                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    @foreach ($langs as $lang)
                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}"
                            id="home-lang-{{ $lang->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-{{ $lang->lang }}">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{ __('admin.Image') }}</th>
                                            <th>{{ __('admin.Title') }}</th>
                                            <th>{{ __('admin.Category') }}</th>
                                            <th>{{ __('admin.In Breaking') }}</th>
                                            <th>{{ __('admin.In Slider') }}</th>
                                            <th>{{ __('admin.In Popular') }}</th>
                                            <th>{{ __('admin.Status') }}</th>
                                            <th>{{ __('admin.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $news = \App\Models\News::where('lang', $lang->lang)
                                                ->latest()
                                                ->get();
                                        @endphp
                                        @foreach ($news as $item)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ++$loop->index }}
                                                </td>
                                                <td>
                                                    <img src="{{ asset($item->image) }}" alt=""
                                                        style="width: 100px">
                                                </td>
                                                <td>{{ truncateText($item->title, 20) }}</td>
                                                <td>{{ $item->category->name }}</td>

                                                <td>
                                                    <label class="custom-switch mt-2">
                                                        <input data-id="{{ $item->id }}" data-name="is_breaking_news"
                                                            @checked($item->is_breaking_news == 1) value="1" type="checkbox"
                                                            class="custom-switch-input toggle-status">
                                                        <span class="custom-switch-indicator"></span> <span
                                                            class="custom-switch-description"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="custom-switch mt-2">
                                                        <input data-id="{{ $item->id }}" data-name="show_at_slider"
                                                            @checked($item->show_at_slider == 1) value="1" type="checkbox"
                                                            class="custom-switch-input toggle-status">
                                                        <span class="custom-switch-indicator"></span> <span
                                                            class="custom-switch-description"></span>
                                                    </label>

                                                </td>

                                                <td>
                                                    <label class="custom-switch mt-2">
                                                        <input data-id="{{ $item->id }}" data-name="show_at_popular"
                                                            @checked($item->show_at_popular == 1) value="1" type="checkbox"
                                                            class="custom-switch-input toggle-status">
                                                        <span class="custom-switch-indicator"></span> <span
                                                            class="custom-switch-description"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="custom-switch mt-2">
                                                        <input data-id="{{ $item->id }}" data-name="status"
                                                            @checked($item->status == 1) value="1" type="checkbox"
                                                            class="custom-switch-input toggle-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.news.edit', $item->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.news.destroy', $item->id) }}"
                                                        class="btn btn-danger delete-item"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                    <a href="{{ route('admin.news.copy', $item->id) }}"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-copy"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            @foreach ($langs as $lang)
                if (!$.fn.DataTable.isDataTable('#table-1')) {
                    $("#table-{{ $lang->lang }}").dataTable({
                        "columnDefs": [{
                            "sortable": false,
                            "targets": [2, 3]
                        }]
                    });
                }
            @endforeach

        });

        //handle toggle status
        $('.toggle-status').on('change', function() {
            $id = $(this).data('id');
            $name = $(this).data('name');
            $status = $(this).prop("checked") ? 1 : 0;

            $.ajax({
                method: 'GET',
                url: '{{ route('admin.news-toggle-status') }}',
                data: {
                    id: $id,
                    name: $name,
                    status: $status
                },
                success: function(data) {
                    if (data.status === 'success') {
                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: data.message
                        });
                    }
                },
                error: function(error) {
                    console.log(error);

                }
            });
        })
    </script>
@endpush
