@extends('layout.app')

@section('content')
    <div id="contentWrapper">

            <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height: 350px; overflow: hidden; visibility: hidden;">
                <!-- Loading Screen -->
                <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                    <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                </div>

                <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 20px; width: 1200px; height: 350px; overflow: hidden;">


                    <div data-p="225.00" style="text-align-center;">
                        <a href="/nirm_lecture.php" target="_blank" rel="noopener noreferrer">
                            <picture align="center">
                                <source type="image/webp" srcset="assets/banners/NIRM-Lecture-Series.webp">
                                <source type="image/jpg" srcset="assets/banners/NIRM-Lecture-Series.png">
                                <img data-u="image" src="assets/banners/NIRM-Lecture-Series.png" alt="NIRM Lecture Series">
                            </source></source></picture>

                    </a></div>




                    <div data-p="225.00" style="display: none;">
                        <a href="https://g20.mygov.in/" target="_blank" rel="noopener noreferrer">
                            <picture align="center">
                                <source type="image/webp" srcset="assets/banners/G20-Logo.webp">
                                <source type="image/jpg" srcset="assets/banners/G20-Logo.png">
                                <img data-u="image" src="assets/banners/G20-Logo.png" alt="G 20 Logo">
                            </source></source></picture>

                    </a></div>



                    <div data-p="225.00" style="display: none;">
                        <a href="https://vishwahindisammelan.gov.in/" target="_blank" rel="noopener noreferrer">
                            <picture align="center">
                                <source type="image/webp" srcset="assets/banners/hindi_sam.webp">
                                <source type="image/jpg" srcset="assets/banners/hindi_sam.png">
                                <img data-u="image" src="assets/banners/hindi_sam.png" alt="Vishwa Hindi Sammelan">
                            </source></source></picture>

                    </a></div>




                    <div data-p="225.00" style="display: none;">
                        <picture align="center">
                            <source type="image/webp" srcset="assets/banners/banner25.webp">
                            <source type="image/jpg" srcset="assets/banners/banner25.jpg">
                            <img data-u="image" src="assets/banners/banner25.jpg" alt="Swachata Pakwada at NIRM">
                        </source></source></picture>

                    </div>

                    <div data-p="225.00" style="display: none;">
                        <picture align="center">
                            <source type="image/webp" srcset="assets/banners/banner26.webp">
                            <source type="image/jpg" srcset="assets/banners/banner26.jpg">
                            <img data-u="image" src="assets/banners/banner26.jpg" alt="Swachata Pakwada at NIRM">
                        </source></source></picture>

                    </div>



                    <div data-p="225.00" style="display: none;">
                        <a href="https://rashtragaan.in/" target="_blank" rel="noopener noreferrer">
                            <picture>
                                <source type="image/webp" srcset="assets/banners/banner15.webp">
                                <source type="image/jpg" srcset="assets/banners/banner15.jpg">
                                <img data-u="image" src="assets/banners/banner15.jpg" alt="Rashtragana">
                            </source></source></picture>
                        </a>
                    </div>



                    <div data-p="225.00" style="display: none;">
                        <a href="https://www.cowin.gov.in/home" target="_blank" rel="noopener noreferrer">
                            <picture>
                                <source type="image/webp" srcset="assets/banners/banner14.webp">
                                <source type="image/jpg" srcset="assets/banners/banner14.jpg">
                                <img data-u="image" src="assets/banners/banner14.jpg" alt="Cowin Home Page">
                            </source></source></picture>

                        </a>
                    </div>


                    <div data-p="225.00" style="display: none;">

                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner1.webp">
                            <source type="image/jpg" srcset="assets/banners/banner1.jpg">
                            <img data-u="image" src="assets/banners/banner1.jpg" alt="NIRM-1">
                        </source></source></picture>

                    </div>

                    <div data-p="225.00" style="display: none;">

                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner2.webp">
                            <source type="image/jpg" srcset="assets/banners/banner2.jpg">
                            <img data-u="image" src="assets/banners/banner2.jpg" alt="NIRM-2">
                        </source></source></picture>

                    </div>
                    <div data-p="225.00" style="display: none;">
                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner3.webp">
                            <source type="image/jpg" srcset="assets/banners/banner3.jpg">
                            <img data-u="image" src="assets/banners/banner3.jpg" alt="NIRM-3">
                        </source></source></picture>

                    </div>
                    <div data-p="225.00" style="display: none;">
                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner4.webp">
                            <source type="image/jpg" srcset="assets/banners/banner4.jpg">
                            <img data-u="image" src="assets/banners/banner4.jpg" alt="NIRM-4">
                        </source></source></picture>

                    </div>
                    <div data-p="225.00" style="display: none;">
                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner5.webp">
                            <source type="image/jpg" srcset="assets/banners/banner5.jpg">
                            <img data-u="image" src="assets/banners/banner5.jpg" alt="NIRM-5">
                        </source></source></picture>

                    </div>

                    <div data-p="225.00" style="display: none;">
                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner6.webp">
                            <source type="image/jpg" srcset="assets/banners/banner6.jpg">
                            <img data-u="image" src="assets/banners/banner6.jpg" alt="NIRM-6">
                        </source></source></picture>

                    </div>

                    <div data-p="225.00" style="display: none;">
                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner7.webp">
                            <source type="image/jpg" srcset="assets/banners/banner7.jpg">
                            <img data-u="image" src="assets/banners/banner7.jpg" alt="NIRM-7">
                        </source></source></picture>

                    </div>

                    <div data-p="225.00" style="display: none;">
                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner8.webp">
                            <source type="image/jpg" srcset="assets/banners/banner8.jpg">
                            <img data-u="image" src="assets/banners/banner8.jpg" alt="NIRM-8">
                        </source></source></picture>

                    </div>

                    <div data-p="225.00" style="display: none;">
                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner9.webp">
                            <source type="image/jpg" srcset="assets/banners/banner9.jpg">
                            <img data-u="image" src="assets/banners/banner9.jpg" alt="NIRM-9">
                        </source></source></picture>

                    </div>

                    <div data-p="225.00" style="display: none;">
                        <img data-u="image" src="assets/banners/banner10.jpg">
                    </div>


                    <div data-p="225.00" style="display: none;">

                        <picture>
                            <source type="image/webp" srcset="assets/banners/banner11.webp">
                            <source type="image/jpg" srcset="assets/banners/banner11.jpg">
                            <img data-u="image" src="assets/banners/banner11.jpg" alt="NIRM-11">
                        </source></source></picture>

                    </div>
                    <div data-p="225.00" style="display: none;">

                        <a href="https://transformingindia.mygov.in/7-years/" target="_blank" rel="noopener noreferrer">

                            <picture>
                                <source type="image/webp" srcset="assets/banners/banner12.webp">
                                <source type="image/jpg" srcset="assets/banners/banner12.jpg">
                                <img data-u="image" src="assets/banners/banner12.jpg" alt="Transforming India">
                            </source></source></picture>
                        </a>
                    </div>
                </div>

                <!-- Arrow Navigator -->
                <span data-u="arrowleft" class="jssora22l" style="top:0px;left:12px;width:40px;height:58px;" data-autocenter="2"></span>
                <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span>
            </div>

            <div class="sectionWrapper">
                <div class="container">
                    <div class="row">
                        <div class="cell-8" style="padding-bottom:3%;">


                            <!-- Responsive Web Design start -->



                            <div class="fx">
                                <font color="#FF0000" size="4" face="sans-serif">
                                    <marquee behavior="scroll" direction="left" scrollamount="6" onmouseover="stop()" onmouseout="start()" onclick="window.open('nirm_lecture.php')"> <b>
                                            <font color="#0000FF" size="+2">NIRM successfully organised lecture series from March 2023 to August 2023 for Engineering students of Mining and Civil Engineering, to commemorate 75 Years of Indian Independence (Aazadi ka Amrut Mahotsav)</font>
                                        </b></marquee>
                                </font>

                                <h2 class="block-head">ABOUT NIRM</h2>
                                <p style="text-align:justify;">The National Institute of Rock Mechanics (NIRM), is an autonomous Research Institute under Ministry of Mines, Government of India. Set up in 1988 under Societies Act, 1860, NIRM has its Head Office (HO) at Bengaluru and Registered Office (RO) at Kolar Gold Fields in Karnataka.
                                    The Institute deals with field and laboratory investigations, basic and applied research, and solving complex problems in almost entire spectrum of Rock Mechanics and Rock Engineering related to Mining and Civil Engineering activities.
                                </p>
                            </div>
                            <!-- Responsive Web Design end -->
                            <a class="btn btn-default" href="about.php" style="    background-color: #053099 !important;">Read more</a>
                            <br>


                            <div class="cell-12 contact-form fx" data-animate="fadeInLeft" id="scrl">
                                <div id="pscroller1" class="pausescroller"></div>
                            </div>


                            <script type="text/javascript">
                                //new pausescroller(message_array, CSS_ID, pause_in_ms, slideeffect_in_ms)

                                var scroller1 = new pausescroller(pausecontent, "pscroller1", 2000, 1500)
                            </script>

                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="container">



                                <div class="cell-12 contact-form fx" data-animate="fadeInLeft" id="contact">

                                    <h2 class="block-head" style="margin-top:3%"> <strong> Lecture Series on Role of Rock Engineering in Nation Building </strong> </h2>

                                    <p style="text-align:justify;"> The National Institute of Rock Mechanics (NIRM) successfully organised a lecture series to commemorate the Azadi ka Amrit Mahotsav.
                                        The lecture series focused on the importance of rock engineering in the building of a nation. Lectures were delivered by a panel of experts from NIRM and also few experts from Industry and Academia.
                                        The lecture series was mainly intended for Engineering Students of Mining and Civil discipline. More than 4000 students and faculty attended the 8 Events conducted at various Engineering Colleges as part of AKAM celebration. The student community was hugely benefited by the lecture series.
                                    </p>

                                    <p style="font-size: 18px;">
                                        <strong> Click Here for more Details on the AKAM Lecture Series </strong>

                                        <b><a href="/nirm_lecture.php">NIRM Lecture Series</a></b>
                                        <br>
                                    </p>

                                </div>





                                <div class=" cell-12 contact-form fx" data-animate="fadeInLeft" id="contact">

                                                <h2 class="block-head" style="margin-top:3%"> <strong> The Mining Arena - Ministry of Mines Initiative </strong> </h2>

                                                <p style="text-align:justify;"> <strong>Hon'ble Minister of Mines, Shri. Pralhad Joshi </strong> launched <strong> The Mining Arena: </strong> at National Mines and Ministers' Conference held at Hyderabad.
                                                    It is a digital platform which provides an insight on Ministry of Mines and its attached bodies. The platform can be accessed at <strong><a href="https://theminingarena.in">(https://theminingarena.in)</a> </strong></p>

                                                <strong> The Mining Arena Link </strong>
                                                <b><a href="https://theminingarena.in">The Mining Arena</a></b>
                                                <br>

                                </div>




                                <div class="cell-12 contact-form fx" data-animate="fadeInLeft" id="contact">

                                    <h2 class="block-head" style="margin-top:3%"> <strong> Vidhi Sahitya Prakashan - Law Journals for Download </strong> </h2>

                                    <p style="text-align:justify;"> On the occassion of celebrations of <strong>Azadi Ka Amrit Mahotsav </strong> Vidhi Sahitya Prakashan has decided to make available to the public, all three law journals in Hindi on its portal <strong><a href="https://legislative.gov.in/vidhi-sahitya">(https://legislative.gov.in/vidhi-sahitya)</a> </strong> in pdf format only,free of cost
                                        for a period of 75 weeks till completion of <strong>Azadi Ka Amrit Mahotsav </strong> cleebration. </p>

                                    <strong> i) Vidhi Sahitya Prakashan Link: </strong>
                                    <b><a href="https://legislative.gov.in/vidhi-sahitya">Vidhi Sahitya Prakashan</a></b>
                                    <br>

                                    

                                </div>

                                <div class="cell-12 contact-form fx" data-animate="fadeInLeft" id="contact">

                                    <h2 class="block-head" style="margin-top:3%"> <strong> Culture Ministry launches a unique programme to celebrate Azadi ka Amrit Mahotsav on Independence Day this year </strong> </h2>

                                    <h3 class="block-head" style="margin-top:3%"> <strong> Sing National Anthem, record and upload your video on 'RASHTRAGAAN.IN </strong> </h3>

                                    <div class="cell-12 fx">
                                        Your browser does not support the &lt;video&gt; tag.
                                            <source src="assets/Video/Nirm-3.m4v"></source>
                                            
                                    </div>

                                </div>

                                <div class="cell-12 contact-form fx" data-animate="fadeInLeft" id="contact">

                                    <h2 class="block-head" style="margin-top:3%"><b>एनआईआरएम "आज़ादी का अमृत महोत्सव" मनाता है </b></h2>
                                    <h3 class="block-head" style="margin-top:3%"><b>NIRM Commemorates "AAZADI KA AMRUT MAHAOTSAV" </b></h3>

                                    <img alt="" src="assets/nirm75.jpg" width="360" height="240">

                                    <p style="text-align:justify;"> <span style="color:#0000FF">As a part of commemoration of 75 years of Indian Independence, (Aazadi ka Amrut Mahotsav) NIRM will be organising a series of Technical lectures starting from 12-March-2021. The schedule of the lectures and their link is given below</span> .


                                    </p><table border="1" width max>
                                        <col width="50">
                                        <col width="120">
                                        <col width="250">
                                        <col width="750">
                                        <col width="470">
                                        <col width="360">
                                        <col width="200">


                                        <thead>
                                            <tr>
                                                <th>Week</th>
                                                <th>Lecture No.</th>
                                                <th>Date</th>
                                                <th>Title of Lecture</th>
                                                <th>Speaker</th>
                                                <th>Department &amp; Organisation</th>
                                                <th>WebEx Link for Lecture </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>Lecture-01</td>
                                                <td>12-Mar-2021 15:00hrs</td>
                                                <td>Engineering Geophysics – GPR as NDE tool</td>
                                                <td>Dr.P C Jha, Scientist-F &amp; HOD, Engineering Geophysics</td>
                                                <td>Engineering Geophysics, NIRM</td>
                                                <td>Completed</td>
                                            </tr>

                                            <tr>
                                                <td>02</td>
                                                <td>Lecture-02</td>
                                                <td>19-Mar-2021 15:00hrs</td>
                                                <td>Engineering Geophysics – MASW for Compaction Studies</td>
                                                <td>Dr.B Butchi Babu, Scientist-E1</td>
                                                <td>Engineering Geophysics, NIRM</td>
                                                <td>Completed</td>
                                            </tr>

                                            <tr>
                                                <td>03</td>
                                                <td>Lecture-03</td>
                                                <td>26-Mar-2021 15:00hrs</td>
                                                <td>Engineering Geophysics - Tomography for defect mapping</td>
                                                <td>Dr.P C Jha, Scientist-F &amp; HOD, Engineering Geophysics</td>
                                                <td>Engineering Geophysics, NIRM</td>
                                                <td>Completed</td>
                                            </tr>

                                            <tr>
                                                <td>04</td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>02-Apr-2021 15:00hrs</td>
                                                <td>No Lecture Scheduled - Good Friday Holiday </td>
                                                <td>- </td>
                                                <td>- </td>
                                                <td>- </td>
                                            </tr>

                                            <tr>
                                                <td>05 </td>
                                                <td>Lecture-04</td>
                                                <td>09-Apr-2021 15:00hrs</td>
                                                <td>Engineering Geophysics - ERT for supplementary investigation </td>
                                                <td>Dr.B Butchi Babu, Scientist-E1</td>
                                                <td>Engineering Geophysics, NIRM </td>
                                                <td>Completed </td>
                                            </tr>

                                            <tr>
                                                <td>06 </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>16-Apr-2021 15:00hrs</td>
                                                <td>Engineering Geophysics – Cross-hole investigations </td>
                                                <td>Dr.Sandeep Nelliat, Scientist-E2</td>
                                                <td>Engineering Geophysics </td>
                                                <td> Lecture Cancelled as the Speaker turned Covid +ve </td>
                                            </tr>

                                            <tr>
                                                <td>07 </td>
                                                <td>Lecture-05</td>
                                                <td>23-Apr-2021 15:00hrs</td>
                                                <td>Armour Rock Blasting </td>
                                                <td>Mr.G Gopinath, Scientist-E1</td>
                                                <td>Rock Blasting and Excavation Engineering, NIRM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td>08 </td>
                                                <td>Lecture-06</td>
                                                <td>30-Apr-2021 15:00hrs</td>
                                                <td>Urban Blasting </td>
                                                <td>Mr.G C Naveen, Scientist-E1</td>
                                                <td>Rock Blasting and Excavation Engineering, NIRM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td>09 </td>
                                                <td>Lecture-07</td>
                                                <td>07-May-2021 15:00hrs</td>
                                                <td>Stability monitoring of gravity dams - Significance of Instrumentation </td>
                                                <td>Mrs. Praveena Das Jennifer, Scientist-E1</td>
                                                <td>Numerical Modelling, NIRM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td>10 </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>14-May-2021 15:00hrs</td>
                                                <td>Instrumentation in Blasting </td>
                                                <td>Mr. G Gopinath, Scientist-E1</td>
                                                <td>Rock Blasting and Excavation Engineering, NIRM </td>
                                                <td> Cancelled on Account of Holiday - Id Ul Fitr </td>
                                            </tr>

                                            <tr>
                                                <td>11 </td>
                                                <td>Lecture-08</td>
                                                <td>21-May-2021 15:00hrs</td>
                                                <td>Instrumentation in Blasting </td>
                                                <td>Mr.G Gopinath, Scientist-E1</td>
                                                <td>Rock Blasting and Excavation Engineering, NIRM </td>
                                                <td> Completed</td>
                                            </tr>

                                            <tr>
                                                <td>12 </td>
                                                <td>Lecture-09</td>
                                                <td>28-May-2021 15:00hrs</td>
                                                <td>Alternative to Blasting </td>
                                                <td>Mr.G C Naveen, Scientist-E1</td>
                                                <td>Rock Blasting and Excavation Engineering, NIRM </td>
                                                <td> Completed</td>
                                            </tr>

                                            <tr>
                                                <td>13 </td>
                                                <td>Lecture-10</td>
                                                <td>04-June-2021 15:00hrs </td>
                                                <td>Underground Damage Assessment </td>
                                                <td>Mr.R Balachander, Scientist-C</td>
                                                <td>Rock Blasting and Excavation Engineering, NIRM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 14 </td>
                                                <td>
                                                    <div align="center">--- </div>
                                                </td>
                                                <td> 11-June-2021 15:00hrs </td>
                                                <td> Crisis Management and SMP Through Digitalization <br> </td>
                                                <td> Mr. Deepak Vidyarthi, </td>
                                                <td> Executive Director, NMDC (Retd.)</td>
                                                <td> Postponed </td>
                                            </tr>

                                            <tr>
                                                <td> 15 </td>
                                                <td>Lecture-11</td>
                                                <td> 18-June-2021 15:00hrs </td>
                                                <td> Real time structural health monitoring of Tunnel </td>
                                                <td> Dr.Ajay Kumar Jha</td>
                                                <td> President, BioID GmbH, Germany </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 16 </td>
                                                <td>Lecture-12</td>
                                                <td> 25-June-2021 15:00hrs </td>
                                                <td> Execution &amp; Commissioning of 720 MW Mangdechhu Hydro Power Plant in Bhutan </td>
                                                <td> Mr.A K Mishra </td>
                                                <td> Managing Director, Mangdechhu Hydroelectric Project Authority, Bhutan</td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 17 </td>
                                                <td> Lecture-13</td>
                                                <td> 02-July-2021 15:00hrs </td>
                                                <td> Seismic Tomography and Crosshole Test as tools in Engineering Geophysics </td>
                                                <td> Dr.Sandeep Nelliat, Scientist-E2 </td>
                                                <td> Engineering Geophysics, NIRM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 18 </td>
                                                <td> Lecture-14 </td>
                                                <td> 09-July-2021 15:00hrs </td>
                                                <td> Geological and Geotechnical intricacies in Koteshwar Hydropower Project </td>
                                                <td> Mr.H L Arora </td>
                                                <td> Former Director(Technical), THDC India Ltd. </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 19 </td>
                                                <td> Lecture-15 </td>
                                                <td> 16-July-2021 15:00hrs </td>
                                                <td> Rock mass Classification of tropically weathered rocks </td>
                                                <td> Dr. Ramesh Bhatawdekar </td>
                                                <td> Director, Innovative Consultancy Research Pte. Ltd. Singapore </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 20 </td>
                                                <td> Lecture-16 </td>
                                                <td> 23-July-2021 15:00hrs </td>
                                                <td> How friction starts during Earthquake </td>
                                                <td> Dr. G L Manjunath </td>
                                                <td> Visiting Faculty, Energy Institute,Center of Rajiv Institute of Petroleum Technology Bengaluru </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 21 </td>
                                                <td> Lecture-17 </td>
                                                <!-- <td id = "blink"> <strong>  30-July-2021 16:30hrs </strong> </td> -->
                                                <td> 30-July-2021 16:30hrs </td>
                                                <td> Use and Application of Wipfrag4 – A Blast Fragmentation Analysis Software </td>
                                                <td> Mr. Thomas Palangio </td>
                                                <td> Chief Technical Officer at WipWare Inc. </td>
                                                <td> Completed</td>
                                            </tr>
                                            <tr>
                                                <td> 22 </td>
                                                <td> Lecture-18 </td>
                                                <!-- <td id = "blink"> <strong>  30-July-2021 16:30hrs </strong> </td> -->
                                                <td> 06-August-2021 15:00hrs </td>
                                                <td> Crisis Management and SMP Through Digitalization </td>
                                                <td> Mr.Deepak Vidyarthi </td>
                                                <td> Former Executive Director, NMDC </td>
                                                <td> Completed</td>
                                            </tr>
                                            <tr>
                                                <td> 23 </td>
                                                <td> Lecture-19 </td>
                                                <!-- <td id = "blink"> <strong>  30-July-2021 16:30hrs </strong> </td> -->
                                                <td> 13-August-2021 15:00hrs </td>
                                                <td> Ahead of its time: Uri Hydroelectric Project Stage-1 (480MW) </td>
                                                <td> Mr.Imarn Sayeed </td>
                                                <td> Former CGM Geotech, NHPC Ltd. </td>
                                                <td> Completed </td>
                                            </tr>
                                            <tr>
                                                <td>24</td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>20-August-2021</td>
                                                <td>No Lecture Scheduled - <span>Muharram Holiday </span></td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>25</td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>27-August-2021</td>
                                                <td>
                                                    <div align="center"><span>Lecture cancelled due to simultaneous official engagements </span></div>
                                                </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>
                                                    <div align="left"><span>to be scheduled next week </span></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> 26 </td>
                                                <td> Lecture-20 </td>

                                                <td> 03-September-2021 15:00hrs </td>
                                                <td> Cyber security Threats in Mining Industries </td>
                                                <td> Dr Padmavathi Ganapathi </td>
                                                <td> Professor, Department of Computer Science, Avinashilingam Institute for Home Science and Higher Education for Women, Coimbatore </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 27</td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td> 10-September-2021 </td>
                                                <td> No Lecture Scheduled - <span>Ganesh Chaturthi Holiday </span> </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> 28 </td>
                                                <td> Lecture-21 </td>
                                                <td> 17-September-2021 15:00hrs </td>
                                                <td> Slope stability analysis and design by using numerical modelling tools </td>
                                                <td> Mr.BH Vijay Sekar </td>
                                                <td> Senior Scientist, NIRM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 29 </td>
                                                <td> Lecture-22 </td>
                                                <td> 24-September-2021 15:00hrs </td>
                                                <td> High precision tunnelling using automation in drilling </td>
                                                <td> Mr. Ankur Agarwal </td>
                                                <td> Underground Product &amp; Sales Support Lead – India, Epiroc Mining India Ltd.  </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 30 </td>
                                                <td> Lecture-23 </td>
                                                <td> 01-October-2021 15:00hrs </td>
                                                <td> Importance of Geotechnical &amp; Geodetic Instrumentation in Hydel Projects ~ A Case Study </td>
                                                <td> Mr.BNV Siva Prasad </td>
                                                <td> Scientist, NIRM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 31 </td>
                                                <td> Lecture-24 </td>
                                                <td> 08-October-2021 15:00hrs </td>
                                                <td> Engineering Rock Mass Classifications for Underground Structures and Foundations </td>
                                                <td> Dr. A. K. Naithani </td>
                                                <td> Senior Scientist, NIRM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 32</td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td> 15-October-2021 </td>
                                                <td> No Lecture Scheduled - <span>Vijay Dashami Holiday </span> </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> 33 </td>
                                                <td>
                                                    <div align="center">---</div>
                                                </td>

                                                <td> 22-October-2021 15:00hrs </td>
                                                <td> Study of Geotechnical Mechanism in Punatsangchhu-II DSG Cavern Failure </td>
                                                <td> Mr.Y K Sharma </td>
                                                <td> Ex-Member, Central Water Commission &amp; Former Director (Technical), Punatsangchhu-I &amp; II, Bhutan </td>
                                                <td> Lecture cancelled due to simultaneous official engagements </td>
                                            </tr>
                                            <tr>
                                                <td> 34 </td>
                                                <td> Lecture-25 </td>

                                                <td> 29-October-2021 15:00hrs </td>
                                                <td> Artificial Intelligence in Rock Engineering </td>
                                                <td> Prof. Pijush Samui  </td>
                                                <td> Associate Professor, Department of Civil Engineering, NIT, Patna </td>
                                                <td> Completed </td>
                                            </tr>


                                            <tr>
                                                <td> 35 </td>
                                                <td> Lecture-26 </td>
                                                <td> 12-November-2021 15:00hrs </td>
                                                <td> Benchmarking the Performance and Interactions of a Bulk Explosive using State of Art Techniques of QMR Australia </td>
                                                <td> Dr Gary Cavanough </td>
                                                <td> Director QMR Blasting Analysis, Australia </td>
                                                <td> Completed </td>
                                            </tr>
                                            <tr>
                                                <td> 36 </td>
                                                <td> Lecture-27 </td>
                                                <td> 03-December-2021 15:00hrs </td>
                                                <td> Active fault Studies in India: Some intriguing observations </td>
                                                <td> Dr.Biju John </td>
                                                <td> Senior Scientist, NIRM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 37 </td>
                                                <td> Lecture-28 </td>

                                                <td> 10-December-2021 15:00hrs.</td>
                                                <td> Explicit Technology from Ansys to simulate blast, Impact, and fragmentation </td>
                                                <td> Mrs. Neetu Jha </td>
                                                <td> Sr. Technical Engineer, Ansys </td>
                                                <td> Completed </td>
                                            </tr>


                                            <tr>
                                                <td> 38 </td>
                                                <td> Lecture-29 </td>

                                                <td> 07-January-2022 15:00hrs </td>
                                                <td> Rampur Agucha: A beacon of Systematic and Pro-active Approach </td>
                                                <td> Dr.Pramod Rajmeny  </td>
                                                <td> Former Vice President, Vedanta and Guest Faculty at MBM Engineering College </td>
                                                <td> Completed </td>
                                            </tr>
                                            <tr>
                                                <td> 39 </td>
                                                <td> Lecture-30 </td>

                                                <td> 21-January-2022 17:30hrs </td>
                                                <td> Design of Roof Bolting Plans for Underground Coal Mines: Some Recent Studies </td>
                                                <td> Prof. Yoginder P. Chugh </td>
                                                <td> Professor Emeritus, Southern Illinois University, Carbondale, USA </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 40 </td>
                                                <td> Lecture-31 </td>
                                                <td> 28-January-2022 15:00hrs </td>
                                                <td> Mine Planning and Scheduling of Open Cast Mine </td>
                                                <td> Mr.Suryanshu Choudhury </td>
                                                <td> Dy. GM Mine planning, Adani Enterprises Ltd. </td>
                                                <td> Completed </td>
                                            </tr>
                                            <tr>
                                                <td> 41 </td>
                                                <td> Lecture-32 </td>
                                                <td> 04-February-2022 15:00hrs </td>
                                                <td> Potential of Patal: Underground Space for decongestion of Urban areas </td>
                                                <td> Prof. Sanjay K. Shrama </td>
                                                <td> Professor, Department of Mining Engineering, IIT (BHU) </td>
                                                <td> Completed</td>
                                            </tr>

                                            <tr>
                                                <td> 42 </td>
                                                <td> Lecture-33 </td>
                                                <td> 11-February-2022 15:00hrs &gt; </td>
                                                <td> State of Ground stress, its uses and measurement in Rock Engineering </td>
                                                <td> Dr. D S Subrahmanyam </td>
                                                <td> Scientist-F, NIRM </td>
                                                <td> Completed </td>
                                            </tr>
                                            <tr>
                                                <td> 43 </td>
                                                <td> Lecture-34 </td>
                                                <td> 11-March-2022 15:00hrs </td>
                                                <td> Role of Rock Engineer in rock Dredging in Ports, with special reference to Under Water Blasting </td>
                                                <td> Prof. Vedala Rama Sastry </td>
                                                <td> Professor, Department of Mining Engineering, NITK Surathkal </td>
                                                <td> Completed </td>
                                            </tr>
                                            <tr>
                                                <td> 44 </td>
                                                <td> Lecture-35 </td>

                                                <td> 18-March-2022 15:00hrs </td>
                                                <td> Challenges in Underground Metro Construction </td>
                                                <td> Dr. N Kumar Pitchumani </td>
                                                <td> Regional Director, AECOM </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 45 </td>
                                                <td> Lecture-36 </td>

                                                <td> 01-April-2022 15:00hrs </td>
                                                <td> Rock Excavation Technology applied to Surface Mines, Tunnels and Sea Ports - Some Challenges and Solutions </td>
                                                <td> Prof. V.M.S.R.Murthy </td>
                                                <td> Professor, Department of Mining Engineering IIT (ISM), Dhanbad </td>
                                                <td> Completed </td>
                                            </tr>
                                            <tr>
                                                <td> 46 </td>
                                                <td> Lecture-37 </td>

                                                <td> 08-April-2022 15:00hrs </td>
                                                <td> Mineral Reserves Optimisation through Appropriate Geotechnical Engineering  </td>
                                                <td> Dr. A Srikant </td>
                                                <td> Director, Master Geotech Services Pvt. Ltd. </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 47 </td>
                                                <td> Lecture-38 </td>
                                                <td> 22-April-2022 15:00hrs </td>
                                                <td> Influence of Initiation System and Pattern on Blast Performance </td>
                                                <td> Dr. K. Ram Chandar </td>
                                                <td> Associate Professor, Department of Mining Engineering, NITK, Surathkal </td>
                                                <td> Completed </td>
                                            </tr>


                                            <tr>
                                                <td> 48 </td>
                                                <td> Lecture-39 </td>

                                                <td> 06-May-2022 15:00hrs </td>
                                                <td> Psychological Effects of Blasting Operations with Special Reference to Forest and Wildlife </td>
                                                <td> Dr. N. R. Thote </td>
                                                <td> Professor, Department of Mining Engineering, VNIT, Nagpur </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 49 </td>
                                                <td> Lecture-40 </td>

                                                <td> 13-May-2022 15:00hrs </td>
                                                <td> Engineering Geological and Geotechnical Aspects of Tehri Dam Project, Uttarakhand Himalaya </td>
                                                <td> Dr.P C Nawani </td>
                                                <td> Former Director, NIRM </td>
                                                <td> Completed</td>
                                            </tr>

                                            <tr>
                                                <td> 50 </td>
                                                <td> Lecture-41 </td>
                                                <td> 27-May-2022 15:00hrs </td>
                                                <td> Safety in Design </td>
                                                <td> Dr. Roshan Nair </td>
                                                <td> Principal Tunnels Engineer, Transportation Sector, Mott MacDonald, Australia </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 51 </td>
                                                <td> Lecture-42 </td>

                                                <td> 10-June-2022 15:00hrs </td>
                                                <td> Drone Technology - Digital Transformation in Mining &amp; Tunnelling </td>
                                                <td> Mr. Cyriac Joseph </td>
                                                <td> MD &amp; CEO, Squadrone Infra and Mining Pvt. Ltd., Bangalore </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 52 </td>
                                                <td> Lecture-43 </td>

                                                <td> 17-June-2022 15:00hrs </td>
                                                <td> Modern Approach to Rock Blasting Instrumentation thru "Blaster Artistic Kit" </td>
                                                <td> Mr. Jagdeepak Sharma </td>
                                                <td> CEO Ultra Enviro Systems Pvt. Ltd., New Delhi </td>
                                                <td> Completed </td>
                                            </tr>

                                            <tr>
                                                <td> 53 </td>
                                                <td> Lecture-44 </td>

                                                <td> 01-July-2022 15:00hrs </td>
                                                <td> Landslides vs Infrastructures in Hilly areas including Himalaya </td>
                                                <td> Dr. Kishore Kumar  </td>
                                                <td> Former Chief Scientist and Professor, CSIR-Central Road Research Institute, New Delhi </td>
                                                <td> Completed </td>
                                            </tr>

                                            <!--
                                            <tr>
                                                <td> <strong> 23 </strong> </td>
                                                <td> <strong> Lecture-19 </strong> </td>
                                                
                                                <td id="blink"> <strong> 13-August-2021 15:00hrs </strong> </td>
                                                <td> <strong> Ahead of its time: Uri Hydroelectric Project Stage-1 (480MW) </strong> </td>
                                                <td> <strong> Mr.Imarn Sayeed </strong> </td>
                                                <td> <strong> Former CGM Geotech, NHPC Ltd. </strong> </td>
                                                <td> <strong><a href="https://nirm.webex.com/nirm/j.php?MTID=me0aaa266f021c736dc68c9991ed96a0f">Webex Link</a></strong> </td>
                                            </tr>
                                            -->
                                        </tbody>
                                    </table>
                                </div>

                                <script type="text/javascript">
                                    document.addEventListener("DOMContentLoaded", () => {
                                        var blink = document.getElementById('blink');
                                        if (blink) {
                                            setInterval(function() {
                                                blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
                                            }, 1500);
                                        }
                                    });
                                </script>

                            </div>

                            <br>
                            <br>
                            <br>
                            <a href="https://diksha.gov.in/igot/" target="_blank"><img src="assets/logo2.JPG"></a>
                            <br>
                            <br>
                            <p style="text-align:justify;font-size:17px; color:blue"> <b> Download Ministry of Mines GOI, Advisory for COVID-2020 from the link:</b>
                                <b><a href="assets/pdf/COVID-2020-2.pdf" target="blank" style="color: red;"><b>COVID-2020</b></a>
                            </b></p>
                            <h3 class="block-head" style="margin-top:3%"><b>Shri Pralhad Joshi, Honorable Union Minister for Coal, Mines and Parliamentary Affairs,tweets about NIRM</b></h3>
                            <p style="text-align:justify;"> <span style="color:#0000FF">Shri Pralhad Joshi</span>, Honorable Union Minister for Coal, Mines and Parliamentary Affairs tweets about NIRM on 15th December 2020 and also commented on his facebook page.

                                <br>
                            </p><blockquote class="twitter-tweet">
                                <p lang="hi" dir="ltr">राष्ट्रीय शिला यांत्रिकी संस्थान खान मंत्रालय के अधीन एक स्वायत्त शोध संस्थान है। <br>रॉक मैकेनिक्स के लिए समर्पित यह दक्षिण एशिया का एकमात्र संस्थान है और अपने वैज्ञानिक अध्ययनों के जरिए खनन एवं निर्माण क्षेत्र को सुरक्षित तरीके से संसाधनों का समुचित उपयोग करने में सहयोग देता है।</p>— Pralhad Joshi (@JoshiPralhad) <a href="https://twitter.com/JoshiPralhad/status/1338818277229744128?ref_src=twsrc%5Etfw">December 15, 2020</a>
                            </blockquote>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                            <br>

                            <h4 style="color:#0000FF"> <mark>Facebook Link </mark>: <b><a href="https://www.facebook.com/story.php?story_fbid=3663925670331304&amp;id=641878655869369&amp;scmts=scwspsdd">Shri Pralhad Joshi about NIRM</a></b> </h4>

                            


                            <h3 class="block-head" style="margin-top:3%"><b>SATYABHMA Portal Ministry of Mines, GOI 2020 </b> </h3>
                            <p style="text-align:justify;"> <span style="color:#0000FF">Shri Pralhad Joshi</span>, Honorable Union Minister for Coal, Mines and Parliamentary Affairs launched <span style="color:#0000FF">SATYABHAMA</span> (Science and Technology Yojana for Aatmanirbhar Bharat in Mining Advancement) Portal for Science and Technology Programme Scheme of Ministry of Mines on 15th June 2020. The portal has been designed, developed and implemented by National Informatics Centre (NIC), Mines Informatics Division. <b>Shri Sushil Kumar</b>, Secretary, Ministry of Mines and other senior officials of the Ministry were also present.:
                                <br>
                                i) NEWS:
                                <b><a href="https://pib.gov.in/PressReleseDetailm.aspx?PRID=1632668">News</a></b>
                                <br>
                                ii)Link to SATYABHAMA Portal:

                                <b><a href="http://research.mines.gov.in/Default.aspx">SATYABHAMA Portal </a></b>
                            </p>


                        </div>

                        <!-- right devices image start -->
                        <div class="cell-4 fx">
                            <div class="padd-top-25 center" style="    padding-top: 62px;">

                                <picture>
                                    <source type="image/webp" srcset="assets/dir_nirm.webp">
                                    <source type="image/jpg" srcset="assets/dir_nirm.jpg">
                                    <img src="dir_nirm.jpg" alt="Director, NIRM">
                                </source></source></picture>

                                <h4 style="padding-top:2%;font-weight:bold;color:#000;">Dr. H.S. Venkatesh, Director, NIRM</h4>
                            </div>


                        </div>
                    </div>
                </div>

            </div>




            <!-- right devices image end -->

            <!-- Responsive Design end -->

            <!-- FUN Staff start -->
            <div class="fun-staff staff-1 block-bg-2 sectionWrapper" style="    background: #1D1D1D;    padding: 7px 10px; ">
                <div class="container">
                    <div class="row" style="padding-top:3%;">
                        <div class="cell-4">
                            <div class="widget widget-address">
                                <h2 style="color:#fff;font-family:inherit;font-weight:500;">Head Office</h2>
                                <p style="color:#fff;"><b>National Institute of Rock Mechanics</b><br> Eshwar Nagar, Outer Ring Road, Banashankari 2nd Stage
                                    Bengaluru - 560 070 Karnataka, India</p>
                                <p style="color:#fff;"><i class="fa fa-phone-square" aria-hidden="true" style="color:#fff;font-size: 20px;"></i>   +91-80–2693 4402 / +91-80–2693 4414
                                    <br>
                                    <br><i class="fa fa-fax" aria-hidden="true" style="color:#fff;font-size: 20px;"></i>   +91-80-26934401
                                    <br>
                                    <br><i class="fa fa-envelope-square" aria-hidden="true" style="color:#fff;font-size: 20px;"></i>   dto@nirm.in
                                </p>
                            </div>
                        </div>
                        <div class="cell-4">
                            <div class="widget widget-address">
                                <h2 style="color:#fff;font-family:inherit;font-weight:500;">Registered Office</h2>
                                <p style="color:#fff;"><b>National Institute of Rock Mechanics</b> Champion Reefs Kolar Gold Fields- 563 117 Karnataka, INDIA</p>
                                <p style="color:#fff;"><i class="fa fa-phone-square" aria-hidden="true" style="color:#fff;font-size: 20px;"></i>   +91-8153-275000
                                    <br>
                                    <br><i class="fa fa-fax" aria-hidden="true" style="color:#fff;font-size: 20px;"></i>   +91-8153-275002
                                    <br>
                                    <br><i class="fa fa-envelope-square" aria-hidden="true" style="color:#fff;font-size: 20px;"></i>   dto@nirm.in
                                </p>

                            </div>
                        </div>
                        <div class="cell-4">
                            <div class="widget widget-address">
                                <h2 style="color:#fff;font-family:inherit;font-weight:500;">Activities &amp; Initiatives</h2>

                                <p style="color:#fff;">
                                    <i class="fa fa-user" aria-hidden="true" style="color:#fff;font-size: 20px;"></i>   Director:<br>     Dr.H. S. Venkatesh     +91-80-26934400 / + 91-80-26934402
                                    <br>
                                    <br>
                                    <i class="fa fa-user" aria-hidden="true" style="color:#fff;font-size: 20px;"></i>   Project Monitoring Cell    +91-80-26934413 / + 91-9611785711
                                    <br>
                                    <br>
                                    <i class="fa fa-user" aria-hidden="true" style="color:#fff;font-size: 20px;"></i>   Controller of Adminstration: Dr. Sandeep Nelliat     +91-80-26934403 / +91-9481826252
                                </p>

                                <a href="https://india.gov.in" target="_blank"><img src="assets/logo1.png"></a>


                            </div>
                        </div>

                    </div>
                    <!-- staff item end -->

                </div>
                <!-- .container end -->
            </div>
            <!-- .funn-staff end -->

        </div>
@endsection