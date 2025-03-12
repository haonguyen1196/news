@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Footer info') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All footer info') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.footer-info.create') }}" class="btn btn-primary">
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
                        @php
                            $footerInfo = \App\Models\FooterInfo::where('lang', $lang->lang)->first();
                        @endphp
                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}"
                            id="home-lang-{{ $lang->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="card-body">
                                <form action="{{ route('admin.footer-info.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <img src="{{ asset(@$footerInfo->logo) }}" alt="" style="width: 100px">
                                        </br>
                                        <label for="">{{ __('admin.Logo') }}</label>
                                        <input type="hidden" value="{{ $lang->lang }}" name="lang">
                                        <input type="file" class="form-control" name="logo">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Short description') }}</label>
                                        <textarea class="form-control" name="description">{{ @$footerInfo->description }}</textarea>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('admin.Copyright text') }}</label>
                                        <textarea class="form-control" name="copyright">{{ @$footerInfo->copyright }}</textarea>
                                        </select>
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
