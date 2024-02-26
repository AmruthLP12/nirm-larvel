<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" id="fontSize">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        {{-- <!-- Fonts-->
        <link href="https://fonts.googleapis.com/css?family={{ urlencode(theme_option('primary_font', 'Roboto')) }}" rel="stylesheet" type="text/css">
        <!-- CSS Library-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
        {{-- <style>
            :root {
                --primary-color: {{ theme_option('primary_color', '#ff2b4a') }};
                --primary-font: '{{ theme_option('primary_font', 'Roboto') }}', sans-serif;
            }
        </style> --}}

        {!! Theme::header() !!}
    </head>
    <body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif>
        {!! Theme::partial('top_bar') !!}
        <!-- header-start -->
        <header class="main-header" id="header">
            <!-- header-top-area start -->
            <div class="header-top-area">
                <div class="container">
                    <div class="row d-flex align-items-md-center header-area">
                        <div class="col-12 col-lg-4 header-logo d-flex justify-content-lg-start justify-content-center">
                            <div class="header-theme-logo">
                                <a href="/" class="theme-logo d-block">
                                    <img src="{{ get_image_url(theme_option('logo')) }}" class="img-fluid" alt="{{ theme_option('site_title') }} Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 header-images d-lg-flex d-none align-items-center justify-content-lg-end">
                            <div class="header-ministry text-lg-end">
                                <a href="#" class="ministry-logo d-block">
                                    <img src="/themes/nirm/assets/image/Ministry_of_Mines_India.svg" class="img-fluid" alt="Ministry of Mines Logo">
                                    
                                </a>
                            </div>
                            <div class="header-azadi text-lg-end">
                                <a href="#" class="azadi-logo d-block" title="Azadi ka-amrit-mahotsav,">
                                    <img src="/themes/nirm/assets/image/azadi.jpg" class="img-fluid" alt="75th Indian Independence Day">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-top-area end -->
            <!-- header-bottom-area start -->
            <div class="header-bottom-area navigation-menu position-relative" id="stickyheader">
                <div class="container">
                    <div class="row d-md-flex align-items-center">
                        <div class="col-12 header-element header-menu-button">
                            {!! Theme::partial('menu_header') !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-bottom-area end -->
        </header>
        <!-- header-end -->
        {!! apply_filters(THEME_FRONT_BODY, null) !!}
        
