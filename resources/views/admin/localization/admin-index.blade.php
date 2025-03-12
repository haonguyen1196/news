@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Admin localization') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All strings') }}</h4>
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

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <form method="post" action="{{ route('admin.extract-localization-string') }}">
                                                @csrf
                                                <input type="hidden" name="directory"
                                                    value="{{ resource_path('views/admin') }},{{ app_path('Http/Controllers/Admin') }}">
                                                <input type="hidden" name="language_code" value="{{ $lang->lang }}">
                                                <input type="hidden" name="file_name" value="admin ">
                                                <button type="submit"
                                                    class="btn btn-primary mr-3">{{ __('admin.General strings') }}</button>
                                            </form>
                                            {{-- <form class="translate-form">
                                                <input type="hidden" name="language_code" value="{{ $lang->lang }}">
                                                <input type="hidden" name="file_name" value="admin">
                                                <button type="submit"
                                                    class="btn btn-dark btn-translate">{{ __('admin.Translate strings') }}</button>
                                            </form> --}}
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped" id="table-{{ $lang->lang }}">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{ __('admin.String') }}</th>
                                            <th>{{ __('admin.Translation') }}</th>
                                            <th>{{ __('admin.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // tên tệp, chuỗi dịch, ngôn ngữ muốn xử dụng để lấy bản dịch
                                            $translatedValues = trans('admin', [], $lang->lang);
                                        @endphp

                                        @if (is_array($translatedValues))
                                            @foreach ($translatedValues as $key => $value)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ ++$loop->index }}
                                                    </td>
                                                    <td>{{ $key }}</td>
                                                    <td>{{ $value }}</td>
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary modal_btn"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            data-lang-code="{{ $lang->lang }}"
                                                            data-key="{{ $key }}"
                                                            data-value="{{ $value }}" data-file-name="admin">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.Value') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.update-lang-string') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="value" class="form-control">
                            <input type="hidden" name="lang_code">
                            <input type="hidden" name="key">
                            <input type="hidden" name="file_name">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('admin.Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('admin.Save changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            @foreach ($langs as $lang)
                if (!$.fn.DataTable.isDataTable('#table-{{ $lang->lang }}')) {
                    $("#table-{{ $lang->lang }}").dataTable({
                        "columnDefs": [{
                            "sortable": false,
                            "targets": [2, 3]
                        }]
                    });
                }
            @endforeach

            //tính toán lại chiều rộng cột để hiển thị
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                // Lấy bảng hiển thị trong tab
                var table = $($.fn.dataTable.tables(true)).DataTable();
                table.columns.adjust().draw();
            });

            //handle when click modal_btn
            // đây gọi là event delegation, lắng nghe sự kiên từ phần tử cha, thì phần tử con được thêm vào sau củng sẽ được thừa thưởng
            $('body').on('click', '.modal_btn', function() {
                $langCode = $(this).data('lang-code');
                $key = $(this).data('key');
                $value = $(this).data('value');
                $fileName = $(this).data('file-name');

                $('input[name="lang_code"]').val('');
                $('input[name="key"]').val('');
                $('input[name="value"]').val('');
                $('input[name="file_name"]').val('');

                $('input[name="lang_code"]').val($langCode);
                $('input[name="key"]').val($key);
                $('input[name="value"]').val($value);
                $('input[name="file_name"]').val($fileName);

            })

            //handle translate form
            $('.translate-form').on('submit', function(e) {
                e.preventDefault();
                $formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.translate-string') }}",
                    method: 'post',
                    data: $formData,
                    beforeSend: function() {
                        $('.btn-translate').text('Translating...').prop('disable', true);
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                title: "Done!",
                                text: data.message,
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Tải lại trang
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: data.message,
                                icon: "error"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Tải lại trang
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            })

        });
    </script>
@endpush
