@php
    $page = Theme::get('page');
    $slug = !empty($page) ? $page->slug : null;

    // Areas of Activities cards: title => [label => url]
    $areas = [
        'Underground Mines' => [
            'Areas of involvement' => '/underground-mines-areas-of-involvement',
            'Work highlights' => '/underground-mines-work-highlights',
            'Clientele' => '/underground-mines-clientele',
        ],
        'Opencast Mines' => [
            'Areas of involvement' => '/opencast-mines',
            'Work highlights' => '/opencast-mines-work-highlights',
            'Clientele' => '/opencast-mines-clientele',
        ],
        'Hydroelectric Projects' => [
            'Areas of involvement' => '/hydroelectric-projects-areas-of-involvement',
            'Work highlights' => '/hydroelectric-projects-work-highlights',
            'Clientele' => '/hydroelectric-projects-clientele',
        ],
        'Nuclear Power Projects' => [
            'Areas of involvement' => '/nuclear-power-projects-area-of-involvement',
            'Work highlights' => '/nuclear-power-projects-work-highlights',
        ],
        'Infrastructures Projects' => [
            'Areas of involvement' => '/infrastructures-projects-areas-of-involvement',
            'Work highlights' => '/infrastructures-projects-work-highlights',
            'Clientele' => '/infrastructures-projects-clientele',
        ],
        'Tunneling' => [],   // no pages yet, add links here later
        'Testing Services' => [
            'Work highlights' => '/testing-services-work-highlights',
            'Clientele' => '/testing-services-clientele',
        ],
        'Training & Seminars' => [
            'Work highlights' => '/training-programme',
        ],
    ];

    // Departments cards: title => [label => url]
    $departments = [
        'Engineering Geology' => [
            'Areas of Activities' => '/engineering-geological-investigations',
            'Manpower' => '/engineering-geological-investigations-manpower',
        ],
        'Engineering Geophysics' => [
            'Areas of Activities' => '/engineering-geophysics-areas-of-activties',
            'Manpower' => '/engineering-geophysics-manpower',
        ],
        'Engineering Seismology' => [
            'Areas of Activities' => '/engineering-seismology-areas-of-activities',
            'Manpower' => '/engineering-seismology-man-power',
        ],
        'Geotechnical Engineering' => [
            'Areas of Activities' => '/geotechnical-engineering-areas-of-activities',
            'Manpower' => '/geotechnical-engineering-man-power',
        ],
        'Numerical Modelling' => [
            'Areas of Activities' => '/numerical-modeling-areas-of-activities',
            'Manpower' => '/numerical-modeling-man-power',
        ],
        'geomechanics & Ground Control' => [
            'Areas of Activities' => '/geomechanics-ground-control-area-of-activities',
            'Manpower' => '/geomechanics-ground-control-man-power',
        ],
        'Rock Blasting & Excavation Engineering' => [
            'Areas of Activities' => '/rock-blasting-excavation-engineering',
            'Manpower' => '/rock-blasting-excavation-engineering-man-power',
        ],
        'Testing Services' => [
            'Manpower' => '/testing-services-man-power',
        ],
        'Seismotectonics' => [
            'Areas of Activities' => '/seismotectonics-area-of-activties',
            'Manpower' => '/seismotectonics-man-power',
        ],
        'Administration & Finance' => [
            'Manpower' => '/administration-and-finance-man-power',
        ],
        'Project Monitoring Cell' => [
            'Manpower' => '/project-monitoring-cell-man-power',
        ],
    ];
@endphp
<div class="header-menu start-0 end-0">
    <nav class="navbar navbar-expand-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-start" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item @if ($slug == 'homepage') active @endif">
                    <a class="nav-link @if ($slug == 'homepage') active @endif" title="NIRM Home Page"
                        aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false" aria-current="page">About
                        NIRM</a>
                    <ul class="dropdown-menu">
                        <li><a href="/about-national-institute-of-rock-mechanics">About NIRM</a></li>
                        <li><a href="/ministry-of-mines">About Ministry of Mines</a></li>
                        <li><a href="/our-vision-and-mission">Our Vision and Mission</a></li>
                        <li><a href="/quality-policy-and-objectives">Quality Policy & Objectives</a></li>
                        <li><a href="/organizational-chart">Organizational Chart</a></li>
                        <li><a href="/governing-body-general-body">Governing Body</a></li>
                        <li><a href="/peer-review-committee">Peer Review Committee</a></li>
                        <li><a href="/our-directors">Our Directors </a></li>
                        <li><a href="/major-facilities">Major Facilities</a></li>
                    </ul>
                </li>

                {{-- Areas of Activities --}}
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false" aria-current="page">Areas of
                        Activities </a>
                    <ul class="dropdown-menu mega-menu-wrapper">
                        @foreach (collect($areas)->chunk(4, true) as $row)
                            <div class="row">
                                @foreach ($row as $title => $links)
                                    <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                        <div class="mega-menu">
                                            <div class="mega-menu-title" role="presentation">{{ $title }}</div>
                                            @if (!empty($links))
                                                <ul class="inner-mega-menu">
                                                    @foreach ($links as $label => $url)
                                                        <li><a href="{{ $url }}">{{ $label }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false" aria-current="page">Project
                        Activities</a>
                    <ul class="dropdown-menu">
                        <li><a href="/ongoing-projects">On-going Projects</a></li>
                        <!-- <li><a href="/completed-projects">Completed Projects</a></li> -->
                    </ul>
                </li>

                {{-- Departments --}}
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false" aria-current="page">Departments</a>
                    <ul class="dropdown-menu mega-menu-wrapper">
                        @foreach (collect($departments)->chunk(4, true) as $row)
                            <div class="row">
                                @foreach ($row as $title => $links)
                                    <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                        <div class="mega-menu">
                                            <h4 class="mega-menu-title">{{ $title }}</h4>
                                            <ul class="inner-mega-menu">
                                                @foreach ($links as $label => $url)
                                                    <li><a href="{{ $url }}">{{ $label }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false" aria-current="page">Announcements</a>
                    <ul class="dropdown-menu">
                        <li><a href="/news">News</a></li>
                        <li><a href="/press-release">Press Releases</a></li>
                        <li><a href="/publications">Publications</a></li>
                        <li><a
                                href="/constitution-of-icc-for-considering-complaints-of-sexual-harassment-of-women-employees-at-nirm">ICC(Women)</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false" aria-current="page">Important
                        Links</a>
                    <ul class="dropdown-menu">
                        <li><a href="https://pgportal.gov.in/">Public Grievances</a></li>
                        <li><a href="https://data.gov.in//">Data.gov</a></li>
                        <li><a href="https://www.mygov.in/">MyGov.in</a></li>
                        <li><a href="https://mines.gov.in/">Ministry of Mines</a></li>
                        <li><a href="https://digitalindia.gov.in/">Digital India</a></li>
                    </ul>
                </li>
                <li class="nav-item @if ($slug == 'contact-us') active @endif">
                    <a href="/contact-us" class="nav-link @if ($slug == 'contact-us') active @endif"
                        data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
                        aria-current="page">Contact
                        Us </a>
                </li>
            </ul>
        </div>
        <div class="navbar-right">
            <form class="search-form searchbar" role="search" id="hiddenSearchBox" action="/search" method="get">
                <div class="input-group">
                    <input type="search" name="q" class="form-control" placeholder="Search..">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default" data-toggle="searchbar"
                            data-target="#hiddenSearchBox">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </nav>
</div>
<!-- end: Header -->