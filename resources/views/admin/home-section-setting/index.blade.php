@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Home section setting') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All home section setting') }}</h4>
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
                            $categories = \App\Models\Category::where('lang', $lang->lang)
                                ->latest()
                                ->get();
                            $homeSectionSetting = \App\Models\HomeSectionSetting::where('lang', $lang->lang)->first();
                        @endphp
                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}"
                            id="home-lang-{{ $lang->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="card-body">
                                <form action="{{ route('admin.home-section-setting.update') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Category section one') }}</label>
                                        <input type="hidden" value="{{ $lang->lang }}" name="lang">
                                        <select name="category_section_one" id="" class="form-control select2">
                                            <option value="">--{{ __('admin.Section') }}--</option>
                                            @foreach ($categories as $category)
                                                <option @selected(@$homeSectionSetting->category_section_one == $category->id) value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Category section two') }}</label>
                                        <select name="category_section_two" id="" class="form-control select2">
                                            <option value="">--{{ __('admin.Section') }}--</option>
                                            @foreach ($categories as $category)
                                                <option @selected(@$homeSectionSetting->category_section_two == $category->id) value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Category section three') }}</label>
                                        <select name="category_section_three" id="" class="form-control select2">
                                            <option value="">--{{ __('admin.Section') }}--</option>
                                            @foreach ($categories as $category)
                                                <option @selected(@$homeSectionSetting->category_section_three == $category->id) value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Category section four') }}</label>
                                        <select name="category_section_four" id="" class="form-control select2">
                                            <option value="">--{{ __('admin.Section') }}--</option>
                                            @foreach ($categories as $category)
                                                <option @selected(@$homeSectionSetting->category_section_four == $category->id) value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
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
