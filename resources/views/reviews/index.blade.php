@extends('layouts.app')

@section('content')
    <!-- Dashboard Container -->
    <div class="dashboard-container">

        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container" data-simplebar>
            <div class="container">
                <div class="dashboard-content-inner" >

                    <!-- Dashboard Headline -->
                    <div class="dashboard-headline">
                        <h3>Reviews</h3>

                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs" class="dark">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Dashboard</a></li>
                                <li>Reviews</li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Row -->
                    <div class="row">

                        <!-- Dashboard Box -->
                        <div class="col-xl-6">
                            <div class="dashboard-box margin-top-0">

                                <!-- Headline -->
                                <div class="headline">
                                    <h3><i class="icon-material-outline-business"></i> Rate Employers</h3>
                                </div>

                                <div class="content">
                                    <ul class="dashboard-box-list">
                                        <li>
                                            <div class="boxed-list-item">
                                                <!-- Content -->
                                                <div class="item-content">
                                                    <h4>Simple Chrome Extension</h4>
                                                    <span class="company-not-rated margin-bottom-5">Not Rated</span>
                                                </div>
                                            </div>

                                            <a href="#small-dialog-2" class="popup-with-zoom-anim button ripple-effect margin-top-5 margin-bottom-10"><i class="icon-material-outline-thumb-up"></i> Leave a Review</a>
                                        </li>
                                        <li>
                                            <div class="boxed-list-item">
                                                <!-- Content -->
                                                <div class="item-content">
                                                    <h4>Adsense Expert</h4>
                                                    <span class="company-not-rated margin-bottom-5">Not Rated</span>
                                                </div>
                                            </div>

                                            <a href="#small-dialog-2" class="popup-with-zoom-anim button ripple-effect margin-top-5 margin-bottom-10"><i class="icon-material-outline-thumb-up"></i> Leave a Review</a>
                                        </li>
                                        <li>
                                            <div class="boxed-list-item">
                                                <!-- Content -->
                                                <div class="item-content">
                                                    <h4>Fix Python Selenium Code</h4>
                                                    <div class="item-details margin-top-10">
                                                        <div class="star-rating" data-rating="5.0"></div>
                                                        <div class="detail-item"><i class="icon-material-outline-date-range"></i> May 2018</div>
                                                    </div>
                                                    <div class="item-description">
                                                        <p>Great clarity in specification and communication. I got payment really fast. Really recommend this employer for his professionalism. I will work for him again with pleasure.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#small-dialog-1" class="popup-with-zoom-anim button gray ripple-effect margin-top-5 margin-bottom-10"><i class="icon-feather-edit"></i> Edit Review</a>
                                        </li>
                                        <li>
                                            <div class="boxed-list-item">
                                                <!-- Content -->
                                                <div class="item-content">
                                                    <h4>PHP Core Website Fixes</h4>
                                                    <div class="item-details margin-top-10">
                                                        <div class="star-rating" data-rating="5.0"></div>
                                                        <div class="detail-item"><i class="icon-material-outline-date-range"></i> May 2018</div>
                                                    </div>
                                                    <div class="item-description">
                                                        <p>Great clarity in specification and communication. I got payment really fast. Really recommend this employer for his professionalism. I will work for him again with pleasure.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#small-dialog-1" class="popup-with-zoom-anim button gray ripple-effect margin-top-5 margin-bottom-10"><i class="icon-feather-edit"></i> Edit Review</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div class="clearfix"></div>
                            <div class="pagination-container margin-top-40 margin-bottom-0">
                                <nav class="pagination">
                                    <ul>
                                        <li><a href="#" class="ripple-effect current-page">1</a></li>
                                        <li><a href="#" class="ripple-effect">2</a></li>
                                        <li><a href="#" class="ripple-effect">3</a></li>
                                        <li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="clearfix"></div>
                            <!-- Pagination / End -->

                        </div>

                        <!-- Dashboard Box -->
                        <div class="col-xl-6">
                            <div class="dashboard-box margin-top-0">

                                <!-- Headline -->
                                <div class="headline">
                                    <h3><i class="icon-material-outline-face"></i> Rate Freelancers</h3>
                                </div>

                                <div class="content">
                                    <ul class="dashboard-box-list">
                                        <li>
                                            <div class="boxed-list-item">
                                                <!-- Content -->
                                                <div class="item-content">
                                                    <h4>Simple Chrome Extension</h4>
                                                    <span class="company-not-rated margin-bottom-5">Not Rated</span>
                                                </div>
                                            </div>

                                            <a href="#small-dialog-2" class="popup-with-zoom-anim button ripple-effect margin-top-5 margin-bottom-10"><i class="icon-material-outline-thumb-up"></i> Leave a Review</a>
                                        </li>
                                        <li>
                                            <div class="boxed-list-item">
                                                <!-- Content -->
                                                <div class="item-content">
                                                    <h4>Help Fix Laravel PHP issue</h4>
                                                    <div class="item-details margin-top-10">
                                                        <div class="star-rating" data-rating="5.0"></div>
                                                        <div class="detail-item"><i class="icon-material-outline-date-range"></i> August 2018</div>
                                                    </div>
                                                    <div class="item-description">
                                                        <p>Excellent programmer - helped me fixing small issue.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#small-dialog-1" class="popup-with-zoom-anim button gray ripple-effect margin-top-5 margin-bottom-10"><i class="icon-feather-edit"></i> Edit Review</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Row / End -->

                    <!-- Footer -->
                    <div class="dashboard-footer-spacer"></div>
                    <div class="small-footer margin-top-15">
                        <div class="small-footer-copyrights">
                            © 2018 <strong>Hireo</strong>. All Rights Reserved.
                        </div>
                        <ul class="footer-social-links">
                            <li>
                                <a href="#" title="Facebook" data-tippy-placement="top">
                                    <i class="icon-brand-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Twitter" data-tippy-placement="top">
                                    <i class="icon-brand-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Google Plus" data-tippy-placement="top">
                                    <i class="icon-brand-google-plus-g"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="LinkedIn" data-tippy-placement="top">
                                    <i class="icon-brand-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Footer / End -->

                </div>
            </div>
        </div>
        <!-- Dashboard Content / End -->

    </div>
    <!-- Dashboard Container / End -->


    <!-- Edit Review Popup
    ================================================== -->
    <div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
            </ul>

            <div class="popup-tabs-container">

                <!-- Tab -->
                <div class="popup-tab-content" id="tab1">

                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>Change Review</h3>
                        <span>Rate <a href="#">Herman Ewout</a> for the project <a href="#">WordPress Theme Installation</a> </span>
                    </div>

                    <!-- Form -->
                    <form method="post" id="change-review-form">

                        <div class="feedback-yes-no">
                            <strong>Was this delivered on budget?</strong>
                            <div class="radio">
                                <input id="radio-rating-1" name="radio" type="radio" checked>
                                <label for="radio-rating-1"><span class="radio-label"></span> Yes</label>
                            </div>

                            <div class="radio">
                                <input id="radio-rating-2" name="radio" type="radio">
                                <label for="radio-rating-2"><span class="radio-label"></span> No</label>
                            </div>
                        </div>

                        <div class="feedback-yes-no">
                            <strong>Was this delivered on time?</strong>
                            <div class="radio">
                                <input id="radio-rating-3" name="radio2" type="radio" checked>
                                <label for="radio-rating-3"><span class="radio-label"></span> Yes</label>
                            </div>

                            <div class="radio">
                                <input id="radio-rating-4" name="radio2" type="radio">
                                <label for="radio-rating-4"><span class="radio-label"></span> No</label>
                            </div>
                        </div>

                        <div class="feedback-yes-no">
                            <strong>Your Rating</strong>
                            <div class="account-type margin-top-10">
                                <div>
                                    <input type="radio" name="account-type-radio" id="freelancer-radio" class="account-type-radio" checked/>
                                    <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Polecam</label>
                                </div>

                                <div>
                                    <input type="radio" name="account-type-radio" id="employer-radio" class="account-type-radio"/>
                                    <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Nie polecam</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <textarea class="with-border" placeholder="Comment" name="message" id="message" cols="7" required>Excellent programmer - helped me fixing small issue.</textarea>

                    </form>

                    <!-- Button -->
                    <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="change-review-form">Save Changes <i class="icon-material-outline-arrow-right-alt"></i></button>

                </div>

            </div>
        </div>
    </div>
    <!-- Edit Review Popup / End -->


    <!-- Leave a Review for Freelancer Popup
    ================================================== -->
    <div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
            </ul>

            <div class="popup-tabs-container">

                <!-- Tab -->
                <div class="popup-tab-content" id="tab2">

                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>Leave a Review</h3>
                        <span>Rate <a href="#">Peter Valentín</a> for the project <a href="#">Simple Chrome Extension</a> </span>
                    </div>

                    <!-- Form -->
                    <form method="post" id="leave-review-form">

                        <div class="feedback-yes-no">
                            <strong>Was this delivered on budget?</strong>
                            <div class="radio">
                                <input id="radio-1" name="radio" type="radio" required>
                                <label for="radio-1"><span class="radio-label"></span> Yes</label>
                            </div>

                            <div class="radio">
                                <input id="radio-2" name="radio" type="radio" required>
                                <label for="radio-2"><span class="radio-label"></span> No</label>
                            </div>
                        </div>

                        <div class="feedback-yes-no">
                            <strong>Was this delivered on time?</strong>
                            <div class="radio">
                                <input id="radio-3" name="radio2" type="radio" required>
                                <label for="radio-3"><span class="radio-label"></span> Yes</label>
                            </div>

                            <div class="radio">
                                <input id="radio-4" name="radio2" type="radio" required>
                                <label for="radio-4"><span class="radio-label"></span> No</label>
                            </div>
                        </div>

                        <div class="feedback-yes-no">
                            <strong>Your Rating</strong>
                            <div class="account-type margin-top-10">
                                <div>
                                    <input type="radio" name="account-type-radio" id="freelancer-radio" class="account-type-radio" checked/>
                                    <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Polecam</label>
                                </div>

                                <div>
                                    <input type="radio" name="account-type-radio" id="employer-radio" class="account-type-radio"/>
                                    <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Nie polecam</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <textarea class="with-border" placeholder="Comment" name="message2" id="message2" cols="7" required></textarea>

                    </form>

                    <!-- Button -->
                    <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="leave-review-form">Leave a Review <i class="icon-material-outline-arrow-right-alt"></i></button>

                </div>

            </div>
        </div>
    </div>
    <!-- Leave a Review Popup / End -->
@endsection