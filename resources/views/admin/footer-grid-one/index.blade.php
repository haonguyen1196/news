@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Footer grid one') }}</h1>
        </div>

        <div class="card card-primary">
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
                        @php
                            $footerTitle = \App\Models\FooterTitle::where([
                                'lang' => $lang->lang,
                                'key' => 'grid_title_one',
                            ])->first();
                        @endphp
                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}"
                            id="home-lang-{{ $lang->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="table-responsive">
                                <form action="{{ route('admin.footer-grid-one-title') }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Footer title') }}</label>
                                        <input type="text" name="value" class="form-control"
                                            value="{{ @$footerTitle->value }}">
                                        <input type="hidden" name="lang" value="{{ $lang->lang }}">
                                    </div>
                                    <button class="btn btn-primary" type="submit">{{ __('admin.Save') }}</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <section class="section">

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All footer grid one') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.footer-grid-one.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('admin.Create new') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    @foreach ($langs as $lang)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="home-tab2" data-toggle="tab"
                                href="#d-table-{{ $lang->lang }}" role="tab" aria-controls="home"
                                aria-selected="true">{{ $lang->name }}</a>
                        </li>
                    @endforeach

                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    @foreach ($langs as $lang)
                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}"
                            id="d-table-{{ $lang->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-{{ $lang->lang }}">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{ __('admin.Name') }}</th>
                                            <th>{{ __('admin.Url') }}</th>
                                            <th>{{ __('admin.Language Code') }}</th>
                                            <th>{{ __('admin.Status') }}</th>
                                            <th>{{ __('admin.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $footerGridOnes = \App\Models\FooterGridOne::where('lang', $lang->lang)
                                                ->orderByDesc('id')
                                                ->get();
                                        @endphp
                                        @foreach ($footerGridOnes as $item)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ++$loop->index }}
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->url }}</td>
                                                <td>{{ $item->lang }}</td>

                                                <td>
                                                    @if ($item->status === 0)
                                                        <span class="badge badge-danger">{{ __('admin.Inactive') }}</span>
                                                    @else
                                                        <span class="badge badge-success">{{ __('admin.Active') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.footer-grid-one.edit', $item->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.footer-grid-one.destroy', $item->id) }}"
                                                        class="btn btn-danger delete-item"><i
                                                            class="fas fa-trash-alt"></i></a>
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
    </script>
@endpush
