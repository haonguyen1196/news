@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Social link') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All social link') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.social-link.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('admin.Create new') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content tab-bordered" id="myTab3Content">
                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-social">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>{{ __('admin.Icon') }}</th>
                                        <th>{{ __('admin.Url') }}</th>
                                        <th>{{ __('admin.Status') }}</th>
                                        <th>{{ __('admin.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($socialLinks as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ ++$loop->index }}
                                            </td>
                                            <td><i class="{{ $item->icon }}"></i></td>
                                            <td>{{ $item->url }}</td>
                                            <td>
                                                @if ($item->status === 0)
                                                    <span class="badge badge-danger">{{ __('admin.Inactive') }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ __('admin.Active') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.social-link.edit', $item->id) }}"
                                                    class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.social-link.destroy', $item->id) }}"
                                                    class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#table-social").dataTable({
                "columnDefs": [{
                    "sortable": false,
                    "targets": [1]
                }]
            });
        });
    </script>
@endpush
