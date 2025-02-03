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
                        <form action="{{route('password.email')}}" method="post">
                            @csrf
                            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Email</label>
                                        <input type="text" placeholder="Email or Username" type="email" name="email"
                                               value="{{old('email')}}" required autofocus>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2"
                                                       style="color: red"/>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <button type="submit" class="common_btn">Email Password Reset Link</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

