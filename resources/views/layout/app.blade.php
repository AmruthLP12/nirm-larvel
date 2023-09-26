<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.header')
</head>
<body>
        <!-- site preloader start -->
    <div class="page-loader">
        <div class="loader-in"></div>
    </div>
    <!-- site preloader end -->

    <div class="pageWrapper">
        <div id="headWrapper" class="clearfix">

            <header class="top-head" data-sticky="true">
                <div class="top-bar ">
                    <div class="container">
                        <div class="row">
                            @include('include.top-bar')
                            <div class="cell-1 right-bar">
                                <ul class="right">
                                    <li><a href="hi-index.php"><i class="fa  fa-language"></i>हिन्दी</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @include('include.menu')
            </header>
        </div>
        <!-- Content Start -->
        @yield('content')

         <!-- Back to top Link -->
        <div id="to-top" class="main-bg"><span class="fa fa-chevron-up"></span></div>
    </div>

    @include('include.footer')
</body>
</html>