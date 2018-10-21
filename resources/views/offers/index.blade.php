@extends('layouts.app')

@section('content')
    <!-- Spacer -->
    <div class="margin-top-90"></div>
    <!-- Spacer / End-->

    <!-- Page Content
    ================================================== -->
    <div class="container gray">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="sidebar-container">

                    <!-- Location -->
                    <div class="sidebar-widget">
                        <h3>Location</h3>
                        <div class="input-with-icon">
                            <div id="autocomplete-container">
                                <input id="autocomplete-input" type="text" placeholder="Location">
                            </div>
                            <i class="icon-material-outline-location-on"></i>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="sidebar-widget">
                        <h3>Category</h3>
                        <select class="selectpicker default" multiple data-selected-text-format="count" data-size="7" title="All Categories" >
                            <option>Admin Support</option>
                            <option>Customer Service</option>
                            <option>Data Analytics</option>
                            <option>Design & Creative</option>
                            <option>Legal</option>
                            <option>Software Developing</option>
                            <option>IT & Networking</option>
                            <option>Writing</option>
                            <option>Translation</option>
                            <option>Sales & Marketing</option>
                        </select>
                    </div>

                    <!-- Keywords -->
                    <div class="sidebar-widget">
                        <h3>Keywords</h3>
                        <div class="keywords-container">
                            <div class="keyword-input-container">
                                <input type="text" class="keyword-input" placeholder="e.g. task title"/>
                                <button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
                            </div>
                            <div class="keywords-list"><!-- keywords go here --></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <!-- Hourly Rate -->
                    <div class="sidebar-widget">
                        <h3>Hourly Rate</h3>
                        <div class="margin-top-55"></div>

                        <!-- Range Slider -->
                        <input class="range-slider" type="text" value="" data-slider-currency="$" data-slider-min="10" data-slider-max="250" data-slider-step="5" data-slider-value="[10,250]"/>
                    </div>

                    <!-- Tags -->
                    <div class="sidebar-widget">
                        <h3>Skills</h3>

                        <div class="tags-container">
                            <div class="tag">
                                <input type="checkbox" id="tag1"/>
                                <label for="tag1">front-end dev</label>
                            </div>
                            <div class="tag">
                                <input type="checkbox" id="tag2"/>
                                <label for="tag2">angular</label>
                            </div>
                            <div class="tag">
                                <input type="checkbox" id="tag3"/>
                                <label for="tag3">react</label>
                            </div>
                            <div class="tag">
                                <input type="checkbox" id="tag4"/>
                                <label for="tag4">vue js</label>
                            </div>
                            <div class="tag">
                                <input type="checkbox" id="tag5"/>
                                <label for="tag5">web apps</label>
                            </div>
                            <div class="tag">
                                <input type="checkbox" id="tag6"/>
                                <label for="tag6">design</label>
                            </div>
                            <div class="tag">
                                <input type="checkbox" id="tag7"/>
                                <label for="tag7">wordpress</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <!-- More Skills -->
                        <div class="keywords-container margin-top-20">
                            <div class="keyword-input-container">
                                <input type="text" class="keyword-input" placeholder="add more skills"/>
                                <button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
                            </div>
                            <div class="keywords-list"><!-- keywords go here --></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="col-xl-9 col-lg-8 content-left-offset">

                <!-- Freelancers List Container -->
                <div class="freelancers-container freelancers-list-layout compact-list">

                    <!--Freelancer -->
                    <div class="freelancer">

                        <!-- Overview -->
                        <div class="freelancer-overview">
                            <div class="freelancer-overview-inner">

                                <!-- Bookmark Icon -->
                                <span class="bookmark-icon"></span>

                                <!-- Avatar -->
                                <div class="freelancer-avatar">
                                    <div class="verified-badge"></div>
                                    <a href="#small-dialog"><img src="images/user-avatar-big-01.jpg" alt=""></a>
                                </div>

                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">Tom Smith <img class="flag" src="images/flags/gb.svg" alt="" title="United Kingdom" data-tippy-placement="top"></a></h4>
                                    <span>UI/UX Designer</span>
                                    <!-- Rating -->
                                    <div class="freelancer-rating">
                                        <div class="star-rating" data-rating="4.9"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="freelancer-details">
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Location <strong><i class="icon-material-outline-location-on"></i> London</strong></li>
                                    <li>Rate <strong>$60 / hr</strong></li>
                                    <li>Job Success <strong>95%</strong></li>
                                </ul>
                            </div>
                            <a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon ripple-effect">Kup lub wymień <i class="icon-material-outline-arrow-right-alt"></i></a>
                        </div>
                    </div>
                    <!-- Freelancer / End -->

                    <!--Freelancer -->
                    <div class="freelancer">

                        <!-- Overview -->
                        <div class="freelancer-overview">
                            <div class="freelancer-overview-inner">

                                <!-- Bookmark Icon -->
                                <span class="bookmark-icon"></span>

                                <!-- Avatar -->
                                <div class="freelancer-avatar">
                                    <div class="verified-badge"></div>
                                    <a href="#small-dialog"><img src="images/user-avatar-big-02.jpg" alt=""></a>
                                </div>

                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">David Peterson <img class="flag" src="images/flags/de.svg" alt="" title="Germany" data-tippy-placement="top"></a></h4>
                                    <span>iOS Expert + Node Dev</span>
                                    <!-- Rating -->
                                    <div class="freelancer-rating">
                                        <div class="star-rating" data-rating="4.2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="freelancer-details">
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Location <strong><i class="icon-material-outline-location-on"></i> Berlin</strong></li>
                                    <li>Rate <strong>$40 / hr</strong></li>
                                    <li>Job Success <strong>88%</strong></li>
                                </ul>
                            </div>
                            <a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon ripple-effect">Kup lub wymień <i class="icon-material-outline-arrow-right-alt"></i></a>
                        </div>
                    </div>
                    <!-- Freelancer / End -->

                    <!--Freelancer -->
                    <div class="freelancer">

                        <!-- Overview -->
                        <div class="freelancer-overview">
                            <div class="freelancer-overview-inner">
                                <!-- Bookmark Icon -->
                                <span class="bookmark-icon"></span>

                                <!-- Avatar -->
                                <div class="freelancer-avatar">
                                    <a href="#small-dialog"><img src="images/user-avatar-placeholder.png" alt=""></a>
                                </div>

                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">Marcin Kowalski <img class="flag" src="images/flags/pl.svg" alt="" title="Poland" data-tippy-placement="top"></a></h4>
                                    <span>Front-End Developer</span>
                                    <!-- Rating -->
                                    <span class="company-not-rated margin-bottom-5">Minimum of 3 votes required</span>
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="freelancer-details">
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Location <strong><i class="icon-material-outline-location-on"></i> Warsaw</strong></li>
                                    <li>Rate <strong>$50 / hr</strong></li>
                                    <li>Job Success <strong>100%</strong></li>
                                </ul>
                            </div>
                            <a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon ripple-effect">Kup lub wymień <i class="icon-material-outline-arrow-right-alt"></i></a>
                        </div>
                    </div>
                    <!-- Freelancer / End -->

                    <!--Freelancer -->
                    <div class="freelancer">

                        <!-- Overview -->
                        <div class="freelancer-overview">
                            <div class="freelancer-overview-inner">
                                <!-- Bookmark Icon -->
                                <span class="bookmark-icon"></span>

                                <!-- Avatar -->
                                <div class="freelancer-avatar">
                                    <div class="verified-badge"></div>
                                    <a href="#small-dialog"><img src="images/user-avatar-big-03.jpg" alt=""></a>
                                </div>

                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">Sindy Forest <img class="flag" src="images/flags/au.svg" alt="" title="Australia" data-tippy-placement="top"></a></h4>
                                    <span>Magento Certified Developer</span>
                                    <!-- Rating -->
                                    <div class="freelancer-rating">
                                        <div class="star-rating" data-rating="5.0"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="freelancer-details">
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Location <strong><i class="icon-material-outline-location-on"></i> Brisbane</strong></li>
                                    <li>Rate <strong>$70 / hr</strong></li>
                                    <li>Job Success <strong>100%</strong></li>
                                </ul>
                            </div>
                            <a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon ripple-effect">Kup lub wymień <i class="icon-material-outline-arrow-right-alt"></i></a>
                        </div>
                    </div>
                    <!-- Freelancer / End -->

                    <!--Freelancer -->
                    <div class="freelancer">

                        <!-- Overview -->
                        <div class="freelancer-overview">
                            <div class="freelancer-overview-inner">
                                <!-- Bookmark Icon -->
                                <span class="bookmark-icon"></span>

                                <!-- Avatar -->
                                <div class="freelancer-avatar">
                                    <a href="#small-dialog"><img src="images/user-avatar-placeholder.png" alt=""></a>
                                </div>

                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">Sebastiano Piccio <img class="flag" src="images/flags/it.svg" alt="" title="Italy" data-tippy-placement="top"></a></h4>
                                    <span>Laravel Dev</span>
                                    <!-- Rating -->
                                    <div class="freelancer-rating">
                                        <div class="star-rating" data-rating="4.5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="freelancer-details">
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Location <strong><i class="icon-material-outline-location-on"></i> Milan</strong></li>
                                    <li>Rate <strong>$80 / hr</strong></li>
                                    <li>Job Success <strong>89%</strong></li>
                                </ul>
                            </div>
                            <a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon ripple-effect">Kup lub wymień <i class="icon-material-outline-arrow-right-alt"></i></a>
                        </div>
                    </div>
                    <!-- Freelancer / End -->


                </div>
                <!-- Freelancers Container / End -->


                <!-- Pagination -->
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Pagination -->
                        <div class="pagination-container margin-top-40 margin-bottom-60">
                            <nav class="pagination">
                                <ul>
                                    <li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
                                    <li><a href="#" class="ripple-effect">1</a></li>
                                    <li><a href="#" class="current-page ripple-effect">2</a></li>
                                    <li><a href="#" class="ripple-effect">3</a></li>
                                    <li><a href="#" class="ripple-effect">4</a></li>
                                    <li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Pagination / End -->

            </div>
        </div>
    </div>

    <div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
            </ul>

            <div class="popup-tabs-container">

                <!-- Tab -->
                <div class="popup-tab-content" id="tab">
                    <button class="button full-width button-sliding-icon ripple-effect margin-top-0" type="submit" form="send-pm">
                        kup Call of Duty: Black Ops IIII za 93,90 zł <i class="icon-material-outline-arrow-right-alt"></i>
                    </button>

                    <!-- Welcome Text -->
                    <div class="welcome-text margin-top-20">
                        <h3>lub</h3>
                    </div>

                    <!-- Form -->
                    <form method="post" id="send-pm">
                        <textarea name="textarea" cols="5" rows="3" placeholder="Wiadomość" class="with-border" required></textarea>
                    </form>

                    <!-- Button -->
                    <button class="button button-sliding-icon ripple-effect" type="submit" form="send-pm">wymień się <i class="icon-material-outline-arrow-right-alt"></i></button>

                </div>

            </div>
        </div>
    </div>
@endsection