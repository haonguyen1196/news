@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Settings') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All setting') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3">
                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab"
                                    aria-controls="home" aria-selected="true">{{ __('admin.General setting') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab"
                                    aria-controls="profile" aria-selected="false">{{ __('admin.SEO setting') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab"
                                    aria-controls="contact" aria-selected="false">{{ __('admin.Appearance setting') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#contact5" role="tab"
                                    aria-controls="contact"
                                    aria-selected="false">{{ __('admin.Microsoft api setting') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-9">
                        <div class="tab-content no-padding" id="myTab2Content">
                            <div class="tab-pane fade show active" id="home4" role="tabpanel"
                                aria-labelledby="home-tab4">
                                @include('admin.setting.forms.general-setting')
                            </div>
                            <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                @include('admin.setting.forms.seo-setting')
                            </div>
                            <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                @include('admin.setting.forms.appearance-setting')
                            </div>
                            <div class="tab-pane fade" id="contact5" role="tabpanel" aria-labelledby="contact-tab5">
                                @include('admin.setting.forms.microsoft-api-setting')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
