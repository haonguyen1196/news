@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Subscribers') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Send mail to subscribers') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.subscriber.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ __('admin.Subject') }}</label>
                        <input type="text" name="subject" class="form-control">
                        @error('subject')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Message') }}</label>
                        <textarea name="message" class="summernote" cols="30" rows="10"></textarea>
                        @error('message')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary">{{ __('admin.Send') }}</button>
                </form>
            </div>
        </div>
    </section>
    <section class="section">

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All subscribers') }}</h4>
            </div>
            <div class="card-body">
                <div class="tab-content tab-bordered" id="myTab3Content">
                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-sub">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>{{ __('admin.Email') }}</th>
                                        <th>{{ __('admin.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subs as $sub)
                                        <tr>
                                            <td class="text-center">
                                                {{ ++$loop->index }}
                                            </td>
                                            <td>{{ $sub->email }}</td>
                                            <td>
                                                <a href="{{ route('admin.subscriber.destroy', $sub->id) }}"
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
            $("#table-sub").dataTable({
                "columnDefs": [{
                    "sortable": false,
                    "targets": [1]
                }]
            });
        });
    </script>
@endpush
