<div class="navbar-bg"></div>
<!-- navbar -->
@include('admin.layouts.navbar')
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Top News</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">{{ __('admin.St') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('admin.Dashboard') }}</li>
            <li class="{{ sidebarActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>{{ __('admin.Dashboard') }}</span></a>
            </li>
            <li class="menu-header">{{ __('admin.Starter') }}</li>
            @if (canAccess(['language index']))
                <li class="{{ sidebarActive(['admin.language.*']) }}">
                    <a class="nav-link" href="{{ route('admin.language.index') }}">
                        <i class="fas fa-language"></i>
                        <span>{{ __('admin.Language') }}</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['category index']))
                <li class="{{ sidebarActive(['admin.category.*']) }}">
                    <a class="nav-link" href="{{ route('admin.category.index') }}">
                        <i class="fas fa-list"></i>
                        <span>{{ __('admin.Category') }}</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['social count index']))
                <li class="{{ sidebarActive(['admin.social-count.*']) }}">
                    <a class="nav-link" href="{{ route('admin.social-count.index') }}">
                        <i class="fas fa-hashtag"></i>
                        <span>{{ __('admin.Social count') }}</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['home section index']))
                <li class="{{ sidebarActive(['admin.home-section-setting.*']) }}">
                    <a class="nav-link" href="{{ route('admin.home-section-setting.index') }}">
                        <i class="fas fa-wrench"></i>
                        <span>{{ __('admin.Home section setting') }}</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['advertisement index']))
                <li class="{{ sidebarActive(['admin.ad.*']) }}">
                    <a class="nav-link" href="{{ route('admin.ad.index') }}">
                        <i class="fas fa-ad"></i>
                        <span>{{ __('admin.Advertisement') }}</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['subscriber index']))
                <li class="{{ sidebarActive(['admin.subscriber.*']) }}">
                    <a class="nav-link" href="{{ route('admin.subscriber.index') }}">
                        <i class="fas fa-envelope"></i>
                        <span>{{ __('admin.Subscriber') }}</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['contact email index']))
                <li class="{{ sidebarActive(['admin.contact-mail.*']) }}">
                    <a class="nav-link" href="{{ route('admin.contact-mail.index') }}">
                        <i class="fas fa-envelope-open"></i>
                        <span>{{ __('admin.Contact mail') }}</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['setting index']))
                <li class="{{ sidebarActive(['admin.setting.*']) }}">
                    <a class="nav-link" href="{{ route('admin.setting.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>{{ __('admin.Setting') }}</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['news index']))
                <li class="dropdown {{ sidebarActive(['admin.news.*']) }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fal fa-newspaper"></i>
                        <span>{{ __('admin.News') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ sidebarActive(['admin.news.*']) }}">
                            <a class="nav-link" href="{{ route('admin.news.index') }}">{{ __('admin.All news') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="dropdown {{ sidebarActive(['admin.frontend-localization.*', 'admin.admin-localization.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-language"></i>
                    <span>{{ __('admin.Localization') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ sidebarActive(['admin.frontend-localization.*']) }}">
                        <a class="nav-link"
                            href="{{ route('admin.frontend-localization.index') }}">{{ __('admin.Frontend lang') }}</a>
                    </li>
                    <li class="{{ sidebarActive(['admin.admin-localization.*']) }}">
                        <a class="nav-link"
                            href="{{ route('admin.admin-localization.index') }}">{{ __('admin.Admin lang') }}</a>
                    </li>
                </ul>
            </li>

            @if (canAccess(['about index', 'contact index']))
                <li class="dropdown {{ sidebarActive(['admin.about.*', 'admin.contact.*']) }}">
                    <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                        <span>{{ __('admin.Pages') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @if (canAccess(['about index']))
                            <li class="{{ sidebarActive(['admin.about.*']) }}">
                                <a class="nav-link"
                                    href="{{ route('admin.about.index') }}">{{ __('admin.About pages') }}</a>
                            </li>
                        @endif
                        @if (canAccess(['contact index']))
                            <li class="{{ sidebarActive(['admin.contact.*']) }}">
                                <a class="nav-link"
                                    href="{{ route('admin.contact.index') }}">{{ __('admin.Contact pages') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (canAccess(['access manager index']))
                <li class="dropdown {{ sidebarActive(['admin.role.*', 'admin.role-user.*']) }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-shield"></i>
                        <span>{{ __('admin.Access manager') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ sidebarActive(['admin.role-user.*']) }}">
                            <a class="nav-link"
                                href="{{ route('admin.role-user.index') }}">{{ __('admin.Role user') }}</a>
                        </li>
                        <li class="{{ sidebarActive(['admin.role.*']) }}">
                            <a class="nav-link"
                                href="{{ route('admin.role.index') }}">{{ __('admin.Role and permission') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (canAccess(['footer setting index']))
                <li
                    class="dropdown {{ sidebarActive(['admin.social-link.*', 'admin.footer-info.*', 'admin.footer-grid-one.*', 'admin.footer-grid-two.*', 'admin.footer-grid-three.*']) }}">
                    <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                        <span>{{ __('admin.Footer setting') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ sidebarActive(['admin.social-link.*']) }}">
                            <a class="nav-link"
                                href="{{ route('admin.social-link.index') }}">{{ __('admin.Social link') }}</a>
                        </li>
                        <li class="{{ sidebarActive(['admin.footer-info.*']) }}">
                            <a class="nav-link"
                                href="{{ route('admin.footer-info.index') }}">{{ __('admin.Footer info') }}</a>
                        </li>
                        <li class="{{ sidebarActive(['admin.footer-grid-one.*']) }}">
                            <a class="nav-link"
                                href="{{ route('admin.footer-grid-one.index') }}">{{ __('admin.Footer grid one') }}</a>
                        </li>
                        <li class="{{ sidebarActive(['admin.footer-grid-two.*']) }}">
                            <a class="nav-link"
                                href="{{ route('admin.footer-grid-two.index') }}">{{ __('admin.Footer grid two') }}</a>
                        </li>

                        <li class="{{ sidebarActive(['admin.footer-grid-three.*']) }}">
                            <a class="nav-link"
                                href="{{ route('admin.footer-grid-three.index') }}">{{ __('admin.Footer grid three') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank
                            Page</span></a></li> --}}

            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="forms-advanced-form.html">Advanced Form</a></li>
                    <li><a class="nav-link" href="forms-editor.html">Editor</a></li>
                    <li><a class="nav-link" href="forms-validation.html">Validation</a></li>
                </ul>
            </li> --}}
        </ul>
    </aside>
</div>
