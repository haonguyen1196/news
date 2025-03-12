@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Language') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All languages') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.language.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('admin.Create new') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>{{ __('admin.Language name') }}</th>
                                <th>{{ __('admin.Language Code') }}</th>
                                <th>{{ __('admin.Default') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{ __('admin.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($languages as $key => $item)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->lang }}</td>
                                    <td>
                                        @if ($item->default == 1)
                                            <span class="badge badge-primary">{{ __('admin.Default') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('admin.No') }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge badge-success">{{ __('admin.Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('admin.Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.language.edit', $item->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.language.destroy', $item->id) }}"
                                            class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#table-1')) {
                $("#table-1").dataTable({
                    "columnDefs": [{
                        "sortable": false,
                        "targets": [2, 3]
                    }]
                });
            }
        });
    </script>
@endpush
