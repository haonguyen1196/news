<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <title>
        @hasSection('title')
            @yield('title')
        @else
            {{ $setting['site_seo_title'] }}
        @endif
    </title>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <meta name="description"
        content="@hasSection('meta_description')
@yield('meta_description')
@else
{{ $setting['site_seo_description'] }}
@endif">

    <meta name="keywords" content="{{ $setting['site_seo_keywords'] }}">

    <!--meta dành cho mạng xã hội   -->
    <meta name="og:title" content="@yield('meta_og_title')">
    <meta name="og:description" content="@yield('meta_og_description')">
    <meta name="og:image" content="@hasSection('meta_og_image')
@yield('meta_og_image')
@else
{{ $setting['site_logo'] }}
@endif ">
    <meta name="twitter:title" content="@yield('meta_tw_title')">
    <meta name="twitter:description" content="@yield('meta_tw_description')">
    <meta name="twitter:image" content="@yield('meta_tw_image')">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ $setting['site_favicon'] }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="{{ asset('frontend/assets/css/styles.css') }}" rel="stylesheet">
    <style>
        :root {
            --colorPrimary: {{ $setting['site_color'] }};
        }
    </style>
</head>

<body>
    <!--Global variable -->
    @php
        $socialLinks = \App\Models\SocialLink::where('status', 1)->orderBy('id', 'desc')->get();
        $footerInfo = \App\Models\FooterInfo::where('lang', getLanguage())->first();
        $footerGridOnes = \App\Models\FooterGridOne::where('lang', getLanguage())->orderBy('id')->get();
        $footerGridTwos = \App\Models\FooterGridTwo::where('lang', getLanguage())->orderBy('id')->get();
        $footerGridThrees = \App\Models\FooterGridThree::where('lang', getLanguage())->orderBy('id')->get();
        $footerGridTitleOne = \App\Models\FooterTitle::where('lang', getLanguage())
            ->where('key', 'grid_title_one')
            ->first();
        $footerGridTitleTwo = \App\Models\FooterTitle::where('lang', getLanguage())
            ->where('key', 'grid_title_two')
            ->first();
        $footerGridTitleThree = \App\Models\FooterTitle::where('lang', getLanguage())
            ->where('key', 'grid_title_three')
            ->first();
    @endphp

    <!-- Header news -->
    @include('frontend.layouts.header')
    <!-- End Header news -->

    @yield('content')

    <!-- Footer -->
    @include('frontend.layouts.footer')
    <!-- End Footer -->

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="{{ asset('frontend/assets/js/index.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')

    <script>
        $(document).ready(function() {
            $('.site_language').on('change', function() {
                $lang = $(this).val();
                $.ajax({
                    method: 'GET',
                    data: {
                        language_code: $lang,
                    },
                    url: '{{ route('language') }}',
                    success: function(data) {
                        if (data.status === 'success') {
                            window.location.href = "{{ url('/') }}";
                        }
                    },
                    error: function(error) {
                        console.log(error);

                    }
                });
            })

            //toast từ sweet alert
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            //add csrf in ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                //handle delete cmt
                $('.delete-cmt').on('click', function(e) {
                    e.preventDefault();
                    $id = $(this).data('id');
                    $cmtLi = $(this).closest("li.comment");
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('news-comment-delete') }}',
                                method: 'DELETE',
                                data: {
                                    'id': $id
                                },
                                success: function(data) {
                                    if (data.status == 'success') {
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: data.message,
                                            icon: "success"
                                        });

                                        //remove row
                                        $cmtLi.remove();

                                    } else {
                                        Swal.fire({
                                            title: "Error!",
                                            text: data.message,
                                            icon: "error"
                                        });
                                    }
                                },
                                error: function(xhr, error, message) {
                                    console.log(error.message);
                                }
                            });
                        }
                    });

                })

                //handle submit news letter form
                $('.news-letter-form').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        method: "POST",
                        url: "{{ route('subscribe-news-letter') }}",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $('.news-letter-btn').text('loading...');
                            $('.news-letter-btn').attr('disable', true);
                        },
                        success: function(data) {
                            if (data.status === 'success') {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message
                                });

                                $('.news-letter-btn').text('sign up');
                                $('.news-letter-btn').attr('disable', false);
                                $('.news-letter-input').val('');
                            }
                        },
                        error: function(error) {
                            $('.news-letter-btn').text('sign up');
                            $('.news-letter-btn').attr('disable', false);
                            if (error.status === 422) {
                                $messageErrors = error.responseJSON.errors;
                                $.each($messageErrors, function(index, value) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: value[0]
                                    });
                                });
                            }
                        }
                    });
                });
            })
        })
    </script>
</body>

</html>
