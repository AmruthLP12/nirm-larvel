@php
    $page = Theme::get('page');
    $slug = !empty($page) ? $page->slug : null;
@endphp
<div class="header-menu start-0 end-0">
    <nav class="navbar navbar-expand-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-start" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item @if($slug == 'homepage') active @endif">
                    <a class="nav-link @if($slug == 'homepage') active @endif" title="NIRM Home Page" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false" aria-current="page">About
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
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false" aria-current="page">Areas of
                        Activities </a>
                    <ul class="dropdown-menu mega-menu-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Underground Mines</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/underground-mines-areas-of-involvement">Areas of involvement </a></li>
                                        <li><a href="/underground-mines-work-highlights">Work highlights </a></li>
                                        <li><a href="/underground-mines-clientele">Clientele</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Opencast Mines</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/opencast-mines">Areas of involvement </a></li>
                                        <li><a href="/opencast-mines-work-highlights">Work highlights</a></li>
                                        <li><a href="/opencast-mines-clientele">Clientele</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Hydroelectric Projects</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/hydroelectric-projects-areas-of-involvement">Areas of involvement</a></li>
                                        <li><a href="/hydroelectric-projects-work-highlights">Work highlights </a></li>
                                        <li><a href="/hydroelectric-projects-clientele">Clientele</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Nuclear Power Projects</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/nuclear-power-projects-area-of-involvement">Areas of involvement</a></li>
                                        <li><a href="/nuclear-power-projects-work-highlights">Work highlights </a></li>
                                     </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Infrastructures Projects</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/infrastructures-projects-areas-of-involvement">Areas of involvement</a></li>
                                        <li><a href="/infrastructures-projects-work-highlights">Work highlights </a></li>
                                        <li><a href="/infrastructures-projects-clientele">Clientele</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Tunneling</h4>
                                    <!--<ul class="inner-mega-menu">
                                        <li><a href="#">Areas of involvement</a></li>
                                        <li><a href="#">Work highlights </a></li>
                                        <li><a href="#">Clientele</a></li>
                                    </ul>-->
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Testing Services</h4>
                                    <ul class="inner-mega-menu">
                                       <!-- <li><a href="#">Areas of involvement</a></li>-->
                                        <li><a href="/testing-services-work-highlights">Work highlights </a></li>
                                        <li><a href="/testing-services-clientele">Clientele</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Training & Seminars</h4>
                                   <ul class="inner-mega-menu">
                                        <!--<li><a href="#">Areas of involvement</a></li>-->
                                        <li><a href="/training-programme">Work highlights </a></li>
                                                                            </ul>
                                </div>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false" aria-current="page">Project
                        Activities</a>
                    <ul class="dropdown-menu">
                        <li><a href="/ongoing-projects">On-going Projects</a></li>
                        <li><a href="/completed-projects">Completed Projects</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false" aria-current="page">Departments</a>
                    <ul class="dropdown-menu mega-menu-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Engineering Geology</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/engineering-geological-investigations">Areas of Activities </a></li>
                                        <!--<li><a href="#">Work highlights </a></li>-->
                                        <li><a href="/engineering-geological-investigations-manpower">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Engineering Geophysics</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/engineering-geophysics-areas-of-activties">Areas of Activities</a></li>
                                       <!-- <li><a href="#">Work highlights </a></li>-->
                                        <li><a href="/engineering-geophysics-manpower">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Engineering Seismology</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/engineering-seismology-areas-of-activities">Areas of Activities </a></li>
                                        <!--<li><a href="#">Work highlights </a></li>-->
                                        <li><a href="/engineering-seismology-man-power">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Geotechnical Engineering</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/geotechnical-engineering-areas-of-activities">Areas of Activties </a></li>
                                    <!--<li><a href="#">Work highlights </a></li>-->

                                        <li><a href="/geotechnical-engineering-man-power">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Numerical Modelling</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/numerical-modeling-areas-of-activities">Areas of Activities </a></li>
                                        <!-- <li><a href="#">Work highlights </a></li>-->
                                       <li><a href="/numerical-modeling-man-power">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">geomechanics & Ground Control</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/geomechanics-ground-control-area-of-activities">Areas of Activities </a></li>
                                        <!--<li><a href="#">Work highlights </a></li>-->
                                        <li><a href="/geomechanics-ground-control-man-power">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Rock Blasting & Excavation Engineering</h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/rock-blasting-excavation-engineering">Areas of Activities</a></li>
                                        <!--<li><a href="#">Work highlights </a></li>-->

                                        <li><a href="/rock-blasting-excavation-engineering-man-power">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Testing Services</h4>
                                    <ul class="inner-mega-menu">
                                      <!--  <li><a href="#">Areas of involvement </a></li>
                                        <li><a href="#">Work highlights </a></li>-->
                                        <li><a href="/testing-services-man-power">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                    
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Seismotectonics </h4>
                                    <ul class="inner-mega-menu">
                                        <li><a href="/seismotectonics-area-of-activties">Areas of Activities </a></li>
                                        <!--<li><a href="#">Work highlights </a></li>-->
                                        <li><a href="/seismotectonics-man-power">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Administration & Finance</h4>
                                    <ul class="inner-mega-menu">
                                       <!-- <li><a href="#">Areas of involvement </a></li>
                                        <li><a href="#">Work highlights </a></li>-->
                                        <li><a href="/administration-and-finance-man-power">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <div class="mega-menu">
                                    <h4 class="mega-menu-title">Project Monitoring Cell</h4>
                                    <ul class="inner-mega-menu">
                                        <!--<li><a href="#">Areas of involvement </a></li>
                                        <li><a href="#">Work highlights </a></li>-->
                                        <li><a href="/project-monitoring-cell-man-power">Manpower</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false"
                        aria-current="page">Announcements</a>
                    <ul class="dropdown-menu">
			
                        <li><a href="/activities">Activities</a></li>
                        <li><a href="/news">News</a></li>
  			<li><a href="/press-release">Press Releases</a></li>
			<li><a href="/publications">Publications</a></li>
                        <li><a href="/constitution-of-icc-for-considering-complaints-of-sexual-harassment-of-women-employees-at-nirm">ICC(Women)</a></li>
                                             <li><a href="/tenders">Tender Notice</a></li>
                        <li><a href="/contractual-appointment-for-projects">Contract Employment</a></li>
                        <li><a href="/technical-information">Technical Info</a></li>
                        <li><a href="/nirm-academics">NIRM Academics</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false" aria-current="page">Important
                        Links</a>
                    <ul class="dropdown-menu">
                        <li><a href="https://pgportal.gov.in/">Public Grievances</a></li>
                        <li><a href="https://data.gov.in//">Data.gov</a></li>
                        <li><a href="https://www.mygov.in/">MyGov.in</a></li>
                        <li><a href="https://mines.gov.in/">Ministry of Mines</a></li>
                        <li><a href="https://digitalindia.gov.in/">Digital India</a></li>
                    </ul>
                </li>
                <li class="nav-item @if($slug == 'contact-us') active @endif">
                    <a href="/contact-us" class="nav-link @if($slug == 'contact-us') active @endif" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false" aria-current="page">Contact
                        Us </a>
                </li>
            </ul>
        </div>
        <div class="navbar-right">
            <form class="search-form searchbar" role="search" id="hiddenSearchBox" action="/search"
                method="get">
                <div class="input-group">
                    <input type="search" name="q" class="form-control"
                        placeholder="Search..">
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