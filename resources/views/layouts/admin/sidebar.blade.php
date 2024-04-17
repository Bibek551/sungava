<aside class="layout-menu menu-vertical menu bg-menu-theme" id="layout-menu">
    <div class="app-brand demo">
        <a class="app-brand-link" href="{{ route('dashboard') }}">
            <img class="" style="margin-left: 50px"
                src="{{ $settings['site_main_logo'] ? asset('admin/images/setting/' . $settings['site_main_logo']) : asset('admin/images/logo.png') }}"
                alt="logo" height="70">
        </a>

        <a class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none" href="javascript:void(0);">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1 mt-2">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('dashboard') }}">
                <i class="menu-icon tf-icons bx bxs-tachometer"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'menus' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.menu.index') }}">
                <i class="menu-icon tf-icons bx bx-list-ol"></i>
                <div data-i18n="Basic">Menus</div>
            </a>
        </li>
        <!-- CMS -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">CMS</span></li>
        <!-- Cards -->

        <li class="menu-item {{ Request::segment(2) == 'destinations' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.destinations.index') }}">
                <i class="menu-icon tf-icons bx bx-world"></i>
                <div data-i18n="Basic">Destinations</div>
            </a>
        </li>

        <li class="menu-item @if (Request::segment(2) == 'packagecategories' || Request::segment(2) == 'packages') {{ 'active open' }} @endif">
            <a class="menu-link menu-toggle" href="javascript:void(0)">
                <i class="menu-icon tf-icons bx bxs-package"></i>
                <div data-i18n="Packages">Packages</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'packagecategories' ? 'active' : '' }}"
                        href="{{ route('admin.packagecategories.index') }}">
                        <div data-i18n="Accordion">Category</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'packages' ? 'active' : '' }}"
                        href="{{ route('admin.packages.index') }}">
                        <div data-i18n="Accordion">Packages</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item @if (Request::segment(2) == 'blogcategories' || Request::segment(2) == 'blogs') {{ 'active open' }} @endif">
            <a class="menu-link menu-toggle" href="javascript:void(0)">
                <i class="menu-icon tf-icons bx bxs-cube-alt"></i>
                <div data-i18n="Packages">Blogs</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'blogcategories' ? 'active' : '' }}"
                        href="{{ route('admin.blogcategories.index') }}">
                        <div data-i18n="Accordion">Category</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'blogs' ? 'active' : '' }}"
                        href="{{ route('admin.blogs.index') }}">
                        <div data-i18n="Accordion">Blogs</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'services' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.services.index') }}">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Basic">Services</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'ourteams' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.ourteams.index') }}">
                <i class="menu-icon tf-icons bx bxs-user-plus"></i>
                <div data-i18n="Basic">Our Teams</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'testimonials' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.testimonials.index') }}">
                <i class="menu-icon tf-icons bx bxs-chat"></i>
                <div data-i18n="Basic">Testimonials</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'whychooseus' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.whychooseus.index') }}">
                <i class="menu-icon tf-icons bx bxs-select-multiple"></i>
                <div data-i18n="Basic">Whychooseus</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'partners' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.partners.index') }}">
                <i class="menu-icon tf-icons bx bxs-layer-plus"></i>
                <div data-i18n="Basic">Partners</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'inquirypersons' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.inquirypersons.index') }}">
                <i class="menu-icon tf-icons bx bxs-user-voice"></i>
                <div data-i18n="Basic">Inquiry Persons</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'bookings' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.bookings.index') }}">
                <i class="menu-icon tf-icons bx bx-purchase-tag"></i>
                <div data-i18n="Basic">Bookings</div>
            </a>
        </li>

        <!-- General Settings  -->
        <li class="menu-item @if (Request::segment(2) == 'pages' ||
                Request::segment(2) == 'socialmedias' ||
                Request::segment(2) == 'subscriptions' ||
                Request::segment(2) == 'terms' ||
                Request::segment(2) == 'popups' ||
                Request::segment(2) == 'branches' ||
                Request::segment(2) == 'faqs' ||
                Request::segment(2) == 'settings' ||
                Request::segment(2) == 'payments' ||
                Request::segment(2) == 'sliders') {{ 'active open' }} @endif">
            <a class="menu-link menu-toggle" href="javascript:void(0)">
                <i class="menu-icon tf-icons bx bxs-cog"></i>
                <div data-i18n="General Setting">Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'subscriptions' ? 'active' : '' }}"
                        href="{{ route('admin.subscriptions.index') }}">
                        <div data-i18n="Accordion">Subscriptions</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'branches' ? 'active' : '' }}"
                        href="{{ route('admin.branches.index') }}">
                        <div data-i18n="Accordion">Branches</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'terms' ? 'active' : '' }}"
                        href="{{ route('admin.terms.index') }}">
                        <div data-i18n="Accordion">Terms & Conditions</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'popups' ? 'active' : '' }}"
                        href="{{ route('admin.popups.index') }}">
                        <div data-i18n="Accordion">Popup Notifications</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'faqs' ? 'active' : '' }}"
                        href="{{ route('admin.faqs.index') }}">
                        <div data-i18n="Accordion">FAQs</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'pages' ? 'active' : '' }}"
                        href="{{ route('admin.pages.index') }}">
                        <div data-i18n="Accordion">Pages</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'sliders' ? 'active' : '' }}"
                        href="{{ route('admin.sliders.index') }}">
                        <div data-i18n="Accordion">Sliders</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'payments' ? 'active' : '' }}"
                        href="{{ route('admin.payments.index') }}">
                        <div data-i18n="Accordion">Payment Gateways</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'socialmedias' ? 'active' : '' }}"
                        href="{{ route('admin.socialmedias.index') }}">
                        <div data-i18n="Accordion">Social Medias</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'settings' ? 'active' : '' }}"
                        href="{{ route('admin.settings.index') }}">
                        <div data-i18n="Accordion">Global Settings</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
