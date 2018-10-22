@extends('layouts.app')

@section('content')
    <!-- Titlebar
================================================== -->
    <div class="single-page-header freelancer-header" data-background-image="images/single-freelancer.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner">
                        <div class="left-side">
                            <div class="header-image freelancer-avatar"><img src="images/user-avatar-big-02.jpg" alt=""></div>
                            <div class="header-details">
                                <h3>David Peterson <span>iOS Expert + Node Dev</span></h3>
                                <ul>
                                    <li><div class="star-rating" data-rating="5.0"></div></li>
                                    <li><img class="flag" src="images/flags/de.svg" alt=""> Germany</li>
                                    <li><div class="verified-badge-with-title">Verified</div></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Page Content
    ================================================== -->
    <div class="container">
        <div class="row">

            <div class="col-xl-8 col-lg-8 content-right-offset">
                <!-- Boxed List -->
                <div class="boxed-list margin-bottom-60">
                    <div class="boxed-list-headline">
                        <h3><i class="icon-material-outline-business"></i> Employment History</h3>
                    </div>
                    <ul class="boxed-list-ul">
                        <li>
                            <div class="boxed-list-item">
                                <!-- Avatar -->
                                <div class="item-image">
                                    <img src="images/browse-companies-03.png" alt="">
                                </div>

                                <!-- Content -->
                                <div class="item-content">
                                    <h4>Development Team Leader</h4>
                                    <div class="item-details margin-top-7">
                                        <div class="detail-item"><a href="#"><i class="icon-material-outline-business"></i> Acodia</a></div>
                                        <div class="detail-item"><i class="icon-material-outline-date-range"></i> May 2018 - Present</div>
                                    </div>
                                    <div class="item-description">
                                        <p>Focus the team on the tasks at hand or the internal and external customer requirements.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="boxed-list-item">
                                <!-- Avatar -->
                                <div class="item-image">
                                    <img src="images/browse-companies-04.png" alt="">
                                </div>

                                <!-- Content -->
                                <div class="item-content">
                                    <h4><a href="#">Lead UX/UI Designer</a></h4>
                                    <div class="item-details margin-top-7">
                                        <div class="detail-item"><a href="#"><i class="icon-material-outline-business"></i> Acorta</a></div>
                                        <div class="detail-item"><i class="icon-material-outline-date-range"></i> April 2014 - May 2018</div>
                                    </div>
                                    <div class="item-description">
                                        <p>I designed and implemented 10+ custom web-based CRMs, workflow systems, payment solutions and mobile apps.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Boxed List / End -->
            </div>


            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-4">
                <div class="sidebar-container margin-top-10">

                    <!-- Profile Overview -->
                    <div class="profile-overview">
                        <div class="overview-item"><strong>$35</strong><span>Hourly Rate</span></div>
                        <div class="overview-item"><strong>53</strong><span>Jobs Done</span></div>
                        <div class="overview-item"><strong>22</strong><span>Rehired</span></div>
                    </div>

                    <!-- Button -->
                    <a href="#small-dialog" class="apply-now-button popup-with-zoom-anim margin-bottom-50">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></a>

                    <!-- Widget -->
                    <div class="sidebar-widget">
                        <h3>Platforms</h3>
                        <div class="task-tags">
                            <span>iOS</span>
                            <span>Android</span>
                            <span>mobile apps</span>
                            <span>design</span>
                            <span>Python</span>
                            <span>Flask</span>
                            <span>PHP</span>
                            <span>WordPress</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="col-xl-12 col-lg-12 content-right-offset">
                <!-- Boxed List -->
                <div class="boxed-list margin-bottom-60">
                    <div class="boxed-list-headline">
                        <h3><i class="icon-material-outline-thumb-up"></i> Work History and Feedback</h3>
                    </div>
                    <ul class="boxed-list-ul">
                        <li>
                            <div class="boxed-list-item">
                                <!-- Content -->
                                <div class="item-content">
                                    <h4>Web, Database and API Developer <span>Rated as Freelancer</span></h4>
                                    <div class="item-details margin-top-10">
                                        <div class="star-rating" data-rating="5.0"></div>
                                        <div class="detail-item"><i class="icon-material-outline-date-range"></i> August 2018</div>
                                    </div>
                                    <div class="item-description">
                                        <p>Excellent programmer - fully carried out my project in a very professional manner. </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="boxed-list-item">
                                <!-- Content -->
                                <div class="item-content">
                                    <h4>WordPress Theme Installation <span>Rated as Freelancer</span></h4>
                                    <div class="item-details margin-top-10">
                                        <div class="star-rating" data-rating="5.0"></div>
                                        <div class="detail-item"><i class="icon-material-outline-date-range"></i> June 2018</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="boxed-list-item">
                                <!-- Content -->
                                <div class="item-content">
                                    <h4>Fix Python Selenium Code <span>Rated as Employer</span></h4>
                                    <div class="item-details margin-top-10">
                                        <div class="star-rating" data-rating="5.0"></div>
                                        <div class="detail-item"><i class="icon-material-outline-date-range"></i> May 2018</div>
                                    </div>
                                    <div class="item-description">
                                        <p>I was extremely impressed with the quality of work AND how quickly he got it done. He then offered to help with another side part of the project that we didn't even think about originally.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="boxed-list-item">
                                <!-- Content -->
                                <div class="item-content">
                                    <h4>PHP Core Website Fixes <span>Rated as Freelancer</span></h4>
                                    <div class="item-details margin-top-10">
                                        <div class="star-rating" data-rating="5.0"></div>
                                        <div class="detail-item"><i class="icon-material-outline-date-range"></i> May 2018</div>
                                    </div>
                                    <div class="item-description">
                                        <p>Awesome work, definitely will rehire. Poject was completed not only with the requirements, but on time, within our small budget.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <!-- Pagination -->
                    <div class="clearfix"></div>
                    <div class="pagination-container margin-top-40 margin-bottom-10">
                        <nav class="pagination">
                            <ul>
                                <li><a href="#" class="ripple-effect current-page">1</a></li>
                                <li><a href="#" class="ripple-effect">2</a></li>
                                <li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Pagination / End -->

                </div>
                <!-- Boxed List / End -->

            </div>

        </div>
    </div>


    <!-- Spacer -->
    <div class="margin-top-15"></div>
    <!-- Spacer / End-->

@endsection