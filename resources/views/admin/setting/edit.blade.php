@extends('layouts.admin.master')
@section('title', 'Website Settings')

@section('content')
    @include('admin.includes.message')
    <div class="content">
        <div class="container-fluid">
            <div class="">
                <div class="card-body p-0">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card card-primary shadow br-8">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 col-sm-2 nav flex-column gap-2 nav-pills" id="v-pills-tab"
                                        role="tablist" aria-orientation="vertical">
                                        <button class="nav-link text-start active" id="v-pills-global-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-global" type="button"
                                            role="tab" aria-controls="v-pills-global"
                                            aria-selected="true">Global</button>
                                        <button class="nav-link text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="false">Homepage</button>

                                        <button class="nav-link text-start" id="v-pills-banner-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-banner" type="button" role="tab"
                                            aria-controls="v-pills-banner" aria-selected="false">Banner</button>

                                        <button class="nav-link text-start" id="v-pills-service-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-service" type="button" role="tab"
                                            aria-controls="v-pills-service" aria-selected="false">Service</button>

                                        <button class="nav-link text-start" id="v-pills-about-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-about" type="button" role="tab"
                                            aria-controls="v-pills-about" aria-selected="false">About</button>

                                        <button class="nav-link text-start" id="v-pills-contact-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-contact" type="button" role="tab"
                                            aria-controls="v-pills-contact" aria-selected="false">Contact</button>

                                        <button class="nav-link text-start" id="v-pills-destination-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-destination" type="button"
                                            role="tab" aria-controls="v-pills-destination"
                                            aria-selected="false">Destination</button>
                                    </div>
                                    <div class="col-9 col-sm-10 tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-global" role="tabpanel"
                                            aria-labelledby="v-pills-global-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_logo">Site Main Logo</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="site_main_logo" class="mainlogo"
                                                                id="site_logo"
                                                                data-default-file="{{ $settings['site_main_logo'] != null ? asset('admin/images/setting') . '/' . $settings['site_main_logo'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_logo">Site Footer Logo</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="site_footer_logo" class="mainlogo"
                                                                id="sitefooter_logo"
                                                                data-default-file="{{ $settings['site_footer_logo'] != null ? asset('admin/images/setting') . '/' . $settings['site_footer_logo'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="fav_icon">Fav Icon</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="fav_icon" class="fav_icon"
                                                                id="fav_icon"
                                                                data-default-file="{{ $settings['fav_icon'] != null ? asset('admin/images/setting') . '/' . $settings['fav_icon'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_information">Site Information</label>
                                                        <textarea name="site_information" rows="4" class="form-control br-8" placeholder="Enter Site Information">{{ $settings['site_information'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="map">Map</label>
                                                        <textarea name="map" rows="4" class="form-control br-8" placeholder="Enter Map Details">{{ $settings['map'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_contact">Contact Number</label>
                                                        <input type="tel" name="site_contact"
                                                            value="{{ $settings['site_contact'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Contact Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_email">Email</label>
                                                        <input type="email" name="site_email"
                                                            value="{{ $settings['site_email'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_location">Location</label>
                                                        <input type="text" name="site_location"
                                                            value="{{ $settings['site_location'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Location">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_location_url">Location Url</label>
                                                        <input type="text" name="site_location_url"
                                                            value="{{ $settings['site_location_url'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Location Url">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="site_copyright">Site Copyright</label>
                                                        <textarea name="site_copyright" rows="4" class="form-control br-8" placeholder="Enter Site Copyright">{{ $settings['site_copyright'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="why_book_with_us">Why Book with Us</label>
                                                        <textarea name="why_book_with_us" rows="4" class="form-control ckeditor br-8"
                                                            placeholder="Enter Site Copyright">{{ $settings['why_book_with_us'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_trending_section_description">Trending Tour
                                                            Section
                                                            Description</label>
                                                        <textarea name="homepage_trending_section_description" rows="4" class="form-control br-8"
                                                            placeholder="Enter Something ...">{{ $settings['homepage_trending_section_description'] ?? '' }}</textarea>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_combo_package_section_description">Combo
                                                            Package Section
                                                            Description</label>
                                                        <textarea name="homepage_combo_package_section_description" rows="4" class="form-control br-8"
                                                            placeholder="Enter Something ...">{{ $settings['homepage_combo_package_section_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_blog_section_description">Blog Section
                                                            Description</label>
                                                        <textarea name="homepage_blog_section_description" rows="4" class="form-control br-8"
                                                            placeholder="Enter Something ...">{{ $settings['homepage_blog_section_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="ourteam_section_description">Ourteam Section
                                                            Description</label>
                                                        <textarea name="ourteam_section_description" rows="4" class="form-control br-8"
                                                            placeholder="Enter Something ...">{{ $settings['ourteam_section_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="testimonial_section_description">Testimonial Section
                                                            Description</label>
                                                        <textarea name="testimonial_section_description" rows="4" class="form-control br-8"
                                                            placeholder="Enter Something ...">{{ $settings['testimonial_section_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="service_section_description">Service Section
                                                            Description</label>
                                                        <textarea name="service_section_description" rows="4" class="form-control br-8"
                                                            placeholder="Enter Something ...">{{ $settings['service_section_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_seo_title">Homepage Seo Title</label>
                                                        <input type="text" name="homepage_seo_title"
                                                            value="{{ $settings['homepage_seo_title'] ?? '' }}"
                                                            class="form-control br-8"
                                                            placeholder="Enter homepage Seo Title">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_seo_description">Homepage Seo
                                                            Keywords</label>
                                                        <input type="text" name="homepage_seo_description"
                                                            value="{{ $settings['homepage_seo_description'] ?? '' }}"
                                                            class="form-control br-8"
                                                            placeholder="Enter Homepage Seo Keywords">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_seo_keywords">Homepage Seo
                                                            Description</label>
                                                        <textarea name="homepage_seo_keywords" rows="4" class="form-control br-8" placeholder="Enter Something ...">{{ $settings['homepage_seo_keywords'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="affiliated_image">Affilated Image</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="affiliated_image"
                                                                class="affiliated_image" id="affiliated_image"
                                                                data-default-file="{{ $settings['affiliated_image'] != null ? asset('admin/images/setting') . '/' . $settings['affiliated_image'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_logo">Certificate Of Excellence Image</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="coe_image" class="coe_image"
                                                                id="coe_image"
                                                                data-default-file="{{ $settings['coe_image'] != null ? asset('admin/images/setting') . '/' . $settings['coe_image'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-banner" role="tabpanel"
                                            aria-labelledby="v-pills-banner-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="banner_image">Banner Image <span
                                                                class="fw-bold">(1024* 683)</span>
                                                        </label>
                                                        <div class="custom-file">
                                                            <input type="file" name="banner_image"
                                                                class="banner_image" id="banner_image"
                                                                data-default-file="{{ $settings['banner_image'] != null ? asset('admin/images/setting') . '/' . $settings['banner_image'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="banner_title">Banner Title</label>
                                                        <input type="text" name="banner_title"
                                                            value="{{ $settings['banner_title'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Banner Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="banner_description">Banner
                                                            Description</label>
                                                        <textarea name="banner_description" rows="4" class="form-control br-8" placeholder="Enter Something ...">{{ $settings['banner_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-service" role="tabpanel"
                                            aria-labelledby="v-pills-service-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="service_image">Service Image <span
                                                                class="fw-bold">(1024* 683)</span>
                                                        </label>
                                                        <div class="custom-file">
                                                            <input type="file" name="service_image"
                                                                class="service_image" id="service_image"
                                                                data-default-file="{{ $settings['service_image'] != null ? asset('admin/images/setting') . '/' . $settings['service_image'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="service_title">Service Title</label>
                                                        <input type="text" name="service_title"
                                                            value="{{ $settings['service_title'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter service Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="service_description">Service
                                                            Description</label>
                                                        <textarea name="service_description" rows="4" class="form-control br-8" placeholder="Enter Something ...">{{ $settings['service_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-about" role="tabpanel"
                                            aria-labelledby="v-pills-about-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="about_page_image">About Page Image <span
                                                                class="fw-bold">(1024* 683)</span>
                                                        </label>
                                                        <div class="custom-file">
                                                            <input type="file" name="about_page_image"
                                                                class="about_page_image" id="about_page_image"
                                                                data-default-file="{{ $settings['about_page_image'] != null ? asset('admin/images/setting') . '/' . $settings['about_page_image'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>

                                                <fieldset class="border p-3">
                                                    <legend class="float-none w-auto legend-title">SEO :</legend>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="aboutpage_seo_title">About Page Seo
                                                                    Title</label>
                                                                <input type="text" name="aboutpage_seo_title"
                                                                    value="{{ $settings['aboutpage_seo_title'] ?? '' }}"
                                                                    class="form-control br-8"
                                                                    placeholder="Enter aboutpage Seo Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="aboutpage_seo_description">About Page Seo
                                                                    Keywords</label>
                                                                <input type="text" name="aboutpage_seo_description"
                                                                    value="{{ $settings['aboutpage_seo_description'] ?? '' }}"
                                                                    class="form-control br-8"
                                                                    placeholder="Enter aboutpage Seo Keywords">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group mb-3">
                                                                <label for="aboutpage_seo_keywords">About Page Seo
                                                                    Description</label>
                                                                <textarea name="aboutpage_seo_keywords" rows="4" class="form-control br-8" placeholder="Enter Something ...">{{ $settings['aboutpage_seo_keywords'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-contact" role="tabpanel"
                                            aria-labelledby="v-pills-contact-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="contact_page_image">Contact Page Image <span
                                                                class="fw-bold">(1024* 683)</span>
                                                        </label>
                                                        <div class="custom-file">
                                                            <input type="file" name="contact_page_image"
                                                                class="contact_page_image" id="contact_page_image"
                                                                data-default-file="{{ $settings['contact_page_image'] != null ? asset('admin/images/setting') . '/' . $settings['contact_page_image'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>

                                                <fieldset class="border p-3">
                                                    <legend class="float-none w-auto legend-title">SEO :</legend>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="contactpage_seo_title">Contact Page Seo
                                                                    Title</label>
                                                                <input type="text" name="contactpage_seo_title"
                                                                    value="{{ $settings['contactpage_seo_title'] ?? '' }}"
                                                                    class="form-control br-8"
                                                                    placeholder="Enter contactpage Seo Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="contactpage_seo_description">Contact Page Seo
                                                                    Keywords</label>
                                                                <input type="text" name="contactpage_seo_description"
                                                                    value="{{ $settings['contactpage_seo_description'] ?? '' }}"
                                                                    class="form-control br-8"
                                                                    placeholder="Enter contactpage Seo Keywords">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group mb-3">
                                                                <label for="contactpage_seo_keywords">Contact Page Seo
                                                                    Description</label>
                                                                <textarea name="contactpage_seo_keywords" rows="4" class="form-control br-8"
                                                                    placeholder="Enter Something ...">{{ $settings['contactpage_seo_keywords'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-destination" role="tabpanel"
                                            aria-labelledby="v-pills-destination-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="destination_page_image">Destination Page Image <span
                                                                class="fw-bold">(1024* 683)</span>
                                                        </label>
                                                        <div class="custom-file">
                                                            <input type="file" name="destination_page_image"
                                                                class="destination_page_image" id="destination_page_image"
                                                                data-default-file="{{ $settings['destination_page_image'] != null ? asset('admin/images/setting') . '/' . $settings['destination_page_image'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>

                                                <fieldset class="border p-3">
                                                    <legend class="float-none w-auto legend-title">SEO :</legend>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="destinationpage_seo_title">destination Page Seo
                                                                    Title</label>
                                                                <input type="text" name="destinationpage_seo_title"
                                                                    value="{{ $settings['destinationpage_seo_title'] ?? '' }}"
                                                                    class="form-control br-8"
                                                                    placeholder="Enter destinationpage Seo Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="destinationpage_seo_description">destination
                                                                    Page Seo
                                                                    Keywords</label>
                                                                <input type="text"
                                                                    name="destinationpage_seo_description"
                                                                    value="{{ $settings['destinationpage_seo_description'] ?? '' }}"
                                                                    class="form-control br-8"
                                                                    placeholder="Enter destinationpage Seo Keywords">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group mb-3">
                                                                <label for="destinationpage_seo_keywords">destination Page
                                                                    Seo
                                                                    Description</label>
                                                                <textarea name="destinationpage_seo_keywords" rows="4" class="form-control br-8"
                                                                    placeholder="Enter Something ...">{{ $settings['destinationpage_seo_keywords'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-9">
                                        <div class="card-footers">
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                <i class="fa-solid fa-rotate"></i>
                                                Update Setting
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $('.mainlogo').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.footerlogo').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.fav_icon').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.banner_image').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.service_image').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.about_page_image').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.contact_page_image').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.affiliated_image').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.coe_image').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.destination_page_image').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endsection
