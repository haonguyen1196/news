@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.About page') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.About page') }}</h4>
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
                        @php
                            $about = \App\Models\About::where('lang', $lang->lang)->first();
                        @endphp
                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}"
                            id="home-lang-{{ $lang->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="card-body">
                                <form action="{{ route('admin.about.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Category section one') }}</label>
                                        <input type="hidden" value="{{ $lang->lang }}" name="lang">
                                        <textarea name="content" class="summernote">{!! @$about->content !!}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>
                                </form>
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
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                Swal.fire({
                    toast: true,
                    position: 'top-end', // Đặt vị trí góc trên bên phải
                    icon: 'error',
                    title: '{{ $error }}',
                    showConfirmButton: false,
                    timer: 3000 // Thời gian hiển thị (3 giây)
                });
            @endforeach
        @endif
    </script>
@endpush
