@extends('frontend.layouts.app')
@section('content')

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
                    <div class="" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab" tabindex="0">
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <h2>Log in<span>!</span></h2>
                            <p class="new_user">New User ? <a href="{{route('register')}}">Create an Account</a></p>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Email or Username*</label>
                                        <input type="text" placeholder="Email or Username" name="email">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Password* <a href="{{route('password.request')}}">Forgot Password?</a></label>
                                        <input type="password" placeholder="Password" name="password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" name="remember"
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
                        <p class="create_account">Don't have an account? <a href="{{route('register')}}">Create free
                                account</a></p>
                    </div>
            </div>
        </div>
    </div>
    <a class="back_btn" href="index.html">Back to Home</a>
</section>
<!--===========================
    SIGN IN END
============================-->

@endsection
