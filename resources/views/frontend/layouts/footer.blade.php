<section class="wrapper__section p-0">
    <div class="wrapper__section__components">
        <!-- Footer -->
        <footer>
            <div class="wrapper__footer bg__footer-dark pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="widget__footer">
                                <figure class="image-logo">
                                    <img src="{{ asset($footerInfo->logo) }}" alt="" class="logo-footer">
                                </figure>

                                <p>
                                    {!! $footerInfo->description !!}
                                </p>


                                <div class="social__media mt-4">
                                    <ul class="list-inline">
                                        @foreach ($socialLinks as $socialLink)
                                            <li class="list-inline-item">
                                                <a href="{{ $socialLink->url }}"
                                                    class="btn btn-social rounded text-white facebook" target="blank">
                                                    <i class="{{ $socialLink->icon }}"></i>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget__footer">
                                <div class="dropdown-footer">
                                    <h4 class="footer-title">
                                        {{ $footerGridTitleOne->value }}
                                        <span class="fa fa-angle-down"></span>
                                    </h4>

                                </div>

                                <ul class="list-unstyled option-content is-hidden">
                                    @foreach ($footerGridOnes as $footerGridOne)
                                        <li>
                                            <a href="{{ $footerGridOne->url }}">{{ $footerGridOne->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget__footer">
                                <div class="dropdown-footer">
                                    <h4 class="footer-title">
                                        {{ $footerGridTitleTwo->value }}
                                        <span class="fa fa-angle-down"></span>
                                    </h4>

                                </div>
                                <ul class="list-unstyled option-content is-hidden">
                                    @foreach ($footerGridTwos as $footerGridTwo)
                                        <li>
                                            <a href="{{ $footerGridTwo->url }}">{{ $footerGridTwo->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="widget__footer">
                                <div class="dropdown-footer">
                                    <h4 class="footer-title">
                                        {{ $footerGridTitleThree->value }}
                                        <span class="fa fa-angle-down"></span>
                                    </h4>

                                </div>

                                <ul class="list-unstyled option-content is-hidden">
                                    @foreach ($footerGridThrees as $footerGridThree)
                                        <li>
                                            <a href="{{ $footerGridThree->url }}">{{ $footerGridThree->name }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer bottom -->
            <div class="wrapper__footer-bottom bg__footer-dark">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border-top-1 bg__footer-bottom-section">
                                <p class="text-white text-center">
                                    {!! $footerInfo->copyright !!}
                                </p>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </footer>
    </div>
</section>
