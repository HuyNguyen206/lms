<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <title>EduCore - Online Courses & Education HTML Template</title>
    @include('frontend.partials.css')
</head>

<body class="home_3">


<!--============ PRELOADER START ===========-->
<div id="preloader">
    <div class="preloader_icon">
        <img src="{{asset('assets/images/preloader.png')}}" alt="Preloader" class="img-fluid">
    </div>
</div>
<!--============ PRELOADER START ===========-->


<!--===========================
    SIGN IN START
============================-->
<section class="wsus__sign_in">
    <div class="row align-items-center">
        <div class="col-xxl-5 col-xl-6 col-lg-6 wow fadeInLeft">
            <div class="wsus__sign_img">
                <img src="{{asset('assets/images/login_img_1.jpg')}}" alt="login" class="img-fluid">
                <a href="index.html">
                    <img src="{{asset('assets/images/logo.png')}}" alt="EduCore" class="img-fluid">
                </a>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-9 m-auto wow fadeInRight">
            <div class="wsus__sign_form_area">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Student</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Instructor</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab" tabindex="0">
                        <form action="#">
                            <h2>Log in<span>!</span></h2>
                            <p class="new_user">New User ? <a href="sign_up.html">Create an Account</a></p>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Email or Username*</label>
                                        <input type="text" placeholder="Email or Username">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Password* <a href="#">Forgot Password?</a></label>
                                        <input type="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Remember Me
                                            </label>
                                        </div>
                                        <button type="submit" class="common_btn">Sign In</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="or">or</p>
                        <ul class="social_login d-flex flex-wrap">
                            <li>
                                <a href="#">
                                    <span><img src="images/google_icon.png" alt="Google" class="img-fluid"></span>
                                    Google
                                </a>
                            </li>
                        </ul>
                        <p class="create_account">Don't have an account? <a href="sign_up.html">Create free
                                account</a></p>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                         aria-labelledby="pills-profile-tab" tabindex="0">
                        <form action="#">
                            <h2>Log in<span>!</span></h2>
                            <p class="new_user">New User ? <a href="sign_up.html">Create an Account</a></p>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Email or Username*</label>
                                        <input type="text" placeholder="Email or Username">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Email or Username* <a href="#">Forgot Password?</a></label>
                                        <input type="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="flexCheckDefault1">
                                            <label class="form-check-label" for="flexCheckDefault1">
                                                Remember Me
                                            </label>
                                        </div>
                                        <button type="submit" class="common_btn">Sign In</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="or">or</p>
                        <ul class="social_login d-flex flex-wrap">
                            <li>
                                <a href="#">
                                    <span><img src="images/google_icon.png" alt="Google" class="img-fluid"></span>
                                    Google
                                </a>
                            </li>
                        </ul>
                        <p class="create_account">Don't have an account? <a href="sign_up.html">Create free
                                account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="back_btn" href="index.html">Back to Home</a>
</section>
<!--===========================
    SIGN IN END
============================-->


<!--================================
    SCROLL BUTTON START
=================================-->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!--================================
    SCROLL BUTTON END
=================================-->


@include('frontend.partials.js')


</body>

</html>
