@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Mail contact') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All mail contact') }}</h4>
            </div>
            <div class="card-body">
                <div class="tab-content tab-bordered" id="myTab3Content">
                    <div class="tab-pane fade show active" id="home-" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-contact-mail">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>{{ __('admin.Email') }}</th>
                                        <th>{{ __('admin.Subject') }}</th>
                                        <th>{{ __('admin.Message') }}</th>
                                        <th>{{ __('admin.Reply') }}</th>
                                        <th>{{ __('admin.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mailContacts as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ ++$loop->index }}
                                            </td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->subject }}</td>
                                            <td>{{ $item->message }}</td>

                                            <td>
                                                @if ($item->reply === 0)
                                                    <span class="badge badge-danger"><i class="far fa-clock"></i></span>
                                                @else
                                                    <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-mail-{{ $item->id }}">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                                {{-- <a href="{{ route('admin.content-mail.destroy', $item->id) }}"
                                                    class="btn btn-danger delete-item">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a> --}}
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

@foreach ($mailContacts as $item)
    <!-- Modal -->
    <div class="modal fade" id="modal-mail-{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('admin.contact-mail.reply') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.Send mail to') }}:
                            {{ $item->email }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('admin.Subject') }}</label>
                            <input type="text" name="subject" class="form-control">
                            <input type="hidden" name="email" value="{{ $item->email }}">
                            <input type="hidden" name="contact_mail_id" value="{{ $item->id }}">
                            @error('subject')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('admin.Message') }}</label>
                            <textarea name="message" class="form-control" style="height: 200px !important"></textarea>
                            @error('message')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('admin.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('admin.Send') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach

@push('scripts')
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#table-1')) {
                $("#table-contact-mail").dataTable({
                    "columnDefs": [{
                        "sortable": false,
                        "targets": [1]
                    }]
                });
            }

        });
    </script>
@endpush
